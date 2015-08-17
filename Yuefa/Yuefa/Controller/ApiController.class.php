<?php
namespace Yuefa\Controller;
use Think\Controller;
class ApiController extends Controller {
	public function Index()
	{
		$re_data=array(
			'Error' =>'403' ,
			'result'=>'Forbidden!'
			);
		$this->ajaxReturn($re_data,'JSON');
	}
	public function Banner(){
		$banner=M('banner')->select();
		$banner_num=M('banner')->count();
		if ($banner_num>=0&&$banner!=null)
		$re_data=array(
			'status' =>'0' ,
			'result'=>array(
				'totle' =>$banner_num ,
				'details'=>$banner
				)
			);
		else
		$re_data=array(
			'status' =>'404' ,
			'result'=>'no picture!'
			);
		$this->ajaxReturn($re_data,'JSON');
    }
    public function Style(){
		$labelid=I('get.labelid');
//		echo $labelid;		
		$page_num=I('get.page',1);
//		echo $page_num;
		$Model=new \Think\Model();
		$PAGE_LIMIT=4;
    	if ($labelid>0) {
//    		$style=M('relation_label_style')->where('fk_label = '.$labelid)->join('__STYLE__ ON __STYLE__.sid = __RELATION_LABEL_STYLE__.fk_style')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->order('yf_style.insert_time')->page(I('get.page',1).',8')->select();
//			$style_num=M('relation_label_style')->where('fk_label = '.$labelid)->join('__STYLE__ ON __STYLE__.sid = __RELATION_LABEL_STYLE__.fk_style')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->count();
			$GetInfo='call GetInfoByLabAndPage('.$labelid.','.$page_num.','.$PAGE_LIMIT.')';
    	}else{
//			$style=M('style')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->order('yf_style.insert_time')->page(I('get.page',1).',8')->select();
//			$style_num=M('style')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->count();
			$GetInfo='call GetHomeInfo('.$page_num.','.$PAGE_LIMIT.')';
    	}

		$style=$Model->query($GetInfo);
		$style_num=count($style);

		if ($style_num>=0&&$style!=null){
		for ($i=0; $i < count($style); $i++) { 
			$data_arr[]=array(
					'id' =>$style[$i]['sid'] ,
					'picurl' =>$style[$i]['pic_url'] , 
					'piclink' =>U('Index/Style').'?sid='.$style[$i]['sid'],
					'headurl' =>$style[$i]['headpic'] , 
					'headlink' =>U('Index/Barber').'?bid='.$style[$i]['bid'],
					'mastername' =>$style[$i]['name'] , 
//					'likednumber' =>M('user_like')->where('fk_sid = '.$style[$i]['sid'])->count(),
					'likednumber'=>$style[$i]['likes'],
					'page_num'=>$page_num,
					'labelid'=>$labelid
					);
		}
		$re_data=array(
			'status' =>'0' ,
			'result'=>array(
				'totle' =>$style_num ,
				'page' =>I('get.page',1) ,
				'details'=>$data_arr
				)
			);
		}else
		$re_data=array(
			'status' =>'404' ,
			'result'=>'no style!'
			);
		$this->ajaxReturn($re_data,'JSON');
    }
    public function Getuserorders(){
    	if (IS_POST&&session('uid')) {
    		$orders=M('orders')->where('fk_uid = '.session('uid'))->limit(I('get.page',1)*8)->select();
			$orders_num=M('orders')->where('fk_uid = '.session('uid'))->count();
			if ($orders_num>=0&&$orders!=null)
			$re_data=array(
				'status' =>'0' ,
				'result'=>array(
					'totle' =>$orders_num ,
					'page' =>I('get.page',1) ,
					'details'=>$orders
					)
				);
			else
			$re_data=array(
				'status' =>'404' ,
				'result'=>'no orders!'
				);
			$this->ajaxReturn($re_data,'JSON');
    	}else{
    		$this->error('未知错误！请联系管理员！');
    	}
		
    }
    public function Like()
    {
		$id=I('post.id',0);
	var_dump($id);
	var_dump(session('uid'));
    	if (session('uid')&&$id){
	    	$temp=M('user_like')->where("fk_uid = ".session('uid')." AND fk_sid =".$id)->find();
	    	if ($temp) {
	    		M('user_like')->delete($temp['ulid']);
				$data[likes]=M('style')->where('sid='.$id)->getField(likes)-1;
				M('style')->where('sid='.$id)->save($data);
	    		$re_data=array(
					'Error' =>'0' ,
					'result'=>'success',
					'method'=>'delete'
					);
				$this->ajaxReturn($re_data,'JSON');
	    	}else{
				M('user_like')->add(array(
	    			'fk_uid'=>session('uid'),
	    			'fk_sid'=>$id,
	    			'insert_ime'=>time()));
				$data[likes]=M('style')->where('sid='.$id)->getField(likes)+1;
				M('style')->where('sid='.$id)->save($data);
	    		$re_data=array(
					'Error' =>'0' ,
					'result'=>'success',
					'method'=>'add'
					);
				$this->ajaxReturn($re_data,'JSON');
			}
		}else{
			dump(session('uid'));
    		$re_data=array(
				'Error' =>'403' ,
				'result'=>'Forbidden!'
				);
			$this->ajaxReturn($re_data,'JSON');
    	}
    }
    public function Getlikes(){
    	if (session('uid')) {
    		$likes=M('user_like')->where('fk_uid ='.session('uid'))->join('__STYLE__ ON __STYLE__.sid = __USER_LIKE__.fk_sid')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->page(I('get.page',1).',8')->select();
			$likes_num=M('user_like')->where('fk_uid ='.session('uid'))->join('__STYLE__ ON __STYLE__.sid = __RELATION_LABEL_STYLE__.fk_likes')->join('__BARBER__ ON __BARBER__.bid = __STYLE__.fk_bid')->count();
			if ($likes_num>=0&&$likes!=null){
			for ($i=0; $i < count($likes); $i++) { 
				$data_arr[]=array(
						'id' =>$likes[$i]['sid'] ,
						'picurl' =>$likes[$i]['pic_url'] , 
						'piclink' =>"",
						'headurl' =>$likes[$i]['headpic'] , 
						'headlink' =>"",
						'mastername' =>$likes[$i]['name'] , 
						'likednumber' =>M('user_like')->where('fk_sid = '.$likes[$i]['sid'])->count(),
						);
			}
			$re_data=array(
				'status' =>'0' ,
				'result'=>array(
					'totle' =>$likes_num ,
					'page' =>I('get.page',1) ,
					'details'=>$data_arr
					)
				);
			}else
			$re_data=array(
				'status' =>'404' ,
				'result'=>'no likes!'
				);
		}else
		$re_data=array(
			'status' =>'403' ,
			'result'=>'Forbidden!'
			);
		$this->ajaxReturn($re_data,'JSON');
    }
}
