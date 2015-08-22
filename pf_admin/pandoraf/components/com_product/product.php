<?php
/*
 * -----------------------------
 * entrance of product component 
 * 产品组件入口
 * -----------------------------
 * @author HollenMok
 * @date 2015/08/16
 * 
 */
require 'controller.php';
$controller = new ProductController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
