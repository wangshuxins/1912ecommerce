<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LoginModel;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    public function login(){
	   return view('Merchandise.Admin.login.login');
	
	}

	public function logindo(){
		$post=request()->all();
        if(empty($post['user_name'])){
			errorone('请填写用户名!');
		}
		if(empty($post['user_pwd'])){
			errorone('请填写密码!');
		}
		$login = LoginModel::where('user_name',$post['user_name'])->first();
		if(empty($login)){
			error('用户名或密码错误');
		}
		if(decrypt($login->user_pwd)!=$post['user_pwd']){
	     	error('用户名或密码错误');
		}
		if(isset($post['isremember'])){
			Cookie::queue('login',serialize($login),60*24*7);
		}
		session(['login'=>$login]);
		success('登陆成功');
	}

}
