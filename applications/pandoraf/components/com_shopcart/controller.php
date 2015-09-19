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
	public $shopcartModuleShopcart; 
	public function __construct(){
	  require 'modules/shopcart.php';
      $this->shopcartModuleShopcart =  new shopcartModuleShopcart();
	}
	
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$itemImage = $this->shopcartModuleShopcart->display();
		$smarty->assign('itemImage',$itemImage);
		$blockList = $this->shopcartModuleShopcart->cartInfo();
		$smarty->assign('blockList',$blockList);
		$countryList = $this->shopcartModuleShopcart->getCountry();
		$smarty->assign('countryList',$countryList);
		$subtotal = 'US$10.09';
		$shiptotal = 'US$1.30';
		$grandtotal = 'US$11.39';
		$smarty->assign('subtotal',$subtotal);
		$smarty->assign('shiptotal',$shiptotal);
		$smarty->assign('grandtotal',$grandtotal);
		$smarty->display('web/display/shopcart.html');exit;
	}
	public function cartInfo(){
		$this->shopcartModuleShopcart->cartInfo();
	}
	public function addProduct(){
		$result = $this->shopcartModuleShopcart->addProduct();
		echo $result;exit; 
	}
}