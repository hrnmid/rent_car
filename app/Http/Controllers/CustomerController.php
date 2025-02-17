<?php

namespace App\Http\Controllers;

use App\Models\PreAlertsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PreAlerts;
use App\Models\AddressBook;
use App\Models\AcSupportingDocs;
use App\Mail\SignupMail;
use App\Mail\AddUserMail;
use App\Models\Branch;
use App\Models\Country;
use App\Models\State;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Mail;
use Validator;

class CustomerController extends Controller
{
    //==============================================================================
    public function vindex(Request $request)
    {
        return view('customer.index');
    }
    public function vcreate(Request $request)
    {
        $post = new User();
        return view('customer.form', compact('post'));
    }
    public function vedit(Request $request, $id)
    {
        $post = User::find($id);
        return view('customer.form', compact('post'));
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

        $filter = " WHERE 1=1 and A.is_active='1' and A.role='6'";

        // $orderby = " order by " . $ordercolumn . " " . $columnorder . " limit " . $start . "," . $length . "";

        if ($search != '') {
            $filter .= " and (A.first_name like '%" . $search . "%' 
            or A.unique_id like '%" . $search . "%' 
            or A.email like '%" . $search . "%' 
            or A.address like '%" . $search . "%' 
            or A.phone like '%" . $search . "%' 
            or A.is_verified like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT A.id, A.first_name, A.unique_id, A.email, A.address, A.phone, A.is_verified , A.kwc_required 
            FROM users A  ";
        ;
        // $sqlcount = "SELECT count(*)  as allcount FROM (" . $sql . ") as temp ";
        $sqlcount = "SELECT count(*) as allcount FROM (" . $sql . $filter . ") as temp ";

        // $sqlall = $sql . $filter . $orderby . "";
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'phone' => 'required',
            'postal_code' => 'required',
            // 'verif_path' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika tidak ada ID (membuat data baru), tambahkan validasi file
        if (!$request->id) {
            $validator->addRules(['verif_path' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048']);
        }

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

        // Generate password only for new data
        if (!$request->id) {
            $password = $input['first_name'] . '123456';
            $input['password'] = bcrypt($password);
        }
        // Generate password
        // $password = $input['first_name'] . '123456';
        // $input['password'] = bcrypt($password);
        $input['verification_token'] = rand(10000, 99999);
        $input['role'] = 6;
        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];
        $input['is_active'] = true;

        $post = null;
        // Memproses file yang diunggah
        if ($request->hasFile('verif_path')) {
            $file = $request->file('verif_path');
            $fileName = $file->getClientOriginalName();
            $unique_name = 'verif_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/documents/kwc/';
            $file->move($destinationPath, $unique_name);

            // Menyimpan nama file ke dalam kolom verif_path
            $input['verif_path'] = 'documents/kwc/' . $unique_name;
        }
        // var_dump($input); exit;
        if ($request->id != '') {
            $post = User::find($request->id);
            $post->update($input);
        } else {
            $post = User::create($input);

            $kecamatan = Kecamatan::find($input['kecamatan']);
            $unique_id = $kecamatan->kode . sprintf('%06d', $post->id);

            // Update the user's unique_id
            $post->update(['unique_id' => $unique_id]);
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'msg' => 'Data created successfully',
                'data' => $post
            ], 200);
        } else {
            return redirect()->route('customer.vindex');
        }
    }

    public function vdestroy($id)
    {
        $post = User::find($id);
        $post->update(array('is_active' => false));
        // $post->delete();
        return response()->json([
            'success' => true,
            'msg' => 'Data created successfully',
            'data' => $post
        ], 200);
    }
    

    public $successStatus = 200;
    public function addCstomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        /* VERIFY IF THE EMAIL MEETS DUPLICATE CHECK */
        $user = User::where([['users.email', '=', $request['email']]])->select('users.*')->get();
        if (!$user->isEmpty()) {
            return response()->json(['success' => true, 'validemail' => false, 'user' => $user], $this->successStatus);
        }

