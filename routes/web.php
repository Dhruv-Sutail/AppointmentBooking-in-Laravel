 <?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware'=>['auth','admin']],function (){

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('/role-register','Admin\DashboardController@registered');

    Route::get('/role-edit/{id}','Admin\DashboardController@registeredit');

    Route::put('/role-registerupdate/{id}','Admin\DashboardController@registerupdate');

    Route::delete('/role-delete/{id}','Admin\DashboardController@registerdelete');

    Route::get('/Appointment','Admin\AppointmentsController@detail');

    Route::get('/Appointment','Admin\AppointmentsController@Appointments');


    Route::post('Appointment/fetch', 'Admin\AppointmentsController@fetch')->name('dynamicdependent.fetch');

    Route::post('/save-appointment','Admin\AppointmentsController@store');

    Route::get('/Appointment-edit/{id}','Admin\AppointmentsController@edit');

    Route::put('/Appointment-update/{id}','Admin\AppointmentsController@update');

    Route::delete('/Appointment-delete/{id}','Admin\AppointmentsController@delete');

    Route::get('/department-category','Admin\DepartmentController@Department');

    Route::get('/Add-Department','Admin\DepartmentController@create');

    Route::post('/department-store','Admin\DepartmentController@store');

    Route::get('/department-edit/{id}','Admin\DepartmentController@edit');

    Route::put('/department-update/{id}','Admin\DepartmentController@update');

    Route::delete('/department-delete/{id}','Admin\DepartmentController@delete');


});
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('home/fetch', 'HomeController@fetch')->name('dynamicdependent.fetch');

Route::post('/save','HomeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/barcode','BarcodegeneratorController@barcode');

Route::get('/sendemail','SendEmailController@index');

Route::post('/sendemail/send','SendEmailController@send');

Route::view('user-delete','delete_appoint');

Route::post('/delete-appoint','DataDeleteController@delete');

Route::get('qr-code-g', function () {
     \QrCode::size(500)
         ->format('png')
         ->generate('ItSolutionStuff.com', public_path('Images/qrcode.png'));

     return view('qrCode');
});
Route::get('qrcode-laravel7', 'QRCodeController@qrCode')->name('qrcode');

Route::get('/dynamic','DynamicController@index');

Route::post('dynamic/fetch', 'DynamicController@fetch')->name('dynamicdependent.fetch');
