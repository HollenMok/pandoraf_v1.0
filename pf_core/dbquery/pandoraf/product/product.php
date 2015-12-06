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
	public function getGeneralInfo($products_id){
		$sql = 'select pd.products_name, p.products_id, p.products_model, pd.force_url_name, p.products_price from products as p left join products_description as pd on p.products_id = pd.products_id where p.products_id='.$products_id;
		$this->dbInstance->dbQuery($sql); 
		$result = $this->dbInstance->getAll();
		return $result;
	}
	public function getCatId($products_id){
		$sql = 'select ptc.categories_id, cd.categories_name from products_to_categories as ptc left join categories_description as cd on cd.categories_id = ptc.categories_id where ptc.products_id='.$products_id;
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getAll();
		return $result['0'];
	}
}






