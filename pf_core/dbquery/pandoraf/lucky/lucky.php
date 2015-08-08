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
		require ROOT.'/pf_core/factory.php';
		$pFactory = new pFactory();
		$this->dbInstance = pFactory::dbInstance();
		
	}
	public function getNewRegistrant(){
		 $sql = 'select * from lucky_registrant where lucky_id=2';
		 $this->dbInstance->dbQuery($sql);
		 $row = $this->dbInstance->getRow();
		 return $row;
	}
}