<?php

use App\Models\ShipmentStatusList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DaashboardController;
use App\Http\Controllers\VirtualAddressController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ShipmentPayerController;
use App\Http\Controllers\ShippmentController;
use App\Http\Controllers\ShipmentTypeController;
use App\Http\Controllers\ShippingModeController;
use App\Http\Controllers\ShipmentStatusListController;
use App\Http\Controllers\RemarksStatusListController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SizeScaleController;
use App\Http\Controllers\WeightScaleController;
use App\Http\Controllers\ProductDescriptionController;
use App\Http\Controllers\GstvatController;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\ShippingRatesController;
use App\Http\Controllers\ShipppingRatesController;
use App\Http\Controllers\ShippingZoneController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ConsigneeController;
use App\Http\Controllers\PreAlertsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AddShipmentController;
use App\Http\Controllers\AddressBookController;
use App\Http\Controllers\PreAlertsCustomerController;
use App\Http\Controllers\BookShipmentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ShipmentStatusController;

use App\Http\Controllers\StrukController;
use App\Http\Controllers\JenController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\XerohooksController;
use App\Http\Controllers\XeroController;
use Dcblogdev\Xero\Facades\Xero;

use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MobilTypeController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\BookingController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('login', 'App\Http\Controllers\AuthController@indexlogin')->name('login');
// Route::get('register', 'App\Http\Controllers\AuthController@indexregister')->name('register');
Route::get('/receipt/xgetinvoice', 'App\Http\Controllers\ReceiptController@xgetinvoice')->name('xgetinvoice');


