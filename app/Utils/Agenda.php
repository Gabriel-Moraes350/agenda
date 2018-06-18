<?php
/**
 * Classe de utilidades para pegar admin em qualquer lugar
 */

namespace App\Utils;

use App\Models\Admin;
use App\Models\AdminToken;
use Request;


class Agenda{
	public static function getAdmin(){
		return Request::get('admin');
	}

	public static function getAdminId(){
		$admin = Request::get('admin');
		return $admin->id;
	}
}