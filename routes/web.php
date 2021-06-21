<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', function () {
 //   return view('home.index');
//});
//Route::get('/contact', function () {
//    return view('home.contact');
//});

Route::view('/', 'home.index');
Route::view('/contact', 'home.contact');
Route::get('/',[HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/single', AboutController::class,'single');

$posts =[
    1=>[
        'title' => 'intro to laravel',
        'content' => 'this is a short intro to laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2=>[
        'title' => 'intro to php',
        'content' => 'this is a short intro to php',
        'is_new' => false,
        'has_comments' => false
    ],
    3=>[
        'title' => 'intro to php',
        'content' => 'this is a short intro to golan',
        'is_new' => false,
    ]
];

 Route::resource('posts', PostsController::class)
 ->only(['index', 'show', 'create', 'store', 'edit', 'update','destroy']);
// route::get('/posts', function()  use($posts){
//     request()->all();
//     dd((int)request()->query('page',1));
//     return view('posts.index', ['posts' => $posts]);
// });

// Route::get('/posts/{id}', function ($id) use($posts) {
//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show',['post' => $posts[$id]]);
// })
// -> where([
  //  'id' => '[0-9]+'
//]);
//->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function ($daysAgo =5) {
    return 'Posts from' . $daysAgo .'daysago';
})->name('posts.recent.index')->middleware('auth');

Route::prefix('/fun')->name('fun.')->group(function() use($posts) {
    Route::get('responses', function() use($posts) {
      return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'Piotr Jura', 3600);
    })->name('responses');

Route::get('redirect', function () {
    return redirect('/contact');
}) ->name('redirect');

Route::get('back', function () {
    return back();
}) ->name('back');

Route::get('named-route', function () {
    return redirect()->route('posts.show',['id' => 1]);
}) ->name('named-route');

Route::get('away', function () {
    return redirect()->away('https://google.com');
}) ->name('away');

// ritorno un file json come front-end
Route::get('json', function () use($posts) {
    return response()->json($posts);
}) ->name('json');

// ritorno un file da scaricare tramite path 
Route::get('download', function () use($posts) {
    return response()->download('C:\xampp\htdocs\matteo_brescianini\images\me.png');
}) ->name('download');
});