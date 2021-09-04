<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsersForgetPasswordMail;
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

#Login
Route::get('/',array('as'=>'login', 'uses' =>'AuthController@authLogin'));
Route::get('/login',array('as'=>'login', 'uses' =>'AuthController@authLogin'));
Route::get('/auth',array('as'=>'Sign in', 'uses' =>'AuthController@authLogin'));
Route::get('auth/login',array('as'=>'Sign in', 'uses' =>'AuthController@authLogin'));
Route::post('auth/post/login',array('as'=>'Sign in', 'uses' =>'AuthController@authPostLogin'));


#ForgetPassword
Route::get('auth/forget/password',array('as'=>'Forgot Password' , 'uses' =>'AuthController@forgetPasswordAuthPage'));
Route::post('auth/forget/password',array('as'=>'Forgot Password' , 'uses' =>'AuthController@authForgotPasswordConfirm'));
Route::get('auth/forget/password/{user_id}/verify',array('as'=>'Forgot Password Verify' , 'uses' =>'AuthController@authSystemForgotPasswordVerification'));
Route::post('auth/forget/password/{user_id}/verify',array('as'=>'New Password Submit' , 'uses' =>'AuthController@authSystemNewPasswordPost'));

Route::get('/load-user-groups', array('as'=>'user-group' , 'uses' =>'AdminController@loadUserGroups'));

// need only authentication
Route::group(['middleware' => ['auth']], function () {
	Route::get('/theme',array('as'=>'Theme' , 			'uses' =>'AdminController@welcome'));
	Route::get('/',array('as'=>'Dashboard' , 			'uses' =>'AdminController@index'));
	Route::get('auth/logout/{email}',array('as'=>'Logout' , 'uses' =>'AuthController@authLogout'));
	Route::get('/dashboard',array('as'=>'Dashboard' , 	'uses' =>'AdminController@index'));

	//my Profile
	Route::get('/profile',array('as'=>'My Profile', 		'uses' =>'AdminController@profileIndex'));
	Route::get('/profile/my-profile-info',array('as'=>'Get My Profile Info', 	'uses' =>'AdminController@profileInfo'));
	Route::post('/profile/my-profile-update',array('as'=>'Update My Profile Info', 'uses' =>'AdminController@updateProfile'));
	Route::post('/profile/password-update',array('as'=>'Update My Profile Info', 'uses' =>'AdminController@updatePassword'));
	//Menus/ Modules
	Route::get('/module/get-parent-menu',array('as'=>'Parent Menu List' ,'uses' =>'SettingController@getParentMenu'));
	Route::get('/web-action/get-module-name',array('as'=>'Actions' , 'uses' =>'SettingController@getModuleName'));
	Route::get('/admin/load-actions-for-group-permission/{id}',array('as'=>'Load Actions', 'uses' =>'AdminController@loadActionsForGroupPermission'));

	Route::get('/notification',array('as'=>'All Notifications', 		'uses' =>'AdminController@profileIndex'));
	Route::get('/notifications',array('as'=>'All Notifications', 		'uses' =>'AdminController@ajaxNotificationList'));
	Route::get('/notifications/{page}',array('as'=>'Notifications', 	'uses' =>'AdminController@notificationHome'));
	Route::get('/notification/view',array('as'=>'Notification Read', 	'uses' =>'AdminController@notificationRead'));
	Route::get('/update-notification',array('as'=>'Read Notifications', 'uses' =>'AdminController@updateNotification'));

});

