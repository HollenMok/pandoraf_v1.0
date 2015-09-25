<?php
/*
 * -----------------------------
* module of product component
* 产品组件模块
* -----------------------------
* @author HollenMok
* @date 2015/09/25
*
*/
class productModuleProduct{
	
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/product/product.php';
		$this->productQuery = new productDbqueryProduct();
	}
	public function display(){
		$products_id = '962452';
		$productInfo['description'] = $this->productQuery->getDescription($products_id);
		return $productInfo;
	}
}
	