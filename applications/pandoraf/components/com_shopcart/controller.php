<?php
/*
 * -----------------------------
* controller of shopcart component
* 购物车组件控制器
* -----------------------------
* @author HollenMok
* @date 2015/09/06
*
*/

use PayPal\CoreComponentTypes\BasicAmountType;
use PayPal\EBLBaseComponents\PaymentDetailsItemType;
use PayPal\EBLBaseComponents\PaymentDetailsType;
use PayPal\EBLBaseComponents\SetExpressCheckoutRequestDetailsType;
use PayPal\PayPalAPI\SetExpressCheckoutReq;
use PayPal\PayPalAPI\SetExpressCheckoutRequestType;
use PayPal\Service\PayPalAPIInterfaceServiceService;
use PayPal\EBLBaseComponents\DoExpressCheckoutPaymentRequestDetailsType;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentReq;
use PayPal\PayPalAPI\DoExpressCheckoutPaymentRequestType;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsReq;
use PayPal\PayPalAPI\GetExpressCheckoutDetailsRequestType;

require 'modules/PPBootStrap.php';
class ShopcartController{
	public $shopcartModuleShopcart; 
	public $smarty; 
	public function __construct(){
	  require 'modules/shopcart.php';
	  
      $this->shopcartModuleShopcart =  new shopcartModuleShopcart();
      //Smarty engine/Smarty 引擎
      require ROOT.'/pf_core/smarty/libs/Smarty.class.php';
      $this->smarty = new Smarty();
	}
	
	public function display(){
		$itemImage = $this->shopcartModuleShopcart->display();
		$this->smarty->assign('itemImage',$itemImage);
		$blockList = $this->shopcartModuleShopcart->cartInfo();
		$this->smarty->assign('blockList',$blockList);
		$this->smarty->display('web/display/shopcart.html');exit;
	}
	public function cartInfo(){
		$this->shopcartModuleShopcart->cartInfo();
	}
	public function addProduct(){
		$result = $this->shopcartModuleShopcart->addProduct();
		echo $result;exit; 
	}
	public function miniCart(){
	    $result = $this->shopcartModuleShopcart->miniCart();
	    $this->smarty->assign('cartProducts',$result['products']);
	    $this->smarty->assign('productTotal',$result['productTotal']);
	    $this->smarty->assign('format_final_productTotal',$result['format_final_productTotal']);
	    $this->smarty->assign('cartNum',$result['count']);
	    $this->smarty->assign('showCheckout', $result['showCheckout']);
	    echo $this->smarty->fetch('web/display/head/head_cart.html');
	}
	/**
	 * @desc 更新购物车产品数量
	 * @author HollenMok 2016-04-21
	 */
	public function updateQty(){
	    $result = $this->shopcartModuleShopcart->updateQty();
	    echo $result;exit;	    
	}
	/**
	 * @desc 设置paypal支付信息
	 * @author HollenMok 2016-04-30
	 */
	public function setExpressCheckout(){
	    //需要从session中取用户信息
	    $customers_id = '2016042101';
	    $productData = $this->shopcartModuleShopcart->shopcartQuery->getCartInfo($customers_id);

		$serverName = $_SERVER['SERVER_NAME'];
		$serverPort = $_SERVER['SERVER_PORT'];
		$url = dirname('http://'.$serverName.':'.$serverPort.$_SERVER['REQUEST_URI']);
		$returnUrl = $url."/index.php?com=shopcart&t=doExpressCheckout";
		$cancelUrl = $url."/index.php";
		$orderTotal = new BasicAmountType();
		$orderTotal->currencyID = USD;
		//必须为两位小数
		$orderTotal->value = round($productData[0]['final_price'],2);
		$taxTotal = new BasicAmountType();
		$taxTotal->currencyID = 'USD';
		$taxTotal->value = '0.0';
		$itemDetails = new PaymentDetailsItemType();
		$itemDetails->Name = 'Sexy Plus Size V-Neck Short Sleeve Lace Hollow Out Dress(SKU189442)';
		$itemDetails->Amount = $orderTotal;
		
		$itemDetails->Quantity = $productData[0]['customers_basket_quantity'];
		$itemDetails->ItemCategory =  'Digital';
		$PaymentDetails= new PaymentDetailsType();
		$PaymentDetails->PaymentDetailsItem[0] = $itemDetails;
		$orderTotalValue = $itemDetails->Quantity * round($productData[0]['final_price'],2);;
		$itemTotalValue = $itemDetails->Quantity * round($productData[0]['final_price'],2);;
		$currencyCode = 'USD';
		$paymentDetails->ItemTotal = new BasicAmountType($currencyCode, $itemTotalValue);
		$PaymentDetails->OrderTotal = new BasicAmountType($currencyCode, $orderTotalValue);
		//$PaymentDetails->ShipToAddress = $address;
		//$PaymentDetails->OrderTotal = $orderTotal;
		/*
		 * How you want to obtain payment. When implementing parallel payments, this field is required and must be set to Order. When implementing digital goods, this field is required and must be set to Sale
		*/
		$PaymentDetails->PaymentAction = 'Sale';
		/*
		 * Sum of cost of all items in this order. For digital goods, this field is required.
		*/
		//$PaymentDetails->ItemTotal = $orderTotal;
		//$PaymentDetails->TaxTotal = $taxTotal;
		
		$setECReqDetails = new SetExpressCheckoutRequestDetailsType();
		$setECReqDetails->BrandName = "pandoraf.com";
		$setECReqDetails->PaymentDetails[0] = $PaymentDetails;
		$setECReqDetails->CancelURL = $cancelUrl;
		$setECReqDetails->ReturnURL = $returnUrl;
		
		$setECReqDetails->ReqConfirmShipping = 0;
		
		$setECReqDetails->NoShipping = 1;
		
		$setECReqType = new SetExpressCheckoutRequestType();
		$setECReqType->SetExpressCheckoutRequestDetails = $setECReqDetails;
		
		$setECReq = new SetExpressCheckoutReq();
		$setECReq->SetExpressCheckoutRequest = $setECReqType;
		
		$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
		$setECResponse = $paypalService->SetExpressCheckout($setECReq);
		
		if($setECResponse->Ack == 'Success'){
		
			$token = $setECResponse->Token;
		
			$payPalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $token;
		    header("Location: ".$payPalURL);
		    exit();
		}
		else {
			var_dump($setECResponse);
			echo "error in SetEC API call";
		}
		
	}
	
