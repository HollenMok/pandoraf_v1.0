<?php
/**
 * --------------------------------------------------------------------------
 * lucky draw query class 
 * lucky 抽奖查询处理类
 * --------------------------------------------------------------------------
 * @author HollenMok
 * @date 2015-07-025
 */
class luckyDbqueryLucky{
	
	public $dbInstance;
	
	public function __construct(){
		
		$this->dbInstance = pFactory::dbInstance();
		
	}
	public function getNewRegistrant(){
		 $sql = 'select * from lucky_registrant where lucky_id=2';
		 $this->dbInstance->dbQuery($sql);
		 $row = $this->dbInstance->getRow();
		 return $row;
	}
	public function register($email, $pwd, $params){
		$ip = $params['ip'];
		$sql = 'insert into customers (customers_email_address,customers_password,customers_ip_address)values('."'$email'".','."'$pwd'".','."'$ip'".')';
		$this->dbInstance->dbQuery($sql);
		$date = $params['date'];
		$sql = 'insert into register_email (customers_email_address,add_date)values('."'$email'".','."'$date'".')';
		$this->dbInstance->dbQuery($sql);
		$sql = 'select * from customers order by customers_id desc limit 1';
		$this->dbInstance->dbQuery($sql);
		$col = $this->dbInstance->getCol();
		return $col;
	}
	
	
	/*
	 * @desc get rate of every prize
	 * @author HollenMok
	 * @date 2015/08/15
	 */
	public function getPrizeRate(){
		$sql = 'select * from lucky_prize';
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getAll();
		return $result;
	}
   /*
    * @desc 更新抽奖界面客户列表/update new register list
	* @author HollenMok
	* @date 2015/08/15
	*/
	//public function getNewRegistrant(){
		
	//}
	public function isEmailExist($email){
		$sql = 'select * from customers where customers_email_address='."'$email'";
		$this->dbInstance->dbQuery($sql);
		$row = $this->dbInstance->getRow();
		return $row;
	}
	
}






