<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SchoolContoller;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use App\Http\Middleware\Uncheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/login', function (Request $request) {
    $username = $request->username;
    $password = $request->password;
    $obj = $request->obj;
    $numbers = $request->numbers;
    $headers = $request->header("X-Auth-Token");

    if ($headers == "ashibahcuvuvtqwetq$5w17fr5sd1")
        return $headers;
    else {
        return "Unauthorized";
    }

});


Route::get('products/{id}/comments/{comment_id}', function (Request $request, $id, $comment_id) {
    return response()->json(["id"=>$id, "comment_id"=>$comment_id], 200, ["Success"=>"YES"]);
});

Route::get('products/{id}', function (Request $request, $id) {
    if (!is_numeric($id)) {
        return response()->json(["message"=>"$id must be number"], 400);
    }
    return response()->json(["id"=>$id]);
})->name('products');

Route::prefix('hello')->group(function() {
    Route::get('world', function(Request $request) {

        return redirect()->route('products', ['id' => 1]);
    
    })->name('hello');

    Route::get('alem', function() {
        return "Alem";
    });
});


Route::middleware(['check', Uncheck::class])->group(function() {
    Route::get('simple', function() {
        return response()->json(["data"=>"simple"]);
    });

    Route::get('hard', function() {
        return response()->json(["data"=>"hard"]);
    })->withoutMiddleware('check');
});

// Route::get('simple', function() {
//     return response()->json(["data"=>"simple"]);
// })->middleware('check');

// Route::get('hard', function() {
//     return response()->json(["data"=>"hard"]);
// })->middleware('check');

Route::get('Home/searchFlights', function(Request $request) {
    $date = $request->date;
    $destination = $request->destination;

    
    return response()->json(["result"=>true, "data"=>["currentTime"=>"27.01.2024 12:22"]]);
});

Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::resource('photos', PhotoController::class);
Route::apiResource('products', ProductController::class);

Route::get('owner', [OwnerController::class, 'index']);
Route::post('owner', [OwnerController::class, 'store']);
Route::patch('owner/{id}', [OwnerController::class, 'update']);
Route::delete('owner/{id}', [OwnerController::class, 'destroy']);

Route::get('owner/count', [OwnerController::class, 'minMax']);

Route::apiResource('schools', SchoolContoller::class);

// Route::get('schools/{id}/is-dirty', [SchoolContoller::class, 'isDirty']);

Route::delete('schools-delete-many', [SchoolContoller::class, 'destroyMany']);

Route::get('schools-with-number', [SchoolContoller::class, 'conditionalIndex']);