Route::group(['middleware' => ['auth']], function () {

    
    Route::controller(KwitansiController::class)->group(function () {
        Route::get('/kwitansi', 'vindex')->name('kwitansi.vindex');
        Route::get('/kwitansi/vload', 'vload')->name('kwitansi.vload');
        Route::get('/kwitansi/vprint/{id}', 'vprint')->name('kwitansi.vprint');
    });

    Route::controller(ReceiptController::class)->group(function () {
        Route::get('/receipt', 'vindex')->name('receipt.vindex');
        Route::get('/receipt/vload', 'vload')->name('receipt.vload');
        Route::get('/receipt/vcreate/{id}', 'vcreate')->name('receipt.vcreate');
        Route::post('/receipt/vcreate/{id}', 'vcreate')->name('receipt.vcreate');
        Route::get('/receipt/vedit/{id}', 'vedit')->name('receipt.vedit');
        Route::post('/receipt/vedit/{id}', 'vedit')->name('receipt.vedit');
        Route::post('/receipt/vstore', 'vstore')->name('receipt.vstore');
        Route::post('/receipt/vdestroy/{id}', 'vdestroy')->name('receipt.vdestroy');

        Route::post('/receipt/vgettotalreceipt', 'vgettotalreceipt')->name('receipt.vgettotalreceipt');
    });


    Route::controller(ShipmentStatusController::class)->group(function () {
        Route::get('/shipmentstatus', 'vindex')->name('shipmentstatus.vindex');
        Route::get('/shipmentstatus/vload', 'vload')->name('shipmentstatus.vload');
        Route::get('/shipmentstatus/vcreate/{id}', 'vcreate')->name('shipmentstatus.vcreate');
        Route::post('/shipmentstatus/vcreate/{id}', 'vcreate')->name('shipmentstatus.vcreate');
        Route::get('/shipmentstatus/vedit/{id}', 'vedit')->name('shipmentstatus.vedit');
        Route::post('/shipmentstatus/vedit/{id}', 'vedit')->name('shipmentstatus.vedit');
        Route::post('/shipmentstatus/vstore', 'vstore')->name('shipmentstatus.vstore');
        Route::post('/shipmentstatus/vdestroy/{id}', 'vdestroy')->name('shipmentstatus.vdestroy');
        Route::get('/shipmentstatus/vpartialindex/{id}', 'vpartialindex')->name('shipmentstatus.vpartialindex');
        //Route::post('/shipmentstatus/vdestroy/{id}', "Partials@generateList");
    });

    Route::controller(AddressBookController::class)->group(function () {
        Route::get('/addressbook', 'vindex')->name('addressbook.vindex');
        Route::get('/addressbook/vload', 'vload')->name('addressbook.vload');
        Route::get('/addressbook/vcreate', 'vcreate')->name('addressbook.vcreate');
        Route::get('/addressbook/vedit/{id}', 'vedit')->name('addressbook.vedit');
        Route::post('/addressbook/vstore', 'vstore')->name('addressbook.vstore');
        Route::post('/addressbook/vstorefromshipment', 'vstorefromshipment')->name('addressbook.vstorefromshipment');
        Route::post('/addressbook/vdestroy/{id}', 'vdestroy')->name('addressbook.vdestroy');

    });

    Route::controller(ShippingRatesController::class)->group(function () {
        Route::get('/shippingrate', 'vindex')->name('shippingrate.vindex');
        Route::get('/shippingratecus', 'vindexcus')->name('shippingrate.vindexcus');
        Route::get('/shippingrate/vload', 'vload')->name('shippingrate.vload');

    });
    
    //PROYEK TA HARUN MIDNIGHT
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/mytransaksi', 'vindexcus')->name('mytransaksi.vindexcus');
        Route::get('/mytransaksi/vloadcus', 'vloadcus')->name('mytransaksi.vloadcus');
        Route::get('/mytransaksi/vdetailcus/{id}', 'vdetailcus')->name('mytransaksi.vdetailcus');
        Route::get('/transaksi/vbayar/{id}', 'vbayar')->name('transaksi.vbayar');
        Route::post('/transaksi/vstorebayar', 'vstorebayar')->name('transaksi.vstorebayar');


        // Route::get('/transaksi/vload', 'vload')->name('transaksi.vload');
        // Route::get('/transaksi/vcreate', 'vcreate')->name('transaksi.vcreate');
        // Route::get('/transaksi/vedit/{id}', 'vedit')->name('transaksi.vedit');
        // Route::post('/transaksi/vstore', 'vstore')->name('transaksi.vstore');
        // Route::post('/transaksi/vdestroy/{id}', 'vdestroy')->name('transaksi.vdestroy');
        // Route::get('/customers/{id}', 'getCustomer')->name('transaksi.getCustomer');
        // Route::get('/search-customers', 'searchCustomers')->name('transaksi.searchCustomers');

        // Route::get('/mobils/{id}', 'getMobil')->name('transaksi.getMobil');
        // Route::get('/transaksi/vdetail/{id}', 'vdetail')->name('transaksi.vdetail');

    });

    Route::controller(MobilController::class)->group(function () {
        // Route::get('/mobils', 'vindexcus')->name('mobils.vindexcus');
        // Route::get('/mobils/vloadcus', 'vloadcus')->name('mobils.vloadcus');
        // Route::get('/mobil/vcreate', 'vcreate')->name('mobil.vcreate');
        // Route::get('/mobil/vedit/{id}', 'vedit')->name('mobil.vedit');
        // Route::post('/mobil/vstore', 'vstore')->name('mobil.vstore');
        // Route::post('/mobil/vdestroy/{id}', 'vdestroy')->name('mobil.vdestroy');
    });

    //==============================================================================

    Route::controller(PreAlertsController::class)->group(function () {
        Route::get('/myshipment', 'vindex')->name('myshipment.vindex');
        Route::get('/myshipment/vdetail/{id}', 'vdetail')->name('myshipment.vdetail');
        Route::get('/myshipment/vload', 'vload')->name('myshipment.vload');
        Route::get('/myshipment/vloaddetail', 'vloaddetail')->name('myshipment.vloaddetail');

        Route::post('/prealert/vstore', 'vstore')->name('prealert.vstore');
        Route::post('/prealert/vdestroy/{id}', 'vdestroy')->name('prealert.vdestroy');
        Route::get('/prealert/vaddressbook/type/{type}/id/{id}', 'vaddressbook')->name('prealert.vaddressbook');
        Route::get('/prealert/vload', 'vload')->name('prealert.vload');
        Route::get('/prealert/vdetail/{id}', 'vdetail')->name('prealert.vdetail');
        Route::get('/bookshipment/vcreate', 'vcreate')->name('bookshipment.vcreate');
        Route::get('/bookshipment/vcreate2', 'vcreate')->name('bookshipment.vcreate2');
        Route::post('/bookshipment/vcreate', 'vcreate')->name('bookshipment.vcreate');
        Route::post('/bookshipment/vcreate2', 'vcreate')->name('bookshipment.vcreate2');

    });



    Route::controller(BookShipmentController::class)->group(function () {
        Route::get('/bookshipment', 'form')->name('bookshipment.form');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/user', 'vindex')->name('user.vindex');
        Route::get('/user/vloadd', 'vloadd')->name('user.vloadd');
        Route::get('/user/vcreate', 'vcreate')->name('user.vcreate');
        Route::get('/user/vedit/{id}', 'vedit')->name('user.vedit');
        Route::post('/user/vstore', 'vstore')->name('user.vstore');
        Route::post('/user/vdestroy/{id}', 'vdestroy')->name('user.vdestroy');
        Route::post('/user/vstoreinfo', 'vstoreinfo')->name('user.vstoreinfo');




    });


    Route::controller(LoadController::class)->group(function () {
        Route::get('/load/branch', 'branch')->name('load.branch');
        Route::get('/load/country', 'country')->name('load.country');
        Route::get('/load/countryy', 'countryy')->name('load.countryy');
        Route::get('/load/shippingzone', 'shippingzone')->name('load.shippingzone');
        Route::get('/load/shipmenttype', 'shipmenttype')->name('load.shipmenttype');
        Route::get('/load/shippingmode', 'shippingmode')->name('load.shippingmode');
        Route::get('/load/weightscale', 'weightscale')->name('load.weightscale');
        Route::get('/load/currency', 'currency')->name('load.currency');
        Route::get('/load/state', 'state')->name('load.state');
        Route::get('/load/city', 'state')->name('load.city');
        Route::get('/load/shipmentstatuslist', 'shipmentstatus')->name('load.shipmentstatuslist');
        Route::get('/load/customer', 'customer')->name('load.customer');

        Route::get('/load/kecamatan', 'kecamatan')->name('load.kecamatan');
        Route::get('/load/kelurahan', 'kelurahan')->name('load.kelurahan');

    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'vindex')->name('dashboard');
        Route::get('/dashboard', 'vindex')->name('dashboard');
        Route::get('/dashboard/vload', 'vload')->name('dashboard.vload');

    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'vlogout')->name('logout');
    });

});

