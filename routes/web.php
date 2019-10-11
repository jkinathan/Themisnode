<?php
use App\SentTask;
Route::get('/', function () { 
    return view('auth.login');
});


Route::get('/getDownload/{file_name}','PdfReport@pdf')->name('getDownload');

Route::get("/forgot_password",function(){
	return view('auth.forgot_password');
}); 

Route::post("/forgot_password","UserControoler@forgot_password")->name('forgot_password');
Route::get('task_remiders','ExtraTaskController@task_remiders')->name('task_remiders');
Route::get('/event_user/{id}','EventUserController@show');
//new
Route::get('/statute_report/{id}','StatuteController@show');
Route::post('/matters', 'MatterController@rsave');
Route::post('/matter/time/create','TimesheetController@matterreporters');
Route::post('/matter_time','TimesheetController@store');
Route::post('/matter/time/create','TimesheetController@show');
Route::get('/matter/time/create','TimesheetController@index');
Route::get('/home2', 'HomeController@index2')->name('home2');

//
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('client','ClientController');
	Route::resource('matter','MatterController');
	Route::resource('matter_follow','MatterFollowupController');
	Route::resource('matter_task','TaskController');
	Route::resource('matter_expenses','ExpenseController');
	Route::resource('court_book','CourtBookController');
	Route::resource('opposite_party','OpposingPartyController');
	Route::resource('opposite_advocates','OpposingAdvocatesController');
	Route::resource('court_followup','CourtbookFollowupController');
	Route::resource('billing_type','BillingTypeController');
	Route::resource('practice_area','PracticeAreaController');
	Route::resource('matter_event','MatterEventController');
	Route::resource('party','PartyCOntroller');	
	Route::resource('communication','CommunicationController');
	Route::resource('billing','BillingController');
	Route::resource('matter_witness','MatterWitnessController');
 	Route::get('matter_details/{matter_id}','ExtraTaskController@matter_details');
 	Route::post('change_password','UserControoler@change_password');
 	Route::resource('user','UserControoler');
	Route::resource('alert','AlertController');
	Route::resource('event_user','EventUserController');
	Route::resource('logs','LoggingController');
	Route::resource('matter_authority','MatterAuthorityController');
	Route::resource('parnering_firms','PartneringFirmController');	
	Route::post('change_case_stage','ExtraTaskController@change_case_stage')->name('change_case_stage');
	Route::get('casees_report','ExtraTaskController@casees_report')->name('casees_report');
	Route::post('caseesreport','ExtraTaskController@caseesreport')->name('caseesreport');
	Route::post('matterreport','ExtraTaskController@matterreport')->name('matterreport');
	Route::get('matter_report','ExtraTaskController@matter_report')->name('matter_report');
	Route::post('clientreport','ExtraTaskController@clientreport')->name('clientreport');
	Route::get('client_report','ExtraTaskController@client_report')->name('client_report');
	Route::get('client_list','ExtraTaskController@client_list')->name('client_list');
	Route::post('change_matter_stage','ExtraTaskController@change_matter_stage')->name('change_matter_stage');
	Route::resource('case_types','CaseTypeController');
	Route::resource('company','CompanyController');
});//middleware