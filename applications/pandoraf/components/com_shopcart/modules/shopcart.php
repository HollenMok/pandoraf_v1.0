<?php
/*
 * -----------------------------
* module of shopcart component
* 购物车组件模块
* -----------------------------
* @author HollenMok
* @date 2015/09/15
*
*/
class shopcartModuleShopcart{
	public $shopcartQuery;
	public function __construct(){
		require ROOT.'/pf_core/factory.php';
		require ROOT.'/pf_core/dbquery/pandoraf/shopcart/shopcart.php';
		$this->shopcartQuery = new shopcartDbqueryShopcart();
	}
	
	public function display(){
		$itemImage['image_url'] = '/applications/pandoraf/templates/imgServer/p962452/medium/SKU189442 (15).jpg';
		return $itemImage;
	}
	public function cartInfo(){
		//test data 
		
		$productList['products_id'] = '962452';
		$productList['products_model'] = 'SKU189442';
		$productList['products_name'] = 'Sexy Plus Size V-Neck Short Sleeve Lace Hollow Out Dress';
		$productList['force_url_name'] = 'Sexy Women Plus Size V-neck Short Sleeves Lace Hollow Out Dress';
		$productList['image_list']['products_image'] = 'upload/2015/08/SKU189442 (8).jpg';
		$productList['image_list']['products_image_2'] = 'upload/2015/08/SKU189442_2.jpg';
		$productList['image_list']['products_image_3'] = 'upload/2015/08/SKU189442 (15).jpg';
		$productList['image_list']['products_image_4'] = 'upload/2015/08/SKU189442 (16).jpg';
		$productList['image_list']['products_image_5'] = 'upload/2015/08/SKU189442 (17).jpg';
		$productList['products_price'] = '10.09';
		$productList['final_price'] = '10.09';
		$productList['discount'] = '0';
		$productList['botCat'] = '3660';
		$productList['categories_name'] = 'Plus Size Dresses';
		
		$productList['categories_seo_url'] = 'Plus Size Dresses';
		$productList['reviewAmount']['amount'] = '0';
		$productList['reviewAmount']['score'] = '0';
		$productList['reviewAmount']['average'] = '0';
		$productList['reviewAmount']['start1'] = '0';
		$productList['reviewAmount']['start2'] = '0';
		$productList['reviewAmount']['start3'] = '0';
		$productList['reviewAmount']['start4'] = '0';
		$productList['reviewAmount']['start5'] = '0';
		$productList['reviewAmount']['averagePercent'] = '962452';
		$productList['diggs'] = '0';
		$productList['products_bulk'] = '0';
		$productList['show_size'] = '0';
		$productList['image_url'] = ' http://pandoraf.com/thumb/list_grid//upload/2015/08/SKU189442 (8).jpg';
		$productList['url'] = 'http://pandoraf.com/plus-size-dresses-3660/p-962452.html';
		$productList['review_url'] = 'http://pandoraf.com/sexy-plus-size-v-neck-short-sleeve-lace-hollow-out-dress-reviews-p962452.html';
		$productList['category_url'] = 'http://pandoraf.com/plus-size-dresses-3660/';
		$productList['wishlist'] = '0';
		
		$productList['image_cover'] = 'http://pandoraf.com/thumb/list_grid/upload/2015/08/SKU189442_2.jpg';
		$productList['askquestion_url'] = 'http://pandoraf.com/plus-size-dresses-3660/p-962452/ask.html';
		$productList['questions_url'] = 'http://pandoraf.com/plus-size-dresses-3660/p-962452/questions.html';
		$productList['shareImage_url'] = ' http://pandoraf.com/plus-size-dresses-3660/p-962452/image.html';
		$productList['warehouse'] = 'HJ';
		$productList['quantity'] = '1';
		$productList['maximum'] = '75';
		$productList['clearStock'] = '1';
		$productList['price_discount'] = 'US$0.00';
		$productList['format_products_price'] = 'US$10.09';
		
		$productList['price'] = '10.09';
		$productList['format_final_price'] = 'US$10.09';
		$productList['format_total_price'] = 'US$10.09';
		$productList['attributes']['0']['name'] = 'Color';
		$productList['attributes']['0']['value'] = 'Dark Blue';
		$productList['attributes']['1']['name'] = 'Size';
		$productList['attributes']['1']['value'] = 'M';
		$productList['qty'] = '1';
		$productList['cart_id'] = '962452_379-16344_380-16218';
		$productList['active'] = '1';
		$productList['selected'] = '1';
		$productList['attrs']['379'] = '16344';
		$productList['attrs']['380'] = '16218';
		$productList['weight'] = '0.145';
		$productList['acce_main'] = '0';
		
		
		$blockList = array();
		$blockList['619']['warehouse'] = '619';  
		$blockList['619']['warehouseName'] = 'CN_HJ';
		$blockList['619']['shipmentList']['hkairmail_hkairmail'] = 'Standard Shipping (Free shipping & 7-20 business days)';
		$blockList['619']['shipmentList']['airmail_airmail'] = 'Air Parcel Register (US$1.30 & 7-20 business days)';
		$blockList['619']['shipmentList']['pam_pam'] = 'Priority Direct Mail (US$2.48 & 6-9 business days)';
		$blockList['619']['shipmentList']['chinapost_chinapost'] = 'EMS Express Mail Service (US$16.68 & 10-15 business days)';
		$blockList['619']['shipmentList']['cndhl_cndhl'] = 'Expedited Shipping Service (US$10.68 & 3-7 business days)';
		$blockList['619']['areaList']['0']['productList']['962452{379}16344{380}16218'] = $productList;
		$blockList['619']['areaList']['0']['format_total_price'] = 'US$10.09';
		
		$blockList['619']['selected'] = '1';
		$blockList['619']['active'] = '1';
		$blockList['619']['shipmentListOrder'] = '1';
		$blockList['619']['defaultShip'] = '1';
		$blockList['619']['defaultShipName'] = '1';
		$blockList['619']['totalShipCost'] = '1';
		$blockList['619']['formatShipCost'] = '1';
		$blockList['619']['itemTotal'] = '1';
		$blockList['619']['itemTotalAmount'] = '1';
		$blockList['619']['formatItemTotalAmount'] = '1';
		$blockList['619']['orderTotal'] = '1';
		$blockList['619']['formatOrderTotal'] = '1';
		
		if($_GET['pf']){
			echo "<pre>";print_r($blockList); exit; 
		}
		
		return $blockList; 
	}
	public function getCountry(){
	    $countryList = $this->shopcartQuery->getCountry();
	    if($_GET['pfCountry']){
	    	echo "<pre>";print_r($countryList); exit; 
	    }
	    return $countryList;
	}
	public function addProduct(){
		$qty = $_POST['qty'];
		$warehouse = $_POST['warehouse'];
		$attrs = $_POST['attrs'];
		$products_id = $_POST['products_id'];
		$result = $this->shopcartQuery->addToCart($qty,$warehouse,$attrs,$products_id);
		return $result;
	}
	
}



