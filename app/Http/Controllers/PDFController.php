<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreAlerts;
use App\Models\PreAlertsProducts;
use App\Models\ShipmentMessage;
use App\Models\VirtualAddress;
use App\Models\Container;
use App\Models\ShippingCharges;
use App\Models\ContainerShipment;
use App\Models\Country;

use App\Models\Transaksi;
use App\Models\User;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $container = Container::find($id);
        $container_shipment = ContainerShipment::where(array('containerid' => $id))->get();

        $type = "";

        if ($container['typeid'] == 1) {
            $type = "AIR";
        } else {
            $type = "TRUCK";
        }


        $data = [
            'type' => $type,
            'origin' => $container['origin'],
            'destination' => $container['destination'],
            'barcode' => $container['airwaybill'],
            'shipment_counts' => count($container_shipment),

        ];

        // return view('pdf');
        $pdf = PDF::loadView('pdf', $data);
        $pdf->setPaper(['0,0,283,425']);
        return $pdf->download('Master_Label.pdf');
    }

    //PROYEK TA
    public function invoices_rental($ids)
    {
        $id_arr = explode(",", $ids);
        $obj = [];

        foreach ($id_arr as $key => $val) {
            $transaksi = Transaksi::find($val);

            $obj[$key] = [
                "pa" => $transaksi,
            ];
        }

        $data = ['obj' => $obj];
        return view('invoices_rental', $data);
    }

    public function shipment_invoices($ids)
    {
        $id_arr = explode(",", $ids);
        foreach ($id_arr as $key => $val) {

            $locals = ['show_local' => false, 'amount' => 0, 'currency' => '', "acc" => []];

            $prealert = PreAlerts::find($val);
            $va[$key] = VirtualAddress::find($prealert->shipping_address);
            $products = PreAlertsProducts::where(array('pre_alert_id' => $val, 'is_active' => true))->get();
            $user = User::find($prealert->created_by);
            $origin_country = Country::find($user->country);
            $local_currency = $this->get_currency_by_ccode($origin_country->code);

            $fee = 0;
            $created_date = '';
            $charges = ShippingCharges::where(array('is_active' => 1, 'pre_alert_id' => $prealert['id']))->get();
            $total = 0;

            foreach ($charges as $ch) {
                if ($ch['charge_type'] == 'Freight') {
                    $fee = $ch['fee'];
                    $created_date = date('d-m-Y', strtotime($ch['created_at']));
                }

                $total = $total + $ch['fee'];
            }

            if ($origin_country->code != "SG") {
                $conversion = $this->convert_currency("SGD", $local_currency['currency'], $total);

                $locals['show_local'] = true;
                $locals['currency'] = $conversion['converted_currency'];
                $locals['amount'] = $conversion['converted_currency_amount'];
                $locals['acc'] = $local_currency['acc'];
            }

            $product_description_arr = [];
            $total_payment = 0;
            $weight_scale = "";
            $currency = "";
            foreach ($products as $p) {
                $total_payment += $p['total'];
                $weight_scale = $p['weight_scale'];
                $currency = $p['currency'];
                array_push($product_description_arr, $p['description']);
            }
            $obj[$key] = [
                "pa" => $prealert,
                "products" => $products,
                "va" => $va,
                "customer" => $user,
                "charge" => $fee,
                "total_payment" => $total_payment,
                "created_at" => $created_date,
                "product_descriptions" => implode(',', $product_description_arr),
                "weight_scale" => $weight_scale,
                'currecny' => $currency,
                'charges' => $charges,
                'total' => $total,
                'locals' => $locals
            ];
        }

        $data = ['obj' => $obj, 'charges' => $charges, 'total' => $total, "currecny" => $currency];
        return view('invoices_pdf', $data);
    }

    public function package_receipt($ids)
    {
        $id_arr = explode(",", $ids);
        foreach ($id_arr as $key => $val) {

            $prealert = PreAlerts::find($val);
            $va[$key] = VirtualAddress::find($prealert->shipping_address);
            $products = PreAlertsProducts::where(array('pre_alert_id' => $val, 'is_active' => true))->get();
            $user = User::find($prealert->created_by);
            $fee = 0;
            $created_date = '';
            $charges = ShippingCharges::where(array('is_active' => 1, 'pre_alert_id' => $prealert['id']))->get();
            foreach ($charges as $ch) {
                if ($ch['charge_type'] == 'Freight') {
                    $fee = $ch['fee'];
                    $created_date = date('d-m-Y', strtotime($ch['created_at']));
                }
            }

            $product_description_arr = [];
            $weight_scale = "";
            foreach ($products as $p) {
                array_push($product_description_arr, $p['description']);
                $weight_scale = $p['weight_scale'];
                $currency = $p['currency'];
            }

            $obj[$key] = [
                "pa" => $prealert,
                "products" => $products,
                "customer" => $user,
                "va" => $va,
                "charge" => $fee,
                "created_at" => $created_date,
                "product_descriptions" => implode(',', $product_description_arr),
                "weight_scale" => $weight_scale,
                "currency" => $currency
            ];
        }

        $data = ['obj' => $obj, 'charges' => $charges, "currecny" => $currency];
        return view('package_receipt', $data);
    }

    public function shipment_label($id)
    {
        $prealert = PreAlerts::find($id);
        $user = User::find($prealert->created_by);
        $va = VirtualAddress::find($prealert->shipping_address);
        $products = PreAlertsProducts::where(array('pre_alert_id' => $id, 'is_active' => true))->get();

        $weight = 0;
        foreach ($products as $ch) {
            $weight += $ch['final_weight'];
        }

        $type = "";
        if ($prealert['type'] == 1) {
            $type = "Air";
        } else {
            $type = "Truck";
        }

        $data = [
            'prealert' => $prealert,
            "customer" => $user,
            'va' => $va,
            'weight' => $weight,
            'type' => $type,
            'products' => $products,
            'boxes' => count($products),
            'unique_id' =>$user->unique_id
        ];
        //  return view('shipment_label', $data);
        $pdf = PDF::loadView('shipment_label', $data);
        $pdf->setPaper(['0,0,283,425']);
        return $pdf->stream($prealert['tracking_no'] . '.pdf');
    }

    function get_currency_by_ccode($code)
    {
        $currency = "";
        $account = [];
        if ($code == "MY") {
            $currency = "MYR";
            $account = ['label' => 'INDOBOX ASIA SDN BHD', 'bank_name' => 'CIMB - MYR', 'acc_name' => 'INDOBOX ASIA SDN BHD', 'acc_no' => '8605098235'];
        } else if ($code == "ID") {
            $currency = "IDR";
            $account = ['label' => 'PT INDOBOX ASIA JAYA', 'bank_name' => 'BRI - BANK RAKYAT INDONESIA', 'acc_name' => 'PT INDOBOX ASIA JAYA', 'acc_no' => '106201000421302'];
        } else {
            $currency = "SGD";
        }

        $arr = ['currency' => $currency, 'acc' => $account];
        return $arr;
    }
    
    public function convert_currency($from, $to, $amount)
    {
        $converted_amount = 0;
        if ($to == 'MYR') {
            $converted_amount = round(($amount * 3.5), 2);
        } else if ($to == 'IDR') {
            $converted_amount = round(($amount * 12000), 2);
        }

        $result =  ['converted_currency' => $to, 'converted_currency_amount' => $converted_amount];
        return $result;
        // $base_url = "https://xecdapi.xe.com/v1/";
        // $converterurl = "convert_from?";
        // $from = "from=" . $from;
        // $to = "&to=" . $to;
        // $amount = "&amount=" . $amount;
        // $url = $base_url . $converterurl . $from . $to . $amount;
        // $ch = curl_init($url);
        // $headers = array(
        //     'Content-Type: application/json',
        //     'Authorization: Basic aW5kb2JveGFzaWFwdGVsdGQ2Nzc3MTMyMDM6bmdnYnVvcHRncnIxaXY2cWxoc3MzM2R2OGw='
        // );
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // $response = curl_exec($ch);

        // $converted_currency = json_decode($response)->to[0]->quotecurrency;
        // $converted_currency_amount = json_decode($response)->to[0]->mid;

        // if (curl_errno($ch)) {
        //     // throw the an Exception.
        //     throw new Exception(curl_error($ch));
        // }

    }
}
