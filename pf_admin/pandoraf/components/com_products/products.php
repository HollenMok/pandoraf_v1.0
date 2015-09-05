<?php
/*
 * -----------------------------
 * entrance of products component/产品管理组件入口程序
 * -----------------------------
 * @author HollenMok
 * @date 2015/09/05
 * 
 */
require 'controller.php';
$controller = new ProductsController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
