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
    Route::prefix('cursos')->group(function () {
        Route::get('', ['as' => 'api.v1.cursos', 'uses' => 'App\Http\Controllers\Api\CursoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.cursos.cadastrar', 'uses' => 'App\Http\Controllers\Api\CursoController@store']);
        Route::get('ver/{id}', ['as' => 'api.v1.cursos.ver', 'uses' => 'App\Http\Controllers\Api\CursoController@show']);
            // ->middleware('auth:sanctum')
        ;
        Route::put('actualizar/{id}', ['as' => 'api.v1.cursos.actualizar', 'uses' => 'App\Http\Controllers\Api\CursoController@update']);
        // ->middleware('auth:sanctum')
        ;

        Route::delete('eliminar/{id}', ['as' => 'api.v1.cursos.eliminar', 'uses' => 'App\Http\Controllers\Api\CursoController@delete']);
        // Route::delete('eliminar/{id}', ['as' => 'api.v1.cursos.eliminar', 'uses' => 'App\Http\Controllers\Api\CursoController@eliminar'])->middleware('auth:sanctum');
        Route::get('por_criador/{id_user}', ['as' => 'api.v1.cursos.por_criador', 'uses' => 'App\Http\Controllers\Api\CursoController@por_criador'])->middleware('auth:sanctum');
        Route::get('por_avaliacao/{estado}', ['as' => 'api.v1.cursos.por_avaliacao', 'uses' => 'App\Http\Controllers\Api\CursoController@por_avaliacao'])
        // ->middleware('auth:sanctum')
        ;

    })->middleware('cors','api');
    Route::prefix('topicos')->group(function () {
        Route::get('', ['as' => 'api.v1.topicos', 'uses' => 'App\Http\Controllers\Api\TopicoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.topicos.cadastrar', 'uses' => 'App\Http\Controllers\Api\TopicoController@cadastrar'])->middleware('auth:sanctum');
        Route::put('actualizar/{id}', ['as' => 'api.v1.topicos.actualizar', 'uses' => 'App\Http\Controllers\Api\TopicoController@actualizar'])->middleware('auth:sanctum');
        Route::get('eliminar/{id}', ['as' => 'api.v1.topicos.eliminar', 'uses' => 'App\Http\Controllers\Api\TopicoController@eliminar'])->middleware('auth:sanctum');
        Route::get('por_curso/{id_curso}', ['as' => 'api.v1.topicos.por_curso', 'uses' => 'App\Http\Controllers\Api\TopicoController@por_curso']);
    });
    Route::prefix('arquivos')->group(function () {
        Route::get('', ['as' => 'api.v1.arquivos', 'uses' => 'App\Http\Controllers\Api\ArquivoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.arquivos.cadastrar', 'uses' => 'App\Http\Controllers\Api\ArquivoController@cadastrar'])
            ->middleware('auth:sanctum')
        ;
        Route::put('actualizar/{id}', ['as' => 'api.v1.arquivos.actualizar', 'uses' => 'App\Http\Controllers\Api\ArquivoController@actualizar'])->middleware('auth:sanctum');
        Route::get('eliminar/{id}', ['as' => 'api.v1.arquivos.eliminar', 'uses' => 'App\Http\Controllers\Api\ArquivoController@eliminar'])->middleware('auth:sanctum');
        Route::get('por_curso/{id_curso}', ['as' => 'api.v1.arquivos.por_curso', 'uses' => 'App\Http\Controllers\Api\ArquivoController@por_curso']);
    });
    Route::prefix('feedbacks')->group(function () {
        Route::get('', ['as' => 'api.v1.feedbacks', 'uses' => 'App\Http\Controllers\Api\FeedBackController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.feedbacks.cadastrar', 'uses' => 'App\Http\Controllers\Api\FeedBackController@cadastrar'])
            // ->middleware('auth:sanctum')
        ;
        ;
        Route::put('actualizar/{id}', ['as' => 'api.v1.feedbacks.actualizar', 'uses' => 'App\Http\Controllers\Api\FeedBackController@actualizar'])->middleware('auth:sanctum');
        ;
        Route::get('eliminar/{id}', ['as' => 'api.v1.feedbacks.eliminar', 'uses' => 'App\Http\Controllers\Api\FeedBackController@eliminar'])->middleware('auth:sanctum');
        ;
        Route::get('por_curso/{id}', ['as' => 'api.v1.feedbacks.por_curso', 'uses' => 'App\Http\Controllers\Api\FeedBackController@por_curso'])->middleware('auth:sanctum');
        ;
        Route::get('por_curso/{id}/educandos', ['as' => 'api.v1.feedbacks.por_curso_educandos', 'uses' => 'App\Http\Controllers\Api\FeedBackController@por_curso_educandos'])->middleware('auth:sanctum');
        ;
        Route::get('por_curso/{id}/professor', ['as' => 'api.v1.feedbacks.por_curso_professor', 'uses' => 'App\Http\Controllers\Api\FeedBackController@por_curso_professor'])->middleware('auth:sanctum');
        ;
        Route::get('estatistica', ['as' => 'api.v1.feedbacks.estatistica', 'uses' => 'App\Http\Controllers\Api\FeedBackController@estatistica'])
            // ->middleware('auth:sanctum')
        ;
        Route::get('estatistica_entidade/{entidade}', ['as' => 'api.v1.feedbacks.estatistica_entidade', 'uses' => 'App\Http\Controllers\Api\FeedBackController@estatistica_entidade']);
        Route::get('meus_feedbacks/{id_user}', ['as' => 'api.v1.feedbacks.meus_feedbacks', 'uses' => 'App\Http\Controllers\Api\FeedBackController@meus_feedbacks']);



    });
    Route::prefix('categoria_cursos')->group(function () {
        Route::get('', ['as' => 'api.v1.categoria_cursos', 'uses' => 'App\Http\Controllers\Api\CategoriaCursoController@index']);
        Route::get('ver/{id}', ['as' => 'api.v1.categoria_cursos.ver', 'uses' => 'App\Http\Controllers\Api\CategoriaCursoController@ver']);
        Route::post('cadastrar', ['as' => 'api.v1.categoria_cursos.cadastrar', 'uses' => 'App\Http\Controllers\Api\CategoriaCursoController@cadastrar']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.categoria_cursos.actualizar', 'uses' => 'App\Http\Controllers\Api\CategoriaCursoController@actualizar']);
        Route::delete('eliminar/{id}', ['as' => 'api.v1.categoria_cursos.eliminar', 'uses' => 'App\Http\Controllers\Api\CategoriaCursoController@eliminar']);
    })->middleware('auth:sanctum');
    Route::prefix('inscricoes')->group(function () {
        Route::get('', ['as' => 'api.v1.inscricoes', 'uses' => 'App\Http\Controllers\Api\InscricaoController@index']);
        Route::post('cadastrar', ['as' => 'api.v1.inscricoes.cadastrar', 'uses' => 'App\Http\Controllers\Api\InscricaoController@cadastrar']);
        Route::put('actualizar/{id}', ['as' => 'api.v1.inscricoes.actualizar', 'uses' => 'App\Http\Controllers\Api\InscricaoController@actualizar']);
        Route::get('eliminar/{id}', ['as' => 'api.v1.inscricoes.eliminar', 'uses' => 'App\Http\Controllers\Api\InscricaoController@eliminar']);
        Route::get('por_formando/{id_user}', ['as' => 'api.v1.inscricoes.por_formando', 'uses' => 'App\Http\Controllers\Api\InscricaoController@por_formando']);
        Route::get('por_curso/{id_curso}', ['as' => 'api.v1.inscricoes.por_curso', 'uses' => 'App\Http\Controllers\Api\InscricaoController@por_curso']);


    })->middleware('auth:sanctum');
    Route::prefix('users')->group(function () {
        Route::get('', ['as' => 'api.v1.users', 'uses' => 'App\Http\Controllers\Api\UserController@index'])
            // ->middleware('auth:sanctum')
        ;
        Route::post('cadastrar', ['as' => 'api.v1.users.cadastrar', 'uses' => 'App\Http\Controllers\Api\UserController@cadastrar']);
        Route::get('ver/{id}', ['as' => 'api.v1.users.ver', 'uses' => 'App\Http\Controllers\Api\UserController@ver'])
            // ->
            // middleware('auth:sanctum');
        ;
        Route::put('actualizar/{id}', ['as' => 'api.v1.users.actualizar', 'uses' => 'App\Http\Controllers\Api\UserController@actualizar']);
        ;
        Route::delete('eliminar/{id}', ['as' => 'api.v1.users.eliminar', 'uses' => 'App\Http\Controllers\Api\UserController@eliminar']);
        ;
        Route::get('por_formando/{id_user}', ['as' => 'api.v1.users.por_formando', 'uses' => 'App\Http\Controllers\Api\UserController@por_formando'])->middleware('auth:sanctum');
        ;
        Route::put('actualizar_password/{id_user}', ['as' => 'api.v1.users.actualizar_password', 'uses' => 'App\Http\Controllers\Api\UserController@actualizar_password'])->middleware('auth:sanctum');
        Route::put('recuperar_password/{id_user}', ['as' => 'api.v1.users.recuperar_password', 'uses' => 'App\Http\Controllers\Api\UserController@recuperar_password']);
        // Route::post('login', ['as' => 'api.v1.users.login', 'uses' => 'App\Http\Controllers\Api\AuthController@login']);
        Route::post('logout', ['as' => 'api.v1.users.logout', 'uses' => 'App\Http\Controllers\Api\AuthController@logout'])->middleware('auth:sanctum');
        ;

    });
})->middleware('cors','api');
