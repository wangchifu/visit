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

//Route::get('/', function () { return view('index'); })->name('index');

Route::get('/', 'PostController@index')->name('index');
Route::get('/map', function () {
    return view('map');
})->name('map');

//Auth::routes();
//管理及廠商登入
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'Auth\LoginController@register')->name('register');
Route::post('do_register', 'Auth\LoginController@do_register')->name('do.register');

Route::get('pic', 'HomeController@pic')->name('pic');

//登出
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//查詢課程
Route::get('search/{township}/township/', 'SearchController@township')->name('searches.township');
Route::get('search/{group_id}/vendor/', 'SearchController@vendor')->name('searches.vendor');
Route::get('search/{tab}/tab/', 'SearchController@tab')->name('searches.tab');
Route::get('search/{visit}/show/{action}/{tab?}', 'SearchController@show')->name('searches.show');
Route::post('search/find', 'SearchController@find')->name('searches.find');

//學校登入、認證、註冊表單、註冊儲存
Route::get('gsuite_login', 'GsuiteController@login')->name('gsuite.login');
Route::post('gsuite_auth', 'GsuiteController@auth')->name('gsuite.auth');
Route::get('gsuite_register', 'GsuiteController@register')->name('gsuite.register');
Route::post('gsuite_register/store', 'GsuiteController@register_store')->name('gsuite.register.store');

//申請local帳號時檢查有無重複帳號
Route::post('check_local_user', 'HomeController@check_local_user')->name('check_local_user');


//顯示上傳的圖片
Route::get('img/{path}', 'HomeController@getImg')->name('getImg');

//下載上傳的檔案
Route::get('file/{file}', 'HomeController@getFile');

//刪除上傳的檔案
Route::get('del_file/{file}/{url}', 'HomeController@delFile')->name('del_file');


//顯示目前已開放職探課程
Route::get('ztan/index', 'ZtansController@index')->name('ztans.index');
Route::get('ztan/{course}/show', 'ZtansController@show')->name('ztans.show');

//顯示職探中心簡介
Route::get('intro_ztan/{user}', 'ZtansController@intro_ztan')->name('intro_ztan');


//顯示國中技藝教育
Route::get('skills/index', 'SkillsController@index')->name('skills.index');
Route::get('skills/{skill}/show', 'SkillsController@show')->name('skills.show');
Route::get('skills/{skill_id}/show_one/{career_id}', 'SkillsController@show_one')->name('skills.show_one');

//顯示心得
Route::get('experiences/guest_index', 'ExperienceController@guest_index')->name('experience.guest_index');
Route::get('experiences/{experience}/guest_show', 'ExperienceController@guest_show')->name('experience.guest_show');

//公告系統
//公告系統
//Route::get('posts' , 'PostController@index')->name('posts.index');
Route::get('posts/{post}', 'PostController@show')->where('post', '[0-9]+')->name('posts.show');
//Route::post('posts/search' , 'PostController@search')->name('posts.search');
//Route::get('posts/{job_title}/job_title' , 'PostController@job_title')->name('posts.job_title');



//有註冊的才能進入
Route::group(['middleware' => 'auth'], function () {
    //管理後台
    Route::get('back', 'HomeController@back')->name('back.index');

    Route::get('users/info', 'UsersController@info')->name('users.info');
    Route::post('users/info_update', 'UsersController@info_update')->name('users.info_update');

    Route::get('sims/impersonate_leave', 'SimulationController@impersonate_leave')->name('sims.impersonate_leave');
});

