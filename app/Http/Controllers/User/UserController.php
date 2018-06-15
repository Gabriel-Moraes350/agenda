<?php
/**
 * Classe para lidar com os contatos da agenda
 * 
 * @author  Gabriel Moraes <[gabriel.m.baptista@gmail.com]>
 */
namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\UserPhone;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiUtils;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

define('ITEMS_USER',15);
define('USER_FOLDER','USER');

class UserController extends Controller{

	/**
	 * Método utilizado para buscar contatos
	 * @param  [string] $query string para buscar contatos
	 * @return json
	 */
	public function search($query){
		
		$list = User::where('name','like','%'. $query . '%')
					->orWhere('email','like','%'.$query.'%')
					->orWhereHas('user_phones',function($q)use($query){
						$q->where('phone','like', '%'.$query.'%');
					})
					->orWhere('address','like','%'.$query . '%')
					->with('user_phones')
					->paginate(ITEMS_USER);

		return ApiUtils::response(false,__('messages.search_user'),$list);
	}

	/**
	 * Método utilizado para listar usuários
	 * @return json
	 */
	public function list(){

		$list = User::with('user_phones')->paginate(ITEMS_USER);

		return ApiUtils::response(false,__('messages.list_user'),$list);
	}

	/**
	 * Método utilizado para inserir imagens no contato
	 * @param  Request $request requisição
	 * @param  int  $id      id do contato
	 * @return json
	 */
	public function newImage(Request $request,$id){

		$validator = $this->validateImage($request);

		if($validator->fails()){
			return ApiUtils::response(true,$validator->messages()->first(),null);
		}

		$user = User::find($id);

		if(!$user instanceof User){
			return ApiUtils::response(true,__('messages.invalid_user'),null);
		}
		$image = $request->file('picture');
		$storage = Storage::disk('public')->put(USER_FOLDER,$image);

		$user->image = $storage;

		try{
			$user->save();
		}catch(Exception $e){
			return ApiUtils::response(true,$e->getMessage(),null);
		}

		return ApiUtils::response(false,__('messages.add_image_user'),$user);
	}

	/**
	 * Método utilizado para remover imagens
	 * @param  int $id id do contato
	 * @return json
	 */
	public function removeImage($id){
		$user = User::find($id);

		if(!$user instanceof User){
			return ApiUtils::response(true,__('messages.invalid_user'),null);
		}
		
		$user->image = NULL;

		try{
			$user->save();
		}catch(Exception $e){
			return ApiUtils::response(true,$e->getMessage(),null);
		}

		return ApiUtils::response(false,__('messages.remove_image_user'),$user);
	
	}

	/**
	 * Método utilizado para criar um contato
	 * @param  Request $request requisição
	 * @return json
	 */
	public function new(Request $request){
		//chama o validator
		$validator = $this->validateUser($request);
		//verifica se passou na validação
		if($validator->fails()){
			return ApiUtils::response(true,$validator->messages()->first(),null);
		}

		//começa transação com o banco
		DB::beginTransaction();
		//pega dados do request
		$data = $request->all();
		//busca usuários já com esse nome
		$userNameExists = User::where('name',$data['name'])->first();
		//caso exista usuário
		if($userNameExists instanceof User){
			return ApiUtils::response(true,__('messages.user_exists'),null);
		}
		//cria o usuário
		$user = User::create($data);

		$numbersPhone = 0;
		$existsEqualNumber = false;
		$stringNumbers = __('messages.number_existent');
		

		//salva telefones para os contatos
		foreach($data['phone'] as $phone){
			//busca telefone igual
			$verifyPhone = UserPhone::where('phone',$phone)->first();

			if($verifyPhone instanceof UserPhone){
				if($existsEqualNumber === false){
					$stringNumbers .= $phone;
				}else{
					$stringNumbers .= ', ' . $phone;
				}
				$existsEqualNumber = true;
				continue;
			}

			$userPhone = new UserPhone;
			$userPhone->user_id = $user->id;
			$userPhone->phone = $phone;
			$numbersPhone++;
			try{
				$userPhone->save();
			}catch(Exception $e){
				DB::rollback();
				return ApiUtils::response(true,$e->getMessage(),null);
			}
		}
		//se todos os números já estavam cadastrados
		if($numbersPhone == 0){
			DB::rollback();
			return ApiUtils::response(true,__('messages.required_number'),null);
		}

		//mensagem principal
		$message = __('messages.new_user');
		//complementa mensagem caso um número não pode ser salvo
		if($existsEqualNumber){
			$message .= $stringNumbers;
		}

		DB::commit();

		return ApiUtils::response(false,$message,$user);
	}

