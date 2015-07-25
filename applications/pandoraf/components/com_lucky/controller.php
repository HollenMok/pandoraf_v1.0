<?php
/*
 * -----------------------------
* controller of lucky compoment
* 幸运抽奖组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/07/25
*
*/
class LuckyController{
	
	public function __construct(){
		require 'modules/lucky.php';
		$LuckyModuleLucky = new LuckymoduleLucky();
		
	}
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/display/index.html');exit;
	}
}