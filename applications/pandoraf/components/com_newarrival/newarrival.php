<?php
/*
 * -----------------------------
 * entrance of new arrival component 
 * 新品组件入口
 * -----------------------------
 * @author HollenMok
 * @date 2015/11/29
 * 
 */
require 'controller.php';
$controller = new NewarrivalController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}