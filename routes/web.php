<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/



Route::get('/', function () {
    return view('home');
});

Route::post('/', function (Request $request) {
    $url = $request->input('url');

    
    DB::table('urls')->insert([
    'name' => $url['name'],
    'created_at' => '26.01.22'
]);
$urls = DB::table('urls')->get();
//$currentUrl = DB::table('urls')->where('name', $url['name'])->first();
return view('test', ['urls' => $urls]);
//$id = 1;
//$u = route('sites');
//return redirect($u.'/'.$id, ['urls' => $urls]);
});


Route::get('/urls', function () {
    $urls = DB::table('urls')->get();
    return view('sites', ['urls' => $urls]);
})->name('sites');


Route::get('/urls/{id}', function ($id) {

    $urls = DB::table('urls')->get();
    return view('site', ['urls' => $urls]);
});


    