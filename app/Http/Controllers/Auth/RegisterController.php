<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Utils\ApiUtils;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validator = $this->validator($request->all());

        if($validator->fails()){
            return ApiUtils::response(true,$validator->messages()->first(),null);
        }

        //busca login em outros administradores
        $adminExistsLogin = Admin::where('login',$data['login'])
                   ->first();

        if($adminExistsLogin instanceof Admin){
            return ApiUtils::response(true, __('messages.admin_exists'),null);
        }

        $admin = $this->create($request->all());

        return ApiUtils::response(false,__('messages.created_admin'),$admin);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'login' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'login' => $data['login'],
            'password' => $data['password'],
        ]);
    }
}
