<?php
/*
 * -----------------------------
* module of shopcart component
* 购物车组件模块
* -----------------------------
* @author HollenMok
* @date 2015/09/15
*
*/
class shopcartModuleShopcart{
	
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/shopcart/shopcart.php';
		$this->shopcartQuery = new shopcartDbqueryShopcart();
	}
	
	public function display(){
		
	}
	public function addProduct(){
		$qty = $_POST['qty'];
		$warehouse = $_POST['warehouse'];
		$attrs = $_POST['attrs'];
		$products_id = $_POST['products_id'];
		$result = $this->shopcartQuery->addToCart($qty,$warehouse,$attrs,$products_id);
		return $result;
	}
	
}