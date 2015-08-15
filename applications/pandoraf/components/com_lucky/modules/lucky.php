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
        	$result = $this->luckyQuery->register($email,$pwd);
        }
		$session = pFactory::sessionInstance();
		$_SESSION['customers_id'] = $result;
		return $result;
	}
	/*
	 * @desc 更新抽奖界面客户列表/update new register list 
	 * @author HollenMok
	 * @date 2015/08/15
	 */
	public function getNewRegistrant(){ 
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
      echo "success in logout";exit; 
	}
	

	
}
