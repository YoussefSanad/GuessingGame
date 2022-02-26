<?php

use App\Events\MessageNotification;
use App\Http\Controllers\GameController;
use App\Http\Middleware\Authenticate;
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


Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('listen', function () {
        return view('listen');
    });

    Route::get('event', function () {
        event(new MessageNotification('This is our first broadcase message'));
    });

    Route::get('start_game', [GameController::class, 'showGame']);

});


require __DIR__ . '/auth.php';
