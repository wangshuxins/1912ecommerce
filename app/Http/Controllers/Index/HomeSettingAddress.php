<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User_AddressModel;
use App\Model\AreaModel;
use App\Model\InfoModel;
//登录表
use App\Model\UserModel;
//使用Redis
use Illuminate\Support\Facades\Redis;
//验证码的code
use App\Model\Shop_codemodel;
use App\Http\Controllers\Index\Common As Commons;
class HomeSettingAddress extends Commons
{

	public function homesettingaddress(){//地址

			$dingji=$this->daohanglan();
			//查询当前用户的收获地址列表信息
			$user_id = $this->sessionUserId();

			$data['user_id'] = $user_id;

			$where = [
					['user_id','=',$user_id],
					['is_del','=',0]
			];
			$AddInfo = User_AddressModel::where($where)->orderBy('is_default','desc')->get();

			foreach($AddInfo as $k=>$v){

				$AddInfo[$k]['province'] = AreaModel::where('id',$v['province'])->value("name");
				$AddInfo[$k]['city'] =AreaModel::where('id',$v['city'])->value("name");
				$AddInfo[$k]['area'] = AreaModel::where('id',$v['area'])->value("name");
			}
			$provinceInfo = $this->getAreaInfo(0);
			return view('Merchandise.Index.homesettingaddress',['dingji'=>$dingji,'provinceInfo'=>$provinceInfo,'add'=>$AddInfo]);
	    }
	    public function getAreaInfo($pid){

		$where = [
				['pid','=',$pid]
		];

		return AreaModel::where($where)->get();
	}
	    public function getArea(){
		$id = Request()->input('id');
		if($id == 0){

			return view('Merchandise.Index.areaajax',['id'=>$id]);

		}
		$info = $this->getAreaInfo($id);
		$option = "<option value='0'>请选择...</option>";
		foreach($info as $k=>$v){
			$option.="<option value='".$v['id']."'>".$v['name']."</option>";
		}
		echo $option;
	}
	    public function saveaddress(){

		$data = Request()->input();


		if(empty($data['user_name'])){

			error('请填写输入姓名');

		}else if(!preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data['user_name'])){
			error('请填写中文姓名');
		}
			if(empty($data['province'])||empty($data['city'])||empty($data['area'])){

				error('请选择配送地址');

			}

		if(empty($data['tel'])){

			error("请填写联系方式");

		}else if(!preg_match("/^1[0-9]{10}$/",$data['tel'])){

			error('请填写正确的手机号码');
		}

