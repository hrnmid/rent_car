<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Mobiltype;
use Illuminate\Support\Facades\DB;

class MobilTypeController extends Controller
{


    //==============================================================================
    public function vindex(Request $request)
    {
        return view('mobiltype.index');
    }
    public function vcreate(Request $request)
    {
        $post = new Mobiltype();
        return view('mobiltype.form', compact('post'));
    }
    public function vedit(Request $request, $id)
    {
        $post = Mobiltype::find($id);
        return view('mobiltype.form', compact('post'));
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

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%'
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
            'name' => 'required',
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
        $post = null;

        if ($request->id != '') {
            $post = Mobiltype::find($request->id);
            $post->update($input);
        } else {
            $post = new Mobiltype($input);
            $post->save();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Data created successfully',
                'data' => $post
            ], 200);
        } else {
            return redirect()->route('mobiltype.vindex');
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
    //==============================================================================
    
}
