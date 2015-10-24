<?php
/*
 * -----------------------------
 * Multilingual component entrance
 * 多语言组件控制器类
 * -----------------------------
 * @author HollenMok
 * @date 2015/10/24
 * 
 */
require 'controller.php';
$controller = new MultilingualController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
