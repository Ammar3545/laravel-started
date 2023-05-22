<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Middleware\MyMiddleware;
use App\Jobs\SlowJob;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use const App\Http\Controllers\PostsController;

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

Route::get('/mail',function(){
    Mail::send(new OrderShipped());
    // Mail::sent(OrderShipped::class);
    // Mail::sent(new OrderShipped());
    return view('welcome');
});

Route::get('/job',function(){
    SlowJob::dispatch()->delay(5);
    // sleep(5);
    return view('welcome');
});

Route::view('/','welcome',);
Route::view('/laravel','welcome');

Route::get('hi/dary/', function () {
    return "hi";
})->middleware(MyMiddleware::class);

Route::get('/contact',function(){
    return "Contact Page";
})->name('home.contact');

Route::get('/post/{id}',function($id){
    return 'Blog post '.$id;
})
// ->where(['id'=>'[0-9]+'])
->name('post');

Route::get('/recent-post/{day_ago?}',function($dayAgo=null){
    return 'Recent post '.$dayAgo. ' day ago';
})->name('post.recnt.index')->middleware('auth');

Route::prefix('/fun')->name('.fun')->group(function(){
    Route::get('/responses',function(){
        return response('google is hero',201)
        ->header('Content-Type','application/json')
        ->cookie('My-Cookie','Hello',3600);
    })->name('responses');

    Route::get('/redirect',function(){
        return redirect('/contact');
    })->name('redirect');

    Route::get('/back',function(){
        return back();
    })->name('back');

    Route::get('/named-route',function(){
        return redirect()->route('post',['id'=>21]);
    })->name('named-route');

    Route::get('/away',function(){
        return redirect()->away('https://google.com');
    })->name('away');

    Route::get('/json',function(){
        return response()->json([1=>'cat',2=>'bat',3=>'sat',4=>'nat']);
    })->name('json');

    Route::get('/download',function(){
        return response()->download(public_path('/daniel.jpg'),'face.jpg');
    })->name('download');
});

Route::get('/request', function(Request $request){
return $request->whenFilled('page',function(){

});
// $request->boolean('page');
// $request->only('page'); also take ['page','name'] array
// $request->except('page'); also take ['page','name'] array
// $request->has('page'); for check
// $request->whenHas('name', function($input){ when has value to mack conditionc
//     $input;
//    });
// $request->hasAny(['page','name']); for check
// $request->filled('page'); for check value and it is not null
// $request->whenFilled('page',function(){ when has value and it is not null to mack condetionc
    // code
// });
});

Route::get('/{age}',[HomeController::class,'home'])->name('home.index');
Route::get('/contact',[HomeController::class,'contact'])->name('home.contact');
Route::get('/single',AboutController::class);
// Route::resource('/posts',PostsController::class);
// Route::resource('/posts',PostsController::class)->only(['index','show']); to mack route for two action just ...
// Route::get('db/posts',[PostsController::class,'index']);
// Route::resource('/posts',PostsController::class);
Route::get('/storage/test',function(){
    Storage::disk('storage')->put('test.txt','welcome');
    return 'ok';
});
Route::get('/up/show',[AuthorController::class,'shows']);
Route::post('/up/stores',[AuthorController::class,'stores'])->name('photo');

Route::get('/log/test',function(){
    Log::channel('mylog')->info('Api end point  ',['user_id'=>1]);
});

Route::get('/lang/test/{lang}',function($lang){
    App::setLocale($lang);
    return view('welcome');
});





// Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