	/**
	 * Método utilizado para editar um contato
	 * @param  Request $request [requisição]
	 * @param  [int]  $id      id do contato
	 * @return json
	 */
	public function edit(Request $request,$id){
		//chama o validator
		$validator = $this->validateUser($request);
		//verifica se passou na validação
		if($validator->fails()){
			return ApiUtils::response(true,$validator->messages()->first(),null);
		}

		//começa transação com o banco
		DB::beginTransaction();
		//pega dados do request
		$data = $request->all();
		//busca usuários já com esse nome
		$userNameExists = User::where('name',$data['name'])
							->whereNotIn('id',[$id])->first();
		//caso exista usuário
		if($userNameExists instanceof User){
			return ApiUtils::response(true,__('messages.user_exists'),null);
		}
		//edita o usuário
		$user = User::find($id);

		//senão existir o usuário
		if(!$user instanceof User){
			return ApiUtils::response(true,__('messages.invalid_user'),null);
		}

		$user->update($data);
		$user->user_phones()->delete();

		$numbersPhone = 0;
		$existsEqualNumber = false;
		$stringNumbers = __('messages.number_existent');
		

		//salva telefones para os contatos
		foreach($data['phone'] as $phone){
			//busca telefone igual
			$verifyPhone = UserPhone::where('phone',$phone)->first();

			if($verifyPhone instanceof UserPhone){
				if($existsEqualNumber === false){
					$stringNumbers .= $phone;
				}else{
					$stringNumbers .= ', ' . $phone;
				}
				$existsEqualNumber = true;
				continue;
			}

			$userPhone = new UserPhone;
			$userPhone->user_id = $user->id;
			$userPhone->phone = $phone;
			$numbersPhone++;
			try{
				$userPhone->save();
			}catch(Exception $e){
				DB::rollback();
				return ApiUtils::response(true,$e->getMessage(),null);
			}
		}
		//se todos os números já estavam cadastrados
		if($numbersPhone == 0){
			DB::rollback();
			return ApiUtils::response(true,__('messages.required_number'),null);
		}

		//mensagem principal
		$message = __('messages.edit_user');
		//complementa mensagem caso um número não pode ser salvo
		if($existsEqualNumber){
			$message .= $stringNumbers;
		}

		DB::commit();

		return ApiUtils::response(false,$message,$user);
	}

	/**
	 * Método utilizado para remover um contato
	 * @param  [int] $id id do contato
	 * @return json  
	 */
	public function remove($id){
		$user = User::find($id);

		if(!$user instanceof User){
			return ApiUtils::response(true,__('messages.invalid_user'),null);
		}

		$user->user_phones()->delete();

		try{
			$user->delete();
		}catch(Exception $e){
			return ApiUtils::response(true,$e->getMessage(),null);
		}

		return ApiUtils::response(false,__('messages.remove_user'),null);
	}

	/**
	 * Método utilizado para validar imagem
	 * @param  Request $request [description]
	 * @return json
	 */
	private function validateImage(Request $request){
		$rules = [
			'picture' => 'image|required'
		];

		return Validator::make($request->all(),$rules);
	}

	/**
	 * Método utilizado para validar o contato
	 * @param  Request $request requisição
	 * @return VALIDATOR
	 */
	private function validateUser(Request $request){
		$rules = [
			'name' => 'required|string|max:255',
			'email' => 'nullable|email|max:255',
			'address' => 'nullable|string',
			'phone' => 'array|required'

		];

		$messages = [

			'phone|required' => 'Ao menos um telefone é requirido'
		];


		return Validator::make($request->all(),$rules,$messages);
	}

}