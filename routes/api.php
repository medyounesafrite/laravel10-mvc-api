<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PassAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/test',[PassAuthController::class,'register']);

Route::post('/register',[PassAuthController::class,'register']);
Route::post('/login',[PassAuthController::class,'login']);

//Route::resource('/products',TestController::class);

//par middleware et auth
Route::middleware(['auth:api'])->group(function() {
    Route::get('/userinfo',[PassAuthController::class,'userInfo']);
   Route::resource('products',TestController::class); // pour tous les urls dans
});
