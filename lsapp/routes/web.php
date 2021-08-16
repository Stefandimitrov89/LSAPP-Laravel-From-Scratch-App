<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController as PagesController;
use App\Http\Controllers\PostsController as PostsController;

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

/* EXAMPLES:
 * 
 * 
 * Route::get('/users/{id}/{name}', function ($id, $name) {
 *    return "This is user ".$name." with an ID  ".$id; 
 * });
 * 
 * 
 *  */


Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/services', [PagesController::class, 'services']);

Route::resource('posts', PostsController::class);

Route::get('/welcome', function () {
    return view('welcome');    
});