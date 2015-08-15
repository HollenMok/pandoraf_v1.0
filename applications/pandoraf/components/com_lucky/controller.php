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
		$this->LuckyModuleLucky = new LuckyModuleLucky();
		
	}
	public function display(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$smarty = new Smarty();
		$result = $this->LuckyModuleLucky->getNewRegistrant();
		$customers_id = $result['customers_id'];
		$smarty->assign('customers_id',$customers_id);
		$smarty->display('web/display/lucky.html');exit;
	}
	/*
	 * 生成旋转角度抽奖
	* @author HollenMok
	* @date 2015/07/25
	*/
	public function lucky(){
		$result = $this->LuckyModuleLucky->lucky();
		echo json_encode($result);exit;
	}
	
	public function register(){
		$result = $this->LuckyModuleLucky->register();
		echo json_encode($result);exit;
	}
	/*
	 * @desc 退出/logout 
	 * @author HollenMok
	 * @date 2015/08/15
	 */
	public function logout(){
		$this->LuckyModuleLucky->logout();
	}
	
	
	
}