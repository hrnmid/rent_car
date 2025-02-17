<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Mobil;
use App\Models\AcSupportingDocs;
use App\Mail\AddUserMail;
use Illuminate\Support\Facades\Mail;
use Validator;

class TransaksiController extends Controller
{
    //==============================================================================
    // CUSTOMER
    public function vindexcus(Request $request)
    {
        return view('transaksi.indexcus');
    }
    public function vdetailcus(Request $request, $id)
    {
        $post = Transaksi::find($id);

        return view('transaksi.detail', compact('post'));
    }
    public function vloadcus(Request $request)
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

        // Retrieve authenticated user's ID
        $customerId = $request->user()->id;

        // Add condition for customer_id
        $filter .= " AND A.customer_id = " . $customerId;

        // $orderby = " order by " . $ordercolumn . " " . $columnorder . " limit " . $start . "," . $length . "";

        if ($search != '') {
            $filter .= " and (A.transaksi_no like '%" . $search . "%' 
            or A.customer_email like '%" . $search . "%' 
            or A.mobil_name like '%" . $search . "%' 
            or A.mobil_warna like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT 
        CASE 
            WHEN (A.total_biaya - COALESCE(J.total, 0)) = 0 THEN 'Paid'
            ELSE 'Unpaid' 
        END AS statusbayar,
        A.id,A.transaksi_no, A.mobil_id, A.mobil_name, A.mobil_merek, B.name as mobil_type, A.mobil_warna, A.mobil_biaya, A.total_biaya , A.customer_name , 
        A.customer_phone , A.customer_email , A.customer_address , A.customer_ktp , A.customer_kecamatan , A.customer_kelurahan , A.customer_kodepos , 
        A.payment_status , A.booking_date  , 
        CASE 
            WHEN A.payment_mode = 1 THEN 'Cash' 
            WHEN A.payment_mode = 2 THEN 'Transfer Bank' 
        END AS payment_mode  , A.invoice_no  , A.invoice_date  , A.invoice_due  
            FROM transaksis A  
            LEFT JOIN ( 
            SELECT transaksi_id,
            SUM(COALESCE(total_biaya,0)) AS total
            FROM kwitansis GROUP BY transaksi_id
            ) J ON J.transaksi_id = A.id
            LEFT JOIN mobiltypes B ON A.mobil_type = B.id

            ";;
        $sqlcount = "SELECT count(*) as allcount FROM (" . $sql . $filter . ") as temp ";

        $sqlall = $sql . $filter . " ORDER BY " . $ordercolumn . " " . $columnorder . " LIMIT " . $start . "," . $length;

        //echo $sqlall;
        //exit;
        $rows = \DB::select($sqlall);
        $rowscount = \DB::select($sqlcount);
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

    //==============================================================================
    public function vindex(Request $request)
    {
        return view('transaksi.index');
    }
    public function vcreate(Request $request)
    {
        $post = new Transaksi();
        return view('transaksi.form', compact('post'));
    }
    public function vedit(Request $request, $id)
    {
        $post = Transaksi::find($id);
        return view('transaksi.form', compact('post'));
    }
    public function vbayar(Request $request, $id)
    {
        $post = Transaksi::find($id);
        return view('transaksi.formbayar', compact('post'));
    }
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

        // $orderby = " order by " . $ordercolumn . " " . $columnorder . " limit " . $start . "," . $length . "";

        if ($search != '') {
            $filter .= " and (A.transaksi_no like '%" . $search . "%' 
            or A.customer_email like '%" . $search . "%' 
            or A.mobil_name like '%" . $search . "%' 
            or A.mobil_warna like '%" . $search . "%' 
            ) ";
        }

        // Tambahkan filter tanggal hanya jika dikirim dari view
        $datetime = $request->get('datetime');
        if ($datetime != "") {
            $dates = explode(" - ", $datetime);
            $startDate = date('Y-m-d', strtotime($dates[0]));
            $endDate = date('Y-m-d', strtotime($dates[1]));
            $filter .= " AND DATE(A.created_at) BETWEEN '" . $startDate . "' AND '" . $endDate . "'";
        }

        $sql = "SELECT 
        CASE 
            WHEN (A.total_biaya - COALESCE(J.total, 0)) = 0 THEN 'Paid'
            ELSE 'Unpaid' 
        END AS statusbayar,
        A.id,A.transaksi_no, A.mobil_id, A.mobil_name, A.mobil_merek, B.name as mobil_type, A.mobil_warna, A.mobil_biaya, A.total_biaya , A.customer_name , 
        A.customer_phone , A.customer_email , A.customer_address , A.customer_ktp , A.customer_kecamatan , A.customer_kelurahan , A.customer_kodepos , 
        A.payment_status , A.booking_date  , A.created_at  , 
        CASE 
            WHEN A.payment_mode = 1 THEN 'Cash' 
            WHEN A.payment_mode = 2 THEN 'Transfer Bank' 
        END AS payment_mode  , A.invoice_no  , A.invoice_date  , A.invoice_due  
            FROM transaksis A  
            LEFT JOIN ( 
            SELECT transaksi_id,
            SUM(COALESCE(total_biaya,0)) AS total
            FROM kwitansis GROUP BY transaksi_id
            ) J ON J.transaksi_id = A.id
            LEFT JOIN mobiltypes B ON A.mobil_type = B.id

