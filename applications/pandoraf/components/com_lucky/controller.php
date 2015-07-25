<?php
/*
 * -----------------------------
* controller of lucky component
* 幸运抽奖组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/07/25
*
*/
class LuckyController{
	public $LuckyModuleLucky; 
	public function __construct(){
		require 'modules/lucky.php';
		$this->LuckyModuleLucky = new LuckymoduleLucky();
		
	}
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$smarty->display('web/display/lucky.html');exit;
	}
	/*
	 * 生成旋转角度抽奖
	* @author HollenMok
	* @date 2015/07/25
	*/
	public function lucky(){
		$result = $this->LuckyModuleLucky->lucky();
		echo $result;exit;
	}
	public function sqlTest(){
		//密码保密/password is confidential 
		$connection = mysql_connect('localhost','root','xxxxxxxxx');
		$result = mysql_db_query('pf','select * from lucky_registrant',$connection);
		$row = mysql_fetch_row($result); 
		mysql_free_result($result);
		mysql_close($connection);
		echo "<pre>";print_r($row);exit;  
	}
	
}