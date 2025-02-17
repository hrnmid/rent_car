<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Mobiltype;
use App\Models\Transaksi;
use App\Models\Mobil;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{


    //==============================================================================
    public function vindex(Request $request)
    {
        return view('booking.index');
    }
    public function vcreate(Request $request)
    {
        $post = new Transaksi();
        return view('booking.form', compact('post'));
    }
    // public function vedit(Request $request, $id)
    // {
    //     $post = Mobiltype::find($id);
    //     return view('mobiltype.form', compact('post'));
    // }
    public function vload(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $sortcolumn = $_GET['order'][0]['column'];
        $ordercolumn = $_GET['columns'][$sortcolumn]['data'];
        $columnorder = $_GET['order'][0]['dir'];

        ## Search 
        $filter = $request->get('search');
        $search = (isset($filter)) ? $filter : '';

        $filter = " WHERE 1=1 and A.is_active='1'";

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%' 
            or B.name like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT A.id,A.name
        FROM mobiltypes A";
        $sqlcount = "SELECT count(*) as allcount FROM (" . $sql . $filter . ") as temp ";

        $sqlall = $sql . $filter . " ORDER BY " . $ordercolumn . " " . $columnorder . " LIMIT " . $start . "," . $length;

        // echo $sqlall;
        // exit;
        $rows = DB::select($sqlall);
        $rowscount = DB::select($sqlcount);
        $totalRecordwithFilter = $rowscount[0]->allcount;
        $totalRecords = $rowscount[0]->allcount;

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $rows
        );
        return json_encode($response);
    }

    public function vstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'customer_ktp' => 'required',
            'customer_phone' => 'required',
            'customer_email' => 'required',
            'customer_address' => 'required',
            'customer_kecamatan' => 'required',
            'customer_kelurahan' => 'required',
            'customer_kodepos' => 'required',

            'mobil_name' => 'required',
            'mobil_merek' => 'required',
            'mobil_type' => 'required',
            'mobil_warna' => 'required',
            'mobil_noplat' => 'required',
            // 'customer_kecamatan' => 'required',
            // 'customer_kelurahan' => 'required',
            // 'customer_kodepos' => 'required',

            'booking_date' => 'required',
            'jenis_sewa' => 'required',
            'lama_sewa' => 'required',
            'booking_end' => 'required',
            'guarantee' => 'required',
            'payment_mode' => 'required',
            'booking_destination' => 'required',

            // 'invoice_no' => 'required',
            'invoice_date' => 'required',
            'invoice_due' => 'required',
            'total_biaya' => 'required',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data creation failed, Please check your input',
                    'errors' => $validator->getMessageBag()->toArray(),
                ], 200);
            } else {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }

        $input = $request->all();

        $input['is_active'] = true;
        $input['created_by'] = Auth::user()->id;

        // $country_id = $input['country'];
        $post = null;

        if ($request->id != '') {
            $post = Transaksi::find($request->id);
            // Set transaksi_no dengan format yang sesuai
            $post->update($input);
        } else {
            $post = Transaksi::create($input);

            // Set invoice_no dengan format yang benar
            $post->invoice_no = "INV-" . sprintf('%05d', $post->id);
            $post->transaksi_no = "NO-" . sprintf('%06d', $post->id);
            $post->save();
        }

        // Update status mobil menjadi 2 (tidak tersedia)
        if ($post->mobil_id) {
            $mobil = Mobil::find($post->mobil_id);
            if ($mobil) {
                $mobil->status = 2; // Ubah status menjadi 2 (tidak tersedia)
                $mobil->save();
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Mobil telah anda booking, silahkan membayar invoice',
                'data' => $post
            ], 200);
        } else {
            return redirect()->away('https://app.projecthree.my.id/mytransaksi/vdetailcus/' . $post->id);
        }
    }

    public function vdestroy($id)
    {
        $post = Mobiltype::find($id);
        $post->update(array('is_active' => false));
        return response()->json([
            'success' => true,
            'msg' => 'Data created successfully',
            'data' => $post
        ], 200);
    }
    public function getMobil($id)
    {
        $mobil = \App\Models\Mobil::find($id);

        if ($mobil) {
            return response()->json([
                'mobil_name' => $mobil->name,
                'mobil_merek' => $mobil->merek,
                'type' => $mobil->type, // Assuming the relation is type_id
                'mobil_warna' => $mobil->warna,
                'mobil_noplat' => $mobil->no_plat,
                'sewa_harian' => $mobil->sewa_harian,
                'sewa_mingguan' => $mobil->sewa_mingguan,
                'sewa_bulanan' => $mobil->sewa_bulanan,
            ]);
        }

        return response()->json(['message' => 'Mobil not found'], 404);
    }
    //==============================================================================
    
}
