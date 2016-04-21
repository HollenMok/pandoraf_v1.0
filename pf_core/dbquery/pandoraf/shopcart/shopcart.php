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
		$sql = 'insert into customers_basket (customers_id,products_id,customers_basket_quantity,customers_basket_date_added,warehouse,app_id,app_group,acce_main,selected)values('."'2016042101'".','."'$products_id'".','."'$qty'".','."'$customers_basket_date_added'".','."'$warehouse'".','."'1'".','."'2'".','."'3'".','."'4'".')';
		$this->dbInstance->dbQuery($sql);
	}
	public function updateQty($qty,$products_id){
	    $sql = 'update customers_basket set customers_basket_quantity=customers_basket_quantity+'.$qty.' where products_id='.$products_id;
	    $this->dbInstance->dbQuery($sql);
	}
	public function getCountry(){
		$sql = 'select * from countries';
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getCol();
		return $result;
	}
	/**
	 * @desc get shopcart product info/获取购物车产品信息
	 * @access public
	 * @author  HollenMok
	 * @date  2016-04-21
	 */
	public function getCartInfo($customers_id){
	    $sql = 'select * from customers_basket';
	    $this->dbInstance->dbQuery($sql);
	    $result = $this->dbInstance->getAll();
	    return $result;
	}
	/**
	 * @desc 检查产品是否已存在购物车中
	 * @access public
	 * @author  HollenMok
	 * @date  2016-04-21
	 */
	public function productsIdCheck($products_id){
	    $sql = 'select * from customers_basket where products_id='.$products_id;
	    $this->dbInstance->dbQuery($sql);
	    $result = $this->dbInstance->getAll();
	    return $result;
	}
}