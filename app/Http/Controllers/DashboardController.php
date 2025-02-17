<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PreAlerts;
use App\Models\User;
use App\Models\PreAlertsProducts;
use App\Models\ShippingCharges;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /* API Function Calls Starts From Here !! */




    //==============================================================================
    public function vindex(Request $request)
    {
        if (Auth::user()->role >= 6) {
            return view('dashboard.indexcus');
        } else {
            return view('dashboard.index');
        }
    }

    public function vloadc(Request $request)
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
            $filter .= " and (A.code like '%" . $search . "%' 
            or A.name like '%" . $search . "%' 
            ) ";
        }
        $sql = "SELECT A.id,A.code,A.name,A.is_active FROM countries A  ";
        $sqlcount = "SELECT count(*)  as allcount FROM (" . $sql . ") as temp ";
        $sqlall = $sql . $filter . $orderby . "";
        // echo $sqlall;
        // exit;
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
    
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        $filter = " WHERE row_num = 1 ";
        $orderby = " ORDER BY " . $ordercolumn . " " . $columnorder . " LIMIT " . $start . "," . $length . "";
    
        if ($search != '') {
            $filter .= " AND (A.tracking_no LIKE '%" . $search . "%' 
                OR A.sender_city LIKE '%" . $search . "%' 
            ) ";
        }
    
        $sql = "SELECT id, tracking_no, sender_city, receiver_country, shipping_mode, booking_date, 
        CASE WHEN payment_status = 1 THEN 'Paid' ELSE 'Unpaid' END AS payment_status,
        is_active, STATUS
        FROM (
            SELECT 
                A.id, A.tracking_no, A.sender_city, A.receiver_country, A.shipping_mode, A.booking_date, A.payment_status, A.is_active, S.status,
                ROW_NUMBER() OVER (PARTITION BY A.id ORDER BY A.updated_at DESC) AS row_num
            FROM pre_alerts A
            LEFT JOIN shipment_statuses S ON A.id = S.shipment_id
            WHERE A.is_active = '1' 
            AND A.created_by = " . $userId . "
        ) AS ranked_data";

        $sqlcount = "SELECT COUNT(*) AS allcount FROM (" . $sql . ") AS temp";
        $sqlall = $sql . $filter . $orderby;

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

    // public function list()
    // {
    //     return view('dashboard.index');
    // }
    public function getMontlyStats()
    {
        $weekly_sale = ShippingCharges::whereRaw('created_at >= DATE_SUB( CURDATE(), INTERVAL 7 Day ) AND created_at <= Date( CURDATE()) AND is_active = 1')
            ->select(
                DB::raw('ifnull(SUM(fee), 0) as total')
            )->get()->first();

        $monthly_sale = ShippingCharges::whereRaw('created_at >= DATE_SUB( CURDATE(), INTERVAL 30 Day ) AND created_at <= Date( CURDATE()) AND is_active = 1')
            ->select(
                DB::raw('ifnull(SUM(fee), 0) as total')
            )->get()->first();

        $monthly_customer_onboard = User::whereRaw('role = 6 AND( created_at >= DATE_SUB( CURDATE(), INTERVAL 30 Day ) AND created_at <= Date( CURDATE()))')
            ->select(
                DB::raw('ifnull(count(id), 0) as total')
            )->get()->first();

        $prealerts = PreAlerts::whereRaw('type = 1 AND( created_at >= DATE_SUB( CURDATE(), INTERVAL 30 Day ) AND created_at <= Date( CURDATE()))')
            ->select(
                DB::raw('ifnull(count(id), 0) as total')
            )->get()->first();

        $shipments = PreAlerts::whereRaw('type = 2 AND( created_at >= DATE_SUB( CURDATE(), INTERVAL 30 Day ) AND created_at <= Date( CURDATE()))')
            ->select(
                DB::raw('ifnull(count(id), 0) as total')
            )->get()->first();

        $shipment_hsitory = $this->get_shipment_history();

        return response()->json([
            'success' => true,
            'weekly_sale' => $weekly_sale->total,
            'montly_sale' => $monthly_sale->total,
            'm_customer_onboard' => $monthly_customer_onboard->total,
            'm_prealerts' => $prealerts->total,
            'm_shipments' => $shipments->total,
            'history' => $shipment_hsitory
        ], 200);
    }

    function account_summary()
    {
        return response()->json([
            'success' => true,
            'summary' => $this->get_account_summary()
        ]);
    }

    function prealert_trends()
    {
        return response()->json([
            'success' => true,
            'trend' => $this->get_prealert_sales()
        ]);
    }

    function shipment_trends()
    {
        return response()->json([
            'success' => true,
            'trend' => $this->get_shipment_sales()
        ]);
    }

    function top_five_customer_trend()
    {
        return response()->json([
            'success' => true,
            'trend' => $this->get_top_five_customers()
        ]);
    }
    function page_load()
    {
        $shipment_hsitory = $this->get_shipment_history();
        $account_summary = $this->get_account_summary();


        return response()->json([
            'success' => true,
            'shipmentHistory' => $shipment_hsitory,
            'accountSummary' => $account_summary
        ], 200);
    }

    /* API Function Calls Ends Here !! */

    function get_shipment_history()
    {
        $overallPrealertCount = DB::table('pre_alerts')
            ->select(DB::raw("COUNT(*) as total_shipments, DATE_FORMAT(created_at, '%M') as month"))
            ->where('created_at', '>=', now()->subYear())
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
            foreach ($overallPrealertCount as $opc) {

                if ($opc->month == $m) {
                    array_push($revenue, $opc->total_shipments);
                    $matched = true;
                    continue;
                }
            }
            if (!$matched) {
                array_push($revenue, 0);
            }
        }
        // foreach ($overallPrealertCount as $opc) {
        //     array_push($months, $opc->month);
        //     array_push($revenue, $opc->total_shipments);
        // };

        $prealertCount = DB::table('pre_alerts')
            ->select(DB::raw("COUNT(*) as total_shipments, DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->where('created_at', '>=', now()->subYear(), ' and ', 'type= 1')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $shipmentCount = DB::table('pre_alerts')
            ->select(DB::raw("COUNT(*) as total_shipments, DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->where('created_at', '>=', now()->subYear(), ' and ', 'type= 2')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return [
            'overallPrealertCount' => $overallPrealertCount,
            'months' => $months,
            'revenue' => $revenue,
            'prealertCount' => $prealertCount,
            'shipmentCount' => $shipmentCount
        ];
    }

    function get_account_summary()
    {

        $todaySalesTotal = DB::table('shipping_charges')
            ->where('shipping_charges.is_active', 1)
            ->whereDate('shipping_charges.created_at', today())
            ->sum('shipping_charges.fee');

        $currentMonthSalesPaidTotal = DB::table('shipping_charges')
            ->where('shipping_charges.is_active', 1)
            ->whereMonth('shipping_charges.created_at', today()->month)
            ->sum('shipping_charges.fee');

        $todayPreAlertsCount = DB::table('pre_alerts')
            ->whereDate('created_at', today())
            ->count();

        $monthPreAlertsCount = DB::table('pre_alerts')
            ->whereMonth('created_at', today()->month)
            ->count();

        $totalPreAlertsCount = DB::table('pre_alerts')
            ->count();

        $totalContainerCount = DB::table('containers')
            ->where('containers.is_active', 1)
            ->count();

        return [
            'todaySalesTotal' => $todaySalesTotal,
            'currentMonthSaleTotal' => $currentMonthSalesPaidTotal,
            'todayShipmentCount' => $todayPreAlertsCount,
            'monthShipmentCount' => $monthPreAlertsCount,
            'totalShipmentCount' => $totalPreAlertsCount,
            'totalContainerCount' => $totalContainerCount
        ];
    }

    function get_prealert_sales()
    {
        $prealertSales = DB::table('shipping_charges')
            ->select(DB::raw("SUM(shipping_charges.fee) as total, DATE_FORMAT(shipping_charges.created_at, '%M') as month"))
            ->join('pre_alerts', 'shipping_charges.pre_alert_id', '=', 'pre_alerts.id')
            ->where('pre_alerts.payment_status', 1)
            ->where('pre_alerts.type', 1)
            ->where('shipping_charges.is_active', 1)
            ->whereMonth('shipping_charges.created_at', today()->month)
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

    function get_shipment_sales()
    {
        $shipmentSales = DB::table('shipping_charges')
            ->select(DB::raw("SUM(shipping_charges.fee) as total, DATE_FORMAT(shipping_charges.created_at, '%M') as month"))
            ->join('pre_alerts', 'shipping_charges.pre_alert_id', '=', 'pre_alerts.id')
            ->where('pre_alerts.payment_status', 1)
            ->where('pre_alerts.type', 2)
            ->where('shipping_charges.is_active', 1)
            ->whereMonth('shipping_charges.created_at', today()->month)
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
            foreach ($shipmentSales as $opc) {

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

        // foreach ($shipmentSales as $opc) {
        //     array_push($months, $opc->month);
        //     array_push($revenue, $opc->total);
        // };

        return ['months' => $months, 'trend' => $revenue];
    }

    function get_top_five_customers()
    {
        $customerTrend = DB::table('users')
            ->select(DB::raw("users.id, ifnull(Concat(users.first_name, ' ', users.last_name), users.business_name) as name,users.email, countries.code,
             users.profile_path, count(pre_alerts.id) as shipment, SUM(shipping_charges.fee) as total"))
            ->join('pre_alerts', 'users.id', '=', 'pre_alerts.created_by')
            ->join('shipping_charges', 'pre_alerts.id', '=', 'shipping_charges.pre_alert_id')
            ->join('countries', 'users.country', '=', 'countries.id')
            ->where('pre_alerts.is_active', 1)
            //->where('pre_alerts.payment_status', 1)
            ->where('users.role', 6)
            ->groupBy('pre_alerts.created_by')
            ->limit(5)
            ->get();

        return $customerTrend;
    }

    //================================================================================


}
