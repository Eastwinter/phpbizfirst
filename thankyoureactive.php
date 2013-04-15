<?php include('header.php'); 
$rs1=mysql_query("update soe_members set freezedate='".date('Y-m-d')."' where mem_id=".$_SESSION['memberid']) or die(mysql_error()."----2");		
$rs1=mysql_query("select * from soe_members where mem_id=".$_SESSION['memberid']) or die(mysql_error()."----1");		
$row1=mysql_fetch_array($rs1);
				$_SESSION['memberlogged']='';
				$_SESSION['memberid']='';
				$_SESSION['memtype']='';
				$_SESSION['memname']='';



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
			 We have received your reactivation fees.<br>
			 Please see below the details of the transaction.<br />
<br />

			 
			 <table width="100%" border="1" cellspacing="0" cellpadding="5">
				  <tr>
					<td>Item </td>
					<td>Price</td>
				  </tr>

				  <tr>
					<td>Reactivation Fees</td>
					<td>$35</td>
				  </tr>

				</table>

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
					$mail->Subject ="ShoeBreeze - Payment Successful!";
					$mail->Body    = $mailcontent;
					$mail->From = "quickonline.us1@gmail.com";
					$mail->FromName="Shoe Site";
					$mail->AddAddress($row1['email']);
					$mail->AddBCC('quickonline.us1@gmail.com');
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
<?php include("left.php"); ?>
			
  
  <div id="content_area_mid_inner1">
  <div>
    <h2>Payment Successful!</h2>
  </div>
   
    <div class="moremarketing">
      
 
    <p class="blue_bold">
            Thank You !!.. You can now login to your account and start using the My Account features.</p>
      <div class="clear"></div>
</div>
  
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  
 

<?php include("footer.php"); ?>