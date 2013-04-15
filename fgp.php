<?php include("header.php"); 


$_SESSION['memberlogged']='';
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{

	$rs=mysql_query("select * from soe_members where email like '".$_POST['email']."'");
	if(mysql_num_rows($rs)<=0)
	{
		$msg="Email-ID does not exist!";
	}
	else
	{
		$err=0;
		$rs=mysql_query("select * from soe_fgp where email like '".$_POST['email']."'");
		if(mysql_num_rows($rs)>0)
		{
			$row=mysql_fetch_array($rs);
			$t=date('Y-m-d')-$row['added'];
			if($t<3)
				$err=1;
			
		}
	if($err==0)
	{
			$length=8;
			 $possible = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$i = 0;
			$coupon='';
			while ( $i <= $length ) {
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
				
				// we don't want this character if it's already in the password
				if (strpos($coupon, $char)>0 && $i>0 )
				{
				}
				else
				{
					$coupon .= $char;
					$i++;
				}
			}
				
			$sql="insert into soe_fgp set code='".md5($coupon)."',email='".$_POST['email']."'";
			$rs=mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
		//	echo $coupon;
		//	echo '<hr />';
		//	echo md5($coupon);
		
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
		
			<p>Dear Customer,</p>
			<p><br />
			 Please follow the link below and enter the code given below.<br>
			</p>
			<p>
			<a href="http://www.innogenius.com/shoebreeze/forgot1.php"><strong>CLICK HERE</strong></a>
			</p>
			<p>
			<strong>Verification Code:</strong>&nbsp;&nbsp;'.$coupon.'<br></p>
			<p><br />
			Please ignore if the mail is not triggered by you.<br />  
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
					$mail->Subject ="Password Reset - Shoe Site";
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
					}
					else
					$msg="Verification Code Sent! Please check your email for further instructions";
		}
		else
		{
			$msg="Verification Code has been sent to your email! Please try again after 3 hours , if you don't receive the email.";
		}		
	}
	
	
}
?>
				
				
                
<?php
if($msg!='')
{
?>
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<div id="object" class="message_box">
		<span class="err"><?php echo $msg; ?></span></div>
<?php
}
?>

<?php
if($_GET['msg']=='login')
{
?>
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<div id="object" class="message_box">
		<span class="err">You must log in to access the system OR Your session has timed out.</span></div>
<?php
}
?>

<?php
if($_GET['msg']=='pr')
{
?>
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<div id="object" class="message_box">
		<span class="err">Password reset successful!</span></div>
<?php
}
?>

<script type="text/javascript">

function validateCaptcha()
{
	var responseField;
	var challengeField;
    challengeField = $("input#recaptcha_challenge_field").val();
    responseField = $("input#recaptcha_response_field").val();
	if(responseField=='')
	{
		alert('Human input verification can not be empty.');
		return false;
	}
	
	var html = $.ajax({
    type: "POST",
    url: "ajax.recaptcha.php",
    data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
    async: false
    }).responseText;
	
 
    if(html == "success")
    {
        $("#captchaStatus").html(" ");
		
        return true;
    }
    else
    {
        $("#captchaStatus").html("Your captcha is incorrect. Please try again");
        Recaptcha.reload();
        return false;
    }
}


$(document).ready(function() {

	$("#loginfrm").validate({
		rules: {
		email: {
				required: true,
				email: true
			}
		},
		messages: {
			email: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			}
		}
	});
	
	$("#fgpbtn").click(function() {
           $('#loginfrm').submit();
        });


});
</script>

    
   <?php include("left.php"); ?>  
	<div id="content_area_mid">
	<div><img src="images/fp_head.jpg" alt=""></div>
    <form action="" method="post" name="loginfrm" id="loginfrm" onsubmit="return validateCaptcha();">
		<div class="border2">
			<div class="hei">&nbsp;</div>
			<div class="search_lable_innerpage">Email Id</div>
			<div class="search_txtbox_innerpage">: <input name="email" type="text" class="txt_box1" size="35" id="email">
			</div>
			<div class="clear"></div>
			<div><?php 
	include("recaptcha.php");
	echo recaptcha_get_html($publickey); ?>
    <span id="captchaStatus" class="error"></span></div>
			<div class="search_lable_innerpage"></div>
			<div class="search_txtbox_innerpage"><a id="fgpbtn" ><img src="images/blue_submit_button.jpg" alt="" width="78" height="35"></a>
            <a onclick="javascript: document.loginfrm.reset(); "><img src="images/clear_buton.jpg" alt=""></a></div>
			<div class="clear"></div>
		</div>
        </form>
	</div>
	
	<div id="content_area_right"> <?php echo showbanners("right"); ?>  </div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
	<div class="hei">&nbsp;</div>
	
 <?php include("footer.php"); ?>  