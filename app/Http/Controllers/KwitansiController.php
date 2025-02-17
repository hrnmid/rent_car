<?php

namespace App\Http\Controllers;

// use App\Helper\Helper;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Receipt;
use App\Models\Kwitansi;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Currency;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendInvoiceMail;
use Illuminate\Support\Facades\Input;


class KwitansiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    //==============================================================================
    public function vindex(Request $request)
    {
        if (Auth::user()->role >= 6) {
            return view('receipt.indexcus');
        } else {
            return view('receipt.index');
        }
    }

    public function vdetail(Request $request, $id)
    {
        $routealias = request()->route()->uri;
        $post = Receipt::find($id);
        $isajax = "0";
        if ($request->ajax()) {
            $isajax = "1";
        }
        return view('receipt.detail', compact('id', 'post', 'isajax'));
    }
    public function vcreate(Request $request, $id)
    {

        $transaksi = Transaksi::find($id);

        $post = new Kwitansi();
        
        return view('kwitansi.form', compact('post', 'transaksi'));
    }

    public function vedit(Request $request, $id)
    {
        $transaksi = Transaksi::find($id); // Mengambil objek Transaksi dengan $id yang sesuai

        $post = Kwitansi::find($id);

        return view('kwitansi.form', compact('post', 'transaksi')); // Mengirimkan $transaksi ke tampilan
    }

    public function vload(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $sortcolumn = $_GET['order'][0]['column'];
        $ordercolumn = $_GET['columns'][$sortcolumn]['data'];
        $columnorder = $_GET['order'][0]['dir'];

        // Get the transaksi_id from the request
        $transaksi_id = $request->get('transaksi_id');

        ## Search 
        $filter = $request->get('search');
        $search = (isset($filter['value'])) ? $filter['value'] : '';

        // Default filter
        $whereClause = " WHERE 1=1";

        // Search filter
        if ($search != '') {
            $whereClause .= " and (A.receipt_no like '%" . $search . "%' 
        or A.receipt_method like '%" . $search . "%' 
        ) ";
        }

        // Add transaksi_id filter
        if ($transaksi_id != '') {
            $whereClause .= " AND A.transaksi_id='" . $transaksi_id . "'";
        }

        // Role-based filter
        if (Auth::user()->role >= 6) {
            // $whereClause .= " AND A.created_by='" . Auth::user()->id . "'";
        }

        // Sorting
        if ($sortcolumn == "0") {
            $orderdefault = " A.receipt_id desc";
        } else {
            $orderdefault = $ordercolumn . " " . $columnorder;
        }

        $orderby = " ORDER BY " . $orderdefault . " LIMIT " . $start . "," . $length;

        // SQL Queries
        $sql = "SELECT A.receipt_id, A.receipt_date, A.transaksi_id, A.receipt_no, A.receipt_method, A.total_biaya, A.receipt_status, A.created_at
            FROM kwitansis A";
        $sqlcount = "SELECT count(*) as allcount FROM (" . $sql . $whereClause . ") as temp";
        $sqlall = $sql . $whereClause . $orderby;

        // Execute queries
        $rows = \DB::select($sqlall);
        $rowscount = \DB::select($sqlcount);
        $totalRecordwithFilter = $rowscount[0]->allcount;
        $totalRecords = $rowscount[0]->allcount;

        // Prepare the response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $rows
        );

        return response()->json($response);
    }


    public function vstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receipt_method' => 'required',
            'receipt_date' => 'required',
            'receipt_status' => 'required',
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
        $post = null;

        if ($request->id != '') {
            $post = Kwitansi::find($request->id);
            $post->update($input);
        } else {
            $post = new Kwitansi($input);
            $res = $post->save();
            if ($res) {
                $receipt_no = "RCP-" . sprintf('%05d', $post->receipt_id);
                $post->update(array('receipt_no' => $receipt_no));
            }
        }
        // Update payment_status transaksi 
        if ($post->transaksi_id) {
            $mobil = Transaksi::find($post->transaksi_id);
            if ($mobil) {
                $mobil->payment_status = $input['receipt_status'];
                $mobil->save();
            }
        }


        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Data created successfully',
                'data' => $post
            ], 200);
        } else {
            return redirect()->route('transaksi.vdetail', ['id' => $post->receipt_id]);
        }
    }
    public function vprint($id)
    {
        $kuitansi = Kwitansi::find($id);

        return view('kwitansi.print', compact('kuitansi'));
    }
    
    public function vdestroy($id)
    {
        $post = Kwitansi::find($id);

        if ($post) {
            $post->delete();
            return response()->json([
                'success' => true,
                'msg' => 'Data deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'Data not found'
            ], 404);
        }
    }

    // public function vdestroy($id)
    // {
    //     $post = Receipt::find($id);
    //     $post->update(array('is_active' => false));
    //     return response()->json([
    //         'success' => true,
    //         'msg' => 'Data created successfully',
    //         'data' => $post
    //     ], 200);
    // }

    public function vgettotalreceipt(Request $request)
    {
        $amountpaid = \Helper::getInvoice("paid", $request->id);
        $statuspaid = \Helper::getInvoice("status", $request->id);
        return response()->json([
            'success' => true,
            'msg' => 'Data created successfully',
            'amountpaid' => $amountpaid,
            'statuspaid' => $statuspaid
        ], 200);
    }
    //==============================================================================

}
