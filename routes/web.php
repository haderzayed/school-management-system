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

    ################################# Grades Route ###################

    Route::group(['namespace'=>'Grades','prefix'=>'Grades'],function(){
        Route::get('index','GradesController@index')->name('grades.index');
        Route::get('create','GradesController@create')->name('grades.create');
        Route::post('store','GradesController@store')->name('grades.store');
        Route::get('/edit/{id}','GradesController@edit')->name('grades.edit');
        Route::post('update/{id}','GradesController@update')->name('grades.update');
        Route::get('delete/{id}','GradesController@destroy')->name('grades.delete');

    });
    ################################# Classrooms Route ###################

    Route::group(['namespace'=>'Classrooms','prefix'=>'Classrooms'],function (){
        Route::get('index','ClassroomsController@index')->name('Classrooms.index');
        Route::get('create','ClassroomsController@create')->name('Classrooms.create');
        Route::post('store','ClassroomsController@store')->name('Classrooms.store');
        Route::get('/edit/{id}','ClassroomsController@edit')->name('Classrooms.edit');
        Route::post('update/{id}','ClassroomsController@update')->name('Classrooms.update');
        Route::get('delete/{id}','ClassroomsController@destroy')->name('Classrooms.delete');
        Route::post('delete-all','ClassroomsController@delete_all')->name('Classrooms.delete_all');
        Route::post('filter-classrooms','ClassroomsController@filter_classrooms')->name('Classrooms.filter_classrooms');

    });

    ################################# Sections Route ###################
    Route::group(['namespace'=>'Sections','prefix'=>'Sections'],function (){
        Route::get('index','SectionsController@index')->name('Sections.index');
        Route::get('create','SectionsController@create')->name('Sections.create');
        Route::post('store','SectionsController@store')->name('Sections.store');
        Route::get('/edit/{id}','SectionsController@edit')->name('Sections.edit');
        Route::post('update/{id}','SectionsController@update')->name('Sections.update');
        Route::get('delete/{id}','SectionsController@destroy')->name('Sections.delete');
        Route::get('/classrooms/{id}','SectionsController@classrooms');

    });

    ################################# parents Route ###################
    Route::view('add-parents','livewire.show-form')->name('parents.add');

    ################################# teacher Route ###################

    Route::group(['namespace'=>'Teachers','prefix'=>'Teachers'],function (){
        Route::get('index','TeachersController@index')->name('Teachers.index');
        Route::get('create','TeachersController@create')->name('Teachers.create');
        Route::post('store','TeachersController@store')->name('Teachers.store');
        Route::get('/edit/{id}','TeachersController@edit')->name('Teachers.edit');
        Route::post('update/{id}','TeachersController@update')->name('Teachers.update');
        Route::get('delete/{id}','TeachersController@destroy')->name('Teachers.delete');


    });
});

