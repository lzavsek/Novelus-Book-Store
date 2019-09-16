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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->post('/books', function() {
    $attributes = request()->validate([
        'title' => 'required',
        'author' => 'required',
        'year' => 'required',
        'quantity' => 'required'
    ]);
    
    App\Book::create($attributes);
    
    return redirect('/');
});
