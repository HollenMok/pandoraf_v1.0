<?php
/*
 * -----------------------------
* controller of products component
* 产品组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/09/05
*
*/
class ProductsController{
	public $ProductsModuleProducts_table;
	public function __construct(){
		require 'modules/products_table.php';
     	//配置用户列表模型
   	    $this->ProductsModuleProducts_table = new ProductsModuleProducts_table();
	}
	
	public function display(){ 
		//配置用户列表模型
		$this->ProductsModuleProducts_table ->display();
	}
}