<?php
/*
 * -----------------------------
* controller of shopcart component
* 购物车组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/09/06
*
*/
class ShopcartController{
	
	public function __construct(){

	}
	
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/display/shopcart.html');exit;
	}
}