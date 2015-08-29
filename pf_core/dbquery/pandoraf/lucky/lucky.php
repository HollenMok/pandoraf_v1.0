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
		$sql = 'select c.customers_email_address,lp.prize_name from lucky_registrant as lr left join customers as c on lr.customers_id=c.customers_id'.'
				left join lucky_prize as lp on lp.prize_id=lr.prize_id order by lr.lucky_id ASC ';
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getAll();
		return array_slice($result,-10,10);
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
	
	public function luckyRegistrant($sql_elements){
		$prize_id = $sql_elements['prize_id'];
		$create_date = $sql_elements['create_date'];
		$customers_id = $sql_elements['customers_id'];
		$expire_date = $sql_elements['expire_date'];
		$sql = 'insert into lucky_registrant (prize_id,create_date,customers_id,expire_date)values('."'$prize_id'".','."'$create_date'".','."'$customers_id'".','."'$expire_date'".')';
		$this->dbInstance->dbQuery($sql);
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
	public function isPrizeAvailable($customers_id){
		$sql = 'select prize_available from lucky_registrant where customers_id ='."'$customers_id'";
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getCol();
		return $result;
	}
	public function setPrizeAvailable($customers_id){
		$sql = 'update lucky_registrant set prize_available=1  where customers_id ='."'$customers_id'";
		$this->dbInstance->dbQuery($sql);
	}

}






