<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/posts', function () {
//     return response()->json([
//         'posts' => [
//             'title' => 'Post One',
//             'description' => 'This is post one content',
//             'date' => '05-02-2023',
//         ],
//         'stack' => [
//             'name' => 'Laravel',
//         ],
//     ]);
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
