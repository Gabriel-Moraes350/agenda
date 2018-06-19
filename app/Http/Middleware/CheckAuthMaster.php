<?php

namespace App\Http\Middleware;
use Closure;
use App\Models\Admin; 
use App\Models\AdminToken; 
use App\Utils\Agenda; 
use Illuminate\Http\Request;
class CheckAuthMaster
{
   public function handle($request, Closure $next)
    {

		$admin = Agenda::getAdmin();

        if($admin->access_level == 2){
            return redirect('/admin');
        }
        	
        return $next($request);
    }
}