//管理員權限才能進入
Route::group(['middleware' => 'admin'], function () {
    Route::get('users/index', 'UsersController@index')->name('users.index');
    Route::get('users/wait', 'UsersController@wait')->name('users.wait');
    Route::get('users/add_user', 'UsersController@add_user')->name('users.add_user');
    Route::any('users/all_user', 'UsersController@all_user')->name('users.all_user');
    Route::any('users/search', 'UsersController@search')->name('users.search');
    Route::post('users/store_add_user', 'UsersController@store_add_user')->name('users.store_add_user');
    Route::get('users/{user}/reset_pwd', 'UsersController@reset_pwd')->name('users.reset_pwd');

    Route::get('users/{user}/apply/{page}', 'UsersController@apply')->name('users.apply');
    Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::post('users/{user}/admin_update', 'UsersController@admin_update')->name('users.admin_update');

    Route::get('users/{user}/destroy', 'UsersController@destroy')->name('users.destroy');

    //廠商行程審核
    Route::get('visits/admin', 'VisitsController@admin')->name('visits.admin');
    Route::get('visits/{visit}/admin_show', 'VisitsController@admin_show')->name('visits.admin_show');
    Route::get('visits/{visit}/admin_pass', 'VisitsController@admin_pass')->name('visits.admin_pass');
    Route::get('visits/{visit}/admin_back', 'VisitsController@admin_back')->name('visits.admin_back');
    Route::get('visits/{visit}/admin_delete', 'VisitsController@admin_delete')->name('visits.admin_delete');


    //國中技藝班
    Route::get('skills/admin', 'SkillsController@admin')->name('skills.admin');
    Route::post('skills/admin_store', 'SkillsController@admin_store')->name('skills.admin_store');
    Route::any('skills/admin_list', 'SkillsController@admin_list')->name('skills.admin_list');
    Route::get('skills/admin_jschool', 'SkillsController@admin_jschool')->name('skills.admin_jschool');
    Route::post('skills/admin_jschool_store', 'SkillsController@admin_jschool_store')->name('skills.admin_jschool_store');
    Route::get('skills/admin_jschool_del/{skill_jschool}', 'SkillsController@admin_jschool_del')->name('skills.admin_jschool_del');
    Route::get('skills/admin_jschool_change/{skill_jschool}', 'SkillsController@admin_jschool_change')->name('skills.admin_jschool_change');
    Route::get('skills/{reback_skill}/admin_ok', 'SkillsController@admin_ok')->name('skills.admin_ok');
    Route::get('skills/{reback_skill}/admin_notok', 'SkillsController@admin_notok')->name('skills.admin_notok');
    Route::get('skills/{reback_skill}/admin_del_reback', 'SkillsController@admin_del_reback')->name('skills.admin_del_reback');
    Route::get('skills/{skill}/admin_del', 'SkillsController@admin_del')->name('skills.admin_del');

    //查看全部媒合
    Route::get('matchmaking_all', 'MatchmakingsController@all')->name('matchmaking_all');


    # 公告系統
    Route::get('posts/create', 'PostController@create')->name('posts.create');
    Route::post('posts', 'PostController@store')->name('posts.store');
    Route::get('posts/{post}/edit', 'PostController@edit')->name('posts.edit');
    Route::patch('posts/{post}', 'PostController@update')->name('posts.update');
    Route::delete('posts/{post}', 'PostController@destroy')->name('posts.destroy');
    //刪檔案
    Route::get('posts/{file}/fileDel', 'PostController@fileDel')->name('posts.fileDel');

    //查看全部心得
    Route::get('experience_all', 'ExperienceController@all')->name('experience_all');
    //刪除心得
    Route::get('experience_admin_destroy/{experience}', 'ExperienceController@admin_destroy')->name('admin_destroy');

    Route::get('sims/{user}/impersonate', 'SimulationController@impersonate')->name('sims.impersonate');
});

//國中小才能進入
Route::group(['middleware' => 'school'], function () {

    //參訪行程媒合
    Route::get('matchmaking/school', 'MatchmakingsController@school')->name('matchmaking.school');

    Route::get('matchmaking/{visit}/visit_data', 'MatchmakingsController@visit_data')->name('matchmaking.visit_data');
    Route::post('matchmaking/store', 'MatchmakingsController@store')->name('matchmaking.store');
    Route::get('matchmaking/{matchmaking}/destroy', 'MatchmakingsController@destroy')->name('matchmaking.destroy');

    //顯示我的參訪
    Route::get('visits/my_visit', 'VisitsController@my_visit')->name('visits.my_visit');
    


    //報名職探中心課程
    Route::get('ztan/{course}/create', 'ZtansController@create')->name('ztans.create');
    Route::post('ztan/store', 'ZtansController@store')->name('ztans.store');

    //我的職探媒合報名
    Route::get('matchmakings/ztans', 'MatchmakingsController@courses_index')->name('matchmakings.ztans_index');
    Route::get('matchmakings/ztans/{course}/show', 'MatchmakingsController@courses_show')->name('matchmakings.ztans_show');

    //技藝班申請
    Route::get('skills/{skill}/application', 'SkillsController@application')->name('skills.application');
    Route::post('skills/application_store', 'SkillsController@application_store')->name('skills.application_store');

    //顯示我的技藝班現狀
    Route::get('skills/my_skill', 'SkillsController@my_skill')->name('skills.my_skill');

    //心得上傳
    Route::get('experience/{matchmaking}/index', 'ExperienceController@index')->name('experiences.index');
    Route::get('experience/{matchmaking}/create', 'ExperienceController@create')->name('experiences.create');
    Route::get('experience/{experience}/edit', 'ExperienceController@edit')->name('experiences.edit');
    Route::post('experience/store', 'ExperienceController@store')->name('experiences.store');
    Route::post('experience/{experience}/update', 'ExperienceController@update')->name('experiences.update');
    Route::get('experience/{experience}/destroy', 'ExperienceController@destroy')->name('experiences.destroy');
});

