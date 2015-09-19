<?php
/**
 * --------------------------------------------------------------------------
 * shopcart query class 
 * 购物车查询处理类
 * --------------------------------------------------------------------------
 * @author HollenMok
 * @date 2015-09-15
 */
class shopcartDbqueryShopcart{
	
	public $dbInstance;
	
	public function __construct(){
		
		$this->dbInstance = pFactory::dbInstance();
		
	}
	public function addToCart($qty,$warehouse,$attrs,$products_id){
		$customers_basket_date_added = date('Y-m-d:h-i-s',time());
		$sql = 'insert into customers_basket (customers_id,products_id,customers_basket_quantity,customers_basket_date_added,warehouse,app_id,app_group,acce_main,selected)values('."'20150915001'".','."'$products_id'".','."'$qty'".','."'$customers_basket_date_added'".','."'$warehouse'".','."'1'".','."'2'".','."'3'".','."'4'".')';
		$this->dbInstance->dbQuery($sql);
	}
	public function getCountry(){
		$sql = 'select * from countries';
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getCol();
		return $result;
	}
}