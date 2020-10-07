<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\Model\HistoryModel;
use Illuminate\Http\Request;
use App\Model\UserModel;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Index\Common As Commons;
use Illuminate\Support\Facades\DB;
use App\Model\CarModel;
class LoginController extends Commons
{
   public function register(){

		if(request()->isMethod("get")){

			return view("Merchandise.Index.register");
		}
		if(request()->isMethod("post")){
			$zhi=request()->zhi;

			$res=UserModel::where("user_name",$zhi)->first();
			if($res){
				return 1;//存在
			}else{
				return 2;//不存在
			}

		}

	}

	public function zhuce(){

			$pwd =request()->pwd;
			$name=request()->name;
			$code=request()->user_code;
			$tel =request()->user_tel;
			if($tel!=session()->get("code")['tel'] || $code!=session()->get("code")['code']){
			return 2;
		}
			$data=[
				"user_name"=>$name,
				"user_tel"=>$tel,
				"code"=>$code,
				"user_pwd"=>password_hash($pwd,PASSWORD_DEFAULT),
				"add_time"=>time()
			];	
			$res=UserModel::insert($data);
			if($res){
				return 1;
			}
	}
    //登录
    public function login(){

        return view("Merchandise.Index.login");
    }
    public function logindo(){
        $post=request()->all();
        $login=UserModel::where('user_name',$post['user_name'])->first();

        if(!empty($login)){
            //1.密码正确  错误用到的公共变量
            $error_num= $login['error_num'];
            $error_time= $login['error_time'];
            $time=time();
            $where=[
                ['user_id','=',$login['user_id']]
            ];
            //判断密码是否正确
            if(password_verify($post['user_pwd'],$login['user_pwd'])){
                //5.错误次数>=3此并且在1小时内  即使密码正确  也不许登录
                if($error_num>=3&&($time-$error_time)<3600){
                    $min=ceil(60-(($time-$error_time)/60));

                    error("账号锁定中，请与".$min."分钟后重试");
                }
                //4.错误次数清零  错误时间改为null
                $res=UserModel::where($where)->update(['error_num'=>0,'error_time'=>null]);
                //把账号密码存入cookie中10天
                // if($post['remember_me']){
                // 	cookie('rememberInfo',['user_pwd'=>$user_pwd,'user_name'=>$user_name],60*60*24*10);
                // }

                session(['users'=>$login]);
                //同步历史浏览记录
                $this->asyncHistory();
                //同步购物车
                $this->asyncCart();
                if(isset($post['remember_me'])){
                    Cookie::queue('remember',serialize($login),60*24*7);
                }
                success('登陆成功');
            }else{
                if($error_num>=3){
                    if(($time-$error_time)>3600){
                        //3.直接错误次数改为1  错误时间改为当前时间
                        $res=UserModel::where($where)->update(['error_num'=>1,'error_time'=>$time]);
                        error('密码输入有误，您还有2次机会');
                    }else{
                        $min=ceil(60-(($time-$error_time)/60));
                        error("账号锁定中，请与".$min."分钟后重试");
                    }
                }else{
                    //2.错误次数+1   错误时间改为当前时间
                    $num=$error_num+1;
                    $res=UserModel::where($where)->update(['error_num'=>$num,'error_time'=>$time]);
                    error('密码输入有误，您还有'.(3-$num).'次机会');
                }
            }
        }else{
            error('账号有误');
        }

    }
    public function asyncHistory(){

        $historyInfos = Cookie::get('historyInfo');

        $historyInfo = unserialize($historyInfos);

        if(!empty($historyInfo)){

            $user_id = $this->sessionUserId();

            foreach($historyInfo as $k=>$v){

                $historyInfo[$k]['user_id']=$user_id;

            }
            $history = new HistoryModel();
//			    $history->addAlll($historyInfo);
            DB::table('shop_history')->insert($historyInfo);
//			dd($history);
            Cookie::queue(Cookie::forget('historyInfo'));
        }
    }
    public function asyncCart(){

        $cartInfo = Cookie::get('cartInfo');

		 $cartInfo = unserialize($cartInfo);


        if(!empty($cartInfo)){

            $user_id = $this->sessionUserId();

            foreach($cartInfo as $k=>$v){

                $where = [

                    ['goods_id','=',$v['goods_id']],

                    ['user_id','=',$user_id],

                    ['is_del','=',1]

                ];

                $ret = CarModel::where($where)->first();

                if(empty($ret)){

                    $result = $this->checkGoodsNum($v['buy_number'],$v['goods_id']);

                    if(empty($result)){

                        error('库存量不足');

                    }

                    $v['user_id'] = $user_id;
                    DB::table('shop_cary')->insert($v);
                   

                }else{

                    $result = $this->checkGoodsNum($v['buy_number'],$v['goods_id'],$ret['buy_number']);
                  

                    $arr = [

                        'buy_number'=>$ret['buy_number']+$v['buy_number'],

                        'add_time'=>$v['add_time']


                    ];

                    $res = CarModel::where($where)->update($arr);

                    if(empty($res)){

                        success('同步购物车成功');

                    }
                }
            }
            Cookie::queue(Cookie::forget('cartInfo'));
        }
    }
    //退出登录
    public function qiut(){
        Session()->flush();
        Cookie::queue(Cookie::forget('remember'));
        return redirect('/');
    }
	public function taoqiande(){//掏钱的验证码


		$tel=request()->tel;
		$code=rand(000000,999999);
		$res=['Message'=>'NO'];// 下面的是手机验证码的
		//$res=$this->sendsms($tel,$code);//手机号  验证码  
		if ($res['Message']=='OK') {
			//session(['code'=>$code]);
			session()->put("code",['tel'=>$tel,'code'=>$code]);
			return session()->get("code")['code'];
		}
			session()->put("code",['tel'=>$tel,'code'=>$code]);
			return session()->get("code")['code'];

	}

	public function shoji(){
	$tel=	request()->tel;
		$res=UserModel::where("user_tel",$tel)->first();
		if($res){
			return 1;
		}
	}

	public function sendsms($tel,$code){
		AlibabaCloud::accessKeyClient('LTAI4FenUj7vMeELL41wDJXB', 'PpifIuqu5F8ui6Orv8y7AMwOnF0sPU')
    	                    ->regionId('cn-hangzhou')
         	               ->asDefaultClient();

		try {
    			$result = AlibabaCloud::rpc()
                 		         ->product('Dysmsapi')
                 	         // ->scheme('https') // https | http
                		         ->version('2017-05-25')
                		         ->action('SendSms')
               		             ->method('POST')
                 		         ->host('dysmsapi.aliyuncs.com')
                 		         ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'PhoneNumbers' => $tel,
                                          'SignName' => "恒恒小院",
                                          'TemplateCode' => "SMS_185230333",
                                          'TemplateParam' => "{code:$code}",
                                        ],
                                    ])
                         		 ->request();
    						return $result->toArray();
							} catch (ClientException $e) {
							    return  $e->getErrorMessage() . PHP_EOL;
							} catch (ServerException $e) {
							    return  $e->getErrorMessage() . PHP_EOL;
							}
							
		}
}