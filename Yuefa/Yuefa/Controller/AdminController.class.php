<?php
namespace Yuefa\Controller;
use Think\Controller;
class AdminController extends Controller {
	public function index()
	{
		session('adminuser','1');
		$this->checkroute();
		$this->display('index');
	}	
	public function barbersUpdate()
	{
		$this->checkroute();
		if (IS_POST) {
			$data=M('barber')->find(I('post.id'));
			$data['name']=I('post.name');
			$data['expert']=I('post.major');
			$data['details']=I('post.message');
			M('order_type')->where('fk_bid='.$data['bid'])->delete();
			$items=I('post.item');
			$costs=I('post.cost');
			for ($i=0; $i < count($items); $i++) { 
				$orders[]=array(
					'fk_bid'=>$data['bid'],
					'type_name'=>$items[$i],
					'cost'=>$costs[$i],
					'insert_time'=>time()
					);
			}
			$bar=M('barber')->save($data);
			$order=M('order_type')->addAll($orders);
			if($bar||$order)
				$this->success('修改成功！','barbers');
			else
				$this->error('修改失败，请重试！','barbersUpdate?id='.$data['bid']);
		}else{
		$barberinfo=M('barber')->find(I('get.id'));
		$this->assign('barberinfo',$barberinfo);
		$data=M('order_type')->where("fk_bid=".$barberinfo['bid'])->select();
		$this->assign('data',$data);
		//dump($data);
		$this->display('barbers_done');
		}
	}
	public function barbersAdd()
	{
		$this->checkroute();
		if (IS_POST) {
			$setting=C('UPLOAD_SITEIMG_QINIU');
			$Upload = new \Think\Upload($setting);
			$info = $Upload->upload($_FILES);
			$data['headpic']=$info['file']['url'];
			$data['haedpic_url']=$info['file']['url'];
			$data['openid']='openid';
			$data['name']=I('post.name');
			$data['expert']=I('post.major');
			$data['position']='没有设计填写界面';
			$data['details']=I('post.message');
			$bar=M('barber')->add($data);
			$items=I('post.item');
			$costs=I('post.cost');
			if($bar){
				for ($i=0; $i < count($items); $i++) { 
					$orders[]=array(
						'fk_bid'=>$bar,
						'type_name'=>$items[$i],
						'cost'=>$costs[$i],
						'insert_time'=>time()
						);
				}
				$order=M('order_type')->addAll($orders);
				if($order)
					$this->success('添加成功！','barbers');
				else
					$this->error('添加失败，请重试！','barbersAdd');
			}
			else
				$this->error('添加失败，请重试！','barbersAdd');
		}else{
		$this->display('barbers_add');
		}
	}
	function barberhead(){
		$this->checkroute();
		$setting=C('UPLOAD_SITEIMG_QINIU');
		$Upload = new \Think\Upload($setting);
		$info = $Upload->upload($_FILES);
		$data=M('barber')->find(I('post.id'));
		$data['headpic']=$info['file']['url'];
		$bar=M('barber')->save($data);
		if($bar)
			$this->success('修改成功！','barbers');
		else
			$this->error('修改失败，请重试！','barbersUpdate?id='.$data['bid']);
	}
	public function barbers()
	{
		$this->checkroute();
		$userinfo=M('barber')->page(I('get.p',1).',8')->select();
		$count=M('barber')->count();
		foreach ($userinfo as $key => $value) {
			$data=M('order_type')->where("fk_bid=".$value['bid'])->select();
			foreach ($data as $k=>$detail) {
			     $userinfo[$key]['table'][]=array($detail['type_name'],$detail['cost']);
			}
		}
		$this->assign("userinfo",$userinfo);
		$Page=new \Think\Page($count,8);
	    $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
	    $Page->setConfig('prev','上一页');
	    $Page->setConfig('next','下一页');
	    $Page->setConfig('last','末页');
	    $Page->setConfig('first','首页');
	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% </ul><br> %HEADER%');
		$show=$Page->show();
		$this->assign('page',$show);
		$this->display('barbers');
	}
	public function banners()
	{
		$this->checkroute();
		$bannerinfo=M('banner')->page(I('get.p',1).',8')->select();
		$this->assign("bannerinfo",$bannerinfo);
		$count=M('banner')->count();
		$Page=new \Think\Page($count,8);
	    $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
	    $Page->setConfig('prev','上一页');
	    $Page->setConfig('next','下一页');
	    $Page->setConfig('last','末页');
	    $Page->setConfig('first','首页');
	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% </ul><br> %HEADER%');
		$show=$Page->show();
		$this->assign('page',$show);
		$this->display('banners');
	}
	public function addBanners()
	{
		if (IS_POST) {
			$setting=C('UPLOAD_SITEIMG_QINIU');
			$Upload = new \Think\Upload($setting);
			$info = $Upload->upload($_FILES);
			$data=array(
				'rank' => I('post.rank'), 
				'url' => $info['file']['url'],
				'content' => '首页banner',
				'to_url' =>I('post.link'),
				'time'=>time(),
				);
			$data=M('banner')->add($data);
			if($data)
				$this->success('添加成功！','banners');
			else
				$this->error('添加失败，请重试！','addBanners');
		}else
			$this->display('banners_done');
	}
	public function updatebanner()
	{
		$this->checkroute();
		if(I('post.link')){
			$data = M('banner')->find(I('post.baid'));
			$data['to_url'] = I('post.link');
			$data = M('banner')->save($data);
			echo json_encode(array("status"=>"success"));
		}
		else{
			$setting=C('UPLOAD_SITEIMG_QINIU');
			$Upload = new \Think\Upload($setting);
			$info = $Upload->upload($_FILES);
			$data = M('banner')->find(I('post.baid'));
			$data['url'] = $info['file']['url'];
			$data = M('banner')->save($data);
			echo json_encode(array("status"=>"success"));
		}
	}
	public function labels()
	{
		$this->checkroute();
		$this->display('labels');
	}
	public function pics()
	{
		$this->checkroute();
		$this->display('pics');
	}
	public function orders()
	{
		$this->checkroute();
		$userinfo=M('orders')->page(I('get.p',1).',8')->select();
		$this->assign("userinfo",$userinfo);
		$count=M('orders')->count();
		$Page=new \Think\Page($count,8);
	    $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
	    $Page->setConfig('prev','上一页');
	    $Page->setConfig('next','下一页');
	    $Page->setConfig('last','末页');
	    $Page->setConfig('first','首页');
	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% </ul><br> %HEADER%');
		$show=$Page->show();
		$this->assign('page',$show);
		$this->display('orders');
	}
	public function users()
	{
		$this->checkroute();
		$userinfo=M('user')->page(I('get.p',1).',8')->select();
		$this->assign("userinfo",$userinfo);
		$count=M('user')->count();
		$Page=new \Think\Page($count,8);
	    $Page->setConfig('header','共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页');
	    $Page->setConfig('prev','上一页');
	    $Page->setConfig('next','下一页');
	    $Page->setConfig('last','末页');
	    $Page->setConfig('first','首页');
	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% </ul><br> %HEADER%');
		$show=$Page->show();
		$this->assign('page',$show);
		$this->display('users');
	}
	public function pics_done()
	{
		$this->checkroute();
		$this->display('pics_done');
	}
	public function login()
	{
		if(session(adminuser)){
			$this->redirect('Yuefa/Admin/index');
		}
		if (IS_POST) {
        	$verify = new \Think\Verify();
			if($verify->check(I('post.code'))){
				$this->error('验证码错误！');
			}
			$Model = M('adminuser');
			$where['usname'] = ':usname';
			$where['pswd'] = ':pswd';
			$find = $Model->where($where)->bind(':usname',I('username'))->bind(':pswd',md5(I('password')))->find();
			if ($find) {
				session('adminuser',$find['nickname']);
				session('adminid',$find['id']);
				$this->success('欢迎您，'.session('adminuser'));
			}
		}else{
			$this->display('login');
			die;
		}
	}
	public function verify()
	{
		$config =    array(
			'expire'      =>    600,
			'useCurve'    =>    false,
		    'fontSize'    =>    30,    // 验证码字体大小
		    'length'      =>    6,     // 验证码位数
		    'useNoise'    =>    true, // 关闭验证码杂点
		    'codeSet'     =>    '0123456789'
		);
		$Verify = new \Think\Verify($config);		
		$Verify->entry(1);
	}
	public function quit()
	{
		$user=session('adminuser');
		session('adminuser',null);
		session('adminid',null);
		$this->success('您已成功退出！','login');
	}
	private function checkroute()
	{
		if (!session('?adminuser'))
			$this->login();
	}
}