<?php
/*
 * -----------------------------
* controller of product component
* 产品组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/08/16
*
*/
class ProductController{
	
	public function __construct(){
	
	}
	
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/display/product_view.html');exit;
	}
}