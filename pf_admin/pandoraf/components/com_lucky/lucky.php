<?php
/*
 * -----------------------------
 * entrance of lucky component/Lucky抽奖管理组件入口程序
 * -----------------------------
 * @author HollenMok
 * @date 2015/08/29
 * 
 */
require 'controller.php';
$controller = new LuckyController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
