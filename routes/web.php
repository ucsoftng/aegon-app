<?php

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

Route::get('/',['as'=>'home','uses'=>'Auth\LoginController@showLoginForm']);
//Route::get('/',['as'=>'home','uses'=>'HomeController@index']);
Route::get('about-us',['as'=>'about-us','uses'=>'HomeController@getAbout']);
Route::get('faq',['as'=>'faq','uses'=>'HomeController@getFaq']);
Route::get('document',['as'=>'document','uses'=>'HomeController@getDocument']);
Route::get('brandbook',['as'=>'brandbook','uses'=>'HomeController@getBandbook']);
Route::get('terms',['as'=>'terms','uses'=>'HomeController@getTerms']);
Route::get('privacy',['as'=>'privacy','uses'=>'HomeController@getPrivacy']);
Route::get('pricing',['as'=>'pricing','uses'=>'HomeController@investment']);
Route::get('services',['as'=>'services','uses'=>'HomeController@getServices']);
Route::get('affiliate',['as'=>'affiliate','uses'=>'HomeController@affiliate']);
Route::get('compounding',['as'=>'compounding','uses'=>'HomeController@compounding']);
Route::get('security',['as'=>'security','uses'=>'HomeController@security']);
Route::get('careers',['as'=>'careers','uses'=>'HomeController@careers']);
Route::get('referral',['as'=>'referral','uses'=>'HomeController@referral']);
Route::get('bots',['as'=>'bots','uses'=>'HomeController@bots']);
Route::get('choose-bots',['as'=>'choose-bots','uses'=>'HomeController@investment']);
Route::get('tgc-academy',['as'=>'tgc-academy','uses'=>'HomeController@tgcAcademy']);
Route::get('tgc-capital-1',['as'=>'tgc-capital-1','uses'=>'HomeController@tgcCapital']);
Route::get('tgc-capital-pro',['as'=>'tgc-capital-pro','uses'=>'HomeController@tgcCapitalPro']);
Route::get('tgc-elite',['as'=>'tgc-elite','uses'=>'HomeController@tgcElite']);
Route::get('tgc-signals',['as'=>'tgc-signals','uses'=>'HomeController@tgcSignals']);
Route::get('contact',['as'=>'contact','uses'=>'HomeController@getContact']);
//Route::get('market',['as'=>'market','uses'=>'HomeController@shop']);
Route::post('contact',['as'=>'contact','uses'=>'HomeController@submitContact']);
Route::get('news',['as'=>'news','uses'=>'HomeController@getNews']);
Route::get('news-details/{id}/{slug}',['as'=>'news-details','uses'=>'HomeController@newsDetails']);
Route::get('/menu/{id}/{name}','HomeController@menu');
Route::get('category-news/{id}/{slug}',['as'=>'category-news','uses'=>'HomeController@categoryNews']);
Route::post('newsletter','HomeController@submitNewsletter')->name('newsletter');
Route::get('home',['as'=>'home','uses'=>'UserController@getDashboard']);

Route::get('otp','HomeController@getOTP')->name('otp');
Route::post('otp','Auth\RegisterController@verifyOTP')->name('otp');


Route::get('verify-2fas','Auth\LoginController@verify2FA')->name('verify-2fas');
Route::post('verify-2fap','Auth\LoginController@verifyToken')->name('verify-2fap');

//Route::group(['middleware' => ['web'], 'namespace' => '\Thecodework\TwoFactorAuthentication\Http\Controllers'], function () {
//    Route::get('verify-2fa', 'TwoFactorAuthenticationController@verifyTwoFactorAuthentication');
//    Route::post('verify-2fa', 'TwoFactorAuthenticationController@verifyToken');
//    Route::get(config('2fa-config.setup_2fa'), 'TwoFactorAuthenticationController@setupTwoFactorAuthentication');
//    Route::post(config('2fa-config.enable_2fa'), 'TwoFactorAuthenticationController@enableTwoFactorAuthentication');
//    Route::post(config('2fa-config.disable_2fa'), 'TwoFactorAuthenticationController@disableTwoFactorAuthentication');
//});

/*----------------Start Admin Authentication Route List----------------------------- */

Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login')->name('admin.login.post');
Route::get('admin-logout', 'Admin\LoginController@logout')->name('admin.logout');

