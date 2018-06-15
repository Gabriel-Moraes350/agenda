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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('new-contact',function(){
	return view('new-contact');
})->name('new-contact');

Route::get('sign-in',function(){
	
})->name('sign-in');

/**
 * Grupo de serviço de rotas
 */
Route::namespace('Services')->group(function(){

	/**
	 * Rota GET para matar sessão
	 */
	Route::get('logout','LoginService@logout');

	/**
	 * Rota POST para login
	 */
	Route::post('login','LoginService@login');

	/**
	 * Rota POST para registrar administradores
	 */
	Route::post('register','LoginService@register');

	/**
	 * grupo de rotas para usuários
	 */
	Route::prefix('user')->group(function(){
		/**
		 * Rota POST para criar novos contatos
		 */
		Route::post('new/','UserService@new');

		/**
		 * Rota POST para editar contatos
		 */
		Route::post('edit/','UserService@edit');

		/**
		 * Rota POST para listar os contatos
		 */
		Route::post('','UserService@list');

		/**
		 * Rota POST para remover contatos
		 */
		Route::post('remove','UserService@remove');

		/**
		 * Rota GET para buscar contatos
		 */
		Route::post('search/','UserService@search');

		/**
		 * Rota POST para inserir imagem nos contatos
		 */
		Route::post('image','UserService@newImage');

		/**
		 * Rota POST para remover imagens dos contatos
		 */
		Route::post('remove-image','UserService@removeImage');
	});

	/**
	 * GRUPO de rotas para administradores
	 */
	Route::prefix('admin')->group(function(){
		/**
		 * Rota POST para criar novos administradores
		 */
		Route::post('new','AdminService@new');

		/**
		 * Rota POST para editar administradores
		 */
		Route::post('edit','AdminService@edit');

		/**
		 * Rota POST para remover administradores
		 */
		Route::post('remove','AdminService@remove');

		/**
		 * Rota POST para buscar dados overview da home
		 */
		Route::post('overview','AdminService@overview');

		/**
		 * Rota POST para listar administradores
		 */
		Route::post('','AdminService@list');

		/**
		 * Rota POST para buscar administradores
		 */
		Route::post('search','AdminService@search');
	});
});