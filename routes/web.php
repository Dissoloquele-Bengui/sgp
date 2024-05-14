<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/bbb', function () {
  echo  $token = Session::token();
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });


Route::get('/', ['as' => 'home', 'uses' => 'Site\HomeController@home']);


/*START OPERADOR*/
Route::prefix('federacoes')->group(function () {
    Route::get('index', ['as' => 'site.federacoes.index', 'uses' => 'Site\FederacaoController@index']);
    Route::get('{id}/ver-mais', ['as' => 'site.federacoes.ver_mais', 'uses' => 'Site\FederacaoController@ver_mais']);
    // Route::get('sobre', ['as' => 'site.federacoes.sobre', 'uses' => 'Site\FederacaoController@sobre']);

});
Route::prefix('registro')->group(function () {
    Route::post('passageiro', ['as' => 'site.register_passageiro.store_passageiro', 'uses' => 'Site\RegistroController@store_passageiro']);
    Route::post('motorista', ['as' => 'site.register_motorista.store_motorista', 'uses' => 'Site\RegistroController@store_motorista']);

});

Route::prefix('labs')->group(function () {
    Route::get('', ['as' => 'admin.labs', 'uses' => 'Lab\LabController@index']);
    // Route::get('mru', ['as' => 'admin.labs.mru', 'uses' => 'Lab\LabController@mru']);

});
Route::get('mru', ['as' => 'admin.labs.mru', 'uses' => 'Lab\LabController@mru']);
Route::get('mruv', ['as' => 'admin.labs.mruv', 'uses' => 'Lab\LabController@mruv']);
Route::get('lo', ['as' => 'admin.labs.lo', 'uses' => 'Lab\LabController@lo']);
Route::get('mcu', ['as' => 'admin.labs.mcu', 'uses' => 'Lab\LabController@mcu']);
Route::get('mcuv', ['as' => 'admin.labs.mcuv', 'uses' => 'Lab\LabController@mcuv']);
Route::get('colisao', ['as' => 'admin.labs.colisao', 'uses' => 'Lab\LabController@colisao']);


/*END OPERADOR*/

Route::get('alavancas-maquinas-simples', ['as' => 'admin.labs.alavancas-maquinas-simples', 'uses' => 'Lab\LabController@alavancas_maquinas_simples']);
Route::get('equilibrio-forca', ['as' => 'admin.labs.equilibrio-forca', 'uses' => 'Lab\LabController@equilibrio_forca']);



// Start Dinâmica
Route::get('forca-tensao', ['as' => 'admin.labs.forca-tensao', 'uses' => 'Lab\LabController@forca_tensao']);

Route::get('forca-aplicadas-dois-corpos', ['as' => 'admin.labs.forca-aplicadas-dois-corpos', 'uses' => 'Lab\LabController@forca_aplicadas_dois_corpos']);
Route::get('segunda-Lei-de-Newton', ['as' => 'admin.labs.segunda-Lei-de-Newton', 'uses' => 'Lab\LabController@segunda_Lei_de_Newton']);
Route::get('forca-de-tensao-com-polias', ['as' => 'admin.labs.forca-de-tensao-com-polias', 'uses' => 'Lab\LabController@forca_de_tensao_com_polias']);

// End Dinâmica


// Start Energia e Trabalho
Route::get('energia_cinetica', ['as' => 'admin.labs.trabalho-energia.energia_cinetica', 'uses' => 'Lab\LabController@energia_cinetica']);
Route::get('energia_potencial', ['as' => 'admin.labs.trabalho-energia.energia_potencial', 'uses' => 'Lab\LabController@energia_potencial']);
Route::get('plano_inclinado', ['as' => 'admin.labs.trabalho-energia.plano_inclinado', 'uses' => 'Lab\LabController@plano_inclinado']);
Route::get('energia_potencial_elastica', ['as' => 'admin.labs.trabalho-energia.energia_potencial_elastica', 'uses' => 'Lab\LabController@energia_potencial_elastica']);

// Start Energia e Trabalho

// Route::get('segunda-Lei-de-Newton', ['as' => 'admin.labs.segunda-Lei-de-Newton', 'uses' => 'Lab\LabController@segunda_Lei_de_Newton']);
// Route::get('forca-de-tensao-com-polias', ['as' => 'admin.labs.forca-de-tensao-com-polias', 'uses' => 'Lab\LabController@forca_de_tensao_com_polias']);

// End Dinâmica
