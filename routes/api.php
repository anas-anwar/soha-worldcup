<?php




use App\Http\Controllers\Api\StadiumsController;
use App\Http\Controllers\Api\TeamsController;
use App\Http\Controllers\Api\MatchesController;
use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\ResturentsController;
use App\Models\Resturent;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('stadiums',StadiumsController::class);
Route::post("stadiums/addImage/{id}",[StadiumsController::class,'addImage']);

Route::apiResource('matches',MatchesController::class);

Route::apiResource('hotels',HotelsController::class);
Route::post("hotels/selectService/{id}",[HotelsController::class,'selectService']);
Route::post("hotels/addImage/{id}",[HotelsController::class,'addImage']);
Route::post("hotels/addRoom/{id}",[HotelsController::class,'addRoom']);
Route::apiResource('resturents',ResturentsController::class);
Route::post("resturents/selectService/{id}",[ResturentsController::class,'selectService']);
Route::post("resturents/addImage/{id}",[ResturentsController::class,'addImage']);
Route::apiResource('teams',TeamsController::class);

////////////////////////////Mobile////////////////////////////

Route::get("mobile/matches",[App\Http\Controllers\Api\Mobile\MatchesController::class,'index']);
Route::get("mobile/stadiums",[App\Http\Controllers\Api\Mobile\StadiumsController::class,'index']);