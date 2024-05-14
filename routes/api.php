<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['cors','api'])->group(function () {
    // Route::get('/userss', [AuthController::class, 'index']);

    /* START CORREÇÃO*/
    Route:: /* middleware(['admin'])-> */prefix('/v1/users')->group(
        function () {
            Route::post('login', [AuthController::class,'login']);




        }
    );

});
Route::any('login-api', function () {
    return response()->json(['error' => 'Unsupported Media Type'], 415);
})->name('login-api');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/v1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('', ['as' => 'api.v1.users', 'uses' => 'App\Http\Controllers\Api\UserController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.users.cadastrar', 'uses' => 'App\Http\Controllers\Api\UserController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.users.ver', 'uses' => 'App\Http\Controllers\Api\UserController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.users.actualizar', 'uses' => 'App\Http\Controllers\Api\UserController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.users.eliminar', 'uses' => 'App\Http\Controllers\Api\UserController@eliminar']);
        Route::get('por_formando/{id_user}', ['as' => 'api.v1.users.por_formando', 'uses' => 'App\Http\Controllers\Api\UserController@por_formando'])->middleware('auth:sanctum');
        Route::put('actualizar_password/{id_user}', ['as' => 'api.v1.users.actualizar_password', 'uses' => 'App\Http\Controllers\Api\UserController@actualizar_password'])->middleware('auth:sanctum');

        Route::put('recuperar_password/{id_user}', ['as' => 'api.v1.users.recuperar_password', 'uses' => 'App\Http\Controllers\Api\UserController@recuperar_password']);
        // Route::post('login', ['as' => 'api.v1.users.login', 'uses' => 'App\Http\Controllers\Api\AuthController@login']);

        Route::post('logout', ['as' => 'api.v1.users.logout', 'uses' => 'App\Http\Controllers\Api\AuthController@logout'])->middleware('auth:sanctum');;

    });

    Route::prefix('users')->group(function () {
        Route::get('', ['as' => 'api.v1.users', 'uses' => 'App\Http\Controllers\Api\UserController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.users.cadastrar', 'uses' => 'App\Http\Controllers\Api\UserController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.users.ver', 'uses' => 'App\Http\Controllers\Api\UserController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.users.actualizar', 'uses' => 'App\Http\Controllers\Api\UserController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.users.eliminar', 'uses' => 'App\Http\Controllers\Api\UserController@eliminar']);

    });

    Route::prefix('tipo_pedidos')->group(function () {
        Route::get('', ['as' => 'api.v1.tipo_pedidos', 'uses' => 'App\Http\Controllers\Api\TipoPedidoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.tipo_pedidos.cadastrar', 'uses' => 'App\Http\Controllers\Api\TipoPedidoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.tipo_pedidos.ver', 'uses' => 'App\Http\Controllers\Api\TipoPedidoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.tipo_pedidos.actualizar', 'uses' => 'App\Http\Controllers\Api\TipoPedidoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.tipo_pedidos.eliminar', 'uses' => 'App\Http\Controllers\Api\TipoPedidoController@eliminar']);

    });

    Route::prefix('tipo_usuarios')->group(function () {
        Route::get('', ['as' => 'api.v1.tipo_usuarios', 'uses' => 'App\Http\Controllers\Api\TipoUsuarioController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.tipo_usuarios.cadastrar', 'uses' => 'App\Http\Controllers\Api\TipoUsuarioController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.tipo_usuarios.ver', 'uses' => 'App\Http\Controllers\Api\TipoUsuarioController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.tipo_usuarios.actualizar', 'uses' => 'App\Http\Controllers\Api\TipoUsuarioController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.tipo_usuarios.eliminar', 'uses' => 'App\Http\Controllers\Api\TipoUsuarioController@eliminar']);

    });
    Route::prefix('pedidos')->group(function () {
        Route::get('', ['as' => 'api.v1.pedidos', 'uses' => 'App\Http\Controllers\Api\PedidoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.pedidos.cadastrar', 'uses' => 'App\Http\Controllers\Api\PedidoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.pedidos.ver', 'uses' => 'App\Http\Controllers\Api\PedidoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.pedidos.actualizar', 'uses' => 'App\Http\Controllers\Api\PedidoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.pedidos.eliminar', 'uses' => 'App\Http\Controllers\Api\PedidoController@eliminar']);

    });
    Route::prefix('permissao')->group(function () {
        Route::get('', ['as' => 'api.v1.permissao', 'uses' => 'App\Http\Controllers\Api\PermissaoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.permissao.cadastrar', 'uses' => 'App\Http\Controllers\Api\PermissaoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.permissao.ver', 'uses' => 'App\Http\Controllers\Api\PermissaoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.permissao.actualizar', 'uses' => 'App\Http\Controllers\Api\PermissaoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.permissao.eliminar', 'uses' => 'App\Http\Controllers\Api\PermissaoController@eliminar']);

    });

    Route::prefix('campo_pedido')->group(function () {
        Route::get('', ['as' => 'api.v1.campo_pedido', 'uses' => 'App\Http\Controllers\Api\CampoPedidoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.campo_pedido.cadastrar', 'uses' => 'App\Http\Controllers\Api\CampoPedidoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.campo_pedido.ver', 'uses' => 'App\Http\Controllers\Api\CampoPedidoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.campo_pedido.actualizar', 'uses' => 'App\Http\Controllers\Api\CampoPedidoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.campo_pedido.eliminar', 'uses' => 'App\Http\Controllers\Api\CampoPedidoController@eliminar']);

    });

    Route::prefix('campo')->group(function () {
        Route::get('', ['as' => 'api.v1.campo', 'uses' => 'App\Http\Controllers\Api\CampoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.campo.cadastrar', 'uses' => 'App\Http\Controllers\Api\CampoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.campo.ver', 'uses' => 'App\Http\Controllers\Api\CampoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.campo.actualizar', 'uses' => 'App\Http\Controllers\Api\CampoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.campo.eliminar', 'uses' => 'App\Http\Controllers\Api\CampoController@eliminar']);

    });

    Route::prefix('parecer')->group(function () {
        Route::get('', ['as' => 'api.v1.parecer', 'uses' => 'App\Http\Controllers\Api\ParecerController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.parecer.cadastrar', 'uses' => 'App\Http\Controllers\Api\ParecerController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.parecer.ver', 'uses' => 'App\Http\Controllers\Api\ParecerController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.parecer.actualizar', 'uses' => 'App\Http\Controllers\Api\ParecerController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.parecer.eliminar', 'uses' => 'App\Http\Controllers\Api\ParecerController@eliminar']);

    });


    Route::prefix('decisaos')->group(function () {
        Route::get('', ['as' => 'api.v1.decisaos', 'uses' => 'App\Http\Controllers\Api\DecisaoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.decisaos.cadastrar', 'uses' => 'App\Http\Controllers\Api\DecisaoController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.decisaos.ver', 'uses' => 'App\Http\Controllers\Api\DecisaoController@ver']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.decisaos.actualizar', 'uses' => 'App\Http\Controllers\Api\DecisaoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.decisaos.eliminar', 'uses' => 'App\Http\Controllers\Api\DecisaoController@eliminar']);

    });
})->middleware('cors','api');
