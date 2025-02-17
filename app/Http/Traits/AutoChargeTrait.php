<?php

namespace App\Http\Traits;

use App\Models\ShippingCharges;
use App\Models\ShippingZone;
use App\Models\ShippingZoneLocation;
use App\Models\PreAlerts;
use App\Models\PreAlertsProducts;
use App\Models\VirtualAddress;
use App\Models\ShippingRate;
use App\Models\ShippingSubRate;
use App\Models\CurrencyConversion;
use App\Models\Gstvat;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

trait AutoChargeTrait
{
    public function AutoChargePrealert($request)
    {

        DB::beginTransaction();
        try {
            $input = $request;
            if ($input['replaceExistingCharges'] == 1 || $input['replaceExistingCharges'] == true) {

                //If Charges are being replaced then delete charges that existed before
                $existingCharges = ShippingCharges::where(array('pre_alert_id' => $input['pre_alert_id']))->get();
                foreach ($existingCharges as $chr) {
                    $chr->update(array('is_active' => false));
                }
            }

            //Get Prealert
            $prealert = PreAlerts::find($input['pre_alert_id']);
            $prealert['virtual_address'] = (object)[];
           
            if ($prealert->type == 1) {
                $virtualAddress = $prealert['virtual_address'] = VirtualAddress::find($prealert->shipping_address);
               
                $state = Country::where(array('name' => $virtualAddress['country']))->first();
                
                if (!$state) {
                    return array('success' => false, 'msg' => "Charges not found for designated location.");
                }
                $shippingZoneLocation = ShippingZoneLocation::where(array('shipping_zone_locations.country' => $state['name'], 'shipping_zones.is_active'=> true))->join('shipping_zones', 'shipping_zone_locations.shipping_zone_id', '=', 'shipping_zones.id')->select('shipping_zone_locations.*')->first();
            } else {
                //Sender Shipping Zone
                $shippingZoneLocation = ShippingZoneLocation::where(array('shipping_zone_locations.country' => $prealert['sender_country'], 'shipping_zones.is_active'=> true))->join('shipping_zones', 'shipping_zone_locations.shipping_zone_id', '=', 'shipping_zones.id')->select('shipping_zone_locations.*')->first();
                
                // ShippingZoneLocation::where(array('country' => $prealert['sender_country'], 'is_active' => true))->first();
            }
            if (!$shippingZoneLocation) {
                return array('success' => false, 'msg' => "Charges not found for designated location..");
            }

            $productstotal = PreAlertsProducts::where(array('pre_alert_id' => $input['pre_alert_id'], 'is_active' => true))->sum('total');

            // Get Zone
            $shippingZone = ShippingZone::find($shippingZoneLocation['shipping_zone_id']);
            $currency = CurrencyConversion::find($shippingZone['currency_id']);
            //Receiver Shipping Zone
            $ReceivershippingZoneLocation = ShippingZoneLocation::where(array('shipping_zone_locations.country' => $prealert['receiver_country'], 'shipping_zones.is_active'=> true))->join('shipping_zones', 'shipping_zone_locations.shipping_zone_id', '=', 'shipping_zones.id')->select('shipping_zone_locations.*')->first();
            
            // ShippingZoneLocation::where(array('country' => $prealert['receiver_country'], 'is_active' => true))->first();
            $ReceivershippingZone = ShippingZone::find($ReceivershippingZoneLocation['shipping_zone_id']);

            //Get RateList for Calculating Freight
            $RatewhereClause = array('origin' => $shippingZone['id'], 'destination' => $ReceivershippingZone['id'], 'rate_name' => "Freight", 'shipment_type' => "{$input['type']}", 'shipping_mode' => "{$input['mode']}", 'is_active' => true);
            $rate = ShippingRate::where($RatewhereClause)->orWhereRaw("(origin={$shippingZone['id']} and destination={$ReceivershippingZone['id']} and rate_name='Freight' and is_active=1 and ((ifnull(shipment_type,1)=1 and ifnull(shipping_mode,1)=1) or (shipment_type='{$input['type']}' and ifnull(shipping_mode,1)=1) or (ifnull(shipment_type,1)=1 and shipping_mode='{$input['mode']}')))")->first();
            if (!$rate) {
                return array('success' => false, 'msg' => "Charges not found for designated location...");
            }

            $rate = $this->CalculateFreight($rate, $input['weight'], $input['pre_alert_id']);
            if ($rate > 0) {
                ShippingCharges::create(array('pre_alert_id' => $input['pre_alert_id'], 'charge_type' => "Freight", 'fee' => $rate, 'is_active' => true));
            } else {
                return array('success' => false, 'msg' => "Charges not found for designated location....");
            }

            //GST Charges Calculation
            $this->CalculateGSTForSingaPore($currency, $productstotal, $input, $prealert);

            DB::commit();
            return array('success' => true, 'rate' => $shippingZoneLocation);
        } catch (\Exception $e) {
            return array('success' => false, 'message' => $e);
            DB::rollback();
        }
    }
    private function CalculateFreight($rate, $weight, $prealert_id)
    {
        $subrates = ShippingSubRate::where(array('is_active' => 1, 'shipping_rate_id' => $rate['id']))->get();
        $rate = 0;
        foreach ($subrates as $key => $subrate) {
            if ($subrate['rate_type'] == "per/each/weight") {
                if ($subrate['weight'] == $weight) {
                    $rate = $subrate['rate'];
                    break;
                }
            } else {
                $weightarray = explode('-', $subrate['weight']);
                if ($weightarray[0] <= $weight && $weightarray[1] >= $weight) {
                    $rate = $weight * $subrate['rate'];
                    break;
                }
            }
        }
        return $rate;
    }


    private function CalculateGSTForSingaPore($currency, $productstotal, $input, $prealert)
    {
        $gst = Gstvat::all()->first();
        $current_gst_value = 0;

        if($input['mode'] == "Truck"){
            $current_gst_value = $gst['truck_vat']/100;
        }else if ($input['mode'] == "Air"){
            $current_gst_value =$gst['air_vat']/100;
        }else{
            $current_gst_value =$gst['sea_vat']/100;
        }

        if ($currency && $productstotal > 0 && $input['mode'] == "Truck" && $prealert['receiver_state'] == 'Singapore') {
            $gstRate = ($productstotal * $currency['conversion_rate'] * 1.1) * $current_gst_value;
            $gstRate = round($gstRate, 2);
            ShippingCharges::create(array('pre_alert_id' => $input['pre_alert_id'], 'charge_type' => "GST", 'fee' => $gstRate, 'is_active' => true));
            return $gstRate;
        } else {
            return 0;
        }
    }
}
