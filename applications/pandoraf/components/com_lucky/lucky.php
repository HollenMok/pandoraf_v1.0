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
$controller->display();