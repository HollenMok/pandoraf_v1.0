<?php
/*
 * -----------------------------
 * entrance of customer component/客户管理组件入口程序
 * -----------------------------
 * @author HollenMok
 * @date 2015/09/05
 * 
 */
require 'controller.php';
$controller = new CustomerController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
