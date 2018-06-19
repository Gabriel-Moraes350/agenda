<?php
/**
 *
 * Classe para fazer chamada a api para Admin
 */

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminService extends Controller{

	/**
	 * Método utilizado para chamar api de criação administrador
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function new(Request $request){
		$request = Request::create('/api/admin/','POST',[
			'name' => $request->get('name'),
			'login' => $request->get('login'),
			'active' => $request->get('active'),
			'password' => $request->get('password'),
			'access_level' => $request->get('access_level')
		]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de editar administrador
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function edit(Request $request){
		$id = $request->get('id');

		$request = Request::create('/api/admin/'. $id,'PUT',[
			'name' => $request->get('name'),
			'login' => $request->get('login'),
			'active' => $request->get('active'),
			'password' => $request->get('password'),
			'access_level' => $request->get('access_level'),
			'id'  => $id
		]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de remover administrador
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function remove(Request $request){
		$id = $request->get('id');

		$request = Request::create('/api/admin/'. $id,'DELETE',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de busca administrador
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function search(Request $request){

		$page = 1;
		if($request->get('page') != null){
			$page = $request->get('page');
		}

		$query = $request->get('query');

		$request = Request::create('/api/admin/'. $query . '?page='. $page,'GET',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de listagem administrador
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function list(Request $request){

		$page = 1;
		if($request->get('page') != null){
			$page = $request->get('page');
		}

		$request = Request::create('/api/admin?page='. $page,'GET',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de overview
	 * @param  Request $request [description]
	 * @return [json]           [description]
	 */
	public function overview(Request $request){

		$request = Request::create('/api/admin/overview','POST',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

}