<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\Admin\OperadorController;



Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    /*START CLASSE*/
    Route::prefix('classes')->group(function () {
        Route::get('', ['as' => 'admin.classe.list', 'uses' => 'Admin\ClasseController@list']);
        Route::post('store', ['as' => 'admin.classe.store', 'uses' => 'Admin\ClasseController@store']);
        Route::get('edit/{id}', ['as' => 'admin.classe.edit', 'uses' => 'Admin\ClasseController@edit']);
        Route::post('update/{id}', ['as' => 'admin.classe.update', 'uses' => 'Admin\ClasseController@update']);
        Route::get('delete/{id}', ['as' => 'admin.classe.delete', 'uses' => 'Admin\ClasseController@delete']);
    });
    /*END CLASSE*/

    /*END RELATÓRIO*/
   
        Route::get('dashboard', ['as' => 'admin', 'uses' => 'Admin\HomeController@index']);


});