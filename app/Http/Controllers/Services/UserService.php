<?php
/**
 *
 * Classe para fazer chamada a api para User
 */

namespace App\Http\Controllers\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserService extends Controller{

	/**
	 * Método utilizado para chamar api de criar contato
	 * @param  Request $request 
	 * @return [json]           [description]
	 */
	public function new(Request $request){

		$request = Request::create('/api/user/','POST',[
			'address' => $request->get('address'),
			'name'	  => $request->get('name'),
			'email'	=> $request->get('email'),
			'phone' => $request->get('phone')
		]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de editar contato
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function edit(Request $request){
		$id = $request->get('id');

		$request = Request::create('/api/user/edit/'. $id,'PUT',[
			'address' => $request->get('address'),
			'name'	  => $request->get('name'),
			'email'	=> $request->get('email'),
			'phone' => $request->get('phone')
		]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para adicionar imagens aos contatos
	 * @param  Request $request 
	 * @return json           
	 */
	public function newImage(Request $request){

		$id = $request->get('id');

		$request = Request::create('/api/user/image/'.$id ,'POST',[],[],['picture' => $request->file()]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para remover contatos
	 * @param  Request $request [description]
	 * @return json           
	 */
	public function remove(Request $request){

		$id = $request->get('id');

		$request = Request::create('/api/user/'.$id ,'DELETE',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de lista
	 * @param  Request $request 
	 * @return json           
	 */
	public function list(Request $request){

		$page = 1;

		if(isset($request->get('page'))){
			$page = $request->get('page');
		}

		$request = Request::create('/api/user?page='.$page ,'GET',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de busca
	 * @param  Request $request 
	 * @return json           
	 */
	public function search(Request $request){

		$page = 1;

		if(isset($request->get('page'))){
			$page = $request->get('page');
		}

		$query = $request->get('query');

		$request = Request::create('/api/user/'.$query.'?page='.$page ,'GET',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}

	/**
	 * Método utilizado para chamar api de remover imagem
	 * @param  Request $request 
	 * @return json           
	 */
	public function removeImage(Request $request){

		$id = $request->get('id');

		$request = Request::create('/api/user/remove-image/'.$id ,'GET',[]);

		$response = app()->handle($request);

		echo $response->getContent();
	}
}