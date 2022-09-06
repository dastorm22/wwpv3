<?php

use App\Http\Controllers\OfferController;

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
Route::get('logout', 'Auth\LoginController@logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'welcome'])->name('home')->middleware('2fa');
  
Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');


Route::get('/', 'HomeController@welcome');
Route::get('/crossReference', 'AnalysisController@crossReference');
Route::get('/comparison', 'AnalysisController@comparison');

Route::get('/analysis/process', 'AnalysisController@process');
Route::get('/analysis/exploration/create', 'AnalysisController@explore');
Route::get('/analysis/ofert/create', 'AnalysisController@ofert');
Route::post('/analysis/ofert_upload', 'AnalysisController@ofert_upload');
Route::post('/analysis/exploration', 'AnalysisController@exploration');
Route::get('/analysis/comparison-list', 'AnalysisController@getComparisonList');
Route::get('/analysis/download/comparison', 'AnalysisController@downloadComparison');
Route::get('/analysis/download/ofert', 'DataController@downloadOfert');
Route::get('/analysis/download/log', 'DataController@downloadLogfile');
Route::get('/analysis/log', 'DataController@LogfileOferts');
Route::get('/analysis/log/offer', [OfferController::class, 'index'])->name('offer.index');



Route::get('/analysis/download/cross-reference', 'AnalysisController@downloadCrossReference');

Route::post('/adjustments', 'AdjustmentController@storeAdjustment');
Route::get('/adjustments/destroy', 'AdjustmentController@destroyAll');
Route::get('/adjustments/download', 'AdjustmentController@download');

Route::resource('sources', 'SourceController');
Route::get('sources/{source}/batches', 'BatchController@sourceIndex');

Route::resource('users', 'UserController');

Route::resource('data', 'DataController');

