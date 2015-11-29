<?php 
/**
 * --------------------------------------------------------------------------
* public model for product lists
* 产品列表公用模型
* --------------------------------------------------------------------------
* @author HollenMok
* @date 2015-11-29
*/
class modProductlist{

	public function __construct(){
         echo "testing productlist";exit; 
	}

  /**
   * @desc 获取产品列表通用数据
   * @author HollenMok
   * @date 2015-11-29
   * @access public
   * @param mixed	 $product_id 	产品id(可批量获取)
   * @param string $imageDir		可以设置取哪种缩略图的地址
   * @param bool	 $parsePrice	是否格式化价格
   * @param string $lang			多语言标识
   * @return array
   */
   public function getGeneralInfo($product_id, $imageDir = null, $parsePrice = false, $lang = null){
	    //redis 
	    
   }

}
	






