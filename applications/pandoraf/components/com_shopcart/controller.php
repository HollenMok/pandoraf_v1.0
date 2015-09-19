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
	public $smarty; 
	public function __construct(){
	  require 'modules/shopcart.php';
      $this->shopcartModuleShopcart =  new shopcartModuleShopcart();
      //Smarty engine/Smarty 引擎
      require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
      $this->smarty = new Smarty();
	}
	
	public function display(){
		$itemImage = $this->shopcartModuleShopcart->display();
		$this->smarty->assign('itemImage',$itemImage);
		$blockList = $this->shopcartModuleShopcart->cartInfo();
		$this->smarty->assign('blockList',$blockList);
		$this->smarty->display('web/display/shopcart.html');exit;
	}
	public function cartInfo(){
		$this->shopcartModuleShopcart->cartInfo();
	}
	public function addProduct(){
		$result = $this->shopcartModuleShopcart->addProduct();
		echo $result;exit; 
	}
	public function miniCart(){
	    $result = $this->shopcartModuleShopcart->miniCart();
	    $this->smarty->assign('cartProducts',$result['products']);
	    $this->smarty->assign('productTotal',$result['productTotal']);
	    $this->smarty->assign('format_final_productTotal',$result['format_final_productTotal']);
	    $this->smarty->assign('cartNum',$result['count']);
	    $this->smarty->assign('showCheckout', $result['showCheckout']);
	    echo $this->smarty->fetch('web/display/head/head_cart.html');
	}
}