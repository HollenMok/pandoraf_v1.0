<?php
/*
 * -----------------------------
 * entrance of paypal component 
 * 支付组件入口
 * -----------------------------
 * @author HollenMok
 * @date 2016/03/03
 * 
 */
require 'controller.php';
$controller = new PaypalController();
if($task){
	$controller->$task();
}else{
	$controller->display();
}
