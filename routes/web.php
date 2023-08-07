<?php

use App\Http\Controllers\Controller;
use App\Models\utils\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

// 日志插件
Route::get('logs', [LogViewerController::class, 'index']);

 // a法，返回请求内容。
Route::get('/a', function (Request $request) {
    $user = [
        'name'=>1,
        'age'=>19
    ];
    return JsonResponse::success(['user' => $user]);
});

//  b法，返回请求内容。
Route::post('/b', function (Request $request) {
    $user = [
        'name'=>1,
        'age'=>19
    ];
    return JsonResponse::success(['user' => $user]);
});

//抛出预期的错误，例如请求字段格式错误

Route::get('/c', [Controller::class, 'store']);

//，d法 抛出意外的错误。
Route::post('/d', function (Request $request) {
    $c = 0;
    $res = 1/$c;
});

//  使用URL查询参数's'进行以下逻辑测试。
Route::get('/e', function (Request $request) {
    $s = $request->input('s');

    $stack = [];
    $brackets = [
        ')' => '(',
        ']' => '[',
        '}' => '{',
    ];

    foreach (str_split($s) as $char) {
        if (in_array($char, array_values($brackets))) {
            $stack[] = $char;
        } elseif (in_array($char, array_keys($brackets))) {
            if (empty($stack) || array_pop($stack) !== $brackets[$char]) {
                return JsonResponse::error($s.'不符合规范', 400);
            }
        }
    }
    if (empty($stack)) {
        return JsonResponse::success(null,$s.'符合规范');
    } else {
        return JsonResponse::error($s.'不符合规范', 400);
    }
});
