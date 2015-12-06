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
    public $productQuery; 
	public function __construct(){
		require ROOT.'/pf_core/dbquery/pandoraf/product/product.php';
		$this->productQuery = new productDbqueryProduct();
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
		  $generalInfo = $this->productQuery->getGeneralInfo($product_id);
		  $gInfo = $generalInfo['0'];	
	    //redis 
	    //products_id	    
	    //products_model SKU
	     $pInfo['products_model'] =  $gInfo['products_model'];
	    //products_name 
	     $pInfo['products_name'] =  $gInfo['products_name'];
	    //force_url_name 产品强制url名称
	     $pInfo['force_url_name'] =  $gInfo['force_url_name'];
	    //image_list  产品全部图片地址
	     $pInfo['image_list'] =  $gInfo['image_list'];
	    //products_price 中国仓库原价（旧销售价）
	     $pInfo['products_price'] =  $gInfo['products_price'];
	    //final_price 中国仓库非购物车最终售价
	     $pInfo['final_price'] =  $gInfo['final_price'];
	    //discount 折扣
	     $pInfo['discount'] =  $gInfo['discount'];
	    //botcat 品所属最底层分类
	     $pInfo['botcat'] =  $pInfo['botcat'];
	    //categories_name
	     $pInfo['categories_name'] =  $gInfo['categories_name'];
	    //products_bulk  体积重量
	     $pInfo['products_bulk'] =  $gInfo['products_model'];
	    //show_size 国际尺码
	     $pInfo['show_size'] =  $gInfo['show_size'];
         return $pInfo;
   }

}
	






