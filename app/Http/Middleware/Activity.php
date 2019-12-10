<?php
/**
 * Created by PhpStorm.
 * User: dxw
 * Date: 2019/12/10
 * Time: 12:17 PM
 */

namespace App\Http\Middleware;


class Activity
{
    public function handle($request,\Closure $next){
        if(time() < strtotime('2019-12-11')){
            return redirect('student/activity0');
        }
        $response = $next($request);
        return $response;
    }
}
