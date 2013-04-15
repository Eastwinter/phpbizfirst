<?php
include("connect.php");
$gender=mysql_real_escape_string($_POST['gender']);
$email=mysql_real_escape_string($_POST['Email']);
$zipcode=mysql_real_escape_string($_POST['ZipCode']);

if($gender=='' or $email=='' or $zipcode=='')
	echo "All Fields Required";
else
{
	$rs=mysql_query("select * from soe_newsletter_users where email like '".$email."'") or die(mysql_error());
	if(mysql_num_rows($rs)>0)
	{
		echo '<br /><br /><center><strong>You are already in the Shoe Breeze mailing list. <br /> <br />We look forward to keeping you informed.<br /><br /></strong></center>';	
	}
	else
	{
	echo '<br /><br /><center><strong>Thank you for joining the Shoe Breeze mailing list. <br /> <br />We look forward to keeping you informed.<br /><br /></strong></center>';
	mysql_query("insert into soe_newsletter_users set gender='".$gender."',email='".$email."',zipcode='".$zipcode."'") or die(mysql_error());
	}
}
?>