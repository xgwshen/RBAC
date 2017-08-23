<?php 
/**
 * 1.判断登录
 * 2.查询用户拥有的节点信息(权限)
 * 3.把节点信息数组nodelist存到session中
 * 4.执行每个方法前判断方法是否在nodelist数组中
 */
//public 判断登录后执行
//取该用户下的所有节点(控制器/方法)
$list=M('node')->field('mname,aname')->where('id in'.M('role_node')->field('nid')->where('rid in'.M('user_role')->field('rid')->where(array('uid'=>array('eq',$data['id'])))->buildSql())->buildSql())->select();

//控制器名转为大写
foreach ($list as $key => $value) {
	# code...
	$list[$key]['mname']=ucfirst($value['nname']);
}

//重装数组
$nodelist=array();
$nodelist['Index']=array('index');
foreach ($list as $key => $v) {
	# code...
	$nodelist[$v['mname']][]=$v['aname'];
	//把修改和执行修改 添加和执行添加 拼装到一起
	if($v['aname']=='edit'){
		$nodelist[$v['mname']][]='save';
	}
	if($v['aname']=='add'){
		$nodelist[$v['mname']][]='doadd';
	}
}

$_SESSION['admin_user']['nodelist']=$nodelist;

 ?>
