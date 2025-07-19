<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    // This is the default route for the application.

    Storage::disk('pdfimages')->put('example.txt', 'Hello, World!');
    $target = storage_path('app/public/pdfimages');
    $link = public_path('pdfimages');

    if (!file_exists($link)) {
        symlink($target, $link);
        echo "Symlink created: $link -> $target";
    }

    return view('welcome');
});
