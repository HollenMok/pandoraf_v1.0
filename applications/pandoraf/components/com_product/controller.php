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
	public $shopcartModuleShopcart;
	public $smarty;
	public function __construct(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		require 'modules/product.php';
		$this->productModuleProduct =  new productModuleProduct();
	}
	
	public function display(){		
		$this->smarty = new Smarty();
		$productInfo = $this->productModuleProduct->display();
		require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
		$this->smarty->assign('Navs',$initConfig);
		$this->smarty->assign('productInfo',$productInfo);
		$this->smarty->display('web/display/product_view.html');exit;
	}

}