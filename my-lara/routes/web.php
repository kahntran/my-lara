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

Route::get('/submit', function () {
    return view('submit');
});

use Illuminate\Http\Request;

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'url' => 'required|url|max:255',
        'description' => 'required|max:255',
    ]);

    $link = tap(new App\Models\Link($data))->save();

    return redirect('/');
});

Route::get('/', function () {
    $links = \App\Models\Link::all();

//    return view('welcome', ['links' => $links]);

    // with()
//    return view('welcome')->with('links', $links);
    // dynamic method to name the variable
    return view('welcome')->withLinks($links);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
