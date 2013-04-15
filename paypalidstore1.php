<?php
include("connect.php");
//print_r($_POST);
//die();
$a=$_POST['storeid'];
$storechoice=mysql_real_escape_string($_POST['storechoice'.$a]);
$email=mysql_real_escape_string($_POST['Email'.$a]);
$url=mysql_real_escape_string($_POST['url'.$a]);

if($email=='' and $url=='')
{
$rs=mysql_query("update soe_stores set onlinestore='".intval($_POST['onlinestore'])."' where sto_id=".intval($_POST['storeid'])) or die(mysql_error());
}
else
{
if($storechoice=='paypal')
	$rs=mysql_query("update soe_stores set paypalid='".$email."',paypalurl='".$storechoice."',onlinestore='".intval($_POST['onlinestore'])."' where sto_id=".intval($_POST['storeid'])) or die(mysql_error());
else
	$rs=mysql_query("update soe_stores set paypalid='".$url."',paypalurl='".$storechoice."',onlinestore='".intval($_POST['onlinestore'])."' where sto_id=".intval($_POST['storeid'])) or die(mysql_error());
}
?>
<script>
location.href="mystores.php#stores";
</script>