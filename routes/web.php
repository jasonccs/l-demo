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


Route::get('/request', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'request' => $request->all(),
    ]);
});

Route::post('/request', function (Request $request) {
    return response()->json([
        'status' => 'success',
        'request' => $request->all(),
    ]);
});

Route::get('/expected-error', function () {
    abort(400, 'Expected Error');
});

Route::get('/unexpected-error', function () {
    throw new Exception('Unexpected Error');
});
