<?php
/*
 * -----------------------------
* controller of lucky component
* 抽奖组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/08/29
*
*/
class LuckyController{
	public $LuckyModuleLucky_table;
	public function __construct(){
		require 'modules/lucky_table.php';
     	//配置用户列表模型
   	    $this->LuckyModuleLucky_table = new LuckyModuleLucky_table();
	}
	
	public function display(){
		//配置用户列表模型
		$this->LuckyModuleLucky_table ->display();
	}
}