// Password Reset Routes...
Route::get('admin-password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin-password/reset', 'Admin\ResetPasswordController@reset');

/*----------------End Admin Authentication Route List----------------------------- */

/*--------- Admin Dashboard Redirected ------------ */
Route::get('admin-dashboard',['as'=>'dashboard','uses'=>'DashboardController@getDashboard']);
Route::get('admin-edit-profile',['as'=>'edit-profile','uses'=>'DashboardController@editProfile']);
Route::post('edit-profile',['as'=>'update-profile','uses'=>'DashboardController@updateProfile']);
Route::get('change-password', ['as'=>'change-pass', 'uses'=>'DashboardController@getChangePass']);
Route::post('change-password', ['as'=>'change-pass', 'uses'=>'DashboardController@postChangePass']);

/*----------- General Setting Route List -------------*/

Route::get('general-setting', ['as'=>'general-setting', 'uses'=>'WebSettingController@getGeneralSetting']);
Route::post('general-setting/{id}', ['as'=>'update_general', 'uses'=>'WebSettingController@putGeneralSetting']);

/*----------- General Setting Route List -------------*/

Route::get('basic-setting', ['as'=>'basic-setting', 'uses'=>'BasicSettingController@getBasicSetting']);
Route::post('basic-general/{id}', ['as'=>'basic-update', 'uses'=>'BasicSettingController@putBasicSetting']);

/* News category Route List */
Route::get('news-category',['as'=>'news-category','uses'=>'DashboardController@getCategory']);
Route::post('news-category',['as'=>'news-category','uses'=>'DashboardController@storeCategory']);
Route::get('news-category/{task_id?}',['as'=>'news-category-edit','uses'=>'DashboardController@editCategory']);
Route::post('news-category/{task_id?}',['as'=>'news-category-edit','uses'=>'DashboardController@updateCategory']);

/* News Management Route List */
Route::get('news-create',['as'=>'news-create','uses'=>'DashboardController@createNews']);
Route::post('news-create',['as'=>'news-create','uses'=>'DashboardController@storeNews']);
Route::get('news-show',['as'=>'news-show','uses'=>'DashboardController@showNews']);
Route::get('news-edit/{id}',['as'=>'news-edit','uses'=>'DashboardController@editNews']);
Route::post('news-edit/{id}',['as'=>'news-update','uses'=>'DashboardController@updateNews']);
Route::get('news-view/{id}',['as'=>'news-view','uses'=>'DashboardController@viewNews']);
Route::post('delete-news',['as'=>'delete-news','uses'=>'DashboardController@deleteNews']);

/* Payment Route List */
Route::get('payment-manage',['as'=>'payment-manage','uses'=>'DashboardController@managePayment']);
Route::post('payment-manage/{id}',['as'=>'payment-manage-update','uses'=>'DashboardController@updateManagePayment']);

/* Plan management Route list */
Route::get('plan-create',['as'=>'plan-create','uses'=>'DashboardController@createPlan']);
Route::post('plan-create',['as'=>'plan-create','uses'=>'DashboardController@storePlan']);
Route::get('plan-show',['as'=>'plan-show','uses'=>'DashboardController@showPlan']);
Route::get('plan-edit/{id}',['as'=>'plan-edit','uses'=>'DashboardController@editPlan']);
Route::post('plan-edit/{id}',['as'=>'plan-update','uses'=>'DashboardController@updatePlan']);
Route::post('delete-plan',['as'=>'delete-plan','uses'=>'DashboardController@deletePlan']);

/* Manage Investment Compound */
Route::get('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@manageCompound']);
Route::post('manage-compound',['as'=>'manage-compound','uses'=>'DashboardController@storeCompound']);
Route::get('manage-compound/{task_id?}',['as'=>'manage-compound-edit','uses'=>'DashboardController@editCompound']);
Route::post('manage-compound/{task_id?}',['as'=>'manage-compound-edit','uses'=>'DashboardController@updateCompound']);

