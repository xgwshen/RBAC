<?php 
//common 公共控制器里判断用户登录后执行
//权限过滤
$mname=CONTROLLER_NMAE;//获取控制器名
$aname=ACTION_NAME;//获取方法名
//获取权限列表
$nodelist=$_SESSION['admin_user']['nodelist'];
//让超管admin拥有所有的权限
if($_SESSION['admin_user']['username']!='admin'){
	//验证操作权限
	if(empty($nodelist[$mname]) || !in_array($aname,$nodelist[$mname])){
		$this->error('抱歉,没有操作权限!');
		exit;
	}
}

 ?>