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
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/lucky/lucky.php';
		$this->luckyQuery = new luckyDbqueryLucky();		
	} 
	
   /*
	* @desc 生成旋转角度抽奖/create angle of lucky draw
	* @author HollenMok
	* @date 2015/08/15
	*/
	public function lucky(){
		//获取设置的概率
		$prizeRate = $this->luckyQuery->getPrizeRate();
		//概率分别是5美金：88/100，10美金：5/100， 20美金：3/100，礼品1：2/100，礼品2：2/100
		$prize_arr = array(
				'0' => array('id'=>1,'min'=>1,'max'=>29,'prize'=>' $5 Bonus','v'=>$prizeRate[0]),
				'1' => array('id'=>2,'min'=>31,'max'=>89,'prize'=>' Free gift','v'=>$prizeRate[1]),
				'2' => array('id'=>3,'min'=>91,'max'=>149,'prize'=>' $10 Bonus','v'=>$prizeRate[2]),
				'3' => array('id'=>4,'min'=>151,'max'=>209,'prize'=>' $5 Bonus','v'=>$prizeRate[3]),
				'4' => array('id'=>5,'min'=>211,'max'=>269,'prize'=>' Free gift','v'=>$prizeRate[4]),
				'5' => array('id'=>6,'min'=>271,'max'=>329,'prize'=>' $20 Bonus','v'=>$prizeRate[5]),
				'6' => array('id'=>7,'min'=>331,'max'=>359,'prize'=>' $5 Bonus','v'=>$prizeRate[6])
		);
		foreach ($prize_arr as $key => $val) {
			$arr[$val['id']] = $val['v'];
		}
		//根据概率获取奖项id
		$rid = $this->getRand($arr);
		$session = pFactory::sessionInstance();
		$this->luckyRegistrant($rid);
		$this->setPrizeAvailable();
		//中奖项
		$res = $prize_arr[$rid-1];
		//中奖角度范围
		$min = $res['min'];
		$max = $res['max'];
		//随机生成一个整数角度
		$result['angle'] = mt_rand($min,$max);
		$result['prize'] = $res['prize'];
		$result['rid'] = $rid-1;
		
		return $result;
	}
   /*
	* Probability Algorithms 概率算法
	* @author HollenMok
	* @date 2015/08/15
	*/
	public function getRand($proArr) {
		$result = '';
		//概率区域大小
		$proSum = array_sum($proArr);
		//概率数组循环
		foreach ($proArr as $key => $proCur) {
			
			
			   
			//生成随机事件，根据概率区域大小来调整随机事件结果
			$randNum = mt_rand(1, $proSum);
			if ($randNum <= $proCur) {
				$result = $key;
				break;
			} else {
				//缩小概率区域
				$proSum -= $proCur;
			}
		}
		unset ($proArr);
		return $result;
	}
	public function register(){
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		//验证邮箱是否存在/check email existence
        $isEmailExist = $this->luckyQuery->isEmailExist($email);
        if(!$isEmailExist){
        	$params['date'] = time();
        	$params['ip'] = $this->getIP();
        	$result = $this->luckyQuery->register($email,$pwd,$params);
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
	
	/*
	 * @desc 更新抽奖界面客户列表/update new register list 
	 * @author HollenMok
	 * @date 2015/08/15
	 */
	public function getNewRegistrant(){ 
	  $registrant =  $this->luckyQuery->getNewRegistrant();
	  for($i=count($registrant)-1;$i>=0;$i--){
	  	//shield customers_email_address with *
	  	$shield_name = explode('@',$registrant[$i][customers_email_address]);
	  	$shiled_name[0] = substr_replace($shield_name[0],str_repeat('*',strlen($shield_name[0])-6),strlen($shield_name[0])/1.5);
	  	$result['registrants'] =$result['registrants'] ."<li> Dear ".$shiled_name[0]."@".$shield_name[1]." get a ".$registrant[$i][prize_name]."</li>";
	  }
	  $session = pFactory::sessionInstance();
	  $result['customers_id'] = $_SESSION['customers_id'];
	  if(!$result['customers_id']){
	 	 $result['customers_id']=0;
	  }
	  return $result; 
	}
	/*
	 * @desc 退出/logout
	* @author HollenMok
	* @date 2015/08/15
	*/
	public function logout(){
	  $session = pFactory::sessionInstance();
	  $_SESSION['customers_id'] = null; 
	}
   /*
    * 注册抽奖客户记录
	* @author HollenMok
	* @date 2015/08/29
	* @rid int 奖项id
	*/
	public function luckyRegistrant($rid){
		$customers_id  = $_SESSION['customers_id'];
		if(!$this->isPrizeAvailable()){
			$sql_elements = array(
					'prize_id' => $rid-1,
					'create_date'  => date("Y-m-d"),
					'customers_id' => $customers_id,
					'expire_date' => date("Y-m-d ", strtotime('+30 day'))
			);
			$this->luckyQuery->luckyRegistrant($sql_elements);
	    }	 
	}
	/*
	 * @desc 检测是否已抽奖
	 * @author HollenMok
	 * date 2015-08-29
	 */
	public function isPrizeAvailable(){
		$customers_id  = $_SESSION['customers_id'];
		if($customers_id){
			$result[0] =  $this->luckyQuery->isPrizeAvailable($customers_id);
		}
		return $result[0]?$result[0]:0;
	}
	/*
	 * @desc set drawed 
	 * @author HollenMok
	 * @date 2015-08-29
	 */
	public function setPrizeAvailable(){
		$customers_id  = $_SESSION['customers_id'];
		if($customers_id){
		  $this->luckyQuery->setPrizeAvailable($customers_id);
		}
	}
	
}
