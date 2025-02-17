<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\CountriesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::resource('branch','App\Http\Controllers\BranchController');
Route::resource('country','App\Http\Controllers\CountryController');
Route::resource('State','App\Http\Controllers\StateController');
Route::get('sendemail/{id}','App\Http\Controllers\MailController@sendEmail');
Route::get('downloadDocument/{id}','App\Http\Controllers\DocumentsController@download');
Route::get('track-shipment/{trackingNo}', 'App\Http\Controllers\PreAlertsController@trackShipment');
Route::post('createresetlink', 'App\Http\Controllers\PasswordResetController@create');
Route::get('find/{token}', 'App\Http\Controllers\PasswordResetController@find');
Route::post('reset', 'App\Http\Controllers\PasswordResetController@reset');
Route::get('getStatesByCountryId/{id}','App\Http\Controllers\CountriesController@getStatesByCountryId');
Route::group([
    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers',
], function () {
    Route::resource('country','CountryController');
    Route::resource('State','StateController');
    Route::post('details', 'AuthController@details');
    Route::get('getallusers', 'AuthController@getallusers');
    Route::get('getuser/{user}', 'AuthController@getuser');
    Route::get('getallcustomers', 'AuthController@getallcustomers');
    Route::get('getLoginActivity/{user}', 'AuthController@getLoginActivity');
    Route::post('adduser', 'AuthController@adduser');
    Route::post('verifycode','AuthController@VerifyCode'); 
    Route::post('testemail','AuthController@TestEmail');
    Route::put('updateuser/{user}', 'AuthController@updateuser');
    Route::put('updatePassword/{user}', 'AuthController@updatePassword');
    Route::delete('deletecustomer/{user}', 'AuthController@deletecustomer');
    Route::delete('deleteuser/{id}', 'AuthController@delete_user');
    Route::resource('virtualaddress', 'VirtualAddressController');
    Route::resource('courier', 'CourierController');
    Route::resource('productdescription', 'ProductDescriptionController');
    Route::resource('shippingmode', 'ShippingModeController');
    Route::resource('shipmenttype', 'ShipmentTypeController');
    Route::resource('weightscale', 'WeightScaleController');
    Route::resource('sizescale', 'SizeScaleController');
    Route::resource('currency', 'CurrencyController');
    Route::resource('shipmentpayer', 'ShipmentPayerController');
    Route::resource('prealert', 'PreAlertsController');
    Route::resource('addressbook', 'AddressBookController');
    Route::get('customeraddressbook/{id}', 'AddressBookController@customeraddressbook');
    Route::resource('permission', 'PermissionController');
    Route::resource('shipmentstatuslist', 'ShipmentStatusListController');
    Route::resource('remarksstatuslist', 'RemarksStatusListController');
    Route::resource('shipmentstatus', 'ShipmentStatusController');
    Route::post('bulkUpdateShipmentStatus', 'ShipmentStatusController@bulkUpdateShipmentStatus');
    Route::resource('shippingrate', 'ShippingRatesController');
    Route::resource('shippingsubrate', 'ShippingSubRatesController');
    Route::post('shippingsubrateimport', 'ShippingSubRatesController@importSubrates');
    Route::get('shippingsubrate/getbyrateid/{id}', 'ShippingSubRatesController@getallshippingsubrates');
    Route::post('searchshippingrate', 'ShippingSubRatesController@searchshippingrate');
    Route::resource('currencyconversion', 'CurrencyConversionController');
    Route::resource('shippingzone', 'ShippingZoneController');
    Route::resource('shippingcharges', 'ShippingChargesController');
    Route::get('getShippingchargesbyShipment/{id}', 'ShippingChargesController@getallbyPreAlertId');
    Route::post('autochargeshipment', 'ShippingChargesController@AutoCharge');
    Route::post('bookshipment', 'PreAlertsController@bookshipment');
    Route::post('createShipmentAdmin', 'PreAlertsController@createShipmentAdmin');
    Route::put('markAsPaid/{id}', 'PreAlertsController@markAsPaid');
    Route::post('bulkmarkAsPaid', 'PreAlertsController@BulkmarkAsPaid');
    Route::get('getpageload', 'PreAlertsController@get_page_load');
    Route::post('addshippingzonelocation', 'ShippingZoneController@storeshippingzonelocation');
    Route::get('getshippingzonelocation/{id}', 'ShippingZoneController@getshippingzonelocation');
    Route::put('updateshippingzonelocation/{id}', 'ShippingZoneController@updateshippingzonelocation');
    Route::delete('deleteshippingzonelocation/{id}', 'ShippingZoneController@destroyshippingzonelocation');
    Route::post('addshipmentproduct', 'PreAlertsController@addSingleShipmentProduct');
    Route::put('updateshipmentproduct/{id}', 'PreAlertsController@updateSingleShipmentProduct');
    Route::get('getshipmentproduct/{id}', 'PreAlertsController@getShipmentProductById');
    Route::delete('deletesingleproductshipment/{id}', 'PreAlertsController@deleteSingleShipmentLineItem');
    Route::get('getallprealert', 'PreAlertsController@get_all_prealerts');
    Route::get('getallshipments', 'PreAlertsController@get_all_shipments');
    Route::get('getprealertsbybranch', 'PreAlertsController@getprealertsbybranch');
    Route::get('getlocationsforshipmentstatus', 'BranchController@getLocationsForShipmentStatus');
    Route::post('adddocument', 'DocumentsController@store');
    Route::post('addVendorDocument', 'DocumentsController@ConsolidateStore');
    Route::post('saveProfileImage', 'DocumentsController@saveProfileImage');
    Route::post('saveSupportingDocument', 'DocumentsController@saveSupportingDocument');
    Route::post('saveSupportingDocumentAdmin', 'DocumentsController@saveSupportingDocumentAdmin');
    Route::get('getSupportingDocument/{id}', 'DocumentsController@getSupportingDocument');
    Route::delete('deleteSupportingDocument/{id}', 'DocumentsController@deleteSupportingDocument');
    Route::get('getShipmentDocuments/{id}', 'DocumentsController@getShipmentDocuments');
    Route::delete('deleteShipmentDocument/{id}', 'DocumentsController@deleteShipmentDocument');
    Route::get('shipmentdata/{id}', 'PreAlertsController@getShipmentData');
    Route::put('editshipment/{id}', 'PreAlertsController@editShipment');
    Route::put('shipmentmessage/{id}', 'PreAlertsController@shipmentMessage');
    Route::put('markAsUnPaid/{id}', 'PreAlertsController@markAsUnPaid');
    Route::get('shipmentmessages/{id}', 'PreAlertsController@getShipmentMessages');
    Route::delete('deleteShipmentMessage/{id}', 'PreAlertsController@deleteMessage');
    Route::get('getshipmentsinfo/{id}', 'PreAlertsController@getshipmentsinfo');
    Route::get('getPersonalEffects', 'PreAlertsController@getPersonalEffects');
    //Container Routes
    Route::resource('container', 'ContainerController');
    Route::get('getcontainers', 'ContainerController@getcontainerstoassign');
    Route::get('getcontainershipments/{id}', 'ContainerController@getcontainershipments');
    Route::resource('containershipment', 'ContainerShipmentController');
    //Driver Routes
    Route::get('getAllDrivers', 'DriversController@getAllDrivers');
    Route::post('addDriver', 'DriversController@addDriver');
    Route::get('getDriver/{id}', 'DriversController@getDriver');
    Route::put('updateDriver/{id}', 'DriversController@updateDriver');
    Route::delete('deleteDriver/{id}', 'DriversController@deleteDriver');
    Route::post('assignShipmentDriver', 'DriversController@assignShipmentDriver');
    Route::get('getMontlyStats', 'DashboardController@getMontlyStats');
    Route::get('dashboardpageload', 'DashboardController@page_load');
    Route::get('dashboardsummary', 'DashboardController@account_summary');
    Route::get('dashboardprealerttrends', 'DashboardController@prealert_trends');
    Route::get('dashboardshipmenttrends', 'DashboardController@shipment_trends');
    Route::get('dashboardTopFiveCustomerTrends', 'DashboardController@top_five_customer_trend');
    Route::get('dashboardRecentShipments/{id}', 'CustomerController@recent_shipments');
    Route::get('cusDashData/{id}', 'CustomerController@cus_dash_data');
    Route::put('rejectSupportingDoc/{id}', 'CustomerController@reject_supporting_doc');
    Route::get('acceptSupportingDoc/{id}', 'CustomerController@accept_supporting_doc');
    Route::post('addCstomer', 'CustomerController@addCstomer');
    Route::resource('gstvat','GstvatController');
    Route::get('getCountryById/{id}', 'CountriesController@getCountryById');
    Route::resource('consignee', 'ConsigneeController');
    Route::get('pageload', 'ConsigneeController@pageload');
    Route::post('sendBulkInvoices', 'PreAlertsController@send_bulk_invoice');
    Route::get('manualVerification/{id}', 'CustomerController@verify_user_kwc');
    Route::post('bulkDeleteShipments', 'PreAlertsController@bulk_delete_shipments');
    Route::post('addConsolidatePreAlert', 'PreAlertsController@storeConsolidate');
    Route::get('downloadVendorDocument/{id}','DocumentsController@downloadVendorDocument');
    Route::post('updatePrealertVendor', 'PreAlertsController@update_prealert_vendor');
});
Route::Get('getcountries',[CountriesController::class,'index']);
Route::Get('getstates',[CountriesController::class,'getStates']);
