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

    return view('home');
})->name('home');


Auth::routes();


// Resource Routes
Route::resource('/users', 'UsersController')->except([
    'create', 'store',
]);

Route::resource('/roles', 'RolesController')->except([
    'create',
]);

Route::resource('/surveys', 'SurveysController');
Route::get('/surveys/{survey}/clear', 'SurveysController@clearVote');
Route::get('/surveys/{survey}/vote/{survey_option}', 'SurveysController@vote');

Route::resource('/shorturis', 'ShortUrisController');
Route::get('/shorturis/{shorturi}/reset', 'ShortUrisController@resetClicked');

Route::resource('/seatingplans', 'SeatingPlansController');

Route::resource('/staticpages', 'StaticPagesController')->except([
    'show',
]);
Route::post('/staticpages/upload', 'StaticPagesController@upload');


// Search Routes
Route::any('/users/search', 'UsersController@search');


// Custom Wildcards
Route::get('/{link}', 'WildcardsController');
