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
		//根据products_id查products_attributs表
		$products_id = $_GET['products_id'];
		$attributes = $this->productModuleProduct->getAttributes($products_id);

		//测试数据样例
// 		$attributes['379']['name'] = "color";
// 		$attributes['379']['values']['16224']['value_name'] = "green";
// 		$attributes['379']['values']['16224']['smallImage'] ="/applications/pandoraf/templates/imgServer/p1050328/small/p1050328(1).jpg";
// 		$attributes['379']['values']['16239']['value_name'] = "purple";
// 		$attributes['379']['values']['16239']['smallImage'] ="/applications/pandoraf/templates/imgServer/p1050328/small/p1050328(2).jpg";
// 		$attributes['379']['values']['16223']['value_name'] = "red";
// 		$attributes['379']['values']['16223']['smallImage'] ="/applications/pandoraf/templates/imgServer/p1050328/small/p1050328(3).jpg";
// 		$attributes['380']['name'] = "size";
// 		$attributes['380']['values']['16218']['value_name'] = "M";
// 		$attributes['380']['values']['16234']['value_name'] = "L";
// 	    $attributes['380']['values']['16233']['value_name'] = "XL";
// 	    $attributes['380']['values']['16235']['value_name'] = "2XL";

		$this->smarty->assign('productInfo',$productInfo);
		$this->smarty->assign('firstImage',$productInfo['firstImage']);
		$this->smarty->assign('products_id',$products_id);
		$this->smarty->assign('productInfo',$productInfo);
		$this->smarty->assign('attributes',$attributes);
		$this->smarty->display('web/display/product_view.html');exit;
	}

}