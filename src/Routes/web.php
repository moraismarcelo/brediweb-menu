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

// Route::prefix('menu')->group(function() {
//     Route::get('/', [
//         'as' => 'teste',
//        'uses'  => 'MenuController@index'
//     ]);
// });
Route::prefix((!empty(config('bredidashboard.prefix')) ? config('bredidashboard.prefix') : 'controle'))->middleware('auth', Brediweb\BrediDashboard\Http\Middleware\ValidaPermissao::class)
->as('menu::')
->group(
    function () {

		Route::get('menu', ['uses' => 'Controle\MenuController@index', 'permissao' => 'controle.menu.index'])->name('controle.menu.index');
		Route::get('menu/create', ['uses' => 'Controle\MenuController@create', 'permissao' => 'controle.menu.create'])->name('controle.menu.create');
		Route::get('menu/edit/{id}', ['uses' => 'Controle\MenuController@edit', 'permissao' => 'controle.menu.edit'])->name('controle.menu.edit');
		Route::post('menu/store', ['uses' => 'Controle\MenuController@store', 'permissao' => 'controle.menu.store'])->name('controle.menu.store');
		Route::post('menu/update/{id}', ['uses' => 'Controle\MenuController@update', 'permissao' => 'controle.menu.update'])->name('controle.menu.update');
        Route::get('menu/delete/{id}', ['uses' => 'Controle\MenuController@destroy', 'permissao' => 'controle.menu.destroy'])->name('controle.menu.destroy');


        Route::get('pagina', ['uses' => 'Controle\PaginaController@index', 'permissao' => 'controle.pagina.index'])->name('controle.pagina.index');
		Route::get('pagina/create', ['uses' => 'Controle\PaginaController@create', 'permissao' => 'controle.pagina.create'])->name('controle.pagina.create');
		Route::get('pagina/edit/{id}', ['uses' => 'Controle\PaginaController@edit', 'permissao' => 'controle.pagina.edit'])->name('controle.pagina.edit');
		Route::post('pagina/store', ['uses' => 'Controle\PaginaController@store', 'permissao' => 'controle.pagina.store'])->name('controle.pagina.store');
		Route::post('pagina/update/{id}', ['uses' => 'Controle\PaginaController@update', 'permissao' => 'controle.pagina.update'])->name('controle.pagina.update');
        Route::get('pagina/delete/{id}', ['uses' => 'Controle\PaginaController@destroy', 'permissao' => 'controle.pagina.destroy'])->name('controle.pagina.destroy');
});
