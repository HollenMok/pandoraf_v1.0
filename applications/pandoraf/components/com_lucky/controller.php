<?php
/*
 * -----------------------------
* controller of lucky component
* 幸运抽奖组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/07/25
*
*/
class LuckyController{
	public $LuckyModuleLucky; 
	public function __construct(){
		require 'modules/lucky.php';
		$this->LuckyModuleLucky = new LuckymoduleLucky();
		
	}
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/display/lucky.html');exit;
	}
	/*
	 * 生成旋转角度抽奖
	* @author HollenMok
	* @date 2015/07/25
	*/
	public function lucky(){
		$result = $this->LuckyModuleLucky->lucky();
		echo "<pre>";print_r($result);exit;
	}
	
}