		if(empty($data['paddress'])){

			error("请填写详细地址");

		}else if(!preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data['paddress'])){

			error('请填写中文详细地址');
		}
        //默认地址
		$user_id = $this->sessionUserId();

		$data['user_id'] = $user_id;

		if(!empty($data['is_default'])){
			$where = [
					['user_id','=',$user_id],
					['is_del','=',0]
			];
			User_AddressModel::where($where)->update(['is_default'=>1]);
		}
			$data['add_time'] = time();

        //添加入库
		$res = User_AddressModel::insert($data);
		if($res){
			success('添加成功');
		}else{
			error('添加失败');
		}
	}
        public function exit($id){
			$dingji=$this->daohanglan();
			//查询当前用户的收获地址列表信息
			$user_id = $this->sessionUserId();

			$data['user_id'] = $user_id;
			$where = [
					['user_id','=',$user_id],
				    ['id','=',$id]
			];
			$AddInfo = User_AddressModel::where($where)->first();
			//省
			$provinceInfo = $this->getAreaInfo(0);
           //市
			$cityInfo = $this->getAreaInfo($AddInfo['province']);
           //区/县
			$areaInfo = $this->getAreaInfo($AddInfo['city']);

			return view('Merchandise.Index.homesettingaddressexit',['dingji'=>$dingji,'addInfo'=>$AddInfo,'provinceInfo'=>$provinceInfo,'cityInfo'=>$cityInfo,'areaInfo'=>$areaInfo]);
	   }
	    public function exitaddress(){
			$data = Request()->input();
			if(empty($data['is_default'])){

				$data['is_default'] = 1;

			}
			if(empty($data['user_name'])){

				error('请填写输入姓名');

			}else if(!preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data['user_name'])){
				error('请填写中文姓名');
			}
			if(empty($data['province'])||empty($data['city'])||empty($data['area'])){

				error('请选择配送地址');

			}
			if(empty($data['tel'])){

				error("请填写联系方式");

			}else if(!preg_match("/^1[0-9]{10}$/",$data['tel'])){

				error('请填写正确的手机号码');
			}
			if(empty($data['paddress'])){

				error("请填写详细地址");

			}else if(!preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data['paddress'])){

				error('请填写中文详细地址');
			}
			//默认地址
			$user_id = $this->sessionUserId();
			$data['user_id'] = $user_id;
			if(($data['is_default']==2)){
				$where = [
						['user_id','=',$user_id],
						['is_del','=',0]
				];
				User_AddressModel::where($where)->update(['is_default'=>1]);
			}
			$data['add_time'] = time();
            //默认地址
			$user_id = $this->sessionUserId();

			$data['user_id'] = $user_id;

           //修改
			$where = [
					['id','=',$data['id']]
			];
			$res = User_AddressModel::where($where)->update($data);
			if($res !== false){
				success('修改成功');
			}else{
				error('修改失败');
			}
		}
	    public function del(){
			$id = Request()->id;
			$delete = User_AddressModel::where('id',$id)->update(['is_del'=>1]);
			if($delete){
				success('删除成功');
			}
	    }
	//设置默认
	public function setDefault(){

		$address_id = Request()->input('address_id');

        $status = Request()->input("status");

		$user_id = $this->sessionUserId();



		$where = [
				['user_id','=',$user_id],
				['is_del','=',0]
		];

		User_AddressModel::where($where)->update(['is_default'=>1]);

		$wheres = [

				['id','=',$address_id]

		];

		$res = User_AddressModel::where($wheres)->update(['is_default'=>$status]);

		if($res!==false){

			success('操作成功');

		}else{

			error('操作失败');
		}
	}

	public function homesettingaddresscomplete(){


		return view('Merchandise.Index.homesettingaddresscomplete');
	}

	public function homesettingaddressphone(){


		return view('Merchandise.Index.homesettingaddressphone');
	}

	public function homesettinginfo(){

		$dingji=$this->daohanglan();
			//查询当前用户的收获地址列表信息
			$user_id = $this->sessionUserId();

			$data['user_id'] = $user_id;

			$where = [
					['user_id','=',$user_id],
					['is_del','=',0]
			];
			$AddInfo = User_AddressModel::where($where)->orderBy('is_default','desc')->get();

			foreach($AddInfo as $k=>$v){

				$AddInfo[$k]['province'] = AreaModel::where('id',$v['province'])->value("name");
				$AddInfo[$k]['city'] =AreaModel::where('id',$v['city'])->value("name");
				$AddInfo[$k]['area'] = AreaModel::where('id',$v['area'])->value("name");
			}
			$provinceInfo = $this->getAreaInfo(0);
		return view('Merchandise.Index.homesettinginfo',['dingji'=>$dingji,'provinceInfo'=>$provinceInfo,'add'=>$AddInfo]);
	}
    public function saveinfo(Request $request){
		$data =$request->input();
		//dd($data);
		if(empty($data['user_name'])){

			error('请填写输入姓名');

		}else if(!preg_match("/[\x{4e00}-\x{9fa5}]+/u",$data['user_name'])){
			error('请填写中文姓名');
		}
		if(empty($data['province'])||empty($data['city'])||empty($data['area'])){

				error('请选择配送地址');

		}

		
		if(empty($data['hobby'])){

			error("请填写爱好");

		}
		$user_id = $this->sessionUserId();
		//dd($user_id);
		$data['user_id'] = $user_id;
		//dd($data['user_id']);
		

        //添加入库
		$res = InfoModel::insert($data);
		if($res){
			success('添加成功');
		}else{
			error('添加失败');
		}
		
	}