Route::controller(AuthController::class)->group(function () {
    

    Route::get('/profilea', 'vindexa')->name('profile.vindexa');
    Route::get('/profileb', 'vindexb')->name('profile.vindexb');
    Route::get('/profilec', 'vindexc')->name('profile.vindexc');
    Route::get('/profiled', 'vindexd')->name('profile.vindexd');
    Route::get('/profile', 'vindexprof')->name('profile.vindexprof');
    Route::post('/remove-avatar', 'removeProfilePath')->name('profile.removeProfilePath');
    Route::get('/profile/vload', 'vload')->name('profile.vload');
    Route::post('/profile/vupdatepass', 'vupdatepass')->name('profile.vupdatepass');
    Route::post('/profile/vuploadverification', 'vuploadverification')->name('profile.vuploadverification');
    Route::post('/profile/vupdatePersonalInfo', 'vupdatePersonalInfo')->name('profile.vupdatePersonalInfo');
    Route::get('/profile/vupdateverif', 'vupdateverif')->name('profile.vupdateverif');
    Route::get('/profile/vloadinfo', 'vloadinfo')->name('profile.vloadinfo');
    Route::post('/profile/vupdateProfile', 'vupdateProfile')->name('profile.vupdateProfile');
    // Route::get('/profilev', 'vindexv')->name('profile.vindexv');

    Route::get('/profilecustomer/{post_id}', 'vindexv')->name('profile.vindexv');
    Route::get('/verifykwc/{id}', 'verifykwc')->name('profile.verifykwc');
    Route::get('/verifykwcno/{id}', 'verifykwcno')->name('profile.verifykwcno');




    // Route::get('/register/vload', 'vload')->name('register.vload');
    // Route::get('/register/vcreate', 'vcreate')->name('register.vcreate');
    Route::get('/register', 'vcreate')->name('register');
    Route::post('/register/vstore', 'vstore')->name('register.vstore');
    
    Route::get('/auth/vcreate', 'vcreate')->name('auth.vcreate');
    Route::get('/login', 'vindex')->name('login');
    Route::get('/forgotpassword', 'forgotpassword')->name('forgotpassword');
    Route::post('/authenticate', 'vlogin')->name('authenticate');
    // Route::get('/state/load', [RegisterController::class, 'loadStatesByCountry'])->name('state.load');


});
Route::controller(PreAlertsController::class)->group(function () {
    Route::get('/trackshipment/{id}', 'vtrackshipment')->name('prealert.trackshipment');
});
Route::group(['middleware' => ['auth.admin']], function () {

    Route::controller(VirtualAddressController::class)->group(function () {
        Route::get('/virtualaddress', 'vindex')->name('virtualaddress.vindex');
        Route::get('/virtualaddress/vload', 'vload')->name('virtualaddress.vload');
        Route::get('/virtualaddress/vcreate', 'vcreate')->name('virtualaddress.vcreate');
        Route::get('/virtualaddress/vedit/{id}', 'vedit')->name('virtualaddress.vedit');
        Route::post('/virtualaddress/vstore', 'vstore')->name('virtualaddress.vstore');
        Route::post('/virtualaddress/vdestroy/{id}', 'vdestroy')->name('virtualaddress.vdestroy');
    });

    Route::controller(BranchController::class)->group(function () {
        Route::get('/branch', 'vindex')->name('branch.vindex');
        Route::get('/branch/vload', 'vload')->name('branch.vload');
        Route::get('/branch/vcreate', 'vcreate')->name('branch.vcreate');
        Route::get('/branch/vedit/{id}', 'vedit')->name('branch.vedit');
        Route::post('/branch/vstore', 'vstore')->name('branch.vstore');
        Route::post('/branch/vdestroy/{id}', 'vdestroy')->name('branch.vdestroy');
    });


    Route::controller(CountryController::class)->group(function () {
        Route::get('/country', 'vindex')->name('country.vindex');
        Route::get('/country/vload', 'vload')->name('country.vload');
        Route::get('/country/vcreate', 'vcreate')->name('country.vcreate');
        Route::get('/country/vedit/{id}', 'vedit')->name('country.vedit');
        Route::post('/country/vstore', 'vstore')->name('country.vstore');
        Route::post('/country/vdestroy/{id}', 'vdestroy')->name('country.vdestroy');
    });


    Route::controller(StateController::class)->group(function () {
        Route::get('/state', 'vindex')->name('state.vindex');
        Route::get('/state/vload', 'vload')->name('state.vload');
        Route::get('/state/vcreate', 'vcreate')->name('state.vcreate');
        Route::get('/state/vedit/{id}', 'vedit')->name('state.vedit');
        Route::post('/state/vstore', 'vstore')->name('state.vstore');
        Route::post('/state/vdestroy/{id}', 'vdestroy')->name('state.vdestroy');
    });


    Route::controller(CourierController::class)->group(function () {
        Route::get('/courier', 'vindex')->name('courier.vindex');
        Route::get('/courier/vload', 'vload')->name('courier.vload');
        Route::get('/courier/vcreate', 'vcreate')->name('courier.vcreate');
        Route::get('/courier/vedit/{id}', 'vedit')->name('courier.vedit');
        Route::post('/courier/vstore', 'vstore')->name('courier.vstore');
        Route::post('/courier/vdestroy/{id}', 'vdestroy')->name('courier.vdestroy');
    });

    Route::controller(ShipmentPayerController::class)->group(function () {
        Route::get('/shipmentpayer', 'vindex')->name('shipmentpayer.vindex');
        Route::get('/shipmentpayer/vload', 'vload')->name('shipmentpayer.vload');
        Route::get('/shipmentpayer/vcreate', 'vcreate')->name('shipmentpayer.vcreate');
        Route::get('/shipmentpayer/vedit/{id}', 'vedit')->name('shipmentpayer.vedit');
        Route::post('/shipmentpayer/vstore', 'vstore')->name('shipmentpayer.vstore');
        Route::post('/shipmentpayer/vdestroy/{id}', 'vdestroy')->name('shipmentpayer.vdestroy');
    });


    Route::controller(ShippingModeController::class)->group(function () {
        Route::get('/shippingmode', 'vindex')->name('shippingmode.vindex');
        Route::get('/shippingmode/vload', 'vload')->name('shippingmode.vload');
        Route::get('/shippingmode/vcreate', 'vcreate')->name('shippingmode.vcreate');
        Route::get('/shippingmode/vedit/{id}', 'vedit')->name('shippingmode.vedit');
        Route::post('/shippingmode/vstore', 'vstore')->name('shippingmode.vstore');
        Route::post('/shippingmode/vdestroy/{id}', 'vdestroy')->name('shippingmode.vdestroy');
    });


    Route::controller(ShipmentTypeController::class)->group(function () {
        Route::get('/shipmenttype', 'vindex')->name('shipmenttype.vindex');
        Route::get('/shipmenttype/vload', 'vload')->name('shipmenttype.vload');
        Route::get('/shipmenttype/vcreate', 'vcreate')->name('shipmenttype.vcreate');
        Route::get('/shipmenttype/vedit/{id}', 'vedit')->name('shipmenttype.vedit');
        Route::post('/shipmenttype/vstore', 'vstore')->name('shipmenttype.vstore');
        Route::post('/shipmenttype/vdestroy/{id}', 'vdestroy')->name('shipmenttype.vdestroy');
    });

    Route::controller(ShipmentStatusListController::class)->group(function () {
        Route::get('/shipmentstatuslist', 'vindex')->name('shipmentstatuslist.vindex');
        Route::get('/shipmentstatuslist/vload', 'vload')->name('shipmentstatuslist.vload');
        Route::get('/shipmentstatuslist/vcreate', 'vcreate')->name('shipmentstatuslist.vcreate');
        Route::get('/shipmentstatuslist/vedit/{id}', 'vedit')->name('shipmentstatuslist.vedit');
        Route::post('/shipmentstatuslist/vstore', 'vstore')->name('shipmentstatuslist.vstore');
        Route::post('/shipmentstatuslist/vdestroy/{id}', 'vdestroy')->name('shipmentstatuslist.vdestroy');
    });

    Route::controller(RemarksStatusListController::class)->group(function () {
        Route::get('/remarksstatuslist', 'vindex')->name('remarksstatuslist.vindex');
        Route::get('/remarksstatuslist/vload', 'vload')->name('remarksstatuslist.vload');
        Route::get('/remarksstatuslist/vcreate', 'vcreate')->name('remarksstatuslist.vcreate');
        Route::get('/remarksstatuslist/vedit/{id}', 'vedit')->name('remarksstatuslist.vedit');
        Route::post('/remarksstatuslist/vstore', 'vstore')->name('remarksstatuslist.vstore');
        Route::post('/remarksstatuslist/vdestroy/{id}', 'vdestroy')->name('remarksstatuslist.vdestroy');
    });


    Route::controller(CurrencyController::class)->group(function () {
        Route::get('/currency', 'vindex')->name('currency.vindex');
        Route::get('/currency/vload', 'vload')->name('currency.vload');
        Route::get('/currency/vcreate', 'vcreate')->name('currency.vcreate');
        Route::get('/currency/vedit/{id}', 'vedit')->name('currency.vedit');
        Route::post('/currency/vstore', 'vstore')->name('currency.vstore');
        Route::post('/currency/vdestroy/{id}', 'vdestroy')->name('currency.vdestroy');
    });

    Route::controller(SizeScaleController::class)->group(function () {
        Route::get('/sizescale', 'vindex')->name('sizescale.vindex');
        Route::get('/sizescale/vload', 'vload')->name('sizescale.vload');
        Route::get('/sizescale/vcreate', 'vcreate')->name('sizescale.vcreate');
        Route::get('/sizescale/vedit/{id}', 'vedit')->name('sizescale.vedit');
        Route::post('/sizescale/vstore', 'vstore')->name('sizescale.vstore');
        Route::post('/sizescale/vdestroy/{id}', 'vdestroy')->name('sizescale.vdestroy');
    });

    Route::controller(WeightScaleController::class)->group(function () {
        Route::get('/weightscale', 'vindex')->name('weightscale.vindex');
        Route::get('/weightscale/vload', 'vload')->name('weightscale.vload');
        Route::get('/weightscale/vcreate', 'vcreate')->name('weightscale.vcreate');
        Route::get('/weightscale/vedit/{id}', 'vedit')->name('weightscale.vedit');
        Route::post('/weightscale/vstore', 'vstore')->name('weightscale.vstore');
        Route::post('/weightscale/vdestroy/{id}', 'vdestroy')->name('weightscale.vdestroy');
    });
    Route::controller(ProductDescriptionController::class)->group(function () {
        Route::get('/productdescription', 'vindex')->name('productdescription.vindex');
        Route::get('/productdescription/vload', 'vload')->name('productdescription.vload');
        Route::get('/productdescription/vcreate', 'vcreate')->name('productdescription.vcreate');
        Route::get('/productdescription/vedit/{id}', 'vedit')->name('productdescription.vedit');
        Route::post('/productdescription/vstore', 'vstore')->name('productdescription.vstore');
        Route::post('/productdescription/vdestroy/{id}', 'vdestroy')->name('productdescription.vdestroy');
    });

    Route::controller(GstvatController::class)->group(function () {
        Route::get('/gstvat', 'vindex')->name('gstvat.vindex');
        Route::get('/gstvat/vload', 'vload')->name('gstvat.vload');
        Route::get('/gstvat/vcreate', 'vcreate')->name('gstvat.vcreate');
        Route::get('/gstvat/vedit/{id}', 'vedit')->name('gstvat.vedit');
        Route::post('/gstvat/vstore', 'vstore')->name('gstvat.vstore');
        Route::post('/gstvat/vdestroy/{id}', 'vdestroy')->name('gstvat.vdestroy');
    });

    Route::controller(CurrencyConversionController::class)->group(function () {
        Route::get('/currencyconversion', 'vindex')->name('currencyconversion.vindex');
        Route::get('/currencyconversion/vload', 'vload')->name('currencyconversion.vload');
        Route::get('/currencyconversion/vcreate', 'vcreate')->name('currencyconversion.vcreate');
        Route::get('/currencyconversion/vedit/{id}', 'vedit')->name('currencyconversion.vedit');
        Route::post('/currencyconversion/vstore', 'vstore')->name('currencyconversion.vstore');
        Route::post('/currencyconversion/vdestroy/{id}', 'vdestroy')->name('currencyconversion.vdestroy');
    });

    Route::controller(ShippingRatesController::class)->group(function () {
        Route::get('/shippingrate/vcreate', 'vcreate')->name('shippingrate.vcreate');
        Route::get('/shippingrate/vedit/{id}', 'vedit')->name('shippingrate.vedit');
        Route::post('/shippingrate/vstore', 'vstore')->name('shippingrate.vstore');
        Route::post('/shippingrate/vdestroy/{id}', 'vdestroy')->name('shippingrate.vdestroy');

    });

    Route::controller(ShippingZoneController::class)->group(function () {
        Route::get('/shippingzone', 'vindex')->name('shippingzone.vindex');
        Route::get('/shippingzone/vload', 'vload')->name('shippingzone.vload');
        Route::get('/shippingzone/vcreate', 'vcreate')->name('shippingzone.vcreate');
        Route::get('/shippingzone/vedit/{id}', 'vedit')->name('shippingzone.vedit');
        Route::post('/shippingzone/vstore', 'vstore')->name('shippingzone.vstore');
        Route::post('/shippingzone/vdestroy/{id}', 'vdestroy')->name('shippingzone.vdestroy');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer', 'vindex')->name('customer.vindex');
        Route::get('/customer/vload', 'vload')->name('customer.vload');
        Route::get('/customer/vcreate', 'vcreate')->name('customer.vcreate');
        Route::get('/customer/vedit/{id}', 'vedit')->name('customer.vedit');
        Route::post('/customer/vstore', 'vstore')->name('customer.vstore');
        Route::post('/customer/vdestroy/{id}', 'vdestroy')->name('customer.vdestroy');
    });

    Route::controller(DriversController::class)->group(function () {
        Route::get('/driver', 'vindex')->name('driver.vindex');
        Route::get('/driver/vload', 'vload')->name('driver.vload');
        Route::get('/driver/vcreate', 'vcreate')->name('driver.vcreate');
        Route::get('/driver/vedit/{id}', 'vedit')->name('driver.vedit');
        Route::post('/driver/vstore', 'vstore')->name('driver.vstore');
        Route::post('/driver/vdestroy/{id}', 'vdestroy')->name('driver.vdestroy');
    });

    Route::controller(ContainerController::class)->group(function () {
        Route::get('/container', 'vindex')->name('container.vindex');
        Route::get('/container/vload', 'vload')->name('container.vload');
        Route::get('/container/vcreate', 'vcreate')->name('container.vcreate');
        Route::get('/container/vedit/{id}', 'vedit')->name('container.vedit');
        Route::post('/container/vstore', 'vstore')->name('container.vstore');
        Route::post('/container/vdestroy/{id}', 'vdestroy')->name('container.vdestroy');
    });
    Route::controller(ConsigneeController::class)->group(function () {
        Route::get('/consignee', 'vindex')->name('consignee.vindex');
        Route::get('/consignee/vload', 'vload')->name('consignee.vload');
        Route::get('/consignee/vcreate', 'vcreate')->name('consignee.vcreate');
        Route::get('/consignee/vedit/{id}', 'vedit')->name('consignee.vedit');
        Route::post('/consignee/vstore', 'vstore')->name('consignee.vstore');
        Route::post('/consignee/vdestroy/{id}', 'vdestroy')->name('consignee.vdestroy');
    });

    Route::controller(StrukController::class)->group(function () {
        Route::get('/struk', 'vindex')->name('struk.vindex');
        Route::get('/struk/vload', 'vload')->name('struk.vload');
        Route::get('/struk/vcreate', 'vcreate')->name('struk.vcreate');
        Route::get('/struk/vedit/{id}', 'vedit')->name('struk.vedit');
        Route::post('/struk/vstore', 'vstore')->name('struk.vstore');
        Route::post('/struk/vdestroy/{id}', 'vdestroy')->name('struk.vdestroy');
    });

    Route::controller(JenController::class)->group(function () {
        Route::get('/jen', 'vindex')->name('jen.vindex');
        Route::get('/jen/vload', 'vload')->name('jen.vload');
        Route::get('/jen/vcreate', 'vcreate')->name('jen.vcreate');
        Route::get('/jen/vedit/{jenid}', 'vedit')->name('jen.vedit');
        Route::post('/jen/vstore', 'vstore')->name('jen.vstore');
        Route::post('/jen/vdestroy/{id}', 'vdestroy')->name('jen.vdestroy');
    });

    Route::controller(AkunController::class)->group(function () {
        Route::get('/akun', 'vindex')->name('akun.vindex');
        Route::get('/akun/vload', 'vload')->name('akun.vload');
        Route::get('/akun/vcreate', 'vcreate')->name('akun.vcreate');
        Route::get('/akun/vedit/{akunid}', 'vedit')->name('akun.vedit');
        Route::post('/akun/vstore', 'vstore')->name('akun.vstore');
        Route::post('/akun/vdestroy/{id}', 'vdestroy')->name('akun.vdestroy');

        Route::get('/history/{history_id}', 'vindexv')->name('akun.vindexv');
    });

    Route::controller(KasController::class)->group(function () {
        Route::get('/kas', 'vindex')->name('kas.vindex');
        Route::get('/kas/vload', 'vload')->name('kas.vload');
        Route::get('/kas/vcreate/{jenis}', 'vcreate')->name('kas.vcreate');
        Route::post('/kas/vcreate/{jenis}', 'vcreate')->name('kas.vcreate');
        Route::get('/kas/vedit/{id}/{jenis}', 'vedit')->name('kas.vedit');
        Route::post('/kas/vedit/{id}/{jenis}', 'vedit')->name('kas.vedit');
        Route::post('/kas/vdestroy/{id}', 'vdestroy')->name('kas.vdestroy');
        Route::post('/kas/vstore', 'vstore')->name('kas.vstore');
        Route::get('/kas/details/{id}', 'kasDetails')->name('kas.details');


    });

    Route::controller(JurnalController::class)->group(function () {
        Route::get('/jurnal', 'vindex')->name('jurnal.vindex');
        Route::get('/jurnal/vcreate', 'vcreate')->name('jurnal.vcreate');
        Route::post('/jurnal/vcreate', 'vcreate')->name('jurnal.vcreate');
        Route::get('/jurnal/vedit/{id}', 'vedit')->name('jurnal.vedit');
        Route::post('/jurnal/vedit/{id}', 'vedit')->name('jurnal.vedit');
        Route::get('/jurnal/vload', 'vload')->name('jurnal.vload');
        Route::get('/jurnal/vstore', 'vstore')->name('jurnal.vstore');
        Route::post('/jurnal/vdestroy/{id}', 'vdestroy')->name('jurnal.vdestroy');

        Route::get('/jurnal/labarugi', 'vindexlabarugi')->name('jurnal.vindexlabarugi');
        Route::get('/jurnal/labarugi/vload', 'vloadlabarugi')->name('jurnal.vloadlabarugi');

        Route::get('/jurnal/neraca', 'vindexneraca')->name('jurnal.vindexneraca');
        Route::get('/jurnal/neraca/vload', 'vloadneraca')->name('jurnal.vloadneraca');

        Route::get('/jurnal/details/{id}', 'jurnalDetails')->name('jurnal.details');
    });

    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/pr', 'vindexpr')->name('purchase.vindexpr');
        Route::get('/po', 'vindexpo')->name('purchase.vindexpo');
        Route::get('/shipment', 'vindex')->name('shipment.vindex');

        Route::get('/addshipment', 'vcreate')->name('purchase.vcreate');
        Route::get('/purchase/vload', 'vload')->name('purchase.vload');
        Route::get('/purchase/vloadpo', 'vloadpo')->name('purchase.vloadpo');
        Route::get('/purchase/vcreate', 'vcreate')->name('purchase.vcreate');
        Route::post('/purchase/vcreate', 'vcreate')->name('purchase.vcreate');
        Route::get('/purchase/vedit/{id}', 'vedit')->name('purchase.vedit');
        Route::post('/purchase/vedit/{id}', 'vedit')->name('purchase.vedit');
        Route::post('/purchase/vstore', 'vstore')->name('purchase.vstore');
        Route::get('/purchase/vpay/{id}', 'vpay')->name('purchase.vpay');


        Route::get('/purchase/vdetail/{id}', 'vdetail')->name('purchase.vdetail');
        Route::post('/purchase/vapprove/{id}', 'vapprove')->name('purchase.vapprove');
        Route::post('/purchase/vdestroy/{id}', 'vdestroy')->name('purchase.vdestroy');

        Route::get('/printpurchase/{id}', 'vindexpur')->name('purchase.vindexpur');
        Route::get('/purchase/details/{id}', 'purchaseDetails')->name('purchase.details');
    });

    
    Route::controller(AddShipmentController::class)->group(function () {
        Route::get('/addshipment', 'vindex')->name('addshipment.vindex');
        Route::get('/addshipment/vcreate', 'vcreate')->name('addshipment.vcreate');
        Route::post('/addshipment/vstore', 'vstore')->name('addshipment.vstore');
    });

    Route::controller(PreAlertsController::class)->group(function () {
        Route::get('/prealert', 'vindex')->name('prealert.vindex');
        Route::get('/shipment', 'vindex')->name('shipment.vindex');

        Route::get('/addshipment', 'vcreate')->name('prealert.vcreate');
        Route::get('/prealert/vcreate', 'vcreate')->name('prealert.vcreate');
        Route::post('/prealert/vcreate', 'vcreate')->name('prealert.vcreate');
        Route::get('/prealert/vedit/{id}', 'vedit')->name('prealert.vedit');
        Route::post('/prealert/vedit/{id}', 'vedit')->name('prealert.vedit');
        Route::post('/prealert/vstore', 'vstore')->name('prealert.vstore');
        Route::post('/prealert/vdestroy/{id}', 'vdestroy')->name('prealert.vdestroy');

        Route::get('/autocharge', 'vautocharge')->name('prealert.vautocharge');
    });

    //PROYEK TA 
    Route::controller(KecamatanController::class)->group(function () {
        Route::get('/kecamatan', 'vindex')->name('kecamatan.vindex');
        Route::get('/kecamatan/vload', 'vload')->name('kecamatan.vload');
        Route::get('/kecamatan/vcreate', 'vcreate')->name('kecamatan.vcreate');
        Route::get('/kecamatan/vedit/{id}', 'vedit')->name('kecamatan.vedit');
        Route::post('/kecamatan/vstore', 'vstore')->name('kecamatan.vstore');
        Route::post('/kecamatan/vdestroy/{id}', 'vdestroy')->name('kecamatan.vdestroy');
    });
    Route::controller(KelurahanController::class)->group(function () {
        Route::get('/kelurahan', 'vindex')->name('kelurahan.vindex');
        Route::get('/kelurahan/vload', 'vload')->name('kelurahan.vload');
        Route::get('/kelurahan/vcreate', 'vcreate')->name('kelurahan.vcreate');
        Route::get('/kelurahan/vedit/{id}', 'vedit')->name('kelurahan.vedit');
        Route::post('/kelurahan/vstore', 'vstore')->name('kelurahan.vstore');
        Route::post('/kelurahan/vdestroy/{id}', 'vdestroy')->name('kelurahan.vdestroy');
    });
    Route::controller(MobilController::class)->group(function () {
        Route::get('/mobil', 'vindex')->name('mobil.vindex');
        Route::get('/mobil/vload', 'vload')->name('mobil.vload');
        Route::get('/mobil/vcreate', 'vcreate')->name('mobil.vcreate');
        Route::get('/mobil/vedit/{id}', 'vedit')->name('mobil.vedit');
        Route::post('/mobil/vstore', 'vstore')->name('mobil.vstore');
        Route::post('/mobil/vdestroy/{id}', 'vdestroy')->name('mobil.vdestroy');
    });
    Route::controller(MobilTypeController::class)->group(function () {
        Route::get('/mobiltype', 'vindex')->name('mobiltype.vindex');
        Route::get('/mobiltype/vload', 'vload')->name('mobiltype.vload');
        Route::get('/mobiltype/vcreate', 'vcreate')->name('mobiltype.vcreate');
        Route::get('/mobiltype/vedit/{id}', 'vedit')->name('mobiltype.vedit');
        Route::post('/mobiltype/vstore', 'vstore')->name('mobiltype.vstore');
        Route::post('/mobiltype/vdestroy/{id}', 'vdestroy')->name('mobiltype.vdestroy');
    });

    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi', 'vindex')->name('transaksi.vindex');
        Route::get('/transaksi/vload', 'vload')->name('transaksi.vload');
        Route::get('/transaksi/vcreate', 'vcreate')->name('transaksi.vcreate');
        Route::get('/transaksi/vedit/{id}', 'vedit')->name('transaksi.vedit');
        Route::post('/transaksi/vstore', 'vstore')->name('transaksi.vstore');
        Route::post('/transaksi/vdestroy/{id}', 'vdestroy')->name('transaksi.vdestroy');
        Route::get('/customers/{id}', 'getCustomer')->name('transaksi.getCustomer');
        Route::get('/search-customers', 'searchCustomers')->name('transaksi.searchCustomers');

        Route::get('/mobils/{id}', 'getMobil')->name('transaksi.getMobil');
        Route::get('/transaksi/vdetail/{id}', 'vdetail')->name('transaksi.vdetail');

        // Route::get('/transaksi/vbayar/{id}', 'vbayar')->name('transaksi.vbayar');
        // Route::post('/transaksi/vstorebayar', 'vstorebayar')->name('transaksi.vstorebayar');
        Route::get('/transaksi/print', 'print')->name('transaksi.print');


    });

    Route::controller(KwitansiController::class)->group(function () {
        Route::get('/kwitansi/vcreate/{id}', 'vcreate')->name('kwitansi.vcreate');
        Route::post('/kwitansi/vcreate/{id}', 'vcreate')->name('kwitansi.vcreate');
        Route::get('/kwitansi/vedit/{id}', 'vedit')->name('kwitansi.vedit');
        Route::post('/kwitansi/vedit/{id}', 'vedit')->name('kwitansi.vedit');
        Route::post('/kwitansi/vstore', 'vstore')->name('kwitansi.vstore');
        Route::post('/kwitansi/vdestroy/{id}', 'vdestroy')->name('kwitansi.vdestroy');
    });

});