        $input = $request->all();
        $password = $input['first_name'] . '@#' . 'cus_';
        $input['password'] = bcrypt($password);
        $input['is_verified'] = 1;
        $input['role'] = 6;
        $input['is_active'] = 1;
        $input['verification_token'] = rand(0, 99999);
        $input['kwc_required'] = 1;

        if ($input['type'] == 2) {
            $input['business_name'] = $input['first_name'];
        }

        $country_id = $input['country'];
        $branch = DB::table('branches')
            ->select('branches.*')
            ->where('branches.name', 'Singapore')
            ->where('branches.is_active', 1)
            ->first();

        $input['branch_id'] = $branch->id;
        $input['country'] = $branch->country_id;

        $user = User::create($input);

        $addressbook = array();
        $addressbook['name'] = $input['first_name'];
        $addressbook['email'] = $input['email'];
        $addressbook['phone'] = $input['phone'];
        $addressbook['street_address'] = $input['address'];
        $addressbook['city'] = $input['city'];
        $country = Country::find($input['country']);
        $addressbook['country'] = $country->name;
        $addressbook['country_id'] = $country_id;
        $state = State::find($input['state']);
        $addressbook['state'] = $state->name;
        $addressbook['zip'] = $input['postal_code'];
        $addressbook['created_by'] = $user->id;
        $addressbook['is_active'] = true;
        $addressbook['isDefault'] = true;
        AddressBook::create($addressbook);

        $country = Country::find($input['country']);
        $unique_id = $country->code . sprintf('%06d', $user->id);
        $user->update(array('unique_id' => $unique_id));

        Mail::to($request['email'])->send(new AddUserMail($input['first_name'], $addressbook['email'], $password));

