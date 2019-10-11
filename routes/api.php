<?php

use Illuminate\Http\Request;
use App\Communication;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('mail',function(){
	echo phpinfo();
	try {
		$send_mail = new Communication();
		$send_mail->send_Email('ashley7520charles@gmail.com','Hello Are you there!!!','This is a test Email','info@schoolplus.co');
		echo "Sent";
	} catch (\Exception $e) {
		echo $e->getMessage();
	}
});
