<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Models\Admin; 
use App\Models\AdminToken; 
use App\Utils\ApiUtils; 

session_start();
class CheckApiMaster
{
   public function handle($request, Closure $next)
    {

        if(!isset($_SESSION['admin'])){
            return response(ApiUtils::response(true,__('messages.no_permission'),null),200);
        }

        $adminToken = AdminToken::where('token',$_SESSION['admin'])->first();
        if(!$adminToken instanceof AdminToken){
            return response(ApiUtils::response(true,__('messages.no_permission'),null),200);
        }

        $admin = Admin::where('id',$adminToken->admin_id)->first();
        if(!$admin instanceof Admin){
            return response(ApiUtils::response(true,__('messages.no_permission'),null),200);
        }

        if(($admin->access_level == 2 || $admin->active == 'no') && $admin->id != $request->get('id')){
            return response(ApiUtils::response(true,__('messages.no_permission'),null),200);
        }

        $request->attributes->add(['admin' => $admin]);
        return $next($request);
    }
}
