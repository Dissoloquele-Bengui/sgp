<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Admin\OperadorController;



Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    

        Route::get('dashboard', ['as' => 'admin', 'uses' => 'Admin\HomeController@index']);


});
