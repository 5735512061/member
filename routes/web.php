<?php
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::get('/','Frontend\SystemController@index');
Route::get('/condition','Frontend\SystemController@condition');
Route::get('/news-activities','Frontend\SystemController@newsActivity');
Route::get('/privilege','Frontend\SystemController@privilege');
Route::get('/rewards','Frontend\SystemController@reward');
Route::get('/reward-detail/{id}','Frontend\SystemController@rewardDetail');
Route::get('/alliance','Frontend\SystemController@alliance');
Route::get('/contact-us','Frontend\SystemController@contactUs');
Route::get('/about-us','Frontend\SystemController@aboutUs');
Route::get('/help-center','Frontend\SystemController@helpCenter');

Route::group(['prefix' => 'member'], function(){
    // ข้อมูลการเข้าสู่ระบบของ member
    Route::get('login','AuthMember\LoginController@ShowLoginForm')->name('member.login');
    Route::post('login','AuthMember\LoginController@login')->name('member.login.submit');
    Route::post('logout', 'AuthMember\LoginController@logout')->name('member.logout');

    Route::get('/change-password', 'AuthMember\ChangePasswordController@index')->name('password.change');
    Route::post('/change-password', 'AuthMember\ChangePasswordController@changePassword')->name('password.update');

    Route::get('/tel-change','Frontend\MembersController@telChange');
    Route::post('/tel-update','Frontend\MembersController@telUpdate');

    Route::get('/profile-change','Frontend\MembersController@profileChange');
    Route::post('/profile-update','Frontend\MembersController@profileUpdate');

    Route::get('/profile','Frontend\MembersController@profile')->name('member.home');
    Route::get('/reward-redem/{id}','Frontend\RewardsController@rewardRedem');
    Route::get('/redeem-point','Frontend\MembersController@redeemPoint');
});


