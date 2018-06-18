<?php
use App\Utils\Agenda;
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
Route::middleware('check.auth')->group(function(){
	
	Route::get('/', function () {
		$admin =  Agenda::getAdmin();
	    return view('home',['admin' => $admin]);
	})->name('home');

	Route::get('novo-contato',function(){
		$admin = Agenda::getAdmin();
		return view('new-contact',['admin' => $admin]);
	})->name('new-contact');

	Route::get('editar-contato',function(){
		$admin = Agenda::getAdmin();
		return view('edit-contact',['admin' => $admin]);
	})->name('edit-contact');

	Route::get('login',function(){
		return view('login');
	})->name('login');
});

Route::middleware('admin.auth')->group(function(){
	
	Route::get('admin',function(){
		$admin = Agenda::getAdmin();
		return view('admin-home',['admin' => $admin]);
	})->name('admin-home');

	Route::get('lista-admin',function(){
		$admin = Agenda::getAdmin();
		return view('admin-list',['admin' => $admin]);
	})->name('admin-list');

	Route::get('novo-admin',function(){
		$admin = Agenda::getAdmin();
		return view('admin-home',['admin' => $admin]);
	})->name('admin-new');

	Route::get('meu-perfil',function(){
		$admin = Agenda::getAdmin();
		return view('admin-home',['admin' => $admin]);
	})->name('my-profile');

	Route::get('editar-admin',function(){
		$admin = Agenda::getAdmin();
		return view('admin-home',['admin' => $admin]);
	})->name('edit-admin');



});


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
		 * Rota POST para retornar detalhes de um contato
		 */
		Route::post('get/','UserService@get');

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