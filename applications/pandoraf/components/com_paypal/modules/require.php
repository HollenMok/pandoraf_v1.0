<?php 
//加载Paypal API(不要修改为include,会导致class重复加载)
require_once 'PayPal.php';
require_once 'PayPal/Profile/Handler/Array.php';
require_once 'PayPal/Profile/API.php';
require_once 'PayPal/CallerServices.php';
require_once 'PayPal/Type/BasicAmountType.php';
require_once 'PayPal/Type/PaymentDetailsType.php';
require_once 'PayPal/Type/PaymentDetailsItemType.php';
require_once 'PayPal/Type/shippingoptiontype.php';
require_once 'PayPal/Type/PayerInfoType.php';

require_once 'PayPal/Type/AddressType.php';
require_once 'PayPal/Type/userselectedoptiontype.php';
require_once 'PayPal/Type/ShippingDetailsType.php';
require_once 'PayPal/Type/ShippingInfoType.php';
require_once 'PayPal/Type/shippingoptiontype.php';
require_once 'PayPal/Type/TransactionType.php';
require_once 'PayPal/Type/PaymentTransactionType.php';
require_once 'PayPal/Type/PaymentInfoType.php';
require_once 'PayPal/Type/PaymentType.php';

require_once 'PayPal/Type/SetExpressCheckoutRequestType.php';
require_once 'PayPal/Type/SetExpressCheckoutRequestDetailsType.php';
require_once 'PayPal/Type/SetExpressCheckoutResponseType.php';
require_once 'PayPal/Type/GetExpressCheckoutDetailsRequestType.php';
require_once 'PayPal/Type/GetExpressCheckoutDetailsResponseDetailsType.php';
require_once 'PayPal/Type/GetExpressCheckoutDetailsResponseType.php';
require_once 'PayPal/Type/BillingAgreementDetailsType.php';

require_once 'PayPal/Type/DoExpressCheckoutPaymentRequestType.php';
require_once 'PayPal/Type/DoExpressCheckoutPaymentRequestDetailsType.php';
require_once 'PayPal/Type/DoExpressCheckoutPaymentResponseType.php';
require_once 'PayPal/Type/DoExpressCheckoutPaymentResponseDetailsType.php';
require_once 'PayPal/Type/GetTransactionDetailsRequestType.php';
require_once 'PayPal/Type/GetTransactionDetailsResponseType.php';

require_once 'PayPal/Type/CreateBillingAgreementRequestType.php';
require_once 'PayPal/Type/CreateBillingAgreementResponseType.php';

require_once 'PayPal/Type/DoReferenceTransactionRequestDetailsType.php';
require_once 'PayPal/Type/DoReferenceTransactionRequestType.php';
require_once 'PayPal/Type/DoReferenceTransactionResponseDetailsType.php';
require_once 'PayPal/Type/DoReferenceTransactionResponseType.php';

require_once 'PayPal/Type/BAUpdateRequestType.php';
require_once 'PayPal/Type/BAUpdateResponseDetailsType.php';
require_once 'PayPal/Type/BAUpdateResponseType.php';
?>
