<?php

use App\Events\OrderPlaced;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\MyMiddleware;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/post',[PostsController::class,'store']);
Route::get('/index',[PostsController::class,'index']);
Route::get('/show/{id}',[PostsController::class,'show']);
Route::patch('/update/{id}',[PostsController::class,'update']);
Route::delete('/delete/{id}',[PostsController::class,'destroy']);
Route::post('/store',[AuthorController::class,'store']);//->middleware([MyMiddleware::class]);
Route::get('/gro',[AuthorController::class,'gro']);
Route::post('/login',[AuthorController::class,'login']);
Route::middleware([MyMiddleware::class])->get('/gate/{profile}',function($profile){
if (Gate::allows('view-profile',[$profile])) {
    return 'something';
}
Gate::authorize('view-profile',[$profile]);//the authorize method return status 403 without using if
});

Route::post('gate/save', function ($id) {

    Gate::authorize('create',);
},[AuthorController::class,'store']);

Route::get('/show',[AuthorController::class,'show']);
Route::get('search/{name?}',[AuthorController::class,'search']);
Route::get('/filter',[AuthorController::class,'filter']);

//student route
Route::prefix('/stu')->group(function(){
    Route::get('/',[StudentController::class,'index']);
    Route::post('/store',[StudentController::class,'store']);
    Route::get('/show/{id}',[StudentController::class,'show']);
    Route::patch('/update/{id}',[StudentController::class,'update']);
    Route::delete('/destroy/{id}',[StudentController::class,'destroy']);
    Route::get('/stuWithSub',[StudentController::class,'studentWithSubject']);
})->middleware('auth:api');
//section route
Route::prefix('/sec')->group(function(){
    Route::get('/',[SectionController::class,'index']);
    Route::post('/store',[SectionController::class,'store']);
    Route::get('/show/{id}',[SectionController::class,'show']);
    Route::patch('/update/{id}',[SectionController::class,'update']);
    Route::delete('/destroy/{id}',[SectionController::class,'destroy']);
});
//teacher route
Route::prefix('/tea')->group(function(){
    Route::get('/',[TeacherController::class,'index']);
    Route::post('/store',[TeacherController::class,'store']);
    Route::get('/show/{id}',[TeacherController::class,'show']);
    Route::patch('/update/{id}',[TeacherController::class,'update']);
    Route::delete('/destroy/{id}',[TeacherController::class,'destroy']);
});
//subject route
Route::prefix('/sub')->group(function(){
    Route::get('/',[SubjectController::class,'index']);
    Route::post('/store',[SubjectController::class,'store']);
    Route::get('/show/{id}',[SubjectController::class,'show']);
    Route::patch('/update/{id}',[SubjectController::class,'update']);
    Route::delete('/destroy/{id}',[SubjectController::class,'destroy']);
    Route::get('/subWithTea',[SubjectController::class,'subjectWithTeacher']);
    Route::get('/subWithstu',[SubjectController::class,'subjectWithStudent']);
});
//level route
Route::controller(LevelController::class)->prefix('lev')->group(function(){
    Route::get('/',[LevelController::class,'index']);
    Route::post('/store',[LevelController::class,'store']);
    Route::get('/show/{id}',[LevelController::class,'show']);
    Route::patch('/update/{id}',[LevelController::class,'update']);
    Route::delete('/destroy/{id}',[LevelController::class,'destroy'])->missing(function(){return 'nothing here';});
});

Route::post('/login',[LoginController::class,'login']);

Route::middleware('auth:api')->group(function(){
    Route::get('/encrypt',[EncryptionController::class,'encrypt']);
    Route::get('/decrypt',[EncryptionController::class,'decrypt']);
});

Route::get('/event',function(){
    $order=Order::create();
    // $order=Order::find(1);
    // OrderPlaced::dispatch($order);
    // OrderPlaced::dispatch($order);// here if we add dipatch prperty in model belong to spesific opreation like created... , we here omit this line
    return 'event';
});
