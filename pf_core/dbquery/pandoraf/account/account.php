<?php
/**
 * --------------------------------------------------------------------------
 * account  query class 
 * account 用户中心查询处理类
 * --------------------------------------------------------------------------
 * @author HollenMok
 * @date 2016-03-16
 */
class accountDbqueryAccount{
	
	public $dbInstance;
	
	public function __construct(){
		
		$this->dbInstance = pFactory::dbInstance();
		
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
	
	
	public function isEmailExist($email){
		$sql = 'select * from customers where customers_email_address='."'$email'";
		$this->dbInstance->dbQuery($sql);
		$row = $this->dbInstance->getRow();
		return $row;
	}
	public function isCustomerExist($email,$password){
		$sql = 'select * from customers where customers_email_address='."'$email'".' and customers_password='."'$password'";
		$this->dbInstance->dbQuery($sql);
		$row = $this->dbInstance->getRow();
		return $row;
	}

}






