<?php
 function upload($filename){

	    if(request()->file($filename)->isValid()){
	    $file = request()->$filename;
	    $path = request()->$filename->store('uploads');
	    return $path;
	    }
	     return '文件上传出错';

	    }

    function CreateTree($cate,$parent_id=0,$level=0){
	//dump($parent_id);
    //dump($cate);
	if(!$cate) return;

	static $newArray = [];

	foreach($cate as $k=>$v){
	//dd($cate);
	if($v->parent_id == $parent_id){
	
	$v->level = $level;

	//dump($v);

	$newArray[] = $v;
    
    CreateTree($cate,$v->cate_id,$level+1);
	//dd($v->cate_id);
	}
	}
	return $newArray;
	}

	function Moreupload($filename){
		
		$files = request()->$filename;

		//dd($files);

		if(!count($files)){

		return;

		}
		
		foreach($files as $k=>$v){
		
		   $path[] = $v->store('uploads');
		
		}
		
		   return $path;
		
		}
    function success($error_msg){
	
	            echo json_encode(['error_no'=>0,'error_msg'=>$error_msg]);
	
	         }
    function error($error_msg){
	
	              echo json_encode(['error_no'=>1,'error_msg'=>$error_msg]);exit;
	
	         }
    function errorone($error_msg){
	              echo json_encode(['error_no'=>2,'error_msg'=>$error_msg]);exit;
	         }
	 function ajax($error_msg,$data=[]){
	              echo json_encode(['code'=>200,'msg'=>$error_msg,"data"=>$data]);exit;
	         }

    function getCateId($cateInfo,$parent_id=0){
	static $c_id = [];
	$c_id[] = $parent_id;
	foreach ($cateInfo as $k=>$v){
		if($v['parent_id']==$parent_id){
			$c_id[$v['cate_id']] = $v['cate_id'];
			getCateId($cateInfo,$v['cate_id']);
		}
	}
	return $c_id;
}








?>