// PROYEK TA INI 2
Route::get('/load/kecamatan', [AuthController::class, 'loadKecamatan'])->name('load.kecamatan');
Route::get('/load/kelurahan', [AuthController::class, 'loadKelurahan'])->name('load.kelurahan');

Route::get('/load/country', [AuthController::class, 'loadCountry'])->name('load.country');
Route::get('/load/state', [AuthController::class, 'loadState'])->name('load.state');
Route::get('/load/akun', [AuthController::class, 'loadAkun'])->name('load.akun');


Route::controller(DocumentsController::class)->group(function () {
    Route::get('/vdownload/{id}', 'vdownload')->name('vdownload');
});


Route::controller(StripeController::class)->group(function () {
    Route::get('/stripe', 'vindex')->name('vindex');
    Route::get('/stripe/create', 'vcreate')->name('vcreate');
    Route::post('/stripe/create', 'vcreate')->name('vcreate');
    Route::get('/stripe/print', 'vprint')->name('vprint');
    Route::get('/stripe/link', 'vlink')->name('vlink');
    
});

Route::controller(XerohooksController::class)->group(function () {
    Route::post('/xerohooks', 'vhooks')->name('vhooks');
    Route::get('/xerohooks', 'vhooks')->name('vhooks');
});

Route::controller(XeroController::class)->group(function () {
    Route::get('/getpaymentbyid/{id}', 'vgetpaymentbyid')->name('vgetpaymentbyid');
    Route::get('/getpayment/', 'vgetpayment')->name('vgetpayment');
    Route::get('/generateinvoice/{id}', 'vgenerateinvoicebyid')->name('vgenerateinvoicebyid');
});