//技藝班，只限高中職進入
Route::group(['middleware' => 'skill'], function () {
    Route::get('skills/high_school', 'SkillsController@high_school')->name('skills.high_school');
    Route::get('skills/high_school_show_co', 'SkillsController@high_school_show_co')->name('skills.high_school_show_co');
    Route::get('skills/{reback_skill}/high_school_ok', 'SkillsController@high_school_ok')->name('skills.high_school_ok');
    Route::get('skills/{reback_skill}/high_school_notok', 'SkillsController@high_school_notok')->name('skills.high_school_notok');
    Route::get('skills/{skill_id}/edit_data/{career_id}', 'SkillsController@edit_data')->name('skills.edit_data');
    Route::post('skills/edit_data_store', 'SkillsController@edit_data_store')->name('skills.edit_data_store');
});


//高中職或公司企業或職場達人才能進入
Route::group(['middleware' => 'vendor'], function () {
    Route::get('vendor_data/show', 'VendorDataController@show')->name('vendor_datas.show');
    Route::patch('vendor_data/{user}/update', 'VendorDataController@update')->name('vendor_datas.update');

    //行程管理
    Route::get('visits/index', 'VisitsController@index')->name('visits.index');
    Route::get('visits/create', 'VisitsController@create')->name('visits.create');
    Route::post('visits/store', 'VisitsController@store')->name('visits.store');
    Route::get('visits/{visit}/show', 'VisitsController@show')->name('visits.show');
    Route::get('visits/{visit}/edit', 'VisitsController@edit')->name('visits.edit');
    Route::patch('visits/{visit}/update', 'VisitsController@update')->name('visits.update');
    Route::delete('visits/{visit}/destroy', 'VisitsController@destroy')->name('visits.destroy');
    Route::get('visits/{visit_id}/file_del/{file}', 'VisitsController@file_delete')->name('visits.file_delete');

    //行程媒合管理
    Route::get('visits/{visit}/matching', 'VisitsController@matching')->name('visits.matching');
    Route::get('visits/{matchmaking}/pass', 'VisitsController@pass')->name('visits.pass');
    Route::get('visits/{matchmaking}/no_pass', 'VisitsController@no_pass')->name('visits.no_pass');
    Route::get('visits/{user}/{visit_id}/show_user', 'VisitsController@show_user')->name('visits.show_user');
    Route::get('visits/{matchmaking}/del', 'VisitsController@del')->name('visits.del');
});


//職探中心才能進入
Route::group(['middleware' => 'ztan'], function () {
    //課程設計
    Route::get('courses/index', 'CoursesController@index')->name('courses.index');
    Route::get('courses/create', 'CoursesController@create')->name('courses.create');
    Route::get('courses/{course}/show', 'CoursesController@show')->name('courses.show');
    Route::post('courses/store', 'CoursesController@store')->name('courses.store');
    Route::get('courses/{course}/edit', 'CoursesController@edit')->name('courses.edit');
    Route::post('courses/{course}/update', 'CoursesController@update')->name('courses.update');
    Route::delete('courses/{course}/destroy', 'CoursesController@destroy')->name('courses.destroy');
    Route::get('courses/{course}/active', 'CoursesController@active')->name('courses.active');
    Route::get('courses/{course}/matching', 'CoursesController@matching')->name('courses.matching');
    Route::get('courses/{matchmaking}/show_answer', 'CoursesController@show_answer')->name('courses.show_answer');
    Route::post('courses/admin_store_answer', 'CoursesController@admin_store_answer')->name('courses.admin_store_answer');
    Route::get('courses/{matchmaking}/pass', 'CoursesController@pass')->name('courses.pass');
    Route::get('courses/{matchmaking}/no_pass', 'CoursesController@no_pass')->name('courses.no_pass');
    Route::get('courses/{matchmaking}/del', 'CoursesController@del')->name('courses.del');
    Route::get('courses/{user}/{course_id}/show_user', 'CoursesController@show_user')->name('courses.show_user');
    Route::get('courses/{course_id}/file_del/{file}', 'CoursesController@file_del')->name('courses.file_del');
    Route::get('courses/{course}/download', 'CoursesController@download')->name('courses.download');
    Route::get('courses/{semester}/download_semester', 'CoursesController@download_semester')->name('courses.download_semester');

    //報名資訊設計
    Route::get('questions/{course}/index', 'QuestionsController@index')->name('questions.index');
    Route::get('questions/{course}/create', 'QuestionsController@create')->name('questions.create');
    Route::post('questions/store', 'QuestionsController@store')->name('questions.store');
    //Route::get('questions/{course}/edit', 'QuestionsController@edit')->name('questions.edit');
    //Route::patch('questions/{course}/update', 'QuestionsController@update')->name('questions.update');
    Route::delete('questions/{question}/destroy', 'QuestionsController@destroy')->name('questions.destroy');
});
