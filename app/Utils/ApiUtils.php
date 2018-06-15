<?php
/**
 *	Classe para retorno da Api
 *
 * 	@author   Gabriel Moraes <gabriel.m.baptista@gmail.com>
 * 
 */
namespace App\Utils;

class ApiUtils{
	/**
	 * Método utilizado para ser retorno da api
	 */
	public static function response($error,$message,$data){
		return json_encode(['error' => $error, 'message' => $message, 'data' => $data]);
	}
}