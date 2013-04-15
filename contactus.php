<?php include("header.php"); 
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$sql="insert into soe_contact_us set name='".mysql_real_escape_string($_POST['name'])."',email='".mysql_real_escape_string($_POST['email'])."',subject='".mysql_real_escape_string($_POST['subject'])."',message='".mysql_real_escape_string($_POST['message'])."',date='".time()."'";
	mysql_query($sql) or die(mysql_error());
	$msg="Thanks for the information. We will get in touch with you shortly.";
	
}
?>
<script type="text/javascript">
    var RecaptchaOptions = { theme : 'white' };
 </script>
								
                

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
	
					
				

				
<script type="text/javascript">
$().ready(function() {
	$("#contact_us").validate({
		rules: {
			name: "required",
			email: {
				required: true,
				email: true				
			},
			confirm_email: {
				required: true,
				equalTo: "#email"
			},			
			subject: "required",			
			message: "required"
		},
		messages: {
			name: "Name cannot be empty.",
			email: {
				required: "Email Address can not be empty.",
				email: "Please enter a valid email address."
			},
			confirm_email: {
				required: "Please repeat your email address.",
				equalTo: "Email &amp; Confirm Email mismatch."
			},			
			subject: "Subject cannot be empty",
			human_input: "Human input verification can not be empty.",
			message: "Message cannot be empty"			
		}
	});
});


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
</script>	
	
	<!-- Content Area Start -->
	<?php include("left.php"); ?>
	 <form class="form" id="contact_us" name="contact_us" method="post" action="" onsubmit="return validateCaptcha();">
	<div id="content_area_mid">
		<div><img src="images/contact_head.jpg" alt=""></div>
		<div class="search_lable_innerpage">Name*</div>
		<div class="search_txtbox_innerpage"><input name="name" type="text" class="txt_box1" size="35" id="name">
		</div>
		<div class="clear"></div>
		<div class="search_lable_innerpage">Email*</div>
		<div class="search_txtbox_innerpage"><input name="email" type="text" class="txt_box1" size="35" id="email">
		</div>
		<div class="clear"></div>
		<div class="search_lable_innerpage">Confirm Email*</div>
		<div class="search_txtbox_innerpage"><input name="confirm_email" type="text" class="txt_box1" size="35" id="confirm_email">
		</div>
		<div class="clear"></div>
		<div class="search_lable_innerpage">Subject*</div>
		<div class="search_txtbox_innerpage"><input name="subject" type="text" class="txt_box1" size="35" id="subject">
		</div>
		<div class="clear"></div>
		<div class="search_lable_innerpage">Message*</div>
		<div class="search_txtbox_innerpage"><textarea name="message" cols="32" rows="5" class="txt_box1" id="message"></textarea>
		</div>
		<div class="clear"></div>
		<div class="search_lable_innerpage"><p>
<?php 
	include("recaptcha.php");
	echo recaptcha_get_html($publickey); ?>
    <span id="captchaStatus" class="error"></span>

    </p>
</div><br class="clear"/>

		<div class="search_txtbox_innerpage"><input type="image" src="images/blue_submit_button.jpg" alt=""></div>
		<div class="clear"></div>
	</div>
    </form>
	
	<div id="content_area_right">	<?php echo showbanners("right"); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
	<?php include("footer.php"); ?>