	public function doExpressCheckout(){
		$token =urlencode( $_REQUEST['token']);
		$payerId=urlencode( $_REQUEST['PayerID']);
		$token = $_REQUEST['token'];
		$getExpressCheckoutDetailsRequest = new GetExpressCheckoutDetailsRequestType($token);
		$getExpressCheckoutReq = new GetExpressCheckoutDetailsReq();
		$getExpressCheckoutReq->GetExpressCheckoutDetailsRequest = $getExpressCheckoutDetailsRequest;
		
		$paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
		try {
			/** @var \PayPal\PayPalAPI\GetExpressCheckoutDetailsResponseType $getECResponse */
			$getECResponse = $paypalService->GetExpressCheckoutDetails($getExpressCheckoutReq);
		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
		$orderTotal = new BasicAmountType();
        $orderTotal->currencyID = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PaymentDetails[0]->OrderTotal->currencyID;
        $orderTotal->value = $getECResponse->GetExpressCheckoutDetailsResponseDetails->PaymentDetails[0]->OrderTotal->value;

       //Details about each individual item included in the order.
       $itemDetails = new PaymentDetailsItemType();
       $itemDetails->Name = 'Sexy Plus Size V-Neck Short Sleeve Lace Hollow Out Dress(SKU189442)';
       $itemDetails->Amount = $orderTotal;
       $itemDetails->Quantity = '1';
       $itemDetails->ItemCategory =  'Digital';
       
       $PaymentDetails= new PaymentDetailsType();
       $PaymentDetails->PaymentDetailsItem[0] = $itemDetails;
       
       //$PaymentDetails->ShipToAddress = $address;
       $PaymentDetails->OrderTotal = $orderTotal;
       
       /*
        * How you want to obtain payment. When implementing parallel payments, this field is required and must be set to Order. When implementing digital goods, this field is required and must be set to Sale.
       */
       $PaymentDetails->PaymentAction = 'Sale';
       
       $PaymentDetails->ItemTotal = $orderTotal;
       
       $DoECRequestDetails = new DoExpressCheckoutPaymentRequestDetailsType();
       $DoECRequestDetails->PayerID = $payerId;
       $DoECRequestDetails->Token = $token;
       $DoECRequestDetails->PaymentDetails[0] = $PaymentDetails;
       
       $DoECRequest = new DoExpressCheckoutPaymentRequestType();
       $DoECRequest->DoExpressCheckoutPaymentRequestDetails = $DoECRequestDetails;
       
       
       $DoECReq = new DoExpressCheckoutPaymentReq();
       $DoECReq->DoExpressCheckoutPaymentRequest = $DoECRequest;
       
       $paypalService = new PayPalAPIInterfaceServiceService(Configuration::getAcctAndConfig());
       $DoECResponse = $paypalService->DoExpressCheckoutPayment($DoECReq);
       //var_dump($DoECResponse);
       if($DoECResponse->Ack == 'Success'){
       	  $this->successExpressCheckout(); 
       	
       }else{
       	  echo "failed, please contact us: cservice@pandoraf.com!";exit;
       }
		
	}
	public function successExpressCheckout(){
		require ROOT.'/applications/pandoraf/models/mod_init/initConfig.php';
		$this->smarty->assign('Navs',$initConfig);
		$orderInfo = "success!";
		$this->smarty->assign('orderInfo',$orderInfo);
		$this->smarty->display('web/display/shopcart/successExpressCheckout.html');exit;
	}
	
}