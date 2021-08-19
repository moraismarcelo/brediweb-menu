<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/menu', function (Request $request) {
//     return $request->user();
// });
Route::middleware(\Barryvdh\Cors\HandleCors::class)->group(function(){
    Route::get('/menu/{slug?}', [
        'as' => 'menu::api.menu',
        'uses' => 'Api\MenuController@detalhe'
    ]);

    Route::get('/pagina/{slug}', [
        'as' => 'menu::api.pagina',
        'uses' => 'Api\PaginaController@detalhe'
    ]);
});
