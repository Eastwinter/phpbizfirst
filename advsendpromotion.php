<?php include("header.php"); ?>
<?php
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$_POST['subject']=mysql_real_escape_string($_POST['subject']);
	$_POST['content']=mysql_real_escape_string($_POST['content']);

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
		
			'.$_POST['content'].'
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
					$mail->Subject =$_POST['subject'];
					$mail->Body    = $mailcontent;
					$mail->From = "quickonline.us1@gmail.com";
					$mail->FromName="ShoeBreeze.com";
					
					$rs=mysql_query("select * from soe_members where mem_id in (select flduserid from soe_reviews where fldtype='save' and fldshoeid in (select soe_id from soe_shoe where sto_id in (select sto_id from soe_stores where mem_id='".$_SESSION['memberid']."')))");
					while($row=mysql_fetch_array($rs))
					{
						$mail->AddAddress($row['email']);
					}
					$mail->AddBCC('quickonline.us1@gmail.com');
		
		
					$mail->AltBody ="Your mail is not supporting html format";
					$mail->IsMail();
					if(!$mail->Send())
					{
						$msg =$mail->ErrorInfo;
					}

	$msg='Message Sent All Users Successfully!';
}
?>
<script type="text/javascript">
$().ready(function() {
	
	jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please and don't leave it empty");



jQuery.validator.addMethod("CheckDOB", function (value, element) {
       var  minDate = Date.parse("12/12/2000");  
        var today=new Date();
        var DOB = Date.parse(value);  
        if((DOB <= minDate)) {  
            return true;  
        }  
        return false;  
    }, "NotValid");

$.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );
	
	
	$("#editprofilefrm").validate({
		rules: {
			subject: {
			required: true,
			minlength: 4,
			maxlength: 20,
			noSpace: true
			},
			last_name: {
			required: true,
			minlength: 4,
			maxlength: 20,
			noSpace: true
			},	
			email: {
				required: true,
				email: true
			},
			gender: 'required',
			dateofbirth:
			{
			required: true,
			DateFormat: true,
			CheckDOB: true
			},
			
			oldpassword: {
				required: function () { if(document.getElementById('password').value=='')
						return false;
						else
						return true;
						}
			},
			password: {
			required: function () { if(document.getElementById('password').value=='')
						return false;
						else
						return true;
						},
			minlength: 6,
			maxlength: 20,
			noSpace: true
			},

			confirmpassword: {
				required: function () { if(document.getElementById('password').value=='')
						return false;
						else
						return true;
						},
				equalTo: "#password"
			},
			
		},
		messages: {
			first_name: {
						required: "First Name can not be empty.",
			minlength: "Minimum 4 chars required",
			maxlength: "FirstName cannot exceed 20 chars"
			},
			last_name:  {
						required: "Last Name can not be empty.",
			minlength: "Minimum 4 chars required",
			maxlength: "LastName cannot exceed 20 chars"
			},
			email: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			},
			confirmpassword: {
				required: "<br/>Please repeat your password.",
				equalTo: "<br/>Password & Confirm Password mismatch."
			},
			oldpassword: {
				required: "<br/>Please enter old password."
			},
						dateofbirth:
			{
			required: "<br />Date of birth required",
			DateFormat: '<br /> Please enter in correct format',
			CheckDOB: '<br /> Enter valid DOB'
			},


		}
	});
	
		$("#editbtn").click(function() {
           $('#editprofilefrm').submit();
        });


	
});
</script>
    
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				
<?php
if($msg!="")
{
?>	
                
<div id="object" class="message_box">
		<span class="err"><?php echo $msg; ?></span></div>
<?php
}
?>				
    
      <?php include("left3.php"); ?>

  
  <div id="content_area_mid_inner1">
  <form action="" method="post" name="editprofilefrm" id="editprofilefrm">
  <div class="border1" style="padding-left:10px;">
  <div>
    <h2>Send Updates/Promotions to Users</h2>
  </div>
    <div class="editprofile">
      <div class="editprofile_left" >
        <p> <b>Subject :</b><br />
          <input name="subject" type="text" id="subject" value="" size="60" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        <p> <b>Content:</b><br />
          <textarea name="content" cols="40" rows="15" id="content" ></textarea>
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        </div>
      <div class="clear"><a id="editbtn" ><img src="images/blue_submit_button.jpg" alt="" border="0"></a> &nbsp;</div>
    </div>
    </div>
    </form>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>