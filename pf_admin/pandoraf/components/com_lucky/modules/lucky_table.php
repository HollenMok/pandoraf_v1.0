<?php
/*
 * -----------------------------
* module of lucky component
* 幸运组件模块
* -----------------------------
* @author HollenMok
* @date 2015/08/29
*
*/
require ROOT.'/pf_admin/pandoraf/models/mod_table/table.php';
class LuckyModuleLucky_table extends modTable{
	public function __construct(){
		parent::__construct();
		$this->setComPath(dirname(__FILE__)); 
		$sql = 'SELECT lr.lucky_id,c.customers_email_address,lr.create_date,lr.expire_date,lp.prize_name FROM lucky_registrant AS lr LEFT JOIN customers AS c ON lr.customers_id=c.customers_id LEFT JOIN.
				 lucky_prize AS lp ON lp.prize_id=lr.prize_id ORDER BY lucky_id DESC';
		$this->setSql($sql);
	}
	public function display(){
		parent::display();
	}
	
}