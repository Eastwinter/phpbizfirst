<?php
include("connect.php");
$storechoice=mysql_real_escape_string($_POST['storechoice']);
$email=mysql_real_escape_string($_POST['Email']);
$url=mysql_real_escape_string($_POST['url']);

if($storechoice=='paypal')
	$rs=mysql_query("update soe_stores set paypalid='".$email."',paypalurl='".$storechoice."',onlinestore='".intval($_POST['onlinestore'])."' where sto_id=".intval($_POST['storeid'])) or die(mysql_error());
else
	$rs=mysql_query("update soe_stores set paypalid='".$url."',paypalurl='".$storechoice."',onlinestore='".intval($_POST['onlinestore'])."' where sto_id=".intval($_POST['storeid'])) or die(mysql_error());
	
	echo '<br /><br /><center><strong>Store Details Updated Successfully!</strong></center>';
	
?>