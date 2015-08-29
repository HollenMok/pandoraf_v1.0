<?php
/*
 * -----------------------------
* module of lucky component
* 幸运组件模块
* -----------------------------
* @author HollenMok
* @date 2015/08/29
*
*/
class LuckyModuleLucky_table{
	public function __construct(){
		
	}
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/table.html');exit;
	}
	
}