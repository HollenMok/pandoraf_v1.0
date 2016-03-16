<?php
/*
 * -----------------------------
* module of account component
* 用户中心组件模块
* -----------------------------
* @author HollenMok
* @date 2016/03/16
*
*/
class accountModuleAccount{

	public $accountQuery;
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/account/account.php';
		$this->accountQuery = new accountDbqueryAccount();
	}
	/**
	 * @desc register/注册
	 * @access public
	 * @author  HollenMok
	 * @date  2016-03-16
	 * @return void
	 */
    public function register(){
		$email = $_POST['email'];
		$pwd = $_POST['password'];

		//验证邮箱是否存在/check email existence
        $isEmailExist = $this->accountQuery->isEmailExist($email);
 
        if(!$isEmailExist){
        	$params['date'] = time();
        	$params['ip'] = $this->getIP();
        	$result = $this->accountQuery->register($email,$pwd,$params);
        }
		$session = pFactory::sessionInstance();
		$_SESSION['customers_id'] = $result;
		return $result;
	}
	/*
	* @desc get visitor ip/ 获取访问者ip
	* @author HollenMok
	* @date 2015/08/29
	*/
	public function getIP(){
		if (isset($_SERVER)) {
			if (isset($_SERVER['HTTP_TRUE_CLIENT_IP'])){
				$ip = $_SERVER['HTTP_TRUE_CLIENT_IP'];
			}
			elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if (getenv('HTTP_TRUE_CLIENT_IP')) {
				$ip = getenv('HTTP_TRUE_CLIENT_IP');
			} elseif (getenv('HTTP_X_FORWARDED_FOR')) {
				$ip = getenv('HTTP_X_FORWARDED_FOR');
			} elseif (getenv('HTTP_CLIENT_IP')) {
				$ip = getenv('HTTP_CLIENT_IP');
			} else {
				$ip = getenv('REMOTE_ADDR');
			}
		}
		return $ip;
	}
}