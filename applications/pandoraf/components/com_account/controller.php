<?php
/*
 * -----------------------------
* account component
* 用户中心组件
* -----------------------------
* @author HollenMok
* @date 2016/03/16
*
*/
class AccountController {
	public function __construct(){
		//Smarty engine/Smarty 引擎
		require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
		$this->smarty = new Smarty();
		require 'modules/account.php';
		$this->accountModuleAccount = new accountModuleAccount();
	}
	/**
	 * @desc account homepage/用户中心首页
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-20
	 * @return void
	 */
	public function display(){
		require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
		$this->smarty->assign('Navs',$initConfig);
		$this->smarty->display('web/display/account/account.html');
	}
	/**
	 * @desc login page/登陆页面
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-16  
	 * @return void
	 */
	public function sign(){
		require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
		$this->smarty->assign('Navs',$initConfig);
	    $this->smarty->display('web/display/account/login.html');
	}
	/**
	 * @desc login /登陆
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-16
	 * @return void
	 */
	public function login(){
		$result = $this->accountModuleAccount->login();
		if($result){
			$data['code'] = true; 
			$data['result'] = $result[0];
		}else{
			$data['code'] = false;
			$data['result'] = $result;
		}
		echo json_encode($data);exit;
	}
	/**
	 * @desc register/注册
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-16
	 * @return void
	 */
	public function register(){
		$result = $this->accountModuleAccount->register();
		if($result){
			$data['code'] = true; 
			$data['result'] = $result[0];
		}else{
			$data['code'] = false;
			$data['result'] = $result;
		}
		echo json_encode($data);exit;
	}
	
	/**
	 * @desc logout/退出登陆
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-16
	 * @return void
	 */
	public function logout(){
		
	}
}
?>