        return response()->json(['success' => true, 'validemail' => true, 'user' => $user], $this->successStatus);
    }

    function cus_dash_data($id)
    {
        return response()->json([
            'success' => true,
            'customer' => $this->get_customer_profile($id),
            'shipments' => $this->get_total_shipment($id),
            'summary' => $this->get_prealert_summary($id),
            'addressBook' => $this->get_addressBook($id),
            'docs' => $this->get_supporting_documents($id)
        ]);
    }

    function recent_shipments($id)
    {
        return response()->json([
            'success' => true,
            'shipments' => $this->get_top_seven_recent_shipments($id),
        ]);
    }

    function get_customer_profile($id)
    {
        $customer = DB::table('users')
            ->select(DB::raw("users.*, countries.name as country_name, states.name as state_name"))
            ->join('countries', 'users.country', '=', 'countries.id')
            ->join('states', 'users.state', '=', 'states.id')
            ->where('users.id', $id)
            ->first();

        return $customer;
    }


    function get_top_seven_recent_shipments($id)
    {
        $whereClause = "pre_alerts.created_by= {$id} ";
        $shipments = PreAlerts::whereRaw($whereClause)->leftJoin('virtual_addresses', 'pre_alerts.shipping_address', '=', 'virtual_addresses.id')->leftJoin('address_books as sender_address', function ($join) {
            $join->on('pre_alerts.sender_id', '=', 'sender_address.id');
        })->leftJoin('address_books as receiver_address', function ($join) {
            $join->on('pre_alerts.receiver_id', '=', 'receiver_address.id');
        })->join('users', 'pre_alerts.created_by', '=', 'users.id')->leftJoin('shipment_statuses', function ($query) {
            $query->on('pre_alerts.id', '=', 'shipment_statuses.shipment_id')->whereRaw('shipment_statuses.id IN (select MAX(a2.id) from shipment_statuses as a2 join pre_alerts as u2 on u2.id = a2.shipment_id group by u2.id)');
        })->leftJoin('branches', 'users.branch_id', '=', 'branches.id')
            ->select('pre_alerts.*', 'virtual_addresses.city_state as prealert_sender_city', 'virtual_addresses.name as prealert_sender_name', 'branches.name as branch_name', 'shipment_statuses.status as status')
            ->orderBy('pre_alerts.id', 'desc')
            ->limit(7)
            ->get();

        return $shipments;
    }
    function get_total_shipment($id)
    {

        $whereClause = "pre_alerts.created_by= {$id} ";
        $shipments = PreAlerts::whereRaw($whereClause)->leftJoin('virtual_addresses', 'pre_alerts.shipping_address', '=', 'virtual_addresses.id')->leftJoin('address_books as sender_address', function ($join) {
            $join->on('pre_alerts.sender_id', '=', 'sender_address.id');
        })->leftJoin('address_books as receiver_address', function ($join) {
            $join->on('pre_alerts.receiver_id', '=', 'receiver_address.id');
        })->join('users', 'pre_alerts.created_by', '=', 'users.id')->leftJoin('shipment_statuses', function ($query) {
            $query->on('pre_alerts.id', '=', 'shipment_statuses.shipment_id')->whereRaw('shipment_statuses.id IN (select MAX(a2.id) from shipment_statuses as a2 join pre_alerts as u2 on u2.id = a2.shipment_id group by u2.id)');
        })->leftJoin('branches', 'users.branch_id', '=', 'branches.id')->select('pre_alerts.*', 'virtual_addresses.city_state as prealert_sender_city', 'virtual_addresses.name as prealert_sender_name', 'branches.name as branch_name', 'shipment_statuses.status as status')->orderBy('pre_alerts.id', 'desc')->get();

        return $shipments;
    }

    function get_prealert_summary($id)
    {
        $prealertSales = DB::table('pre_alerts_products')
            ->select(DB::raw("SUM(pre_alerts_products.total) as total, DATE_FORMAT(pre_alerts.created_at, '%M') as month"))
            ->join('pre_alerts', 'pre_alerts_products.pre_alert_id', '=', 'pre_alerts.id')
            // ->where('pre_alerts.payment_status', 1)
            ->where('pre_alerts.created_by', $id)
            ->whereMonth('pre_alerts.created_at', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $months = array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        );
        $revenue = [];

        foreach ($months as $m) {
            $matched = false;
            foreach ($prealertSales as $opc) {

                if ($opc->month == $m) {
                    array_push($revenue, $opc->total);
                    $matched = true;
                    continue;
                }
            }
            if (!$matched) {
                array_push($revenue, 0);
            }
        }
        // foreach ($prealertSales as $opc) {
        //     array_push($months, $opc->month);
        //     array_push($revenue, $opc->total);
        // };

        return ['months' => $months, 'trend' => $revenue];
    }

    function get_addressBook($id)
    {
        return AddressBook::where(array('is_active' => 1, 'created_by' => $id))->orderBy('id', 'asc')->get();
    }

    function get_supporting_documents($id)
    {
        return AcSupportingDocs::where(array('user_id' => $id, 'is_active' => 1))->orderBy('id', 'asc')->get();
    }

    public function reject_supporting_doc(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required',
        ]);

        $doc = AcSupportingDocs::where('id', $id)->first();
        if (!$doc)
            return response()->json([
                "message" => "We can't find a supporting document"
            ]);

        $doc->rejection_reason = $request->rejection_reason;
        $doc->accepted = false;
        $doc->is_active = false;

        $doc->save();
        return response()->json($doc);
    }

    public function accept_supporting_doc($id)
    {

        $doc = AcSupportingDocs::where('id', $id)->first();
        if (!$doc)
            return response()->json([
                "status" => false,
                "message" => "We can't find a supporting document"
            ]);

        $doc->accepted = true;
        $doc->rejection_reason = "Accepted";
        $doc->save();

        $user = User::where('id', $doc->user_id)->first();
        // $user->is_verified = 1;
        // $user->kwc_required = 0;
        // $user->save();
        return response()->json($user);
    }

    public function verify_user_kwc($id)
    {

        $docs = DB::table('ac_supporting_docs')
            ->select(DB::raw("COUNT(*) as verified_docs"))
            ->where(['user_id' => $id, 'accepted' => 1])
            ->first();


        if ($docs->verified_docs > 0) {
            //Eligible for the verification
            $user = User::where('id', $id)->first();
            $user->is_verified = 1;
            $user->kwc_required = 0;
            $user->save();
            return response()->json([
                "success" => true,
                "message" => "Account is verified successfully",
                'user' => $user
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Missing verified supporting documents"
            ]);
        }
    }
}
