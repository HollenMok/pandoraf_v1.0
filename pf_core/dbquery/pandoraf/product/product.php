<?php
/**
 * --------------------------------------------------------------------------
 * product query class 
 * product 产品查询处理类
 * --------------------------------------------------------------------------
 * @author HollenMok
 * @date 2015-09-025
 */
class productDbqueryProduct{
	
	public $dbInstance;
	
	public function __construct(){
		
		$this->dbInstance = pFactory::dbInstance();
		
	}
	public function getDescription($products_id){
		$sql = 'select wap_description from products_description where products_id='.$products_id;
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getCol();
		return $result;
	}
}






