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
class CustomerModuleCustomer_table extends modTable{
	public function __construct(){
		parent::__construct();
		$this->setComPath(dirname(__FILE__)); 
		$sql = 'SELECT c.customers_id,c.customers_nickname,c.customers_email_address,ci.customers_info_date_account_created,'.'
				c.customers_ip_address,ci.source,ci.utm_medium,ci.utm_campaign,ci.utm_content FROM customers AS c LEFT JOIN customers_info AS ci ON c.customers_id=ci.customers_info_id';
		$this->setSql($sql);
	}
	public function display(){
		parent::display();
	}
	
}