<?php
/*
 * -----------------------------
* module of customer component
* 客户组件模块
* -----------------------------
* @author HollenMok
* @date 2015/09/05
*
*/
require ROOT.'/pf_admin/pandoraf/models/mod_table/table.php';
class ProductsModuleProducts_table extends modTable{
	public function __construct(){
		parent::__construct();
		$this->setComPath(dirname(__FILE__)); 
		$sql = 'SELECT p.products_id,p.products_model,p.products_image,pd.products_name,p.products_status'.'
				 FROM products AS p LEFT JOIN products_description AS pd ON p.products_id = pd.products_id';
		$this->setSql($sql);
	}
	public function display(){
		parent::display();
	}
	
}