<?php
/*
 * @desc background public data list model/后台公用数据列表模型
 * @author HollenMok
 * @date 2015/09/04
 * 
 */

class modTable{
	public function __construct(){
		
	}
	public function display(){
		$this->initSqlFields();
	    //Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/table.html');exit;
	}
	
	
	public function initSqlFields(){
		
	}
}