/* MANAGE SUPPORT */
Route::get('admin-support',['as'=>'admin-support','uses'=>'DashboardController@adminSupport']);
Route::get('admin-support-pending',['as'=>'admin-support-pending','uses'=>'DashboardController@adminSupportPending']);
Route::get('admin-support-mess/{id}',['as'=>'admin-support-mess','uses'=>'DashboardController@adminSupportMessage']);
Route::post('admin-support-message',['as'=>'admin-support-message','uses'=>'DashboardController@adminSupportMessageSubmit']);
Route::post('admin-support-close',['as'=>'admin-support-close','uses'=>'DashboardController@adminSupportClose']);

/* Admin Manual Fund Add Route */

/* User Authentication */

Auth::routes();
Route::get('verifyDone/{email}/{verifyToken}',['as'=>'verifyDone','uses'=>'Auth\RegisterController@verifyDone']);
Route::get('e-confirm/{email}/{verifyToken}',['as'=>'e-confirm','uses'=>'Auth\RegisterController@verifyDone']);
//Route::post('reset_password_without_token', 'Auth\AccountsController@validatePasswordRequest');
//Route::post('reset_password_with_token', 'Auth\AccountsController@resetPassword');

/* ----- User Dashboard Route List -----*/
Route::get('deposit-amount',['as'=>'deposit-amount','uses'=>'UserController@amountDeposit']);
Route::post('paypal-check-amount',['as'=>'paypal-check-amount','uses'=>'UserController@paypalCheck']);
Route::post('paypal-ipn',['as'=>'paypal-ipn','uses'=>'HomeController@paypalIpn']);
Route::post('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::get('withdraw-check-amount',['as'=>'withdraw-check-amount','uses'=>'WithdrawController@checkAmount']);
Route::post('user-details',['as'=>'user-details','uses'=>'DashboardController@userDetails']);

Route::get('btc-preview',['as'=>'btc-preview','uses'=>'UserController@btcPreview']);
Route::post('btcash-preview',['as'=>'btcash-preview','uses'=>'UserController@btcashPreview']);
Route::post('eth-preview',['as'=>'eth-preview','uses'=>'UserController@ethPreview']);
Route::post('usdt-preview',['as'=>'usdt-preview','uses'=>'UserController@usdtPreview']);
Route::post('usdd-preview',['as'=>'usdd-preview','uses'=>'UserController@usddPreview']);
Route::post('doge-preview',['as'=>'doge-preview','uses'=>'UserController@dogePreview']);
Route::post('stellar-preview',['as'=>'stellar-preview','uses'=>'UserController@stellarPreview']);
Route::post('busd-preview',['as'=>'busd-preview','uses'=>'UserController@busdPreview']);

Route::get('btc_ipn/{invoice_id}/{secret}',['as'=>'btc_ipn','uses'=>'HomeController@btcIPN']);

Route::get('crypto-prices/{id}','HomeController@cryptoPrices')->name('crypto-prices');

Route::get('auto-deposit',['as'=>'auto-deposit','uses'=>'UserController@autoDeposit']);
Route::post('kyc-update','UserController@submitKYC')->name('kyc-update');

Route::get('charts/wallet_chart','UserController@walletChart')->name('charts.wallet_chart');

Route::post('place-trade','UserController@placeTrade')->name('place-trade');
Route::post('trade-result','UserController@tradeResult')->name('trade-result');

Route::get('/2fa/validate', 'Auth\LoginController@getValidateToken');
Route::post('/2fa/validate', 'Auth\LoginController@postValidateToken')->name('2fa.validate');


Route::group(['prefix' => 'user'], function () {

    Route::get('dashboard',['as'=>'user-dashboard','uses'=>'UserController@getDashboard']);
    Route::get('details',['as'=>'user-details','uses'=>'UserController@getDetails']);
    Route::get('programs','UserController@getPrograms')->name('programs');
    Route::get('user-kyc','UserController@getKYC')->name('user-kyc');


    Route::get('user-edit',['as'=>'user-edit','uses'=>'UserController@editUser']);
    Route::post('user-edit/{id}',['as'=>'user-update','uses'=>'UserController@updateUser']);

    Route::get('markets',['as'=>'markets','uses'=>'UserController@markets']);
    Route::get('pair-detail/{id}',['as'=>'pair-detail','uses'=>'UserController@pairDetail']);
    Route::get('user-password',['as'=>'user-password','uses'=>'UserController@userPassword']);
    Route::post('user-password/{id}',['as'=>'user-password-update','uses'=>'UserController@updatePassword']);

    Route::get('wallets','UserController@wallets')->name('wallets');
    Route::get('wallet/{id}/{short}','UserController@walletDetails')->name('wallet');
//    Route::get('fund-add',['as'=>'add-fund','uses'=>'UserController@addFund']);
    Route::post('fund-add',['as'=>'add-fund','uses'=>'UserController@storeFund']);
    Route::get('fund-history',['as'=>'fund-history','uses'=>'UserController@historyFund']);

    Route::get('trade',['as'=>'trade','uses'=>'UserController@selectTrade']);
    Route::get('start-trade',['as'=>'start-trade','uses'=>'UserController@startTrade']);


    Route::get('deposit-new',['as'=>'deposit-new','uses'=>'UserController@newDeposit']);
    Route::post('deposit-post',['as'=>'deposit-post','uses'=>'UserController@postDeposit']);
    Route::post('deposit-submit',['as'=>'deposit-submit','uses'=>'UserController@depositSubmit']);
    Route::get('deposit-history',['as'=>'deposit-history','uses'=>'UserController@depositHistory']);

    Route::get('repeat-history',['as'=>'repeat-history','uses'=>'UserController@repeatHistory']);
    Route::get('repeat-table/{id}',['as'=>'repeat-table','uses'=>'UserController@repeatTable']);

    Route::get('withdraw-new',['as'=>'withdraw-new','uses'=>'WithdrawController@newWithdraw']);
    Route::post('withdraw-new',['as'=>'withdraw-new','uses'=>'WithdrawController@postWithdraw']);
    Route::post('withdraw-submit',['as'=>'withdraw-submit','uses'=>'WithdrawController@submitWithdraw']);
    Route::get('withdraw-history',['as'=>'withdraw-history','uses'=>'WithdrawController@withdrawHistory']);

    Route::get('reference-user',['as'=>'reference-user','uses'=>'UserController@referenceUser']);
    Route::get('reference-history',['as'=>'reference-history','uses'=>'UserController@referenceHistory']);

    Route::get('user-activity',['as'=>'user-activity','uses'=>'UserController@userActivity']);
    Route::get('announcements',['as'=>'announcements','uses'=>'UserController@announcements']);


    Route::get('manual-fund-add',['as'=>'manual-fund-add','uses'=>'UserController@manualFundAdd']);
    route::post('manual-fund-add',['as'=>'manual-fund-add','uses'=>'UserController@StoreManualFundAdd']);
    Route::post('manual-fund-submit',['as'=>'manual-fund-submit','uses'=>'UserController@submitManualFund']);
    Route::get('manual-fund-history',['as'=>'manual-fund-history','uses'=>'UserController@manualFundHistory']);
    Route::get('manual-fund-details/{id}',['as'=>'manual-fund-details','uses'=>'UserController@manualFundAddDetails']);

    Route::get('support-open',['as'=>'support-open','uses'=>'UserController@openSupport']);
    Route::post('support-open',['as'=>'support-open','uses'=>'UserController@submitSupport']);
    Route::get('support-all',['as'=>'support-all','uses'=>'UserController@allSupport']);
    Route::get('support-message/{id}',['as'=>'support-message','uses'=>'UserController@supportMessage']);
    Route::post('user-support-message',['as'=>'user-support-message','uses'=>'UserController@userSupportMessage']);
    Route::post('user-support-close',['as'=>'user-support-close','uses'=>'UserController@supportClose']);

    Route::post('user-top-up',['as'=>'user-top-up','uses'=>'UserController@topUpDeposit']);

    Route::get('swap-coins','UserController@swapCoins')->name('swap-coins');
    Route::post('sswap-coin','UserController@sswapCoins')->name('sswap-coin');

    Route::get('transfer-reference','UserController@transferReference')->name('transfer-reference');
    Route::post('tansfer-referral','UserController@transferReferral')->name('transfer-referral');

    Route::get('settings',['as'=>'settings','uses'=>'UserController@settings']);

    Route::get('start-2fa','UserController@start2FA')->name('start-2fa');
    Route::get('complete-2fa','UserController@complete2FA')->name('complete-2fa');

    Route::get('deactivate-2fa','UserController@disable2fa')->name('deactivate-2fa');

});

Route::middleware(['2fa'])->group(function () {
    Route::post('/2fa', 'UserController@enable2FA')->name('2fa');
    Route::post('/log-2fa', 'Auth\LoginController@postValidateToken')->name('log-2fa');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('withdraw-pending',['as'=>'withdraw-pending','uses'=>'DashboardController@withdrawPending']);
    Route::get('withdraw-success',['as'=>'withdraw-success','uses'=>'DashboardController@withdrawSuccess']);
    Route::get('withdraw-refund',['as'=>'withdraw-refund','uses'=>'DashboardController@withdrawRefund']);
    Route::post('withdraw-success-submit',['as'=>'withdraw-success-submit','uses'=>'DashboardController@withdrawSuccessSubmit']);
    Route::post('withdraw-refund-submit',['as'=>'withdraw-refund-submit','uses'=>'DashboardController@withdrawRefundSubmit']);
    Route::post('edit-withdraw-date',['as'=>'edit-withdraw-date','uses'=>'DashboardController@updateWithdrawDate']);
    Route::post('edit-wallet-address',['as'=>'edit-wallet-address','uses'=>'DashboardController@updateWalletAddress']);

    Route::get('user-manage',['as'=>'user-manage','uses'=>'DashboardController@manageUser']);
    Route::get('user-transaction/{id}',['as'=>'user-transaction','uses'=>'DashboardController@userTransaction']);
    Route::get('user-wallets/{id}',['as'=>'user-wallets','uses'=>'DashboardController@userWallets']);
    Route::get('user-deposit/{id}',['as'=>'user-deposit','uses'=>'DashboardController@userDeposit']);
    Route::get('user-withdraw/{id}',['as'=>'user-withdraw','uses'=>'DashboardController@userWithdraw']);

    Route::get('manual-admin-fund/{id}',['as'=>'manual-admin-fund','uses'=>'DashboardController@manualAdminAddFunds']);
    Route::post('store-manual-admin-fund',['as'=>'store-manual-admin-fund','uses'=>'DashboardController@storemanualAdminAddFunds']);
    Route::get('manual-admin-deposit/{id}',['as'=>'manual-admin-deposit','uses'=>'DashboardController@manualAdminDeposit']);
    Route::post('store-manual-admin-deposit',['as'=>'store-manual-admin-deposit','uses'=>'DashboardController@submitManualAdminDeposit']);
    Route::get('tweak-funds/{id}',['as'=>'tweak-funds','uses'=>'DashboardController@tweakFunds']);
    Route::post('tweak-fundz',['as'=>'tweak-fundz','uses'=>'DashboardController@doTweakNow']);
    Route::post('deposit-tweak/{id}',['as'=>'deposit-tweak','uses'=>'DashboardController@depositTweak']);
    Route::get('delete-profit/{id}',['as'=>'delete-profit','uses'=>'DashboardController@deleteProfit']);
    
    
    Route::get('referrals-v/{id}',['as'=>'referrals-v','uses'=>'DashboardController@vReferrals']);
    Route::get('update-referrals/{id}',['as'=>'update-referrals','uses'=>'DashboardController@updateReferrals']);

    Route::post('user-block',['as'=>'user-block','uses'=>'DashboardController@blockUser']);
    Route::post('user-unblock',['as'=>'user-unblock','uses'=>'DashboardController@unblockUser']);
    Route::post('user-activate',['as'=>'user-activate','uses'=>'DashboardController@activateUser']);
    Route::post('delete-user',['as'=>'delete-user','uses'=>'DashboardController@deleteUser']);

    Route::get('block-user',['as'=>'block-user','uses'=>'DashboardController@blockUserList']);

    Route::get('latter-create',['as'=>'latter-create','uses'=>'DashboardController@latterCreate']);
    Route::post('latter-create',['as'=>'latter-create','uses'=>'DashboardController@latterStore']);

    Route::get('manage-strategy',['as'=>'manage-strategy','uses'=>'DashboardController@getStrategy']);
    Route::post('manage-strategy',['as'=>'manage-strategy','uses'=>'DashboardController@storeStrategy']);
    Route::get('strategy-edit/{id}',['as'=>'strategy-edit','uses'=>'DashboardController@editStrategy']);
    Route::post('strategy-edit/{id}',['as'=>'strategy-update','uses'=>'DashboardController@updateStrategy']);

    Route::get('manage-about',['as'=>'manage-about','uses'=>'WebSettingController@getAbout']);
    Route::post('about-update/{id}',['as'=>'about-update','uses'=>'WebSettingController@putAbout']);

    Route::get('manage-faq',['as'=>'manage-faq','uses'=>'WebSettingController@getFAQS']);
    Route::post('faq-update/{id}',['as'=>'faq-update','uses'=>'WebSettingController@putFAQS']);

    Route::get('manage-document',['as'=>'manage-document','uses'=>'WebSettingController@getDocument']);
    Route::post('document-update/{id}',['as'=>'document-update','uses'=>'WebSettingController@putDocument']);

    Route::get('manage-terms',['as'=>'manage-terms','uses'=>'WebSettingController@getTerms']);
    Route::post('terms-update/{id}',['as'=>'terms-update','uses'=>'WebSettingController@putTerms']);

    Route::get('manage-privacy',['as'=>'manage-privacy','uses'=>'WebSettingController@getPrivacy']);
    Route::post('privacy-update/{id}',['as'=>'privacy-update','uses'=>'WebSettingController@putPrivacy']);

    Route::get('manage-brandbook',['as'=>'manage-brandbook','uses'=>'WebSettingController@getBandbook']);
    Route::post('brandbook-update/{id}',['as'=>'brandbbok-update','uses'=>'WebSettingController@putBrandbook']);

    Route::get('admin-activity',['as'=>'admin-activity','uses'=>'DashboardController@adminActivity']);

    Route::get('admin-deposit',['as'=>'admin-deposit','uses'=>'DashboardController@adminDeposit']);
    Route::get('admin-rebeat',['as'=>'admin-rebeat','uses'=>'DashboardController@adminRebeat']);

    Route::get('manual-payment',['as'=>'manual-payment','uses'=>'ManualPaymentController@getMethod']);
    Route::post('manual-payment',['as'=>'manual-payment','uses'=>'ManualPaymentController@storeMethod']);
    Route::get('manual-payment/{task_id?}',['as'=>'manual-payment-edit','uses'=>'ManualPaymentController@editMethod']);
    Route::post('manual-payment/{task_id?}',['as'=>'manual-payment-edit','uses'=>'ManualPaymentController@updateMethod']);
    Route::post('manual-active',['as'=>'manual-active','uses'=>'ManualPaymentController@manualActive']);
    Route::post('manual-deactive',['as'=>'manual-deactive','uses'=>'ManualPaymentController@manualDeActive']);

    Route::get('manual-payment-request',['as'=>'manual-payment-request','uses'=>'DashboardController@getManualPaymentRequest']);
    Route::get('manual-payment-view/{id}',['as'=>'manual-payment-view','uses'=>'DashboardController@viewManualPayment']);
    Route::post('manual-payment-confirm',['as'=>'manual-payment-confirm','uses'=>'DashboardController@manualPaymentConfirm']);
    Route::get('btc-payment-request',['as'=>'btc-payment-request','uses'=>'DashboardController@getBtcPaymentRequest']);
    Route::get('btc-payment-confirm/{id}',['as'=>'btc-payment-confirm','uses'=>'DashboardController@BtcPaymentConfirm']);
    Route::get('btc-payment-cancel/{id}',['as'=>'btc-payment-cancel','uses'=>'DashboardController@BtcPaymentCancel']);

    Route::get('slider-create',['as'=>'slider-create','uses'=>'DashboardController@sliderCreate']);
    Route::post('slider-create',['as'=>'slider-create','uses'=>'DashboardController@sliderStore']);
    Route::get('slider-show',['as'=>'slider-show','uses'=>'DashboardController@sliderShow']);
    Route::get('slider-edit/{id}',['as'=>'slider-edit','uses'=>'DashboardController@sliderEdit']);
    Route::post('slider-edit/{id}',['as'=>'slider-update','uses'=>'DashboardController@sliderUpdate']);
    Route::delete('slider-delete',['as'=>'slider-delete','uses'=>'DashboardController@sliderDelete']);

    Route::get('manage-promo',['as'=>'manage-promo','uses'=>'DashboardController@managePromo']);
    Route::post('manage-promo',['as'=>'manage-promo','uses'=>'DashboardController@storePromo']);
    Route::get('manage-promo/{task_id?}',['as'=>'manage-promo-edit','uses'=>'DashboardController@editPromo']);
    Route::post('manage-promo/{task_id?}',['as'=>'manage-promo-edit','uses'=>'DashboardController@updatePromo']);

    Route::get('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@manageTestimonial']);
    Route::post('manage-testimonial',['as'=>'manage-testimonial','uses'=>'DashboardController@storeTestimonial']);
    Route::get('manage-testimonial/{task_id?}',['as'=>'manage-testimonial-edit','uses'=>'DashboardController@editTestimonial']);
    Route::get('delete-testimonial/{id}',['as'=>'delete-testimonial','uses'=>'DashboardController@deleteTestimonial']);
    Route::post('manage-testimonial/{task_id?}',['as'=>'manage-testimonial-edit','uses'=>'DashboardController@updateTestimonial']);

    Route::get('manage-chose',['as'=>'manage-chose','uses'=>'DashboardController@manageChose']);
    Route::post('manage-chose',['as'=>'manage-chose','uses'=>'DashboardController@storeChose']);
    Route::get('manage-chose/{task_id?}',['as'=>'manage-chose-edit','uses'=>'DashboardController@editChose']);
    Route::post('manage-chose/{task_id?}',['as'=>'manage-chose-edit','uses'=>'DashboardController@updateChose']);

    /* Menu Route List*/
    Route::get('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@getMenuCreate']);
    Route::post('menu-create',['as'=>'menu_create','uses'=>'WebSettingController@postMenuCreate']);
    Route::get('menu-show',['as'=>'menu_show','uses'=>'WebSettingController@showMenuCreate']);
    Route::get('menu-edit/{id}',['as'=>'menu-edit','uses'=>'WebSettingController@editMenuCreate']);
    Route::post('menu-edit/{id}',['as'=>'menu-update','uses'=>'WebSettingController@updateMenuCreate']);
    Route::delete('menu-delete/{id}',['as'=>'menu-delete','uses'=>'WebSettingController@deleteMenuCreate']);

    /*Announcements*/
    Route::get('announcement-create',['as'=>'announcement_create','uses'=>'WebSettingController@getAnnouncementCreate']);
    Route::post('announcement-create',['as'=>'announcement_create','uses'=>'WebSettingController@postAnnouncementCreate']);
    Route::get('announcement-show',['as'=>'announcement_show','uses'=>'WebSettingController@showAnnouncementCreate']);
    Route::get('announcement-edit/{id}',['as'=>'announcement-edit','uses'=>'WebSettingController@editAnnouncementCreate']);
    Route::post('announcement-edit/{id}',['as'=>'announcement-update','uses'=>'WebSettingController@updateAnnouncementCreate']);
    Route::post('announcement-delete',['as'=>'announcement-delete','uses'=>'WebSettingController@deleteAnnouncementCreate']);
    
    Route::post('cancel-deposit','DashboardController@cancelDeposit')->name('cancel-deposit');
    
    Route::get('trading-activity','DashboardController@tradingActivity')->name('trading-activity');
    Route::post('trading-activity','DashboardController@submitTradingActivity')->name('trading-activity');
    Route::post('trading-activity-detail','DashboardController@submitTradingActivityDetail')->name('trading-activity-detail');
    Route::get('delete-trading-activity/{id}','DashboardController@deleteTradingActivity')->name('delete-trading-activity');
    Route::get('updates','DashboardController@updates')->name('updates');
    Route::get('delete-all-trad-input','DashboardController@deletealltradinput')->name('delete-all-trad-input');

    Route::post('top-up','DashboardController@topUpDeposit')->name('top-up');
    Route::post('complete-deposit','DashboardController@completeDeposit')->name('complete-deposit');

    Route::get('compound-account/{id}','DashboardController@compoundUserAccount')->name('compound-account');
    Route::get('uncompound-account/{id}','DashboardController@unCompoundUserAccount')->name('uncompound-account');

    Route::get('payment-wallets','DashboardController@paymentWallets')->name('payment-wallets');
    Route::get('ed/{id}',['as'=>'ed','uses'=>'DashboardController@edPaymentWallets']);
    Route::get('delete-payment-wallets/{id}','DashboardController@deletePaymentWallets')->name('delete-payment-wallets');
    Route::post('store-payment-wallets','DashboardController@createPaymentWallets')->name('store-payment-wallets');
    Route::post('update-payment-wallets','DashboardController@updatePaymentWallets')->name('update-payment-wallets');

    Route::get('trade-setting',['as'=>'trade-setting','uses'=>'DashboardController@tradeSetting']);
    Route::post('trade-setting',['as'=>'trade-setting','uses'=>'DashboardController@storeTradeSetting']);
    Route::get('trade-setting/{task_id?}',['as'=>'trade-setting-edit','uses'=>'DashboardController@editTradeSetting']);
    Route::post('trade-setting/{task_id?}',['as'=>'trade-setting-edit','uses'=>'DashboardController@updateTradeSetting']);

    Route::post('update-user-wallet','DashboardController@updateUserWallet')->name('update-user-wallet');

});

