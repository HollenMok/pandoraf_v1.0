<?php
/*
 * -----------------------------
* controller of paypal component
* 支付组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/10/16
*
*/
class PaypalController{
	public $paypalModulePaypal; 
	public $smarty; 
	public function __construct(){
	  require 'modules/paypal.php';
      $this->paypalModulePaypal =  new paypalModulePaypal();
      //Smarty engine/Smarty 引擎
      require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
      $this->smarty = new Smarty();
	}
	public function display(){
		$itemImage = $this->paypalModulePaypal->display();
		$this->smarty->display('web/display/paypal.html');exit;
	}
	
}