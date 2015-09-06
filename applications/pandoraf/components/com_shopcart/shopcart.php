<?php
/*
 * -----------------------------
 * entrance of shopcart component 
 * 购物车组件入口
 * -----------------------------
 * @author HollenMok
 * @date 2015/09/06
 * 
 */
require 'controller.php';
$controller = new ShopcartController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
