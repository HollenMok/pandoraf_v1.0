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
		
	}
	
	public function display(){
		
	}
	public function addProduct(){
		$qty = $_POST['qty'];
		$warehouse = $_POST['warehouse'];
		$attrs = $_POST['attrs'];
		$products_id = $_POST['products_id'];
		return $warehouse;
	}
	
}