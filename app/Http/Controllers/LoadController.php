<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


class LoadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function Country(Request $request)
    {
        $out = ['totalcount' => 0, 'items' => ['id' => '', 'text' => '']];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $start = $limit * (isset($_GET['page']) ? ($_GET['page'] - 1) : 0);

        $filter = " WHERE 1=1 AND A.is_active='1'";
        $orderby = " ORDER BY A.id ASC limit $limit offset $start";

        $search = $request->get('q');
        $search = (isset($search)) ? $search : '';

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%' 
        or A.code like '%" . $search . "%' 
        ) ";
        }
        $sql = "SELECT A.id as id,concat('[',A.code,']') as code,A.name AS text
            FROM countries A";
        $sqlall = $sql . $filter . $orderby;
        $rows = DB::select($sqlall);
        $items = collect($rows);

        $out['items'] = $items;
        $out['totalcount'] = count($items);

        return response()->json($out, 200);
    }

    public function State(Request $request)
    {
        $out = ['totalcount' => 0, 'items' => ['id' => '', 'text' => '']];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $start = $limit * (isset($_GET['page']) ? ($_GET['page'] - 1) : 0);

        $filter = " WHERE 1=1 AND A.is_active='1'";
        $orderby = " ORDER BY A.id ASC limit $limit offset $start";

        $search = $request->get('q');
        $search = (isset($search)) ? $search : '';

        $country_id = $request->get('country'); // Get selected country ID

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%' 
        or A.id like '%" . $search . "%' 
        ) ";
        }
        if ($country_id) { // If country is selected
            $filter .= " AND A.country_id = " . $country_id;
        }
        $sql = "SELECT A.id as id, A.name AS text
            FROM states A";
        $sqlall = $sql . $filter . $orderby;
        $rows = DB::select($sqlall);
        $items = collect($rows);

        $out['items'] = $items;
        $out['totalcount'] = count($items);

        return response()->json($out, 200);
    }

    public function Kecamatan(Request $request)
    {
        $out = ['totalcount' => 0, 'items' => ['id' => '', 'text' => '']];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $start = $limit * (isset($_GET['page']) ? ($_GET['page'] - 1) : 0);

        $filter = " WHERE 1=1 AND A.is_active='1'";
        $orderby = " ORDER BY A.id ASC limit $limit offset $start";

        $search = $request->get('q');
        $search = (isset($search)) ? $search : '';

        if ($search != '') {
            $filter .= " and (A.name like '%" . $search . "%') ";
        }
        $sql = "SELECT A.id as id, A.name AS text
        FROM kecamatans A";
        $sqlall = $sql . $filter . $orderby;
        $rows = DB::select($sqlall);
        $items = collect($rows);

        $out['items'] = $items;
        $out['totalcount'] = count($items);

        return response()->json($out, 200);
    }

    public function Kelurahan(Request $request)
    {
        $out = ['totalcount' => 0, 'items' => []];
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $start = $limit * ($page - 1);

        $filter = " WHERE A.is_active = 1";
        $orderby = " ORDER BY A.id ASC LIMIT $limit OFFSET $start";

        $search = $request->input('q', '');
        $kecamatan_id = $request->input('kecamatan');

        if ($search) {
            $filter .= " AND A.name LIKE '%" . $search . "%'";
        }
        if ($kecamatan_id) {
            $filter .= " AND A.kecamatan_id = " . intval($kecamatan_id);
        }

        $sql = "SELECT A.id, A.name AS text
            FROM kelurahans A" . $filter . $orderby;
        $rows = DB::select($sql);
        $items = collect($rows);

        $out['items'] = $items;
        $out['totalcount'] = count($items);

        return response()->json($out, 200);
    }

    public function Customer(Request $request)
    {
        $out = ['totalcount' => 0, 'items' => ['id' => '', 'text' => '']];
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $start = $limit * (isset($_GET['page']) ? ($_GET['page'] ) : 0);

        $filter = " WHERE 1=1 AND A.is_deleted=false and role='6'";
        $orderby = " ORDER BY A.id ASC limit $limit offset $start";

        $search = $request->get('q');
        $search = (isset($search)) ? $search : '';

        if ($search != '') {
            $filter .= " and (concat(A.first_name,' ',A.last_name) like '%" . $search . "%' 
        or A.email like '%" . $search . "%' 
        or A.unique_id like '%" . $search . "%' 
        or A.phone like '%" . $search . "%' 
        ) ";
        }
        $sql = "SELECT A.id as id,concat(A.first_name,' ',A.last_name) AS text,A.email,A.unique_id,A.phone
            FROM users A"; 
        $sqlcount = "SELECT count(*)  as count FROM (" . $sql . $filter . ") as temp ";
        $sqlall = $sql . $filter . $orderby . "";
        //echo $sqlall;
        $rows = DB::select($sqlall);
        $items = collect($rows);
        $rowscount = DB::select($sqlcount);
        $totalRecords = $rowscount[0]->count;
        $out['items'] = $items;
        $out['totalcount'] = $totalRecords;

        return response()->json($out, 200);
    }

    
}
