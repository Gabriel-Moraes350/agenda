<?php
/**
 *	Classe utilizada para listar todos os administradores
 * 	Gabriel Moraes Baptista <gabriel.m.baptista@gmail.com>
 */
namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\User;
use App\Models\UserPhone;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiUtils;
use App\Utils\Agenda;
use App\Http\Controllers\Controller;

define('ITEMS_ADMIN',15);

class AdminController extends Controller{

	/**
	 * Método utilizado para listar administradores
	 * @return json
	 */
	public function list(){
		$list = Admin::paginate(ITEMS_ADMIN);

		return ApiUtils::response(false,__('messages.list_admin'),$list);
	}

	public function search($query){

		$list = Admin::where('name','like','%'.$query.'%')
					->orWhere('login','like','%'.$query.'%')
					->paginate(ITEMS_ADMIN);
		return ApiUtils::response(false,__('messages.search_admin'),$list);

	}

	/**
	 * Método utilizado para criar novos administradores
	 * @param  Request $request 
	 * @return json           
	 */
	public function new(Request $request){
		//valida dados
		$validator = $this->validateAdmin($request);

		if($validator->fails()){
			return ApiUtils::response(true,$validator->messages()->first(),null);
		}

		$data = $request->all();

		//busca login em outros administradores
		$adminExistsLogin = Admin::where('login',$data['login'])->first();

		if($adminExistsLogin instanceof Admin){
			return ApiUtils::response(true, __('messages.admin_exists'),null);
		}

		//cria admin
		$admin = Admin::create($data);

		return ApiUtils::response(false,__('messages.created_admin'),null);

	}

	/**
	 * Método utilizado para editar novos administradores
	 * @param  Request $request 
	 * @param   $id id do administrador
	 * @return json           
	 */
	public function edit(Request $request,$id){
		//valida dados
		$validator = $this->validateEditAdmin($request);

		if($validator->fails()){
			return ApiUtils::response(true,$validator->messages()->first(),null);
		}

		$data = $request->all();

		//busca login em outros administradores
		$adminExistsLogin = Admin::where('login',$data['login'])
					->whereNotIn('id',[$id])->first();

		if($adminExistsLogin instanceof Admin){
			return ApiUtils::response(true, __('messages.admin_exists'),null);
		}

		//edita admin
		$admin = Admin::find($id);

		if(!$admin instanceof Admin){
			return ApiUtils::response(true,__('messages.admin_invalid'),null);
		}

		$admin->name = $data['name'];
		$admin->login = $data['login'];
		if(!empty($data['password'])){
			$admin->password = $data['password'];
		}

		if(!empty($data['access_level'])){
			$admin->access_level = $data['access_level'];
		}
		$adminLogged = Agenda::getAdmin();
		if($adminLogged->id != $id){
			$admin->active = $data['active'];
		}

		try{
			$admin->save();
		}catch(Exception $e){
			return ApiUtils::response(true, $e->getMessage(),null);
		}

		return ApiUtils::response(false,__('messages.edit_admin'),$admin);

	}

	/**
	 * Método utilizado para remover administradores
	 * @param  int $id id do adminstrador
	 * @return json     
	 */
	public function  remove($id){

		$adminCount = Admin::count();

		if($adminCount == 1){
			return ApiUtils::response(true,__('messages.admin_unique'),null);
		}

		//busca admin
		$admin = Admin::find($id);

		if(!$admin instanceof Admin){
			return ApiUtils::response(true,__('messages.admin_invalid'),null);
		}
		try{
			$admin->admin_tokens()->delete();
			$admin->delete();

		}catch(Exception $e){
			return ApiUtils::response(true,$e->getMessage(),null);
		}

		return ApiUtils::response(false,__('messages.remove_admin'),null);
	}

	/**
	 * Método utilizado para listar a home do adminstrador
	 * @return [type] [description]
	 */
	public function overview(){
		$list['count_user'] = User::count();
		$list['total_phone'] = UserPhone::whereHas('user',function($q){
											$q->where('deleted_at',null);
										})
										->count();

		$list['one_phone'] = $this->queryUser(1);
		$list['two_phone'] = $this->queryUser(2);
		$list['three_phone'] = $this->queryUser(3);
		return ApiUtils::response(false,__('messages.overview'),$list);
									
	}

	/**
	 * Método que retorna query com quantos telefones tem os contatos
	 * @param  [type] $number [description]
	 * @return [type]         [description]
	 */
	private function queryUser($number){
		$collection = DB::table('user')->select('user.id')
									->join('user_phone',function($q){
										$q->on('user.id','=','user_phone.user_id');
										$q->where('user_phone.deleted_at','=',null);
									})
									->where('user.deleted_at',null)
									->groupBy('user.id')
									->having(DB::raw('count(`user`.id)'),'=',$number)->get();
		return count($collection);
	}

	/**
	 * Método utilizado para validar administradores
	 * @param  request $request 
	 * @return validator          
	 */
	private function validateAdmin($request){
		$rules = [
			'name' => 'required|string|max:255',
			'password' => 'required|string|max:255|min:6',
			'login' => 'required|email|max:255',
			'active' => 'required|in:yes,no'
		];

		return Validator::make($request->all(),$rules);
	}

	/**
	 * Método utilizado para validar administradores
	 * @param  request $request 
	 * @return validator          
	 */
	private function validateEditAdmin($request){
		$rules = [
			'name' => 'required|string|max:255',
			'password' => 'nullable|string|max:255|min:6',
			'login' => 'required|email|max:255',
			'active' => 'required|in:yes,no'
		];

		return Validator::make($request->all(),$rules);
	}
}