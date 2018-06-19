<?php

namespace App\Http\Middleware;
session_start();
use Closure;
use App\Models\Admin; 
use App\Models\AdminToken; 
use Illuminate\Http\Request;
class CheckAuthAdmin
{
   public function handle($request, Closure $next)
    {

    	$admin = null;
    	if(isset($_SESSION['admin'])){
    		$adminToken = AdminToken::where('token',$_SESSION['admin'])->first();
            if(!$adminToken instanceof AdminToken){
                 return redirect('/logout');
            }
    		$admin = Admin::where('id',$adminToken->admin_id)->first();
    		if(!$admin instanceof Admin){
    			$admin = null;
    		}
    	}
    	
    	if($admin != null){

            if($admin->active == 'no'){
                return redirect('/logout');
            }

    		$request->attributes->add(['admin' => $admin]);
            return $next($request);
    	}else{
            return redirect('/logout');
        }
        
    }
}