// Super Admin
Route::group(['prefix' => '/'], function(){
    // ข้อมูลการลงทะเบียนและเข้าสู่ระบบของ super admin
    Route::get('register','AuthAdmin\RegisterController@ShowRegisterForm');
    Route::post('register','AuthAdmin\RegisterController@register');

    Route::get('login','AuthAdmin\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    Route::get('dashboard','Backend\AdminController@dashboard')->name('admin.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('member/list','Backend\AdminController@memberList')->name('member-list'); //หน้าข้อมูลสมาชิกทั้งหมด
    Route::get('member/list/status-on','Backend\AdminController@memberListOn'); //หน้าข้อมูลสมาชิกที่เปิดใช้งาน
    Route::get('member/list/status-off','Backend\AdminController@memberListOff'); //หน้าข้อมูลสมาชิกที่ปิดใช้งาน
    Route::get('search-member-list','Backend\AdminController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('search-member-tier','Backend\AdminController@searchMemberTier'); //ค้นหาข้อมูลสมาชิกตามระดับ
    Route::get('member/profile/{id}','Backend\AdminController@memberProfile'); //หน้าโปรไฟล์สมาชิก
    Route::get('editProfile/{id}','Backend\AdminController@editProfile'); //หน้าแก้ไขโปรไฟล์สมาชิก
    Route::post('editProfile','Backend\AdminController@editProfilePost'); //แก้ไขโปรไฟล์สมาชิก

    // ข้อมูลบัญชีร้านค้า
    Route::get('account-store','Backend\AdminController@accountStore'); //หน้าข้อมูลบัญชีร้านค้า
    Route::get('account-store/{store_name}','Backend\AdminController@accountStoreName'); //หน้าข้อมูลบัญชีร้านค้าแต่ละร้าน
    Route::get('create-account-store','Backend\AdminController@createAccountStore'); //หน้าสร้างบัญชีร้านค้า
    Route::post('create-account-store','Backend\AdminController@createAccountStorePost'); //สร้างบัญชีร้านค้า

    // ข้อมูลบัญชีพนักงาน
    Route::get('create-account-staff/{store_name}/{branch}','Backend\AdminController@createAccountStaff'); //หน้าสร้างบัญชีพนักงาน
    Route::post('create-account-staff','Backend\AdminController@createAccountStaffPost'); //สร้างบัญชีพนักงาน
    Route::get('account-staff/{store_name}/{branch}','Backend\AdminController@accountStaff'); //หน้าข้อมูลบัญชีพนักงานแต่ละร้าน
    Route::get('edit-account-staff/{id}','Backend\AdminController@editAccountStaff'); //หน้าแก้ไขบัญชีพนักงาน
    Route::post('edit-account-staff','Backend\AdminController@editAccountStaffPost'); //แก้ไขบัญชีพนักงาน
    
    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\AdminController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\AdminController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::post('editPoint','Backend\AdminController@editPoint'); //แก้ไขคะแนนสะสม
    Route::get('search-member','Backend\AdminController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม

    // ข้อมูลระดับสมาชิก
    Route::post('addtier','Backend\AdminController@addTierPost'); //เพิ่มระดับสมาชิก

    // จัดการของรางวัล   
    Route::get('create-reward','Backend\AdminController@createReward'); //หน้าสร้างของรางวัล
    Route::post('create-reward','Backend\AdminController@createRewardPost'); //เพิ่มของรางวัล
    Route::get('reward','Backend\AdminController@reward'); //หน้าของรางวัลทั้งหมด
    Route::get('reward-on','Backend\AdminController@rewardOn'); //หน้าของรางวัลกำลังใช้งาน
    Route::get('reward-notActive','Backend\AdminController@rewardNotActive'); //หน้าของรางวัลยังไม่ใช้งาน
    Route::get('reward-pause','Backend\AdminController@rewardPause'); //หน้าของรางวัลพักการใช้งาน
    Route::get('reward-off','Backend\AdminController@rewardOff'); //หน้าของรางวัลปิดการใช้งาน
    Route::get('reward-delete/{id}','Backend\AdminController@rewardDelete'); //ลบของรางวัล
    Route::get('reward-edit/{id}','Backend\AdminController@rewardEdit'); //แก้ไขของรางวัล
    Route::post('update-reward','Backend\AdminController@updateReward'); //อัพเดตของรางวัล

    // จัดการแคมเปญ
    Route::get('create-campaign','Backend\AdminController@createCampaign'); //หน้าสร้างแคมเปญ
    Route::post('create-campaign','Backend\AdminController@createCampaignPost'); //สร้างแคมเปญ
    Route::get('campaign','Backend\AdminController@campaign'); //หน้าแคมเปญทั้งหมด
    Route::get('campaign-on','Backend\AdminController@campaignOn'); //หน้ากำลังจัดแคมเปญ
    Route::get('campaign-notActive','Backend\AdminController@campaignNotActive'); //หน้ายังไม่เริ่มแคมเปญ
    Route::get('campaign-pause','Backend\AdminController@campaignPause'); //หน้าแคมเปญถูกพัก
    Route::get('campaign-off','Backend\AdminController@campaignOff'); //หน้าสิ้นสุดแคมเปญ
    Route::get('campaign-edit/{id}','Backend\AdminController@campaignEdit'); //แก้ไขแคมเปญ
    Route::post('update-campaign','Backend\AdminController@updateCampaign'); //อัพเดตแคมเปญ
});

// Admin ร้านค้า
Route::group(['prefix' => 'admin'], function(){
    // ข้อมูลการเข้าสู่ระบบของ admin ร้านค้า
    Route::get('/login','AuthStore\LoginController@ShowLoginForm')->name('admin-store.login');
    Route::post('/login','AuthStore\LoginController@login')->name('admin-store.login.submit');
    Route::post('/logout', 'AuthStore\LoginController@logout')->name('admin-store.logout');   

    Route::get('dashboard','Backend\AdminStoreController@dashboard')->name('admin-store.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('search-member-list','Backend\AdminStoreController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('member/profile/{id}','Backend\AdminStoreController@memberProfile'); //หน้าโปรไฟล์สมาชิก

    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\AdminStoreController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\AdminStoreController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::get('search-member','Backend\AdminStoreController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม

    // ข้อมูลบัญชีพนักงาน
    Route::get('account-staff','Backend\AdminStoreController@accountStaff'); //หน้าข้อมูลบัญชีพนักงาน
    Route::get('create-account-staff','Backend\AdminStoreController@createAccountStaff'); //หน้าสร้างบัญชีพนักงาน
    Route::post('create-account-staff','Backend\AdminStoreController@createAccountStaffPost'); //สร้างบัญชีพนักงาน

    // จัดการคูปอง
    Route::get('coupon','Backend\AdminStoreController@coupon'); //หน้าจัดการคูปอง
    Route::get('search-coupon','Backend\AdminStoreController@searchCoupon'); //หน้าค้นหาคูปอง
});

// Staff พนักงาน
Route::group(['prefix' => 'staff'], function(){
    // ข้อมูลการเข้าสู่ระบบของพนักงาน
    Route::get('/login','AuthStaff\LoginController@ShowLoginForm')->name('staff.login');
    Route::post('/login','AuthStaff\LoginController@login')->name('staff.login.submit');
    Route::post('/logout', 'AuthStaff\LoginController@logout')->name('staff.logout');

    Route::get('dashboard','Backend\StaffController@dashboard')->name('staff.home'); //หน้า dashboard

    // ข้อมูลสมาชิก
    Route::get('search-member-list','Backend\StaffController@searchMemberList'); //ค้นหาข้อมูลสมาชิก
    Route::get('member/profile/{id}','Backend\StaffController@memberProfile'); //หน้าโปรไฟล์สมาชิก

    // ข้อมูลคะแนนสะสม
    Route::get('addpoint','Backend\StaffController@addpoint'); //หน้าเพิ่มคะแนนสะสม
    Route::post('addpoint','Backend\StaffController@addPointPost'); //เพิ่มคะแนนสะสม
    Route::get('search-member','Backend\StaffController@searchMember'); //หน้าค้นหาข้อมูล เพิ่มคะแนนสะสม
    
    // สมัครสมาชิกใหม่
    Route::get('register-member','Backend\StaffController@registerMember'); //หน้าสมัครสมาชิกใหม่
    Route::post('register-member','Backend\StaffController@registerMemberPost'); //สมัครสมาชิกใหม่

    // จัดการคูปอง
    Route::get('coupon','Backend\StaffController@coupon'); //หน้าจัดการคูปอง
    Route::get('search-coupon','Backend\StaffController@searchCoupon'); //หน้าค้นหาคูปอง
});