Route::get("/send-mail", [MailController::class, "sendEmail"]);
Route::get('/send-mail/{id}', 'App\Http\Controllers\MailController@sendEmail');
Route::get('masterlabel/{id}', [PDFController::class, 'index']);
Route::get('invoice_pdf/{id}', [PDFController::class, 'shipment_invoices']);
Route::get('package_receipt/{id}', [PDFController::class, 'package_receipt']);
Route::get('shipmentlabel/{id}', [PDFController::class, 'shipment_label']);
Route::get('convert_gstvat', [PDFController::class, 'convert_gstvat']);
Route::get('stt_pdf/{id}', [PDFController::class, 'stt_pdf']);


//Proyek TA
Route::get('invoices_rental/{id}', [PDFController::class, 'invoices_rental'])->name('invoices.rental');

Route::controller(BookingController::class)->group(function () {
    Route::get('/booking', 'vindex')->name('booking.vindex');
    Route::get('/booking/vload', 'vload')->name('booking.vload');
    Route::get('/booking/vcreate', 'vcreate')->name('booking.vcreate');
    Route::post('/booking/vstore', 'vstore')->name('booking.vstore');
    Route::get('/mobilss/{id}', 'getMobil')->name('booking.getMobil');


    // Route::get('/mobiltype/vcreate', 'vcreate')->name('mobiltype.vcreate');
    // Route::get('/mobiltype/vedit/{id}', 'vedit')->name('mobiltype.vedit');
    // Route::post('/mobiltype/vdestroy/{id}', 'vdestroy')->name('mobiltype.vdestroy');
});

// Gunakan middleware dalam group route

Route::group(['middleware' => ['web', 'XeroAuthenticated']], function () {
    Route::get('xero', function () {
        return Xero::getTenantName();
    });
});
Route::get('xero/connect', function () {
    return Xero::connect();
});