//安全管理方法
	public function homesettingsafe(){
		if(request()->isMethod("get")){
			$dingji = $this->daohanglan();
			$name = "订单";  	
			return view('Merchandise.Index.homesettingsafe',compact("name","dingji"));
		}
		if(request()->isMethod("post")){
			$user_name = request()->post("user_name");
			$password = request()->post("password");
			$name = UserModel::where("user_name",$user_name)->first();
			if(!$name){
				$data = [
					"error"=>1,
					"msg"=>"用户名或密码存复",
				];
				return json_encode($data,true);
			}
			// dd(password_verify($password,$name->user_pwd));
			if(password_verify($password,$name->user_pwd) ==true){
				$data = [
					"error"=>1,
					"msg"=>"用户名或密码存复",
				];
				return json_encode($data,true);
			}
			$user_pwd = password_hash($password,PASSWORD_DEFAULT);
			$data = [
				"error"=>0,
				"msg"=>"成功,请验证手机号",
				"data"=>[
					"user_name"=>$user_name,
					"user_tel"=>$name->user_tel,
					"user_pwd"=>$user_pwd,
				]
			];
			return json_encode($data,true);
		}
	}
	//短信验证码
	public function sends_verification_code(){
		if(request()->isMethod("get")){
			$user_name = request()->get("user_name");
			$password = request()->get("password");
			$user_tel = request()->get("user_tel");
			$code = request()->get("code");
			if(empty(Redis::get($user_tel))){
				$data = [
					"error"=>1,
					"msg"=>"请先发验证码！",
				];
				return json_encode($data,true);
			}
			$code_name = Shop_codemodel::orderBy("code_id","desc")->where("user_tel",$user_tel)->first();
			if($code_name->code !== $code){
				$data = [
					"error"=>1,
					"msg"=>"请填写正确的验证码！",
				];
				return json_encode($data,true);
			}
			//加密后的密码
			$pwd = password_hash($password,PASSWORD_DEFAULT);
			$name = [
				"user_pwd"=>$pwd,
				"add_time"=>time(),
				"error_time"=>time(),
				"is_del"=>'1',
			];
			$user_name = UserModel::where(["user_tel"=>$user_tel,"is_del"=>"1"])->update($name);
			if($user_name){
				$data = [
					"error"=>0,
					"msg"=>"修改成功",
				];
				return json_encode($data,true);
			}else{
				$data = [
					"error"=>1,
					"msg"=>"修改失败，请联系管理员！",
				];
				return json_encode($data,true);
			}
		}
		if(request()->isMethod("post")){
			$user_tel = request()->post("user_tel");
			//随机数
			$rand = mt_rand(10000,1000000);
			// 存session
			// session(["updpwd"=>$rand]);
			// 判断时间
			if(!Redis::get("$user_tel")){
				Redis::set("$user_tel","杨文龙");
				Redis::expire("$user_tel","60");
			}else{
				$seconds = Redis::ttl("$user_tel");
				$data = [
					"error"=>1,
					"msg"=>"请等验证码结束剩余".$seconds."秒",
				];
				return json_encode($data,true);
			}
			//将发送验证码
			// $name = $this->Send_verification_code($user_tel,$rand);
			$Shop_codemodel = new Shop_codemodel;
			$Shop_codemodel->code = $rand;
			$Shop_codemodel->user_tel = $user_tel;
			$Shop_codemodel->add_time = time();
			$Shop_codemodel->over_time = time()+3600;
			$name = $Shop_codemodel->save();
			if($name){
				$data = [
					"error"=>0,
					"msg"=>"成功",
				];
				return json_encode($data,true);
			}else{
				$data = [
					"error"=>1,
					"msg"=>"请联系管理员！",
				];
				return json_encode($data,true);
			}
		}
	}
}