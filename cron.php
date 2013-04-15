<?php
include("connect.php");
$rs=mysql_query("select * from soe_newsletter where month ='".strtotime(date("m")."/01/".date('Y'))."'");
if(mysql_num_rows($rs)<=0)
	die();

$rs=mysql_query("select * from soe_newsletter_users");
while($row=mysql_fetch_array($rs))
{	
	$rs1=mysql_query("select * from soe_newsletter where month ='".strtotime(date("m")."/01/".date('Y'))."' and gender='".$row['gender']."'");
	$row1=mysql_fetch_array($rs1);
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->Subject ="ShoeBreeze Monthly Newsletter - ".$row['title'];
	$mail->Body    = $description;
	$mail->From = "quickonline.us1@gmail.com";
	$mail->FromName="ShoeBreeze.com";
	$mail->AddAddress($row['email']);
	$mail->AddBCC('quickonline.us1@gmail.com');
	$mail->AltBody ="Your mail is not supporting html format";
	$mail->IsMail();
	if(!$mail->Send())
	{
		$msg =$mail->ErrorInfo;
	}
}
					
?>