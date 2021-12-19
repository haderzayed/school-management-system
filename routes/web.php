<?php


use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::group(['middleware'=>['guest']],function (){
    Route::get('/', function()
    {
        return view('auth.login');
    });

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth']
    ], function(){ //...

    Route::get('dashboard','HomeController@index');

    Route::group(['namespace'=>'Grades','prefix'=>'Grades'],function(){
        Route::get('index','GradesController@index')->name('grades.index');
        Route::get('create','GradesController@create')->name('grades.create');
        Route::post('store','GradesController@store')->name('grades.store');
        Route::get('/edit/{id}','GradesController@edit')->name('grades.edit');
        Route::post('update/{id}','GradesController@update')->name('grades.update');
        Route::get('delete/{id}','GradesController@destroy')->name('grades.delete');

    });
    Route::group(['namespace'=>'Classrooms','prefix'=>'Classrooms'],function (){
        Route::get('index','ClassroomsController@index')->name('Classrooms.index');
        Route::get('create','ClassroomsController@create')->name('Classrooms.create');
        Route::post('store','ClassroomsController@store')->name('Classrooms.store');

    });
});

