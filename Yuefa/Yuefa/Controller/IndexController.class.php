<?php
namespace Yuefa\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function Index()
	{
		session('uid',1);
		$label=M('label')->select();
		$this->assign('label',$label);
		$banner=M('banner')->select();
		$this->assign('banner',$banner);
		$this->display('index');
	}
	public function Barber()
	{
		$this->assign('bid',I('get.bid','1'));
		$barber=M('barber')->find(I('get.bid','1'));
		$this->assign('barber',$barber);
		$books=M('order_type')->where('fk_bid = '.I('get.bid','1'))->select();
		$this->assign('books',$books);
		$styles=M('style')->where('fk_bid = '.I('get.bid','1'))->select();
		$this->assign('styles',$styles);
		$this->assign('ordernum',M('orders')->where('fk_bid = '.I('get.bid','1'))->count());
		$this->display('barber');

	}
	public function Orders()
	{
		$orders=M('orders')->where('fk_uid = '.session('uid'))->select();
		$this->assign('orders',$orders);
		//dump($orders);
		$this->display('orders');
	}
	public function Sure()
	{
		$books=M('order_type')->where('fk_bid = '.I('get.bid','1'))->select();
		$this->assign('books',$books);
		$this->assign('bid',I('get.bid','1'));
		$this->display('sure');
	}
	public function style()
	{
		$this->assign('sid',I('get.sid','1'));
		$style=M('style')->find(I('get.sid','1'));
		$this->assign('style',$style);
		$this->assign('bid',$style['fk_bid']);
		$this->assign('ordernum',M('orders')->where('fk_bid = '.$style['fk_bid'])->count());
		$barber=M('barber')->find($style['fk_bid']);
		$this->assign('barber',$barber);
		$books=M('order_type')->where('fk_bid = '.$style['fk_bid'])->select();
		$this->assign('books',$books);
		$styles=M('style')->where('fk_bid = '.$style['fk_bid'])->select();
		$this->assign('styles',$styles);
		$this->display('style');
	}
	public function home()
	{
		$this->display('home');
	}
	public function likes()
	{
		$this->display('likes');
	}
	public function insert_order()
	{
		dump(I('post.'));
	}

}