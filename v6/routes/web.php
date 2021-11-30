<?php

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

use \App\{Post, PostImage};

Route::get('/', function () {
    $users = \App\User::all();
    return view('welcome', compact('users'));
});


Route::get('sub', function() {

    // adicionando subquery com addSelect
    $posts = \App\Post::addSelect([
        'thumb' => PostImage::select('image')->whereColumn('post_id', 'posts.id')->limit(1)
    ])->get();

    // obtendo o mesmo resultado utilizando join com a classe DB
    //$posts = \Illuminate\Support\Facades\DB::table('posts', 'p')->join('post_images', 'post_images.post_id', 'p.id')->get();

    return $posts;
});