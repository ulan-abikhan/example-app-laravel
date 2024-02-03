<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/some', function(Request $request) {
    $param = $request->is_admin;
    if ($param != null && $param == true) {
        return view('some');
    }
    else {
        return view('hello');
    }
});

// Route::view('/some', 'some');

Route::get('hello/world', function(Request $request) {
    $param = $request->id;
    $name = $request->name;

    return "Hello world $name";
});

Route::get('simple', function() {
    return response()->json(["data"=>"simple"]);
});

Route::redirect('/here', '/some');