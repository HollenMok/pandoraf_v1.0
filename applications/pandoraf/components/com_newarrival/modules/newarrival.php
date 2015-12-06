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
	public $modProductlist; 
	
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		
		require ROOT.'/pf_core/dbquery/pandoraf/newarrival/newarrival.php';
		
		$this->newarrivalQuery = new newarrivalDbqueryNewarrival();
		
		require ROOT.'/applications/pandoraf/models/mod_productlist/productlist.php';
		$this->modProductlist = new modProductlist();
	}
	public function display(){
		$productIds = $this->newarrivalQuery->getResult();
		//get top 100 
		$productIds = array_slice($productIds,0,100);
		$dir = "gallery";
		$item = array();
		$productList = array();
		foreach ($productIds as $k => $pid){
			$item = $this->modProductlist->getGeneralInfo($pid, $dir, true);
			$productList[] = $item;
		}
		return $productList;
	}
}