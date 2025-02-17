<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\Company;
use App\Models\AddressBook;
use App\Models\AcLoginActivity;
use Validator;
use App\Mail\SignupMail;
use App\Mail\DocumentRequiredMail;
use App\Mail\ShipmentMessage;
use App\Mail\AddUserMail;
use App\Models\register;
use Illuminate\Support\Facades\Mail;
use App\Models\PreAlertsProducts;
use App\Models\PreAlerts;
use App\Models\AcSupportingDocs;
use App\Models\Branch;
use App\Models\Kecamatan;
use App\Models\Transaksi;


class AuthController extends Controller
{
    public function vindexprof(Request $request)
    {
        return view('profile.indexprof');
    }
    public function vindexa(Request $request)
    {
        return view('profile.indexa');
    }
    public function vindexb(Request $request)
    {
        return view('profile.indexb');
    }
    public function vindexc(Request $request)
    {
        return view('profile.indexc');
    }
    public function vindexd(Request $request)
    {
        return view('profile.indexd');
    }
    
    public function vindexv($post_id)
    {
        // Mengambil data user berdasarkan $post_id
        $user = User::where('id', $post_id)->first();

        // Mengecek apakah user ditemukan
        if (!$user) {
            abort(404); // Tampilkan halaman 404 jika user tidak ditemukan
        }

        $tranSaksi = Transaksi::select('transaksis.*', 'mobiltypes.name AS mobil_type_name')
        ->leftJoin('mobiltypes', 'transaksis.mobil_type', '=', 'mobiltypes.id')
        ->leftJoin(DB::raw('( 
        SELECT transaksi_id,
        SUM(COALESCE(total_biaya,0)) AS total
        FROM kwitansis GROUP BY transaksi_id
        ) J'), 'J.transaksi_id', '=', 'transaksis.id')
        ->where(function ($query) use ($post_id) {
            $query->where('transaksis.created_by', $post_id)
                ->orWhere('transaksis.customer_id', $post_id);
        })
        ->where('transaksis.is_active', 1)
        ->orderBy('transaksis.created_at', 'desc') // Menambahkan orderBy untuk mendapatkan 15 transaksi terbaru
        ->take(10) // Mengambil hanya 15 transaksi terbaru
        ->select('transaksis.*', 'mobiltypes.name AS mobil_type_name', DB::raw('CASE 
            WHEN (transaksis.total_biaya - COALESCE(J.total, 0)) = 0 THEN "Paid"
            ELSE "Unpaid" 
        END AS statusbayar'))
        ->get();

        // Melemparkan data user ke view 'profile.indexv'
        return view('profile.indexv', compact('user', 'tranSaksi'));

    }
  
    public function vupdatepass(Request $request){
        // Lakukan validasi data yang diterima dari formulir
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'verify_password' => 'required|same:new_password',
        ]);
    
        // Dapatkan instance user yang sedang login
        $user = auth()->user();
    
        // Periksa kecocokan old password
        if (Hash::check($request->old_password, $user->password)) {
            // Old password benar, perbarui password baru
            $user->password = bcrypt($request->new_password);
            $user->save();
    
            // Berikan respons JSON yang sesuai 
            return response()->json(['success' => true, 'message' => 'Password updated successfully']);
        } else {
            // Old password tidak sesuai
            return response()->json(['success' => false, 'message' => 'Old password is incorrect'], 422);
        }
    }
    public function vuploadverification(Request $request)
    {
        // Validasi request, pastikan file terkirim dan sesuai format
        $request->validate([
            'verif_file' => 'required|mimes:jpeg,png,jpg|max:2048',
            'identity_type' => 'required|string|in:KTP,SIM',
        ]);

        // Simpan file ke server
        if ($request->hasFile('verif_file')) {
            $verifImage = $request->file('verif_file');
            $verifImageName = 'verif_' . time() . '.' . $verifImage->getClientOriginalExtension();

            // Pindahkan file ke folder kwc di dalam folder documents
            $verifImage->move(public_path('documents/kwc'), $verifImageName);

            // Update path dokumen verifikasi pada user yang sedang login
            $user = Auth::user();
            $user->verif_path = 'documents/kwc/' . $verifImageName;
            $user->identity_type = $request->input('identity_type'); // Simpan jenis dokumen identitas
            $user->kwc_required = 2; // Mengubah is_verified menjadi 1
            $user->save();

            return response()->json(['message' => 'Verification document uploaded successfully']);
        } else {
            return response()->json(['message' => 'No file uploaded.']);
        }
    }

    public function verifykwc($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Update the kwc_required attribute to 1
        $user->kwc_required = 1;

        // Save the updated user model
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User verification status updated successfully');
    }

    public function verifykwcno($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Update the kwc_required attribute to 1
        $user->kwc_required = 3;

        // Save the updated user model
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'User verification status updated successfully');
    }
    
