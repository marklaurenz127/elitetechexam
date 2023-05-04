<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\Crewcontroller;
use App\Http\Controllers\Documentcontroller;
use App\Http\Controllers\Admincontroller;

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

Route::get('/login', function () {
    return view('auth.login');
});

// Auth
Route::post('/auth/login',[Authcontroller::class, 'login']);
Route::get('/auth/logout',[Authcontroller::class, 'logout']);

Route::group(['middleware' => ['adminsession']], function(){
    Route::get('/',[Pagecontroller::class, 'index']);
    Route::get('/crews',[Pagecontroller::class, 'crews']);
    Route::get('/documents',[Pagecontroller::class, 'documents']);
    Route::get('/admins',[Pagecontroller::class, 'admins']);

    Route::get('/document/{documentid}',[Pagecontroller::class, 'singleDocument']);
    Route::get('/crew/{crewid}',[Pagecontroller::class, 'singleCrew']);
});

// Admin
Route::post('/admin/addAdmin',[Admincontroller::class, 'addAdmin']);
Route::post('/admin/removeAdmin',[Admincontroller::class, 'removeAdmin']);

// Crew
Route::post('/crew/CUcrew',[Crewcontroller::class, 'CUcrew']); // Create and Update Crew
Route::post('/crew/removeCrew',[Crewcontroller::class, 'removeCrew']);

// Document
Route::post('/document/CUdocument',[Documentcontroller::class, 'CUdocument']); // Create and Update Document
Route::post('/document/removeDocument',[Documentcontroller::class, 'removeDocument']);