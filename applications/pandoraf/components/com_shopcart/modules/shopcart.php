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
		$productList['reviewAmount'] = '962452';
		$productList['diggs'] = '962452';
		$productList['products_bulk'] = '962452';
		$productList['show_size'] = '962452';
		$productList['image_url'] = ' http://pandoraf.com/thumb/list_grid//upload/2015/08/SKU189442 (8).jpg';
		$productList['url'] = '962452';
		$productList['review_url'] = '962452';
		$productList['category_url'] = '962452';
		$productList['wishlist'] = '962452';
		
		$productList['image_cover'] = '962452';
		$productList['askquestion_url'] = '962452';
		$productList['questions_url'] = '962452';
		$productList['shareImage_url'] = '962452';
		$productList['warehouse'] = '962452';
		$productList['quantity'] = '962452';
		$productList['maximum'] = '962452';
		$productList['clearStock'] = '962452';
		$productList['price_discount'] = '962452';
		$productList['format_products_price'] = 'US$10.09';
		
		$productList['price'] = '962452';
		$productList['format_final_price'] = 'US$10.09';
		$productList['format_total_price'] = 'US$10.09';
		$productList['attributes'] = '962452';
		$productList['qty'] = '962452';
		$productList['cart_id'] = '962452';
		$productList['active'] = '962452';
		$productList['selected'] = '962452';
		$productList['attrs'] = '962452';
		$productList['weight'] = '962452';
		$productList['acce_main'] = '962452';
		
		
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
		
		
		
		return $blockList; 
	}
	public function addProduct(){
		$qty = $_POST['qty'];
		$warehouse = $_POST['warehouse'];
		$attrs = $_POST['attrs'];
		$products_id = $_POST['products_id'];
		$result = $this->shopcartQuery->addToCart($qty,$warehouse,$attrs,$products_id);
		return $result;
	}
	public function miniCart(){
		$cartProduct['count'] = "1"; 
		$cartProduct['products']['962452{379}16344{380}16218']['ocart_id'] = "962452{379}16344{380}16218";
		$cartProduct['products']['962452{379}16344{380}16218']['cart_id'] = "962452_379-16344_380-16218";
		$cartProduct['products']['962452{379}16344{380}16218']['products_id'] = "962452";
		$cartProduct['products']['962452{379}16344{380}16218']['url'] = "http://newchic.banggood.com/plus-size-dresses-3660/p-962452.html";
		$cartProduct['products']['962452{379}16344{380}16218']['image_url'] = "http://img.newchic.com/thumb/list_grid//upload/2015/08/SKU189442 (8).jpg";
		$cartProduct['products']['962452{379}16344{380}16218']['products_name'] = "Sexy Plus Size V-Neck Short Sleeve Lace Hollow Out Dress";
		$cartProduct['products']['962452{379}16344{380}16218']['products_model'] = "SKU189442";
		$cartProduct['products']['962452{379}16344{380}16218']['warehouse'] = "619";
		$cartProduct['products']['962452{379}16344{380}16218']['maximum'] = "0";
		$cartProduct['products']['962452{379}16344{380}16218']['clearStock'] = "0";
		$cartProduct['products']['962452{379}16344{380}16218']['quantity'] = "1";
		$cartProduct['products']['962452{379}16344{380}16218']['final_price'] = "10.09";
		$cartProduct['products']['962452{379}16344{380}16218']['format_final_price'] = "US$10.09";
		$cartProduct['products']['962452{379}16344{380}16218']['attrList']['0']['options_name'] = "Color";
		$cartProduct['products']['962452{379}16344{380}16218']['attrList']['0']['value_name'] = "Dark Blue";
		$cartProduct['products']['962452{379}16344{380}16218']['attrList']['1']['options_name'] = "Size";
		$cartProduct['products']['962452{379}16344{380}16218']['attrList']['1']['value_name'] = "M";
		
		$cartProduct['showCheckout'] = "1";
		$cartProduct['format_final_productTotal'] = "10.09";
		$cartProduct['productTotal'] = "US$10.09";
		return $cartProduct; 
	}
}



