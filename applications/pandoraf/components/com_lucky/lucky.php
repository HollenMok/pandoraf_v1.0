<?php
/*
 * -----------------------------
 * entrance of lucky component 
 * 幸运抽奖组件入口
 * -----------------------------
 * @author HollenMok
 * @date 2015/07/25
 * 
 */
require 'controller.php';
$controller = new LuckyController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