// need  authentication and permission to access the action/action-lists
// you have to define the action no from DB
Route::group(['middleware' => ['auth','permission'] ], function () {
	//Admin User
	Route::get('user/admin/admin-user-management',array('as'=>'Users' , 'action_id'=>'1', 'uses' =>'AdminController@adminUserManagement'));
	Route::get('/admin/ajax/admin-list',array('as'=>'User List' ,  'action_id'=>'1','uses' =>'AdminController@adminList'));
	Route::get('/admin/admin-view/{id}',array('as'=>'View' , 'action_id'=>'1', 'uses' =>'AdminController@adminUserView'));
	Route::post('/admin/admin-user-entry',array('as'=>'User Entry', 'action_id'=>'2', 'uses' =>'AdminController@adminCreateOrEdit'));
	Route::get('/admin/edit/{id}',array('as'=>'User Edit', 'action_id'=>'3', 'uses' =>'AdminController@adminUserEdit'));
	Route::get('/admin/delete/{id}',array('as'=>'User Delete', 'action_id'=>'4', 'uses' =>'AdminController@adminDestroy'));

	// Actions
	Route::get('cp/web-action/web-action-management',array('as'=>'Web Action Management', 'action_id'=>'5', 'uses' =>'SettingController@webActionManagement'));
	Route::get('/web-action/action-lists',array('as'=>'Actions', 'action_id'=>'5' , 'uses' =>'SettingController@webActionList'));
	Route::post('/web-action/web-action-entry',array('as'=>'Web Action Entry', 'action_id'=>'6', 'uses' =>'SettingController@webActionEntry'));
	Route::get('/web-action/edit/{id}',array('as'=>'Web Action Edit', 'action_id'=>'7', 'uses' =>'SettingController@web_action_edit'));

	//Menus/ Modules
	Route::get('cp/module/manage-module',array('as'=>'Modules' , 'action_id'=>'8', 'uses' =>'SettingController@moduleManagement'));
	Route::get('/module/menu-list',array('as'=>'Menu List' ,'action_id'=>'8', 'uses' =>'SettingController@ajaxMenuList'));
	Route::post('/module/module-entry/',array('as'=>'Module Entry' , 'action_id'=>'9', 'uses' =>'SettingController@moduleEntry'));
	Route::get('/module/edit/{id}',array('as'=>'Module Edit' , 'action_id'=>'10', 'uses' =>'SettingController@moduleEdit'));
	Route::get('/module/delete/{id}',array('as'=>'Module Edit' , 'action_id'=>'11', 'uses' =>'SettingController@moduleDelete'));

	//General Setting
	Route::get('settings/general/general-setting',array('as'=>'General Setting', 'action_id'=>'12', 'uses' =>'SettingController@generalSetting'));
	Route::post('/general/setting-update',array('as'=>'General Setting Update', 'action_id'=>'15', 'uses' =>'SettingController@generalSettingUpdate'));

	//Super Admin User Group
	Route::get('settings/admin/admin-group-management',array('as'=>'User Groups', 'action_id'=>'16', 'uses' =>'AdminController@admin_user_groups'));
	Route::get('/admin/admin-group-list',array('as'=>'Admin Groups List' ,   'action_id'=>'16','uses' =>'AdminController@adminGroupsList'));
	Route::post('/admin/admin-group-entry',array('as'=>'Admin Groups Entry', 'action_id'=>'17', 'uses' =>'AdminController@adminGroupsEntryOrUpdate'));
	Route::get('/admin/admin-group-edit/{id}',array('as'=>'Admin Groups Edit', 'action_id'=>'18', 'uses' =>'AdminController@adminGroupEdit'));
	Route::get('/admin/admin-group-delete/{id}',array('as'=>'Admin Groups Delete', 'action_id'=>'19', 'uses' =>'AdminController@adminGroupDelete'));
	//Permission
	Route::post('/admin/permission-action-entry-update',array('as'=>'Permission Entry', 'action_id'=>'20', 'uses' =>'AdminController@permissionActionEntryUpdate'));

    // Schools Settings
    Route::get('settings/school',array('as'=>'Schools', 'action_id'=>'93', 'uses' =>'SchoolController@schoolIndex'));
    Route::get('settings/schools',array('as'=>'Schools List' ,   'action_id'=>'93','uses' =>'SchoolController@schoolList'));
    Route::post('settings/school',array('as'=>'Schools Entry', 'action_id'=>'94', 'uses' =>'SchoolController@schoolCreateOrEdit'));
    Route::get('settings/school/{id}',array('as'=>'Schools Edit', 'action_id'=>'95', 'uses' =>'SchoolController@showSchoolDetails'));
    Route::get('settings/school/delete/{id}',array('as'=>'Schools Delete', 'action_id'=>'96', 'uses' =>'SchoolController@schoolDestroy'));

    // Schools Admin Users
    Route::get('school/admin',array('as'=>'School Admins' , 'action_id'=>'99', 'uses' =>'SchoolController@schoolAdminIndex'));
    Route::get('school/admins',array('as'=>'School Admin List' ,  'action_id'=>'99','uses' =>'SchoolController@schoolAdminsList'));
    Route::post('school/admin',array('as'=>'School Admin Entry', 'action_id'=>'100', 'uses' =>'SchoolController@SchoolAdminCreateOrEdit'));
    Route::get('school/admin/{id}',array('as'=>'View' , 'action_id'=>'99', 'uses' =>'SchoolController@SchooladminView'));
    Route::get('school/admin/delete/{id}',array('as'=>'School Admin Delete', 'action_id'=>'102', 'uses' =>'SchoolController@schoolAdminDestroy'));

    //Students
    Route::get('student',array('as'=>'Student' , 'action_id'=>'103', 'uses' =>'StudentController@index'));
    Route::get('students',array('as'=>'Student List' ,  'action_id'=>'103','uses' =>'StudentController@showList'));
    Route::post('student',array('as'=>'Student Entry', 'action_id'=>'104', 'uses' =>'StudentController@createOrEdit'));
    Route::get('student/{id}',array('as'=>'Student View' , 'action_id'=>'103', 'uses' =>'StudentController@show'));
    Route::get('student/delete/{id}',array('as'=>'Student Delete', 'action_id'=>'106', 'uses' =>'StudentController@destroy'));
    Route::get('key-stage-class',array('as'=>'Key Stage Class', 'action_id'=>'103', 'uses' =>'StudentController@getStageClass'));
    Route::get('class_subject',array('as'=>'class_subject Search', 'action_id'=>'103', 'uses' =>'StudentController@getClassSubject'));

    //Students
    Route::get('teacher',array('as'=>'Teacher' , 'action_id'=>'107', 'uses' =>'TeacherController@index'));
    Route::get('teachers',array('as'=>'Teacher List' ,  'action_id'=>'107','uses' =>'TeacherController@showList'));
    Route::post('teacher',array('as'=>'Teacher Entry', 'action_id'=>'108', 'uses' =>'TeacherController@createOrEdit'));
    Route::get('teacher/{id}',array('as'=>'Teacher View' , 'action_id'=>'107', 'uses' =>'TeacherController@show'));
    Route::get('teacher/delete/{id}',array('as'=>'Teacher Delete', 'action_id'=>'110', 'uses' =>'TeacherController@destroy'));

    //Student Classes and Assign
    Route::get('student-class',array('as'=>'classes' , 'action_id'=>'111', 'uses' =>'ClassController@index'));
    Route::get('student-classes',array('as'=>'Class List' ,  'action_id'=>'111','uses' =>'ClassController@showList'));
    Route::get('key-stage-class-name/{id}',array('as'=>'Class Year and Key Stage','action_id'=>'111', 'uses' =>'ClassController@classKeyStage'));
    Route::post('class-subject',array('as'=>'Class Subject list','action_id'=>'116', 'uses' =>'ClassController@classSubjectCreateOrEdit'));
    Route::get('class-subject-view/{id}',array('as'=>'Subject Class list','action_id'=>'111', 'uses' =>'ClassController@showClassSubject'));
    Route::post('class-subjects-auto-suggest',array('as'=>'Key Stage Suggest', 'action_id'=>'107', 'uses' =>'ClassController@keyStageClassSubjectAutoComplete'));

	// Subject route
	Route::get('/subject',array('as'=>'Subject', 'action_id'=>'112', 'uses' =>'SubjectController@index'));
	Route::get('/subjects',array('as'=>'Subject List' ,'action_id'=>'112', 'uses' =>'SubjectController@showList'));
	Route::get('/subject/{id}',array('as'=>'Subject Details' ,'action_id'=>'112', 'uses' =>'SubjectController@show'));
	Route::post('/subject',array('as'=>'Subject Entry' , 'action_id'=>'113', 'uses' =>'SubjectController@createOrEdit'));
	Route::get('/subject/delete/{id}',array('as'=>'Subject Delete' , 'action_id'=>'114', 'uses' =>'SubjectController@destroy'));
    Route::post('subjects-auto-suggest',array('as'=>'Subject Autosuggest list','action_id'=>'112', 'uses' =>'SubjectController@subjectAutoComplete'));
    Route::get('/subject-autosearch/{id}',array('as'=>'Subject Details' ,'action_id'=>'112', 'uses' =>'SubjectController@showSubject'));
    Route::get('/subject-autosearch-class/{id}',array('as'=>'Subject Details' ,'action_id'=>'112', 'uses' =>'SubjectController@showClassSubject'));

    // Notice Category route
	Route::get('/setting/admin/notice-category',array('as'=>'Notice Category', 'action_id'=>'123', 'uses' =>'NoticeController@index'));
	Route::get('/setting/admin/notice-categories',array('as'=>'Notice Category List' ,'action_id'=>'123', 'uses' =>'NoticeController@showList'));
	Route::get('/setting/admin/notice-category/{id}',array('as'=>'Notice Details' ,'action_id'=>'123', 'uses' =>'NoticeController@show'));
    Route::get('/setting/admin/notice-category-view/{id}',array('as'=>'Notice View' ,'action_id'=>'119', 'uses' =>'NoticeController@show'));
	Route::post('/setting/admin/notice-category',array('as'=>'Notice Category Entry' , 'action_id'=>'124', 'uses' =>'NoticeController@noticeCategoryCreateOrEdit'));
	Route::get('/setting/admin/notice-category/delete/{id}',array('as'=>'Notice Category Delete' , 'action_id'=>'125', 'uses' =>'NoticeController@destroy'));

     // Notice route
	Route::get('/notice',array('as'=>'Notice', 'action_id'=>'119', 'uses' =>'NoticeController@noticeIndex'));
	Route::get('/notices',array('as'=>'Notice List' ,'action_id'=>'119', 'uses' =>'NoticeController@noticeShowList'));
	Route::get('/notice/{id}',array('as'=>'Notice Details' ,'action_id'=>'119', 'uses' =>'NoticeController@noticeShow'));
    Route::get('/notice-details/{id}',array('as'=>'Notice Details' ,'action_id'=>'119', 'uses' =>'NoticeController@noticeShow'));
	Route::post('/notice',array('as'=>'Notice Entry' , 'action_id'=>'121', 'uses' =>'NoticeController@noticeCreateOrEdit'));
	Route::get('/notice/delete/{id}',array('as'=>'Notice Delete' , 'action_id'=>'120', 'uses' =>'NoticeController@noticeDestroy'));

    // Chat route
	Route::get('/message',array('as'=>'Chat', 'action_id'=>'127', 'uses' =>'MessageController@index'));
    Route::get('/message/load-app-user',array('as'=>'Load App User','action_id'=>'127', 'uses' =>'MessageController@loadAppUser'));
	Route::get('/message/view-app-user/{id}',array('as'=>'Get App user View','action_id'=>'127', 'uses' =>'MessageController@app_user_view'));
    Route::post('/message/load-message',array('as'=>'Load Message', 'action_id'=>'127', 'uses' =>'MessageController@loadMessage'));
    Route::post('/message/admin-message-sent-to-user',array('as'=>'Admin message Sent', 'action_id'=>'128', 'uses' =>'MessageController@newMsgSent'));

	// Route::get('/notices',array('as'=>'Notice List' ,'action_id'=>'119', 'uses' =>'NoticeController@notice_showList'));
	// Route::get('/notice/{id}',array('as'=>'Notice Details' ,'action_id'=>'119', 'uses' =>'NoticeController@notice_show'));
    // Route::get('/notice-details/{id}',array('as'=>'Notice Details' ,'action_id'=>'119', 'uses' =>'NoticeController@notice_show'));
	// Route::post('/notice',array('as'=>'Notice Entry' , 'action_id'=>'121', 'uses' =>'NoticeController@notice_createOrEdit'));
	// Route::get('/notice/delete/{id}',array('as'=>'Notice Delete' , 'action_id'=>'120', 'uses' =>'NoticeController@notice_destroy'));

    Route::get('quiz',array('as'=>'Quiz' , 'action_id'=>'131', 'uses' =>'QuizController@index'));
    Route::get('quizes',array('as'=>'Quizes List' , 'action_id'=>'131', 'uses' =>'QuizController@showList'));
    Route::post('quiz',array('as'=>'Quizes Entry', 'action_id'=>'132', 'uses' =>'QuizController@quizCreateOrEdit'));
    Route::get('quiz/{id}',array('as'=>'Quizes View' , 'action_id'=>'131', 'uses' =>'QuizController@show'));
    Route::get('quiz/delete/{id}',array('as'=>'Quizes Delete', 'action_id'=>'134', 'uses' =>'QuizController@destroy'));
    Route::get('class-subject-topic',array('as'=>'class_subject Topic', 'action_id'=>'103', 'uses' =>'QuizController@getClassSubjectTopic'));

    // Question
    Route::post('question',array('as'=>'Qestion' , 'action_id'=>'131', 'uses' =>'QuizController@questionCreateOrEdit'));

});

