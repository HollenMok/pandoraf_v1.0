<?php
/*
 * -----------------------------
* controller of new arrival component
* 新品组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/11/29
*
*/
class NewarrivalController{
	public $newarrivalModuleNewarrival;
	public $smarty;
	public function __construct(){		
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		require 'modules/newarrival.php';
		$this->newarrivalModuleNewarrival =  new newarrivalModuleNewarrival();
	}
	
	public function display(){
		$this->smarty = new Smarty();
		$productList = $this->newarrivalModuleNewarrival->display();
		require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
		$this->smarty->assign('Navs',$initConfig);
		$this->smarty->assign('productList',$productList);
		$this->smarty->display('web/display/new_arrival.html');exit;
	}

}