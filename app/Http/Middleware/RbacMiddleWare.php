<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;
class RbacMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $login = session('login');
        if(!$login){
            $cookie_login = Request()->cookie('login');
            //dd($cookie_admin);
            if($cookie_login){
                //echo 'cookie';
                session(['login'=>unserialize($cookie_login)]);

            }else{
                return redirect('/admin/login');
            }
        }
       $user = DB::table('shop_admin_user')->where('user_id',$login->user_id)->first();
        if(!empty($user)){
            if($user->user_name=='王树鑫'){
                return $next($request);
            }else{
                $url=$request->path();

                $user_role=DB::table('admin_role_rbac')->where('user_id',$login->user_id)->first();
                if($user_role==null){
                    echo "<script>alert('你没有权限访问~请联系超级管理员添加权限')</script>";
                    exit;
                }else{
                    $role_id=trim($user_role->role_id,',');
                    $user_role->role_id=explode(',',$role_id);
                    $arr_poter=[];
                    foreach ($user_role->role_id as $v) {
                        $role_poter=DB::table('role_right_rbac')->where('role_id','=',$v)->get();
                        $arr_poter[]=$role_poter;
                    }
                    foreach ($arr_poter as &$vv){
                        $right_id=trim($vv[0]->right_id,',');
                        $arr_poter2[]=array_unique(explode(',',$right_id));
                    }
                    $right2=[];
                    foreach ($arr_poter2 as $vv2){
                        foreach ($vv2 as $vv3) {
                            $right=DB::table('shop_right_rbac')->where('right_id','=',$vv3)->get();
                            $right2[]=$right[0]->right_url;
                        }
                    }
                    if(in_array('/'.$url,$right2)){
                        return $next($request);
                    }else{
                        return redirect(url()->previous())->with('info','你没有此权限!');
                        exit;
                    }
                }
            }
        }
    }
}
