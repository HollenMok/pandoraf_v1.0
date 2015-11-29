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
		require ROOT.'/applications/pandoraf/models/mod_productlist/productlist.php';
		$this->modProductlist = new modProductlist();
	}
	public function display(){
		$productIds = $this->newarrivalQuery->getResult();
		$dir = "gallery";
		$item = array();
		foreach ($product_ids as $pid){
			$item = $this->modProductlist->getGeneralInfo($pid, $dir, true);
			$productList[] = $item; 
		}				
		return $productList; 
	}
}