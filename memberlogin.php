<?php include("header.php"); 


$_SESSION['memberlogged']='';
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
if($_GET['forgot']==1)
{
	$rs=mysql_query("select * from soe_members where email like '".$_POST['email']."' and member_type='mem'");
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
elseif($_POST['email']!='')
{
$_POST['email']=mysql_real_escape_string($_POST['email']);
	$rs=mysql_query("select * from soe_members where email like '".$_POST['email']."' and member_type='mem'");
	if(mysql_num_rows($rs)>0)
	{
		$row=mysql_fetch_array($rs);
		if(md5($_POST['password'])==$row['password'])
		{
			if($row['verified']=='1' and $row['banned']=='0')
			{
			
				insertstats('login',$row['mem_id'],0,'mem');
				$_SESSION['memberlogged']='yes';
				$_SESSION['memberid']=$row['mem_id'];
				$_SESSION['memtype']=$row['member_type'];
				$_SESSION['memname']=$row['first_name'];
				?>
                <script>
					location.href="memberprofile.php";
				</script>
                <?php
			}
			elseif($row['banned']=='1')
			{
				$msg='Your account is not yet active or banned.';
			}
			else
			{
				$msg='Account not yet verified! Please check your email for verification link.';
			}
		}
		else
		{
			$msg="Incorrect Password!";
		}
	}
	else
	{
		$msg="Incorrect Email or not a Member!";
	}
}
elseif($_POST['email_reg']!='')
{

	
	
	$_POST['email_reg']=mysql_real_escape_string($_POST['email_reg']);



			$rs=mysql_query("select * from soe_members where email like '".$_POST['email_reg']."'");
			if(mysql_num_rows($rs)>0)
			{
				$msg="Duplicate Email Address Not Allowed!";
			}
			else
			{
			$rs=mysql_query("select * from soe_verification where email like '".$_POST['email_reg']."'");
			
			if(mysql_num_rows($rs)>0)
			{
				$msg='You have already been sent a verification link! Please check you inbox.';
			}
			else
			{
								$sql="insert into soe_verification set email='".$_POST['email_reg']."',code='".session_id()."',added='".time()."',member_type='mem'";
								mysql_query($sql) or die(mysql_error());
								
									
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
							  Thank you for signing up with us.<br>
						We`re sure you`ll enjoy with us and our features.<br /><br />
						
							To complete your registration, please click on the following link:</p>
							<p><a href="http://www.innogenius.com/shoebreeze/verifymember.php?code='.session_id().'" class="input_box">Click Here</a><br></p>
							<p>Once verified you can login with the email and password you entered on registration.<br />  
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
									$mail->Subject ="Email Verification Shoe Site";
									$mail->Body    = $mailcontent;
									$mail->From = "quickonline.us1@gmail.com";
									$mail->FromName="Shoe Site";
									$mail->AddAddress($_POST['email_reg']);
									$mail->AddBCC('quickonline.us1@gmail.com');
						
						
									$mail->AltBody ="Your mail is not supporting html format";
									$mail->IsMail();
									if(!$mail->Send())
									{
										$msg =$mail->ErrorInfo;
									}
								
							?>
						<script>
						location.href="thanks.php";
						</script>
						<?php	
	}
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


<?php
if($_GET['msg']=='alreadyregistered')
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
		<span class="err">You are already registered! Please login using your email and password.</span></div>
<?php
}
?>

<?php
if($_GET['msg']=='invalidcode')
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
		<span class="err">Please register again. The Verirication Link is invalid.</span></div>
<?php
}
?>

<script type="text/javascript">

function validateCaptcha()
{
    return true;
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
			},
			password: "required"
		},
		messages: {
			email: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			},
			password: "<br/>Password can not be empty."
		}
	});
	
	$("#loginbtn").click(function() {
           $('#loginfrm').submit();
        });



	$("#signupfrm").validate({
		rules: {
		email_reg: {
				required: true,
				email: true
			}
		},
		messages: {
			email_reg: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			}
		}
	});
	
	$("#signupbtn").click(function() {
           $('#signupfrm').submit();
        });


});
</script>

<?php include("left.php"); ?>	
	
	<div><img src="images/login_head.jpg" alt=""></div>
	<div id="content_area_mid_inner1">
		<div class="border2" align="center"> Capcha Input is Mandatory for either form !<br /><?php 
	include("recaptcha.php");
	echo recaptcha_get_html($publickey); ?>
    <span id="captchaStatus" class="error"></span></div>
		<div class="hei">&nbsp;</div>
        <form action="memberlogin.php" method="post" name="loginfrm" id="loginfrm" onsubmit="return validateCaptcha();">
		<div class="border2">
			<div class="gfont_big">Already have an account?</div>
			<div class="hei">&nbsp;</div>
			<div class="search_lable_innerpage">Email</div>
			<div class="search_txtbox_innerpage">: <input name="email" type="text" class="txt_box1" id="email" size="35" maxlength="40">
		  </div>
			<div class="clear"></div>
			<div class="search_lable_innerpage">Password</div>
			<div class="search_txtbox_innerpage">: <input name="password" type="password" class="txt_box1" id="password" size="35" maxlength="20">
		  </div>
			<div class="clear"></div>
			<div class="search_lable_innerpage"></div>
			<div class="search_txtbox_innerpage"><a id="loginbtn" ><img src="images/login_button.jpg" alt=""></a>
            
            <a onclick="javascript: document.loginfrm.reset(); "><img src="images/clear_buton.jpg" alt=""></a></div>
			<div class="clear"> </div>
            
            <div class="fgpass"><a onclick="javascript: location.href='fgp.php';">Forgot Password</a></div>
            <div class="clear"> </div>
           
		</div>
		  </form>
		<div class="hei">&nbsp;</div>
		<form action="" method="post" name="signupfrm" id="signupfrm" onsubmit="return validateCaptcha();">
		<div class="border2">
			<div class="gfont_big">New Account</div>
			<div class="hei">&nbsp;</div>
			<div>To Register all you need and few minutes and active Email</div>
			<div class="hei">&nbsp;</div>
			<div class="search_lable_innerpage">Enter Valid Email</div>
			<div class="search_txtbox_innerpage">: <input name="email_reg" type="text" class="txt_box1" id="email_reg" size="35" maxlength="40">
		  </div>
			<div class="clear"></div>
			<div class="search_lable_innerpage"></div>
			<div class="search_txtbox_innerpage"><a id="signupbtn"><img src="images/sign_up_button.jpg" alt=""></a>
            <a onclick="javascript: document.signupfrm.reset(); "><img src="images/clear_buton.jpg" alt=""></a>
            </div>
			<div class="clear"></div>
		</div>
        </form>
	</div>
	
	<div id="content_area_right"><?php echo  showbanners('right'); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
	<div class="hei"></div>
	
<?php include("footer.php"); ?>	