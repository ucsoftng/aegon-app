<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('plans','API\HomeController@getPlans');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'user'], function ()
{

//USER PROFILE API
    Route::get('profile','API\UserController@profile');
    Route::post('update-profile','API\UserController@updateProfile');


    Route::get('/dashboard', 'API\UserController@getDashboard');

//    Route::post('/passchange/{id}', 'Api\UserProfileController@submitPassword');

    // Visitor Registration/Login
    Route::post('/login', 'API\AuthenticationController@login');
    Route::post('/register', 'API\AuthenticationController@register');

    Route::get('deposit-fund','API\UserController@depositMethod');
    Route::post('deposit-fund','API\UserController@submitDepositFund');
    Route::get('deposit-preview','API\UserController@depositPreview');
    Route::get('deposit-confirm','API\UserController@depositConfirm');
    Route::get('deposit-history','API\UserController@historyDepositFund');
    Route::post('manual-deposit-submit','API\UserController@manualDepositSubmit');

    Route::get('transaction-log','API\UserController@userActivity');

    Route::get('withdraw-request','API\UserController@withdrawRequest');
    Route::post('withdraw-request','API\UserController@submitWithdrawRequest');
    Route::get('withdraw-preview/{id}','API\UserController@previewWithdraw');
    Route::post('withdraw-submit','API\UserController@submitWithdraw');
    Route::get('withdraw-log','API\UserController@withdrawLog');

    Route::get('support-open','API\UserController@openSupport');
    Route::post('support-open','API\UserController@submitSupport');
    Route::get('support-all','API\UserController@allSupport');
    Route::get('support-message/{id}','API\UserController@supportMessage');
    Route::post('user-support-message','API\UserController@userSupportMessage');
    Route::post('user-support-close','API\UserController@supportClose');

    Route::get('investment-new','API\UserController@newInvest');
    Route::post('investment-new','API\UserController@postInvest');
    Route::post('invest-amount-chk','API\UserController@chkInvestAmount');
    Route::post('investment-submit','API\UserController@submitInvest');
    Route::get('investment-history','API\UserController@historyInvestment');

    Route::group(['middleware'=>'auth:profile-api'], function()
    {
//        Route::post('logout', 'Api\UserAuthController@logout');
//        Route::post('details', 'Api\UserAuthController@details');
    });
});
