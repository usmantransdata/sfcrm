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


	Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::post('userActivate', 'AdminController@userActivate')->name('userActivate');	


Route::post('import_parse', 'ClientController@parseImport')->name('import_parse');
Route::post('import_process', 'ClientController@processImport')->name('import_process');


Route::post('user_signup', 'AdminController@signup')->name('user_signup');

Route::get('backend', 'HomeController@index')->name('backend');
Route::post('readcsv', 'ClientController@readcsv')->name('readcsv');

Route::get('user', 'AdminController@addUsers')->name('user');

Route::get('userView', 'AdminController@userView')->name('userView');

Route::get('client.view', 'ClientController@view')->name('client.view');

Route::get('data_upload', 'BatchController@upload')->name('data_upload');


Route::post('importExcel', 'ClientController@importExcel')->name('importExcel');


Route::resource('client', 'ClientController');

Route::get('getUsers' , 'AdminController@getUsers')->name('getUsers');

Route::get('viewData' , 'BatchDetailController@index')->name('viewData');


Route::post('batchDetail', 'BatchDetailController@store')->name('batchDetail');

Route::get('userEdit/{id}', 'AdminController@edit')->name('userEdit');

Route::get('userDel', 'AdminController@destroy')->name('userDel');

Route::post('usersUpdate/{id}', 'AdminController@update')->name('usersUpdate');


Route::post('assign-company', 'ClientController@assignCompany')->name('assign-company');

Route::post('statusChanged', 'BatchDetailController@statusChanged')->name('statusChanged');

Route::get('statusChangedManager/{id}', 'BatchDetailController@statusChangedManager')->name('statusChangedManager');


Route::get('download-csv/{id}', function ($id) {

//echo "string";dd();
	$batch = \App\OrderBatch::where('batch_id', '=', $id)->get();
	//print_r($batch);dD();
	$csvExporter = new \Laracsv\Export();

	return $csvExporter->build($batch, ['id', 'batch_id', 'first_name', 'last_name', 'title', 'phone_number', 'validation', 'disposition', 'organization', 'address1', 'address2', 'health_status'])->download();

});

Route::get('download-csv-client/{id}', function ($id) {

//echo "string";dd();
	$batch = \App\OrderBatch::where('batch_id', '=', $id)->get();
	//print_r($batch);dD();
	$csvExporter = new \Laracsv\Export();

	return $csvExporter->build($batch, ['first_name', 'last_name', 'title', 'phone_number', 'validation', 'disposition', 'organization', 'address1', 'address2'])->download();

});

Route::get('completedBatch/{id}', 'ClientController@completedBatch')->name('completedBatch');

Route::get('data.compare', function () {
				$company = \App\BatchDetail::get();
			return view('data.compare', compact('company'));
});

Route::post('compareFiles', 'ClientController@compareFiles')->name('compareFiles');

Route::post('compareUpdateFile' , 'ClientController@compareUpdateFile')->name('compareUpdateFile');


Route::get('uploadGoodRecords/{id}', 'ClientController@uploadGoodRecords')->name('uploadGoodRecords');


});

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/user/forgotPassword/{token}', 'Auth\ForgotPasswordController@forgotPassword');

Route::get('setPassword/{id}', 'Auth\RegisterController@setPassword')->name('setPassword');

Route::post('savePassword', 'Auth\RegisterController@savePassword')->name('savePassword');

Route::post('retrivePassword', 'Auth\ForgotPasswordController@retrivePassword')->name('retrivePassword');
