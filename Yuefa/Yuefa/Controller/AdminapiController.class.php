<?php
namespace Yuefa\Controller;
use Think\Controller;
class AdminapiController extends Controller {
	public function Index()
	{
		$this->show('This is the index!');
	}
}