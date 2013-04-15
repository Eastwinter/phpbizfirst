<?php

//-------------------------------------------------
// When you integrate this code
// look for TODO as an indication
// that you may need to provide a value or take action
// before executing this code
//-------------------------------------------------

require_once ("paypalplatform.php");


// ==================================
// PayPal Platform Parallel Payment Module
// ==================================

// Request specific required fields
$actionType			= "PAY";
$cancelUrl			= "http://www.innogenius.com/shoebreeze/cancelshpr.php";	// TODO - If you are not executing the Pay call for a preapproval,
												//        then you must set a valid cancelUrl for the web approval flow
												//        that immediately follows this Pay call
$returnUrl			= "http://www.innogenius.com/shoebreeze/thankyoushpr.php";	// TODO - If you are not executing the Pay call for a preapproval,
												//        then you must set a valid returnUrl for the web approval flow
												//        that immediately follows this Pay call
$currencyCode		= "USD";

// for parallel payment, no primary indicators are needed, so set empty array
$receiverPrimaryArray = array();

// TODO - Set invoiceId to uniquely identify the transaction associated with each receiver
//        set the array entries with value for receivers that you have
//		  each of the array values must be unique
// Request specific optional fields
//   Provide a value for each field that you want to include in the request, if left as an empty string the field will not be passed in the request
$senderEmail					= "";		// TODO - If you are executing the Pay call against a preapprovalKey, you should set senderEmail
											//        It is not required if the web approval flow immediately follows this Pay call
$feesPayer						= "";
$ipnNotificationUrl				= "";
$memo							= "";		// maxlength is 1000 characters
$pin							= "";		// TODO - If you are executing the Pay call against an existing preapproval
											//        the requires a pin, then you must set this
$preapprovalKey					= "";		// TODO - If you are executing the Pay call against an existing preapproval, set the preapprovalKey here
$reverseAllParallelPaymentsOnError	= "";	// TODO - Set this to "true" if you would like each parallel payment to be reversed if an error occurs
											//        defaults to "false" if you don't specify
$trackingId						= generateTrackingID();	// generateTrackingID function is found in paypalplatform.php

//-------------------------------------------------
// Make the Pay API call
//
// The CallPay function is defined in the paypalplatform.php file,
// which is included at the top of this file.
//-------------------------------------------------

?>