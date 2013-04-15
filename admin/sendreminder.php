<?php 
include('../connect.php'); 
include_once "../class.phpmailer.php";
$sql="select * from soe_membership where memshipid='".$_GET['memshipid']."'";
$rs=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($rs);



$rs1=mysql_query("select * from soe_members where mem_id=".$row['mem_id']) or die(mysql_error()."----1");		
$row1=mysql_fetch_array($rs1);

$rs2=mysql_query("select * from soe_packages where packageid=".$row['packageid']) or die(mysql_error()."----2");		
$row2=mysql_fetch_array($rs2);
mysql_query("delete from temp_membership where memshipid=".$_GET['memshipid']) or die(mysql_error());	


			$mailcontent='
			<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
		<head>
			<title>Home</title>
			<meta name="description" content="Home | ShoeBreeze.com" />
		
			<meta name="keywords" content="Home | ShoeBreeze.com" />
			<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
			<meta name="generator" content="shoe.com" />
			<link rel="stylesheet" href="http://www.innogenius.com/shoebreeze/style2.css" type="text/css" />
			<link rel="stylesheet" href="http://www.innogenius.com/shoebreeze/style.css" type="text/css" />
<style>
	body{
		padding:0px;
		margin:0px;
		font-size:14px;
		color: #4F4F4F;
		background:#FFFFFF;
		background-image:none;		
		font-family:Verdana,Tahoma,Arial,sans-serif;
		color:#5B2F5F;
	}
</style>
		
			
		
		</head>
			<body>
				
				<div class="mainbody">
					<div class="content" style="background-color:#E0D6E1">
						<div class="space_top">&nbsp;</div>		 
		<div class="divider_h">&nbsp;</div>
		<div class="mid_body">
		  <div class="mid_body">
		
			<p>Dear '.$row1['first_name'].',</p>
			<p><br />
			This is to remind you that your Default Subscription is getting expired in '.$_GET['days'].' Days.<br>
			You can anytime go to Purchase Lot section of your account on site and switch the packge.<br />
			Hope you enjoyed the experience on our site and will continue to be with us.<br />
<br />

			 
			 

			</p>
			<p>
			</p>
			<p>
			  <br />
			  Thanks,<br>
			  Shoesite Team.			  
			</p>
		  </div>
		  </div>
					</div>
					<div class="footer"><br class="clear"/>		
							Copyright &copy; ShoeBreeze.com All rights reserved.
				  </div>				
						
			</div>			
				</div>
		
				
				<!-- footer -->
				
			</body>
		</html>				
						
					
			';
			
					$mail = new PHPMailer();
					$mail->IsHTML(true);
					$mail->Subject ="ShoeBreeze - REMINDER !";
					$mail->Body    = $mailcontent;
					$mail->From = "quickonline.us1@gmail.com";
					$mail->FromName="Shoe Site";
					$mail->AddAddress($row1['email']);
					$mail->AddBCC('quickonline.us1@gmail.com');
		
		
					$mail->AltBody ="Your mail is not supporting html format";
					$mail->IsMail();
					if(!$mail->Send())
					{
						$msg =$mail->ErrorInfo;
					}
					else
					$msg="Verification Code Sent! Please check your email for further instructions";
?>
<script>
alert('Reminder Sent Successfully!');
location.href='storesremadv.php';
</script>