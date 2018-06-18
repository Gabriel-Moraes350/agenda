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

Route::namespace('Auth')->group(function(){
	/**
	 * Rota POST para logar 
	 */
	Route::post('/login','LoginController@login');
	/**
	 * Rota POST para registrar admin
	 */
	Route::post('/register','LoginController@register');
});

/**
 * Grupo de rotas para alterar usuários da agenda
 */
Route::namespace('User')->prefix('user')->group(function(){

	/**
	 * Rota POST para adicionar um contato
	 */
	Route::post('/','UserController@new');

	/**
	 * Rota DELETE para remover um contato
	 */
	Route::delete('/{id}', 'UserController@remove');

	/**
	 * Rota GET para retornar um contato
	 */
	Route::get('details/{id}','UserController@get');

	/**
	 * Rota PUT para editar um contato
	 */
	Route::put('/{id}','UserController@edit');

	/**
	 * Rota GET para listar os contatos
	 */
	Route::get('','UserController@list');

	/**
	 * Rota GET para buscar os contatos
	 */
	Route::get('/{query}','UserController@search');

	/**
	 * Rota POST para salvar novas imagens para o usuário
	 */
	Route::post('/image/{id}','UserController@newImage');

	/**
	 * Rota GET para remover imagem
	 */
	Route::get('/remove-image/{id}','UserController@removeImage');

});


Route::namespace('Admin')->prefix('admin')->group(function(){
	/**
	 * Rota POST  para criar novos administradores
	 */
	Route::post('/','AdminController@new');

	/**
	 * Rota PUT para editar novos administradores
	 */
	Route::put('{id}','AdminController@edit');

	/**
	 * Rota DELETE para deletar um administrador
	 */
	Route::delete('{id}','AdminController@remove');

	/**
	 * Rota GET para listar administradores
	 */
	Route::get('','AdminController@list');

	/**
	 * Rota GET para buscar administradores
	 */
	Route::get('{query}','AdminController@search');

	/**
	 * Rota GET para listar relatórios dos administradores
	 */
	Route::post('overview','AdminController@overview');
});