Route::post('check-compounding','DashboardController@checkCompounding')->name('check-compounding');

Route::get('partner-create',['as'=>'partner-create','uses'=>'DashboardController@createPartner']);
Route::post('partner-create',['as'=>'partner-create','uses'=>'DashboardController@storePartner']);
Route::get('partner-show',['as'=>'partner-show','uses'=>'DashboardController@showPartner']);
Route::get('partner-edit/{id}',['as'=>'partner-edit','uses'=>'DashboardController@editPartner']);
Route::post('partner-edit/{id}',['as'=>'partner-update','uses'=>'DashboardController@updatePartner']);
Route::post('partner-delete',['as'=>'partner-delete','uses'=>'DashboardController@deletePartner']);


Route::get('perfect-ipn',['as'=>'perfect-ipn','uses'=>'HomeController@perfectIPN']);
Route::post('stripe-preview',['as'=>'stripe-preview','uses'=>'UserController@stripePreview']);
Route::post('stripe-submit',['as'=>'stripe-submit','uses'=>'UserController@submitStripe']);

Route::get('withdraw-payment',['as'=>'withdraw-payment','uses'=>'DashboardController@getManualPayment']);
Route::post('withdraw-payment',['as'=>'withdraw-payment','uses'=>'DashboardController@storeManualPayment']);
Route::get('withdraw-payment/{task_id?}',['as'=>'withdraw-payment-edit','uses'=>'DashboardController@editManualPayment']);
Route::post('withdraw-payment/{task_id?}',['as'=>'withdraw-payment-edit','uses'=>'DashboardController@updateManualPayment']);
Route::post('payment-active',['as'=>'payment-active','uses'=>'DashboardController@paymentActive']);

