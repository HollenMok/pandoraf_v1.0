<?php
/**
 * --------------------------------------------------------------------------
 * new arrival query class 
 * new arrival 新品查询处理类
 * --------------------------------------------------------------------------
 * @author HollenMok
 * @date 2015-11-29
 */
class newarrivalDbqueryNewarrival{
	
	public $dbInstance;
	
	public function __construct(){
		
		$this->dbInstance = pFactory::dbInstance();
		
	}
	
	/**
	 * @desc new arrival查询
	 * @author HollenMok
	 * @date 2015-11-29  
	 * @access public
	 * @param int  	$cat_id		分类id
	 * @param array $params		其他查询参数
	 * @param int	$offset		查询数据起始位置
	 * @param int  	$limit		显示关键词个数
	 * @param int  	$total		可设置变量获取数据总数
	 * @return array
	 */
	public function getResult($cat_id, $params = array(), $offset = 0, $limit = 36, &$total = null){
		$sql = "SELECT DISTINCT p.products_id FROM products AS p JOIN ".
		 "products_to_categories AS pc ON pc.products_id=p.products_id LEFT JOIN products_attributes AS pa".
		 " ON pa.products_id=p.products_id WHERE p.products_status=1 AND p.clear_stock = 0 AND p.products_sale_price > 0".
		 " AND p.products_date_added > DATE_ADD(NOW(),INTERVAL -15 DAY) ORDER BY p.products_date_added DESC";
		$this->dbInstance->dbQuery($sql);
		$result = $this->dbInstance->getCol();
		echo "<pre>testingByHollenMok";print_r($result); exit; 
		return $result;
	}
}






