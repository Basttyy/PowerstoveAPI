<?php

use Illuminate\Http\Request;

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

//user auth middleware
Route::middleware('auth:api')->get('/users', function (Request $request) {
    return $request->user();
});
//device auth middleware
Route::middleware('auth:api-iot')->get('/devices', function (Request $request) {
    return $request->user();
});

//Auth::routes(['verify' => true]);

//User Authentication
Route::group(['prefix' => 'v1/auth'], function ($router) {
    //user auth routes
    Route::post('/login','Auth\Api\AuthController@login');
    Route::post('/register', 'Auth\Api\AuthController@register');
    Route::post('/logout', 'Auth\Api\AuthController@logout');
    Route::post('/refresh', 'Auth\Api\AuthController@refresh');
    Route::get('/profile', 'Auth\Api\AuthController@me');
    // Route::post('/user/facebook', 'CustomerController@loginFacebook');
    // Route::get('/oauth/token', 'CustomerController@redirect');
    // Route::get('/oauth/callback', 'CustomerController@callback');
});
//IoT Authentication
Route::group(['prefix' => 'v1/auth'], function ($router) {
    //device auth routes
    Route::post('/device/login', 'Auth\ApiIot\AuthController@login');
    Route::post('/device/logout', 'Auth\ApiIot\AuthController@logout');
    Route::post('/device/register', 'Auth\ApiIot\AuthController@register');
    Route::post('/device/profile', 'Auth\ApiIot\AuthController@me');
});

Route::get('v1/auth/email/verify/{id}', 'Auth\Api\VerificationApiController@verify')->name('verificationapi.verify');
Route::get('v1/auth/email/resend', 'Auth\Api\VerificationApiController@resend')->name('verificationapi.resend');
Route::post('v1/auth/resetpassword', 'Auth\Api\ResetPasswordController@sendResetLink');
Route::put('v1/auth/resetpassword', 'Auth\Api\ResetPasswordController@resetPassword');
Route::put('v1/auth/changepassword', 'Auth\Api\ResetPasswordController@changePassword');

Route::apiResources([
    '/v1/users' => 'Api\UserController',
    '/v1/stoves' => 'Api\StoveController',
    '/v1/feedbacks' => 'Api\FeedbackController'
]);

// //All User Based Protected Routes
// Route::group(['middleware' => 'auth:api'], function () {
//     Route::get('/customer', 'CustomerController@getCustomerProfile');
//     Route::put('/customer', 'CustomerController@updateCustomerProfile');
//     Route::put('/customer/address', 'CustomerController@updateCustomerAddress');
//     Route::put('/customer/creditCard', 'CustomerController@updateCreditCard');
// });

// //All Device Based Protected Routes
// Route::group(['middleware' => 'auth:api_device'], function () {
//     Route::apiResource('device_logs', 'ApiDevice\DeviceLogController', [ 'as' => 'api.device' ]);
//     Route::apiResource('data', 'ApiDevice\DatumController', [ 'as' => 'api.device' ]);
// });

// Route::post('/customers', 'CustomerController@store');                          //create a single customer

// //Routes for Attributes requests
// Route::group(['prefix' => 'attributes'], function () {
//     Route::get('/', 'AttributeController@getAllAttributes');
//     Route::get('/{attribute_id}', 'AttributeController@getSingleAttribute');
//     Route::get('/values/{attribute_id}', 'AttributeController@getAttributeValues');
//     Route::get('/inProduct/{product_id}', 'AttributeController@getProductAttributes');
// });
// //TODO routes for product requests
// Route::group(['prefix' => 'products'], function () {
//     Route::get('/', 'ProductController@getAllCategories');
//     Route::get('/{product_id}', 'ProductController@getProduct');
//     Route::get('/search', 'ProductController@searchProduct');
//     Route::get('/inCategory/{category_id}', 'ProductController@getProductsByCategory');
//     Route::get('/inDepartment/{department_id}', 'ProductController@getProductsInDepartment');
// });
// //TODO routes for department requests
// Route::group(['prefix' => 'departments'], function () {
//     Route::get('/', 'ProductController@getAllDepartments');
//     Route::get('/{department_id}', 'ProductController@getDepartment');
// });
// //TODO routes for categories requests
// Route::group(['prefix' => 'categories'], function () {
//     Route::get('/', 'ProductController@getAllCategories');
//     Route::get('/{category_id}', 'ProductController@getCategoryById');
//     Route::get('/inDepartment/{category_id}', 'ProductController@getDepartmentCategories');
//     Route::get('/inProduct/{category_id}', 'ProductController@getProductCategory');
// });
// //TODO routes for shipping requests
// Route::get('/shipping/regions', 'ShippingController@getShippingRegions');
// Route::get('/shipping/regions/{shipping_region_id}', 'ShippingController@getShippingType');
// //TODO routes for shopping carts
// Route::group(['prefix' => 'shoppingcart'], function () {
//     Route::get('/generateUniqueId', 'ShoppingCartController@generateUniqueCart');
//     Route::post('/add', 'ShoppingCartController@addItemToCart');
//     Route::get('/{cart_id}', 'ShoppingCartController@getCart');
//     Route::put('/update/{item_id}', 'ShoppingCartController@updateCartItem');
//     Route::delete('/empty/{cart_id}', 'ShoppingCartController@emptyCart');
//     Route::delete('/removeProduct/{item_id}', 'ShoppingCartController@removeItemFromCart');
// });
// //TODO routes for orders requests
// Route::group(['prefix' => 'orders'], function () {
//     Route::post('/', 'ShoppingCartController@createOrder');
//     Route::get('/inCustomer', 'ShoppingCartController@getCustomerOrders');
//     Route::get('/{order_id}', 'ShoppingCartController@getOrderSummary');
// });

// //Route::post('/stripe/charge', 'ShoppingCartController@processStripePayment');  //payment route

// //Tax relates requests routes
// Route::get('/tax', 'TaxController@getAllTax');
// Route::get('/tax/{tax_id}', 'TaxController@getTaxById');
