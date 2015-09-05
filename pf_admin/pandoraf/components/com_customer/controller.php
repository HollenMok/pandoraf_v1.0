<?php
/*
 * -----------------------------
* controller of customer component
* 客户组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/09/05
*
*/
class CustomerController{
	public $CustomerModuleCustomer_table;
	public function __construct(){
		require 'modules/customer_table.php';
     	//配置用户列表模型
   	    $this->CustomerModuleCustomer_table = new CustomerModuleCustomer_table();
	}
	
	public function display(){ 
		//配置用户列表模型
		$this->CustomerModuleCustomer_table ->display();
	}
}