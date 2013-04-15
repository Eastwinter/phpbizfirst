<?php
include("connect.php");
include_once "class.phpmailer.php";


	$_POST['email']=mysql_real_escape_string($_POST['email']);
	$_POST['first_name']=mysql_real_escape_string($_POST['first_name']);
	$_POST['last_name']=mysql_real_escape_string($_POST['last_name']);
	$_POST['password']=mysql_real_escape_string($_POST['password']);



$rs=mysql_query("select * from soe_members where email like '".$_POST['email']."' and reg=1");
if(mysql_num_rows($rs)>0)
{
	?>
    <script>
	location.href="memberregister.php?msg=duplicate";
	</script>
    <?php
}
else
{
	$sql="update soe_members set password='".md5($_POST['password'])."',first_name='".$_POST['first_name']."',dateofbirth='".$_POST['dateofbirth']."',gender='".$_POST['gender']."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',joined='".time()."',member_type='mem',from_ip='".$_SERVER['REMOTE_ADDR']."',reg=1,banned='0' where email like '".$_POST['email']."'";
	mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
	$custid=mysql_insert_id();
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
    <link rel="stylesheet" href="http://www.innogenius.com/shoebreeze/style1.css" type="text/css" />
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

    <p>Dear Customer,</p>
    <p><br />
     Welcome To ShoeBreeze.com .<br>
    <p>Now you can login to your account and enjoy facilities of My Account.<br></p>
    <p>To login <a href="http://www.innogenius.com/shoebreeze/memberlogin.php">CLICK HERE</a><br />  
	HAPPY SURFING!
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
			$mail->Subject ="Welcome To Shoe Breeze";
			$mail->Body    = $mailcontent;
			$mail->From = "quickonline.us1@gmail.com";
			$mail->FromName="Shoe Site";
			$mail->AddAddress($_POST['email']);
			$mail->AddBCC('quickonline.us1@gmail.com');


			$mail->AltBody ="Your mail is not supporting html format";
			$mail->IsMail();
			if(!$mail->Send())
			{
				$msg =$mail->ErrorInfo;
				echo("STATUS = <font color=red>".$msg."</font>");
			}
			
}
?>
<script>
location.href="thanks1.php";
</script>