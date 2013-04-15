<?php
require_once ("paypalplatform.php");
include("connect.php");




while(1)
{
srand ((double) microtime( )*1000000);
$random_number = rand(100000,999999);
$z=strlen($random_number);
$htg=mysql_query("select * from cart where ocn like '".$random_number."'");
	if(mysql_num_rows($htg)>0 and $z < 6)
		continue;
	else
	{
		$random_number=substr($random_number,0,6);
		break;
	}
}
$ocn=$random_number;
$newqr=mysql_query("select max(LEFT(RIGHT(ocn,6),5)) as mx from cart where LEFT(ocn,2)='SH' and RIGHT(ocn,1)='A'");
if(mysql_num_rows($newqr)>0)
{
	$newqrow=mysql_fetch_array($newqr);
	if($newqrow['mx']>0)
	{
	$newocn=$newqrow['mx']+1;
	$newocn='SH'.$newocn.'A';
	}
	else
	$newocn='SH10001A';
}
else	
	$newocn='SH10001A';

$ocn=$newocn;
mysql_query("update cart set ocn='".$newocn."' where sessionid='".session_id()."'") or die(mysql_error());	
  

			$tot=0;
			$maintot=0;
			$n=1;
			
			$receiverEmailArray=array();
			$receiverAmountArray=array();
			$rema=0;
			
			
          $rsh=mysql_query("select * from cart where sessionid='".session_id()."' and paid='not paid' group by advid,stoid");
          while($rshrow=mysql_fetch_array($rsh))
          {
		  	$rsadv=mysql_query("select * from soe_members where mem_id=".$rshrow['advid']);
			$rsadvrow=mysql_fetch_array($rsadv);
			
			$receiverEmailArray[$rema]=$rsadvrow['email'];
			
			 $rs2=mysql_query("select * from soe_stores where sto_id=".$rshrow['stoid']);
             $row2=mysql_fetch_array($rs2);
			
			$rs=mysql_query("select * from cart where sessionid='".session_id()."' and paid='not paid' and advid=".$rshrow['advid']." and stoid=".$rshrow['stoid']) or die(mysql_error());	
			$subtot=0;
			while($row=mysql_fetch_array($rs))
			{
				$rs1=mysql_query("select * from soe_shoe where soe_id=".$row['itemid']);
				$row1=mysql_fetch_array($rs1);

				$rs2=mysql_query("select * from soe_stores where sto_id=".$row['stoid']);
				$row2=mysql_fetch_array($rs2);
				$paypalid=$row['paypalid'];
				
				
				$rs3=mysql_query("select * from soe_brand where brn_id=".$row1['brn_id']);
				$row3=mysql_fetch_array($rs3);
				
				$tot=$row['qty']*$row['price'];
				$maintot+=$tot;
				$subtot+=$tot;
				$ocn=$row['ocn'];
				$n++;
			}	
			$receiverAmountArray[$rema]=$subtot;
			$receiverInvoiceIdArray[$rema]=($rema+1);
			$rema++;
			}	

//$receiverEmailArray[0]='quicko_1311442448_per@gmail.com';
//$receiverEmailArray[1]='defadv_1311578836_per@gmail.com';

//print_r($receiverAmountArray);

//-------------------------------------------------
// When you integrate this code
// look for TODO as an indication
// that you may need to provide a value or take action
// before executing this code
//-------------------------------------------------




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

//print_r($receiverEmailArray);
$resArray = CallPay ($actionType, $cancelUrl, $returnUrl, $currencyCode, $receiverEmailArray,
						$receiverAmountArray, $receiverPrimaryArray, $receiverInvoiceIdArray,
						$feesPayer, $ipnNotificationUrl, $memo, $pin, $preapprovalKey,
						$reverseAllParallelPaymentsOnError, $senderEmail, $trackingId
);
//print_r($resArray);

$ack = strtoupper($resArray["responseEnvelope.ack"]);
if($ack=="SUCCESS")
{
	if ("" == $preapprovalKey)
	{
		// redirect for web approval flow
		$cmd = "cmd=_ap-payment&paykey=" . urldecode($resArray["payKey"]);
		RedirectToPayPal ( $cmd );

	}
	else
	{
		// payKey is the key that you can use to identify the result from this Pay call
		$payKey = urldecode($resArray["payKey"]);
		// paymentExecStatus is the status of the payment
		$paymentExecStatus = urldecode($resArray["paymentExecStatus"]);
	}
} 
else  
{
	//Display a user friendly Error on the page using any of the following error information returned by PayPal
	//TODO - There can be more than 1 error, so check for "error(1).errorId", then "error(2).errorId", and so on until you find no more errors.
	$ErrorCode = urldecode($resArray["error(0).errorId"]);
	$ErrorMsg = urldecode($resArray["error(0).message"]);
	$ErrorDomain = urldecode($resArray["error(0).domain"]);
	$ErrorSeverity = urldecode($resArray["error(0).severity"]);
	$ErrorCategory = urldecode($resArray["error(0).category"]);
	
	echo "<br />Preapproval API call failed. ";
	echo "<br />Detailed Error Message: " . $ErrorMsg;
	echo "<br />Error Code: " . $ErrorCode;
	echo "<br />Error Severity: " . $ErrorSeverity;
	echo "<br />Error Domain: " . $ErrorDomain;
	echo "<br />Error Category: " . $ErrorCategory;
}


include("header.php"); 
?>  


<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: x-small;
	color: #FF0000;
}
-->
</style>


				
				

	
					
					<?php include("left1.php"); ?>
			

  
  <div id="content_area_mid_inner1">
  <div>
    <h2> PURCHASE OF SHOE(s)</h2>
  </div>
   
    <div class="moremarketing">
    
        <p align="center"> <img src="throbber.gif" width="100" height="100" align="absmiddle" /> <br />
           <span class="style1">Do not press 'back' or close the window until the process is complete</span></p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  

<?php include("footer.php"); ?>