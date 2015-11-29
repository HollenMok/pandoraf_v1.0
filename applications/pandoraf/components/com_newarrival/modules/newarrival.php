<?php
/*
 * -----------------------------
* module of new arrival component
* 新品组件模块
* -----------------------------
* @author HollenMok
* @date 2015/11/29
*
*/
class newarrivalModuleNewarrival{
	
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/newarrival/newarrival.php';
		$this->newarrivalQuery = new newarrivalDbqueryNewarrival();
	}
	public function display(){
		$this->newarrivalQuery->getResult();
	}
}