            ";
        ;
        $sqlcount = "SELECT count(*) as allcount FROM (" . $sql . $filter . ") as temp ";

        $sqlall = $sql . $filter . " ORDER BY " . $ordercolumn . " " . $columnorder . " LIMIT " . $start . "," . $length;
        
        //echo $sqlall;
        //exit;
        $rows = \DB::select($sqlall);
        $rowscount = \DB::select($sqlcount);
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
            return redirect()->away('https://app.projecthree.my.id/transaksi/vdetail/' . $post->id);
        }
    }
    public function vstorebayar(Request $request)
    {
        // Assuming you have the ID of the transaction to fetch
        $postId = $request->input('id');
        $post = Transaksi::find($postId);

        // Conditional validation logic
        $rules = [
            'payment_jenis' => 'required',
        ];

        if (empty($post->bukti_path)) {
            $rules['bukti_path'] = 'required';
            $rules['bukti_path2'] = 'sometimes';
        } else {
            $rules['bukti_path'] = 'sometimes';
            $rules['bukti_path2'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ]);
            }

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $input['payment_status'] = 2;
        
        $post = null;
        // Memproses file yang diunggah
        if ($request->hasFile('bukti_path')) {
            $file = $request->file('bukti_path');
            $fileName = $file->getClientOriginalName();
            $unique_name = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/documents/bukti/';
            $file->move($destinationPath, $unique_name);

            // Menyimpan nama file ke dalam kolom bukti_path
            $input['bukti_path'] = 'documents/bukti/' . $unique_name;
        }
        if ($request->hasFile('bukti_path2')) {
            $file = $request->file('bukti_path2');
            $fileName = $file->getClientOriginalName();
            $unique_name = 'bukti_2' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/documents/bukti/';
            $file->move($destinationPath, $unique_name);

            // Menyimpan nama file ke dalam kolom bukti_path
            $input['bukti_path2'] = 'documents/bukti/' . $unique_name;
        }

        if ($request->id != '') {
            $post = Transaksi::find($request->id);
            // Set transaksi_no dengan format yang sesuai
            $post->update($input);
        } else {
            $post = Transaksi::create($input);
            $post->save();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Anda telah mengunggah bukti pembayaran, silahkan menunggu proses selanjutnya',
                'data' => $post,
                'redirect_url' => url('https://app.projecthree.my.id/transaksi/vdetail/' . $post->id)
            ], 200);
        } else {
            return redirect()->away('https://app.projecthree.my.id/transaksi/vdetail/' . $post->id);
        }
    }

    public function vdetail(Request $request, $id)
    {
        $post = Transaksi::find($id);
        
        return view('transaksi.detail', compact('post'));
    }
    public function vdestroy($id)
    {
        $post = Transaksi::find($id);
        $post->update(array('is_active' => false));
        // $post->delete();
        return response()->json([
            'success' => true,
            'msg' => 'Data created successfully',
            'data' => $post
        ], 200);
    }

    public function getCustomer($id)
    {
        $customer = \App\Models\User::find($id);

        if ($customer) {
            return response()->json([
                'customer_name' => $customer->name,
                'customer_ktp' => $customer->ktp,
                'customer_phone' => $customer->phone,
                'customer_email' => $customer->email,
                'customer_address' => $customer->address,
                'kecamatan' => $customer->kecamatan,
                'kelurahan' => $customer->kelurahan,
                'customer_kodepos' => $customer->postal_code,
            ]);
        }

        return response()->json(['message' => 'Customer not found'], 404);
    }
    // Add this method to handle the AJAX search for select2
    public function searchCustomers(Request $request)
    {
        $search = $request->input('q');
        $customers = \App\Models\User::where('name', 'LIKE', "%$search%")->get();

        $results = [];
        foreach ($customers as $customer) {
            $results[] = ['id' => $customer->id, 'text' => $customer->name];
        }

        return response()->json($results);
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

    public function print(Request $request)
    {
        $dateRange = $request->get('datetime');
        // Parse the date range
        list($startDate, $endDate) = explode(' - ', $dateRange);

        // Convert dates to the appropriate format
        $startDate = \Carbon\Carbon::createFromFormat('Y/m/d', trim($startDate))->startOfDay();
        $endDate = \Carbon\Carbon::createFromFormat('Y/m/d', trim($endDate))->endOfDay();

        // Fetch transactions within the date range
        $transactions = \DB::table('transaksis')
        ->whereBetween('booking_date', [$startDate, $endDate])
            ->select('transaksi_no', 'mobil_merek', 'total_biaya', 'customer_name', 'customer_phone', 'payment_status', 'booking_date', 'invoice_no')
            ->get();

        // Format the data for printing (e.g., create a view)
        return view('transaksi.print', compact('transactions'));
    }
}
