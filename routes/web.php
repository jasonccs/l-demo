<?php

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


Route::get('/expected-error', function () {
    abort(400, 'Expected Error');
});

Route::get('/unexpected-error', function () {
    throw new Exception('Unexpected Error');
});

Route::get('/validate-brackets', function (Request $request) {
    $s = $request->input('s');

    $stack = [];
    $brackets = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];

    foreach (str_split($s) as $char) {
        if (in_array($char, array_values($brackets))) {
            array_push($stack, $char);
        } elseif (in_array($char, array_keys($brackets))) {
            if (empty($stack) || array_pop($stack) !== $brackets[$char]) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid brackets',
                ], 400);
            }
        }
    }

    if (empty($stack)) {
        return response()->json([
            'status' => 'success',
            'message' => 'Valid brackets',
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid brackets',
        ], 400);
    }
});