    public function vupdatePersonalInfo(Request $request){
        // Validate the form data, including the avatar
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'profile_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Added validation for the profile picture
        ]);
    
        // Update the user's information in the database
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        // var_dump ($request->file('profile_path'));
        // exit;
        // Handle profile picture upload
        if ($request->hasFile('profile_path')) {

            $profileImage = $request->file('profile_path');
            $imageName = 'profile_' . time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('documents/profile'), $imageName);

            $user->profile_path = 'documents/profile/' . $imageName;
        }
    
        $user->save();
    
        // Redirect back or to a success page
        return response()->json(['message' => '   Data Succesfully Changed.']);
    }

    public function removeProfilePath()
    {
        $user = auth()->user();

        if ($user) {
            $user->update(['profile_path' => null]);
            return response()->json(['message' => 'Profile path removed successfully'], 200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
    
    
    public function vload(Request $request){
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id(); // Sesuaikan dengan cara Anda mendapatkan ID user dari autentikasi

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $sortcolumn = $_GET['order'][0]['column'];
        $ordercolumn = $_GET['columns'][$sortcolumn]['data'];
        $columnorder = $_GET['order'][0]['dir'];

        ## Search 
        $filter = $request->get('search');
        $search = (isset($filter)) ? $filter : '';

        $filter = " WHERE A.user_id = $userId"; // Menambahkan kondisi untuk ID user yang sedang login
        $orderby = " ORDER BY " . $ordercolumn . " " . $columnorder;
        
        // Memperbarui kueri SQL untuk membatasi hasil menjadi 10 baris teratas
        $sql = "SELECT A.created_at, 'User Login successfully' AS user_id FROM ac_login_activities A" . $filter . $orderby . " LIMIT 10";

        $sqlcount = "SELECT COUNT(*) AS allcount FROM (" . $sql . ") AS temp";
        $sqlall = $sql;

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
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function loadCountry(Request $request)
    {
        $term = $request->input('q');
        $countries = Country::where('name', 'like', '%' . $term . '%')->get();

        $result = [];
        foreach ($countries as $country) {
            $result[] = ['id' => $country->id, 'text' => $country->name];
        }

        return response()->json(['items' => $result, 'totalcount' => count($result)]);
    }

    public function loadState(Request $request)
    {
        $term = $request->input('q');
        $countryId = $request->input('country');

        $states = State::where('country_id', $countryId)
            ->where('name', 'like', '%' . $term . '%')
            ->get();

        $result = [];
        foreach ($states as $state) {
            $result[] = ['id' => $state->id, 'text' => $state->name];
        }

        return response()->json(['items' => $result, 'totalcount' => count($result)]);
    }
    public function loadAkun(Request $request)
    {
        $term = $request->input('q');
        $jenis = $request->input('jenis');
        if ($jenis == '1') {
            $sql = "SELECT A.akunid as id,A.akunnama as akunnama FROM akun A 
            LEFT JOIN jen C ON A.jenid = C.jenid
            LEFT JOIN struk D ON C.strukid = D.strukid
            WHERE D.strukkode in (1,2)
            ORDER BY D.strukkode ASC, C.jenkode ASC, A.akunkode ASC
            ";
        } else {
            $sql = "SELECT A.akunid as id,A.akunnama as name FROM akun A 
            LEFT JOIN jen C ON A.jenid = C.jenid
            LEFT JOIN struk D ON C.strukid = D.strukid
            ORDER BY D.strukkode ASC, C.jenkode ASC, A.akunkode ASC
            ";
        }

        $rows = \DB::select($sql);
        $result = [];
        foreach ($rows as $akun) {
            $result[] = ['id' => $akun->id, 'text' => $akun->akunnama];
        }

        return response()->json(['items' => $result]);
    }
    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->pluck('name', 'id')->prepend('Choose State', '');

        return response()->json($states);
    }

    public function vindex()
    {
        return view('auth.login');
    }
    public function forgotpassword()
    {
        return view('auth.forgotpassword');
    }

    public function vlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->get('email');
        $password = $request->get('password');
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $rows = \DB::select($sql, [$email]);

        if ($rows) {
            if (Hash::check($credentials['password'], $rows[0]->password)) {
                Auth::loginUsingId($rows[0]->id);
                $request->session()->regenerate();
                $user = Auth::user();
                $user['token'] = $user->createToken('MyApp')->accessToken;

                AcLoginActivity::create([
                    'user_id' => $user->id,
                    'role_id' => $user->role,
                ]);

                return redirect()->route('dashboard')
                ->withSuccess('Anda berhasil masuk!');
            } else {
                return back()->withErrors([
                    'password' => 'Kata sandi yang Anda masukkan salah.',
                ])->onlyInput('email');
            }
        } else {
            return back()->withErrors([
                'email' => 'Email anda tidak terdaftar.',
            ])->onlyInput('email');
        }
    }


    public function vlogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
        ;
    }

    //==============================================================================

    public function vregister()
    {
        return view('auth.register');
    }
    public function vcreate(Request $request)
    {
        $post = new User();
        return view('auth.register', compact('post'));
    }
    public function vstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'address' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'phone' => 'required|numeric',
            'postal_code' => 'required|numeric',
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

        $input['password'] = bcrypt($input['password']);
        // $input['verification_token'] = rand(10000, 99999);

        $input['role'] = 6;
        $input['name'] = $input['first_name'] . ' ' . $input['last_name'];
        $input['is_active'] = true;

        $post = null;

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
            // return redirect()->route('login');
            return redirect()->to('https://app.projecthree.my.id/login?success=1');

        }
    }
    public function loadKecamatan(Request $request)
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

    public function loadKelurahan(Request $request)
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
    

    //==============================================================================

    public function login()
    {
        //var_dump(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'is_active' => 1]));
        // if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'is_active' => 1])) { $email = $request->get('email');
        $email = request('email');
        $password = request('password');
        $sql = "SELECT id,password FROM users where email='" . $email . "'";
        $rows = \DB::select($sql);
        // return bcrypt($password);
        // die;
        // foreach ($user as $row) {
        //     $passdb = $row->password;
        // }
        //return (bcrypt($password)."|||".$rows[0]->password);
        if ($rows && Hash::check($password, $rows[0]->password)) {
            Auth::loginUsingId($rows[0]->id);
            $user = Auth::user();

            $user['token'] = $user->createToken('MyApp')->accessToken;

            AcLoginActivity::create([
                'user_id' => $user->id,
                'role_id' => $user->role,
            ]);

            return response()->json(['success' => true, 'user' => $user], $this->successStatus);
        } else if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'is_active' => 1])) {
            $user = Auth::user();
            $user = $user;
            $user['token'] = $user->createToken('MyApp')->accessToken;

            AcLoginActivity::create([
                'user_id' => $user->id,
                'role_id' => $user->role,
            ]);

            return response()->json(['success' => true, 'user' => $user], $this->successStatus);
        } else {
            // return response()->json(['error' => 'Unauthorised'], 401);
            return response()->json(['success' => false, 'msg' => 'Invalid credentials'], $this->successStatus);
        }
    }

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function TestEmail(Request $request)
    {

        $verif = rand(10000, 99999);
        // var_dump($verif);
        // exit;
        $request = Mail::to("rifanrizkyjb@gmail.com")->send(new SignupMail("rifan", $verif));

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'country_code_phone' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            // 'postal_code' => 'required',
            'branch_id' => 'required',
            // 'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role'] = 6;
        $input['is_active'] = 1;
        $input['verification_token'] = rand(10000, 99999);
        $input['kwc_required'] = 1;
        $input['is_verified'] = 0;
        $user = User::create($input);
        // $company = Company::create([
        //     'company_name' => 'My Company',
        //     'description' => '',
        //     'createdby' => $user->id,
        // ]);


        $addressbook = array();
        if ($user['type'] == 1) {
            $addressbook['name'] = $input['first_name'] . " " . $input['last_name'];
        } else {
            $addressbook['name'] = $input['business_name'];
        }
        $addressbook['phone'] = $input['country_code_phone'] . $input['phone'];
        $addressbook['street_address'] = $input['address'];
        $addressbook['city'] = $input['city'];
        $country = Country::find($input['country']);
        $addressbook['country_id'] = $input['country'];
        $addressbook['country'] = $country->name;
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
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;


        // Mail::to($request['email'])->send(new SignupMail($addressbook['name'], $input['verification_token']));

        return response()->json(['success' => $success, 'user' => $user], $this->successStatus);
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }


    public function adduser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
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
        $input['password'] = bcrypt($input['password']);
        $input['type'] = 1;
        $input['is_active'] = 1;
        $input['is_verified'] = 1;
        $branch = Branch::find($input['branch_id']);
        $input['country'] = $branch['country_id'];

        $user = User::create($input);

        //Mail::to($request['email'])->send(new AddUserMail($request['first_name'], $request['email'], $request['password']));

        return response()->json(['success' => true, 'validemail' => true, 'user' => $user], $this->successStatus);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getuser($id)
    {
        return User::find($id);
    }
    public function updateuser(Request $request, $id)
    {
        //
        $user = User::find($id);
        if (!$user)
            return response()->json([
                "message" => "We can't find a user with that e-mail address."
            ], 404);

        $user->update($request->all());


        // if($request->kwc_required == 1){
        //     $user->kwc_required= 1;
        //     $user->save();
        // }

        return response()->json($user);
    }
    public function getallusers()
    {
        // return User::where('role','<>',1)->get();
        return User::where([['users.role', '<>', 1], ['users.role', '<>', 6], ['users.is_deleted', '=', 0], ['users.role', '<>', 7]])->leftJoin("branches", 'users.branch_id', '=', 'branches.id')->select('users.*', 'branches.name as branch')->get();
    }
    public function getallcustomers()
    {
        return User::where([['users.role', '=', 6], ['users.is_active', '=', 1]])
            ->leftJoin("branches", 'users.branch_id', '=', 'branches.id')
            // ->join("ac_supporting_docs", "users.id", '=', "ac_supporting_docs.user_id")
            ->select('users.*', 'branches.name as branch')->get();
    }

    public function deletecustomer($id)
    {
        $post = User::find($id);
        $post->update(array('is_active' => false));
        return $post;
    }

    public function VerifyCode(Request $request)
    {
        //
        $input = $request->all();
        $user = User::where([['users.id', '=', $input['id']], ['users.verification_token', '=', $input['code']]])->select('users.*')->get();
        /* $res = Mail::to("rifanrizkyjb@gmail.com")->send(new ShipmentMessage("test"));
              return response()->json(['message' => $res], $this->successStatus); */
        if (count($user) > 0) {
            User::where('verification_token', $input['code'])
                ->where('id', $input['id'])
                ->update(['is_verified' => 1]);


            // Send Email to user


            return response()->json(['success' => true, 'user' => $user], $this->successStatus);
        } else {
            return response()->json(['success' => false], $this->successStatus);
        }
    }


    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required',
        ]);

        $user = User::where('id', $id)->first();
        if (!$user)
            return response()->json([
                "message" => "We can't find a user with that e-mail address."
            ], 404);
        // if (bcrypt($request->old_password) != $user->password)
        //     return response()->json([
        //         "message" => "Your Current Password is Wrong"
        //     ], 404);
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json($user);
    }

    public function delete_user($id)
    {
        $post = User::find($id);
        $post->update(array('is_deleted' => true));
        return $post;
    }

    public function getLoginActivity($id)
    {

        $activity = AcLoginActivity::where('user_id', $id)->get();

        return response()->json($activity);
    }
}
