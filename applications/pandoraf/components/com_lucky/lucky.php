<?php
/*
 * -----------------------------
 * entrance of lucky compoment 
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
