<?php
/**
 *
 * Classe para fazer chamada a api para Login
 */

namespace App\Http\Controllers\Services;

session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LoginService extends Controller{

	/**
	 * Método utilizado para chamar api de login
	 * @param  Request $request 
	 * @return json           retorno da api
	 */
	public function login(Request $request){

		$request = Request::create('/api/login','POST',[
			'login' => $request->get('login'),
			'password' => $request->get('password')
		]);

		$response = json_decode(app()->handle($request),true);

		unset($response['token']);

		echo $response->getContent();

	}

	/**
	 * Método utilizado para chamar api de registrar administrador
	 * @param  Request $request 
	 * @return json           retorno da api
	 */
	public function register(Request $request){

		$request = Request::create('/api/register','POST',[
			'name' => $request->get('name'),
			'login' => $request->get('login'),
			'password' => $request->get('password')
		]);

		$response = app()->handle($request);

		echo $response->getContent();

	}

	/**
	 * Método utilizado para matar o token de sessão
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function logout(Request $request){
		session_destroy();
		
		return redirect('/');
	}
}