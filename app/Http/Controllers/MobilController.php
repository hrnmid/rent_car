<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use App\Models\Mobil;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //==============================================================================
    // CUSTOMER
    public function vindexcus(Request $request)
    {
        return view('mobil.indexcus');
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
        $orderby = " order by " . $ordercolumn . " " . $columnorder . " limit " . $start . "," . $length . "";

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%' 
            or A.merek like '%" . $search . "%' 
            or A.tahun_produksi like '%" . $search . "%' 
            or A.warna like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT A.id,A.name,A.merek,A.type,A.warna,A.tahun_produksi,A.sewa_harian,A.sewa_mingguan,A.sewa_bulanan,A.mobil_path,
        A.status,A.no_plat,A.is_active,B.name AS typemobil FROM mobils A  
        LEFT JOIN mobiltypes B ON B.id = A.type 
        -- LEFT JOIN states C ON C.id = A.state 
        ";
        $sqlcount = "SELECT count(*)  as allcount FROM (" . $sql . ") as temp ";
        $sqlall = $sql . $filter . $orderby . "";
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
        return view('mobil.index');
    }
    public function vcreate(Request $request)
    {
        $post = new Mobil();
        return view('mobil.form', compact('post'));

    }
    public function vedit(Request $request, $id)
    {
        $post = Mobil::find($id);
        return view('mobil.form', compact('post'));
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
        $orderby = " order by " . $ordercolumn . " " . $columnorder . " limit " . $start . "," . $length . "";

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%' 
            or A.merek like '%" . $search . "%' 
            or A.tahun_produksi like '%" . $search . "%' 
            or A.warna like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT A.id,A.name,A.merek,A.type,A.warna,A.tahun_produksi,A.sewa_harian,A.sewa_mingguan,A.sewa_bulanan,A.mobil_path,
        A.status,A.no_plat,A.is_active,B.name AS typemobil FROM mobils A  
        LEFT JOIN mobiltypes B ON B.id = A.type 
        -- LEFT JOIN states C ON C.id = A.state 
        ";
        $sqlcount = "SELECT count(*)  as allcount FROM (" . $sql . ") as temp ";
        $sqlall = $sql . $filter . $orderby . "";
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
            'name' => 'required',
            'merek' => 'required',
            'type' => 'required',
            'warna' => 'required',
            'no_plat' => 'required',
            'tahun_produksi' => 'required',
            'sewa_harian' => 'required|numeric',
            'sewa_mingguan' => 'required|numeric',
            'sewa_bulanan' => 'required|numeric',
            'status' => 'required',
            // 'mobil_path' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file
        ]);

        // Jika tidak ada ID (membuat data baru), tambahkan validasi file
        if (!$request->id) {
            $validator->addRules(['mobil_path' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048']);
        }

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Data creation failed. Please check your input.',
                    'errors' => $validator->getMessageBag()->toArray(),
                ], 200);
            } else {
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            }
        }

        $input = $request->all();
        $input['is_active'] = true;
        $post = null;

        // Memproses file yang diunggah
        if ($request->hasFile('mobil_path')) {
            $file = $request->file('mobil_path');
            $fileName = $file->getClientOriginalName();
            $unique_name = 'mobil_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/documents/mobil/';
            $file->move($destinationPath, $unique_name);

            // Menyimpan nama file ke dalam kolom mobil_path
            $input['mobil_path'] = 'documents/mobil/' . $unique_name;
        }

        if ($request->id != '') {
            $post = Mobil::find($request->id);
            $post->update($input);
        } else {
            $post = Mobil::create($input);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Data created successfully',
                'data' => $post
            ], 200);
        } else {
            return redirect()->route('mobil.vindex');
        }
    }

    public function vdestroy($id)
    {
        $post = Mobil::find($id);
        $post->update(array('is_active' => false));
        return response()->json([
            'success' => true,
            'msg' => 'Data created successfully',
            'data' => $post
        ], 200);
    }
    
}