Route::post('fund-check-amount',['as'=>'fund-check-amount','uses'=>'UserController@fundAddCheck']);

Route::post('withdraw-details',['as'=>'withdraw-details','uses'=>'HomeController@withdrawDetails']);
Route::post('swap-details',['as'=>'swap-details','uses'=>'HomeController@swapDetails']);
Route::post('ref-trf-check',['as'=>'ref-trf-check','uses'=>'HomeController@referralTransferCheck']);
Route::post('swap-check',['as'=>'swap-check','uses'=>'HomeController@swapCheck']);
Route::post('wallet-details',['as'=>'wallet-details','uses'=>'DashboardController@walletDetails']);

Route::post('see-announcement',['as'=>'see-announcement','uses'=>'HomeController@viewAnnouncement']);

Route::get('verify-payment/{id}',['as'=>'verify-payment','uses'=>'UserController@verifyPayment']);

Route::get('repeat-generator',['as'=>'repeat-generator','uses'=>'HomeController@rebetgen']);
Route::get('set-rate',['as'=>'set-rate','uses'=>'HomeController@setRate']);
Route::get('get-wallets',['as'=>'get-wallets','uses'=>'HomeController@getWallets']);
Route::get('assign-fpairs',['as'=>'assign-fpairs','uses'=>'HomeController@assignBotPairs']);
Route::get('delete-dets',['as'=>'delete-dets','uses'=>'HomeController@deleteDets']);
Route::get('/command', function(){
    \Artisan::call('custom:command');
});
