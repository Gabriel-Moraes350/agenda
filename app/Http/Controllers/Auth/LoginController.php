<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminToken;
use Illuminate\Http\Request;
use App\Utils\ApiUtils;
use Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * Método que implementa o login dos administradores
     * @param  Request $request requisição
     * @return json           
     */
    public function login(Request $request){
        $validator = $this->validateLogin($request);

        if($validator->fails()){
            return ApiUtils::response(true, $validator->messages()->first(),null);
        }

        $data = $request->all();

        $admin = Admin::where('login',$data['login'])->first();

        //verifica o login
        if(!$admin instanceof Admin){
            return ApiUtils::response(true,__('messages.login_invalid'),null);
        }

        //verifica senha
        if(!password_verify($data['password'],$admin->password)){
            return ApiUtils::response(true,__('messages.login_invalid'),null);
        }

        if($admin->active == 'no'){
            return ApiUtils::response(true,__('messages.admin_inactive'),null);
        }

        //cria token para administrador
        $token = $this->refreshToken($admin);

        //se ocorreu problema ao criar o token
        if($token == null){
            return ApiUtils::response(true,__('messages.internal_error'),null);
        }

        return ApiUtils::response(false,__('messages.logged_admin'),[
                            'admin' => $admin,
                            'token' => $token
        ]);
    }

    private function validateLogin(Request $request){
        $rules = [
            'login' => 'email|required|string|max:255',
            'password' => 'string|required|min:6|max:255'
        ];

        return Validator::make($request->all(),$rules);
    }

    /**
     * Método utilizado para criar token para o administrador
     * @param  Admin  $admin 
     * @return string        token
     */
    private function refreshToken(Admin $admin){
        //deleta outros tokens
        $admin->admin_tokens()->delete();

        //cria token
        $token = md5(uniqid(rand(), true));
        //cria novo token de administrador
        $adminToken  = new AdminToken;
        $adminToken->admin_id = $admin->id;
        $adminToken->token = $token;

        try{
            $adminToken->save();
        }catch(Exception $e){
            return ApiUtils::response(true,$e->getMessage(),null);
            $token = null;
        }

        return $token;
    }
}
