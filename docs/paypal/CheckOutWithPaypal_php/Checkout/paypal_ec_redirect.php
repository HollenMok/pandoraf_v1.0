<?php

   require_once("paypal_functions.php");
  
   //Call to SetExpressCheckout using the shopping parameters collected from the shopping form on index.php and few from config.php 

   $returnURL = RETURN_URL;
   $cancelURL = CANCEL_URL; 
   
   if(isset($_POST["PAYMENTREQUEST_0_ITEMAMT"]))
		$_POST["L_PAYMENTREQUEST_0_AMT0"]=$_POST["PAYMENTREQUEST_0_ITEMAMT"];
  
   if(!isset($_POST['Confirm']) && isset($_POST['checkout'])){

		if($_REQUEST["checkout"] || isset($_SESSION['checkout'])) {
			$_SESSION['checkout'] = $_POST['checkout'];
		}
	$_SESSION['post_value'] = $_POST;
	
	//Assign the Return and Cancel to the Session object for ExpressCheckout Mark
	$returnURL = RETURN_URL_MARK;
	$_SESSION['post_value']['RETURN_URL'] = $returnURL;
	$_SESSION['post_value']['CANCEL_URL'] = $cancelURL;
	$_SESSION['EXPRESS_MARK'] = 'ECMark';
   include('header.php');
?>
   <div class="span4">
   </div>
   <div class="span5">
            <!--Form containing item parameters and seller credentials needed for SetExpressCheckout Call-->
            <form class="form" action="paypal_ec_mark.php" method="POST">
               <div class="row-fluid">
                  <div class="span6 inner-span">
                        <p class="lead">Shipping Address</p>
                        <table>
                        <input type="hidden" name="L_PAYMENTREQUEST_0_AMT" value="<?php echo $_POST["PAYMENTREQUEST_0_AMT"]; ?>">
                        <tr><td width="30%">First Name</td><td><input type="text" name="L_PAYMENTREQUEST_FIRSTNAME" value="Alegra"></input></td></tr>
                        <tr><td>Last Name:</td><td><input type="text" name="L_PAYMENTREQUEST_LASTNAME" value="Valava"></input></td></tr>
                        <tr><td>Address</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOSTREET" value="55 East 52nd Street"></input></td></tr>
                        <tr><td>Address 1</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOSTREET2" value="21st Floor"></input></td></tr>
                        <tr><td>City:</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOCITY" value="New York" ></input></td></tr>
                        <tr><td>State:</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOSTATE" value="NY" ></input></td></tr>
                        <tr><td>Postal Code:</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOZIP" value="10022" ></input></td></tr>
                        <tr><td>Country</td><td><select id="PAYMENTREQUEST_0_SHIPTOCOUNTRY" name="PAYMENTREQUEST_0_SHIPTOCOUNTRY">
							<option value="AF">Afghanistan</option>
							<option value="AX">Aland Islands</option>
							<option value="AL">Albania</option>
							<option value="DZ">Algeria</option>
							<option value="AS">American Samoa</option>
							<option value="AD">Andorra</option>
							<option value="AO">Angola</option>
							<option value="AI">Anguilla</option>
							<option value="AQ">Antarctica</option>
							<option value="AG">Antigua and Barbuda</option>
							<option value="AR">Argentina</option>
							<option value="AM">Armenia</option>
							<option value="AW">Aruba</option>
							<option value="AU">Australia</option>
							<option value="AT">Austria</option>
							<option value="AZ">Azerbaijan</option>
							<option value="BS">Bahamas</option>
							<option value="BH">Bahrain</option>
							<option value="BD">Bangladesh</option>
							<option value="BB">Barbados</option>
							<option value="BY">Belarus</option>
							<option value="BE">Belgium</option>
							<option value="BZ">Belize</option>
							<option value="BJ">Benin</option>
							<option value="BM">Bermuda</option>
							<option value="BT">Bhutan</option>
							<option value="BO">Bolivia</option>
							<option value="BA">Bosnia and Herzegovina</option>
							<option value="BW">Botswana</option>
							<option value="BV">Bouvet Island</option>
							<option value="BR">Brazil</option>
							<option value="IO">British Indian Ocean Territory</option>
							<option value="BN">Brunei Darussalam</option>
							<option value="BG">Bulgaria</option>
							<option value="BF">Burkina Faso</option>
							<option value="BI">Burundi</option>
							<option value="KH">Cambodia</option>
							<option value="CM">Cameroon</option>
							<option value="CA">Canada</option>
							<option value="CV">Cape Verde</option>
							<option value="KY">Cayman Islands</option>
							<option value="CF">Central African Republic</option>
							<option value="TD">Chad</option>
							<option value="CL">Chile</option>
							<option value="CN">China</option>
							<option value="CX">Christmas Island</option>
							<option value="CC">Cocos (Keeling) Islands</option>
							<option value="CO">Colombia</option>
							<option value="KM">Comoros</option>
							<option value="CG">Congo</option>
							<option value="CD">Congo, The Democratic Republic of The</option>
							<option value="CK">Cook Islands</option>
							<option value="CR">Costa Rica</option>
							<option value="CI">Cote D'ivoire</option>
							<option value="HR">Croatia</option>
							<option value="CU">Cuba</option>
							<option value="CY">Cyprus</option>
							<option value="CZ">Czech Republic</option>
							<option value="DK">Denmark</option>
							<option value="DJ">Djibouti</option>
							<option value="DM">Dominica</option>
							<option value="DO">Dominican Republic</option>
							<option value="EC">Ecuador</option>
							<option value="EG">Egypt</option>
							<option value="SV">El Salvador</option>
							<option value="GQ">Equatorial Guinea</option>
							<option value="ER">Eritrea</option>
							<option value="EE">Estonia</option>
							<option value="ET">Ethiopia</option>
							<option value="FK">Falkland Islands (Malvinas)</option>
							<option value="FO">Faroe Islands</option>
							<option value="FJ">Fiji</option>
							<option value="FI">Finland</option>
							<option value="FR">France</option>
							<option value="GF">French Guiana</option>
							<option value="PF">French Polynesia</option>
							<option value="TF">French Southern Territories</option>
							<option value="GA">Gabon</option>
							<option value="GM">Gambia</option>
							<option value="GE">Georgia</option>
							<option value="DE">Germany</option>
							<option value="GH">Ghana</option>
							<option value="GI">Gibraltar</option>
							<option value="GR">Greece</option>
							<option value="GL">Greenland</option>
							<option value="GD">Grenada</option>
							<option value="GP">Guadeloupe</option>
							<option value="GU">Guam</option>
							<option value="GT">Guatemala</option>
							<option value="GG">Guernsey</option>
							<option value="GN">Guinea</option>
							<option value="GW">Guinea-bissau</option>
							<option value="GY">Guyana</option>
							<option value="HT">Haiti</option>
							<option value="HM">Heard Island and Mcdonald Islands</option>
							<option value="VA">Holy See (Vatican City State)</option>
							<option value="HN">Honduras</option>
							<option value="HK">Hong Kong</option>
							<option value="HU">Hungary</option>
							<option value="IS">Iceland</option>
							<option value="IN">India</option>
							<option value="ID">Indonesia</option>
							<option value="IR">Iran, Islamic Republic of</option>
							<option value="IQ">Iraq</option>
							<option value="IE">Ireland</option>
							<option value="IM">Isle of Man</option>
							<option value="IL">Israel</option>
							<option value="IT">Italy</option>
							<option value="JM">Jamaica</option>
							<option value="JP">Japan</option>
							<option value="JE">Jersey</option>
							<option value="JO">Jordan</option>
							<option value="KZ">Kazakhstan</option>
							<option value="KE">Kenya</option>
							<option value="KI">Kiribati</option>
							<option value="KP">Korea, Democratic People's Republic of</option>
							<option value="KR">Korea, Republic of</option>
							<option value="KW">Kuwait</option>
							<option value="KG">Kyrgyzstan</option>
							<option value="LA">Lao People's Democratic Republic</option>
							<option value="LV">Latvia</option>
							<option value="LB">Lebanon</option>
							<option value="LS">Lesotho</option>
							<option value="LR">Liberia</option>
							<option value="LY">Libyan Arab Jamahiriya</option>
							<option value="LI">Liechtenstein</option>
							<option value="LT">Lithuania</option>
							<option value="LU">Luxembourg</option>
							<option value="MO">Macao</option>
							<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
							<option value="MG">Madagascar</option>
							<option value="MW">Malawi</option>
							<option value="MY">Malaysia</option>
							<option value="MV">Maldives</option>
							<option value="ML">Mali</option>
							<option value="MT">Malta</option>
							<option value="MH">Marshall Islands</option>
							<option value="MQ">Martinique</option>
							<option value="MR">Mauritania</option>
							<option value="MU">Mauritius</option>
							<option value="YT">Mayotte</option>
							<option value="MX">Mexico</option>
							<option value="FM">Micronesia, Federated States of</option>
							<option value="MD">Moldova, Republic of</option>
							<option value="MC">Monaco</option>
							<option value="MN">Mongolia</option>
							<option value="ME">Montenegro</option>
							<option value="MS">Montserrat</option>
							<option value="MA">Morocco</option>
							<option value="MZ">Mozambique</option>
							<option value="MM">Myanmar</option>
							<option value="NA">Namibia</option>
							<option value="NR">Nauru</option>
							<option value="NP">Nepal</option>
							<option value="NL">Netherlands</option>
							<option value="AN">Netherlands Antilles</option>
							<option value="NC">New Caledonia</option>
							<option value="NZ">New Zealand</option>
							<option value="NI">Nicaragua</option>
							<option value="NE">Niger</option>
							<option value="NG">Nigeria</option>
							<option value="NU">Niue</option>
							<option value="NF">Norfolk Island</option>
							<option value="MP">Northern Mariana Islands</option>
							<option value="NO">Norway</option>
							<option value="OM">Oman</option>
							<option value="PK">Pakistan</option>
							<option value="PW">Palau</option>
							<option value="PS">Palestinian Territory, Occupied</option>
							<option value="PA">Panama</option>
							<option value="PG">Papua New Guinea</option>
							<option value="PY">Paraguay</option>
							<option value="PE">Peru</option>
							<option value="PH">Philippines</option>
							<option value="PN">Pitcairn</option>
							<option value="PL">Poland</option>
							<option value="PT">Portugal</option>
							<option value="PR">Puerto Rico</option>
							<option value="QA">Qatar</option>
							<option value="RE">Reunion</option>
							<option value="RO">Romania</option>
							<option value="RU">Russian Federation</option>
							<option value="RW">Rwanda</option>
							<option value="SH">Saint Helena</option>
							<option value="KN">Saint Kitts and Nevis</option>
							<option value="LC">Saint Lucia</option>
							<option value="PM">Saint Pierre and Miquelon</option>
							<option value="VC">Saint Vincent and The Grenadines</option>
							<option value="WS">Samoa</option>
							<option value="SM">San Marino</option>
							<option value="ST">Sao Tome and Principe</option>
							<option value="SA">Saudi Arabia</option>
							<option value="SN">Senegal</option>
							<option value="RS">Serbia</option>
							<option value="SC">Seychelles</option>
							<option value="SL">Sierra Leone</option>
							<option value="SG">Singapore</option>
							<option value="SK">Slovakia</option>
							<option value="SI">Slovenia</option>
							<option value="SB">Solomon Islands</option>
							<option value="SO">Somalia</option>
							<option value="ZA">South Africa</option>
							<option value="GS">South Georgia and The South Sandwich Islands</option>
							<option value="ES">Spain</option>
							<option value="LK">Sri Lanka</option>
							<option value="SD">Sudan</option>
							<option value="SR">Suriname</option>
							<option value="SJ">Svalbard and Jan Mayen</option>
							<option value="SZ">Swaziland</option>
							<option value="SE">Sweden</option>
							<option value="CH">Switzerland</option>
							<option value="SY">Syrian Arab Republic</option>
							<option value="TW">Taiwan, Province of China</option>
							<option value="TJ">Tajikistan</option>
							<option value="TZ">Tanzania, United Republic of</option>
							<option value="TH">Thailand</option>
							<option value="TL">Timor-leste</option>
							<option value="TG">Togo</option>
							<option value="TK">Tokelau</option>
							<option value="TO">Tonga</option>
							<option value="TT">Trinidad and Tobago</option>
							<option value="TN">Tunisia</option>
							<option value="TR">Turkey</option>
							<option value="TM">Turkmenistan</option>
							<option value="TC">Turks and Caicos Islands</option>
							<option value="TV">Tuvalu</option>
							<option value="UG">Uganda</option>
							<option value="UA">Ukraine</option>
							<option value="AE">United Arab Emirates</option>
							<option value="GB">United Kingdom</option>
							<option value="US" selected>United States</option>
							<option value="UM">United States Minor Outlying Islands</option>
							<option value="UY">Uruguay</option>
							<option value="UZ">Uzbekistan</option>
							<option value="VU">Vanuatu</option>
							<option value="VE">Venezuela</option>
							<option value="VN">Viet Nam</option>
							<option value="VG">Virgin Islands, British</option>
							<option value="VI">Virgin Islands, U.S.</option>
							<option value="WF">Wallis and Futuna</option>
							<option value="EH">Western Sahara</option>
							<option value="YE">Yemen</option>
							<option value="ZM">Zambia</option>
							<option value="ZW">Zimbabwe</option>
							</select></td>
						</tr>
                        <tr><td>Telephone:</td><td><input type="text" name="PAYMENTREQUEST_0_SHIPTOPHONENUM" value="" maxlength="12"></input></td></tr>
						
                        <tr><td colspan="2"><p class="lead">Shipping Detail:</p></td></tr>
                        <tr><td>Shipping Type: </td><td><select name="shipping_method" id="shipping_method" style="width: 250px;" class="required-entry">
					<optgroup label="United Parcel Service" style="font-style:normal;">
					<option value="2.00">
					Worldwide Expedited - $2.00</option>
					<option value="3.00">
					Worldwide Express Saver - $3.00</option>
					</optgroup>
					<optgroup label="Flat Rate" style="font-style:normal;">
					<option value="0.00" selected>
					Fixed - $0.00</option>
					</optgroup>
					</select><br>
						</td></tr>
					<tr><td colspan="2"><p class="lead">Payment Methods:</p></td></tr>	
					<tr><td colspan="2">
						<input id="paypal_payment_option" value="paypal_express" type="radio" name="paymentMethod" title="PayPal Express Checkout" class="radio" checked>
						<img src="https://fpdbs.paypal.com/dynamicimageweb?cmd=_dynamic-image&amp;buttontype=ecmark&amp;locale=en_US" alt="Acceptance Mark" class="v-middle">&nbsp;
						<a href="https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside" onclick="javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, ,left=0, top=0, width=400, height=350'); return false;">What is PayPal?</a>
					</td></tr>
					<tr><td colspan="2"><input id="p_method_paypal_express" value="credit_card" type="radio" name="paymentMethod" title="PayPal Express Checkout" class="radio" disabled>&nbsp;Credit Card</td></tr>
					<tr><td>&nbsp;</td></tr>

                        </table>
                        <input type="submit" id="placeOrderBtn" class="btn btn-primary btn-large" name="PlaceOrder" value="Place Order" />
                  </div>
               </div>
            </form>
   </div>
   <div class="span3">
   </div>
    <script src="//www.paypalobjects.com/api/checkout.js" async></script>
      <script type="text/javascript">
      window.paypalCheckoutReady = function () {
          paypal.checkout.setup('<?php echo($merchantID); ?>', {
              button: 'placeOrderBtn',
              environment: '<?php echo($env); ?>',
              condition: function () {
                      return document.getElementById('paypal_payment_option').checked === true;
                  }
          });
      };
      </script>
   <?php
   } else {

   $resArray = CallShortcutExpressCheckout ($_POST, $returnURL, $cancelURL);
   $ack = strtoupper($resArray["ACK"]);
   if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")  //if SetExpressCheckout API call is successful
   {
		RedirectToPayPal ( $resArray["TOKEN"] );
   } 
   else  
   {
   	//Display a user friendly Error on the page using any of the following error information returned by PayPal
   	$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
   	$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
   	$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
   	$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
   	
   	echo "SetExpressCheckout API call failed. ";
   	echo "Detailed Error Message: " . $ErrorLongMsg;
   	echo "Short Error Message: " . $ErrorShortMsg;
   	echo "Error Code: " . $ErrorCode;
   	echo "Error Severity Code: " . $ErrorSeverityCode;
   }
   }
   
?>
