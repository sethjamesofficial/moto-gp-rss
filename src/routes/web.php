<?php

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
route::get('/', [App\Http\Controllers\ChannelController::class, 'index'])->name('home');
route::get('/channels', [App\Http\Controllers\ChannelController::class, 'index'])->name('channels.index');
route::get('/channels/{channel}', [App\Http\Controllers\ChannelController::class, 'show'])->name('channels.show');
