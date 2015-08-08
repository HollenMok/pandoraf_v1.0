<?php
/*
 * -----------------------------
* module of lucky component
* 幸运组件模块
* -----------------------------
* @author HollenMok
* @date 2015/07/25
*
*/
class LuckyModuleLucky{
	public $luckyQuery;
	public function __construct(){
		require ROOT.'/pf_core/dbquery/pandoraf/lucky/lucky.php';	
		$this->luckyQuery = new luckyDbqueryLucky();		
	} 
	public function lucky(){
		$result = $this->luckyQuery->getNewRegistrant();
		return $result;
	}
}
