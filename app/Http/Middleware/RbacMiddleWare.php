<?php

namespace App\Http\Middleware;
use App\Model\AdminModel;
use Closure;
use Illuminate\Support\Facades\DB;
use App\Model\UserRoleModel;
use App\Model\RoleRightModel;
use App\Model\RightModel;
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
        $user_id = session('login')->user_id;

        $user1=AdminModel::where(['is_del'=>1,'user_id'=>$user_id])->first();

        $user2=UserRoleModel::orderBy('id','desc')->where('user_id',$user_id)->first();
        if(empty($user1)) {
            echo "<script>alert('你没有权限访问~请联系管理员添加权限');history.back(-1);</script>";
            exit;
        }
        if($user1->user_name== '王树鑫'){
            return $next($request);
        }
        if(empty($user2)){
            echo "<script>alert('你没有权限访问~请联系管理员添加权限');history.back(-1);</script>";
            exit;
        }
        $user2_arr=explode(',',trim($user2->role_id,','));
        $role_arr=RoleRightModel::whereIn('role_id',$user2_arr)->get()->toArray();
        if(empty($role_arr)){
            echo "<script>alert('你没有权限访问~请联系管理员添加权限');history.back(-1);</script>";
            exit;
        }
        $url='/'.$request->path();
        $url = preg_replace("/\\d+/",'', $url);
        foreach ($role_arr as $k=>$v) {
            $right_id=explode(',',trim($v['right_id'],','));
            asort($right_id);
            $arr=RightModel::whereIN('right_id',$right_id)->get('right_url')->toArray();
              foreach($arr as $v1){
                  $url2[]=$v1['right_url'];
              }
            if(in_array($url,$url2)){
                return $next($request);
            }else{
                echo "<script>alert('你没有权限访问~请联系管理员添加权限');history.go(-1);</script>";
                exit;
            }

        }
    }
}
