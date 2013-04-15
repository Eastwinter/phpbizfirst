<?php include("header.php"); ?>
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
				
	$("#register").validate({
		rules: {
			first_name: {
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
			password: {
			required: true,
			minlength: 6,
			maxlength: 20,
			noSpace: true
			},
			confirm_password: {
				required: true,
				equalTo: "#password"
			},
			gender: 'required',
			dateofbirth:
			{
			required: true,
			DateFormat: true,
			CheckDOB: true
			},
			terms_conditions: "required"
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
			password: {
						required: "Password can not be empty.",
			minlength: "Minimum 6 chars required",
			maxlength: "Password cannot exceed 20 chars"
			},
			email: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			},
			
			confirm_password: {
				required: "<br/>Please repeat your password.",
				equalTo: "<br/>Password & Confirm Password mismatch."
			},
			dateofbirth:
			{
			required: "<br />Date of birth required",
			DateFormat: '<br /> Please enter in correct format',
			CheckDOB: '<br /> Enter valid DOB'
			},

			human_input: "<br/>Human input verification can not be empty."
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
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				
<?php
if($_GET['msg']=="duplicate")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">Duplicate Email Address!</span></div>
<?php
}
?>	
	<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<?php
if($_GET['msg']=="verify")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">Your email has been verified. Please continue with the registration!</span></div>
<?php
}
?>				


<?php
if($_GET['msg']=='alreadyverified')
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
		<span class="err">You have already verified your email! Please complete the registration process.</span></div>
<?php
}
?>

   <?php include("left.php"); ?>   
   
   <?php
   $sql="select * from soe_members where mem_id= ".intval($_GET['id'])."";
$rs=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($rs);
?>
  <div id="content_area_mid_inner1">
    <div>
      <h2>Member _ Signup</h2>
    </div>
    <div class="border1">
      <div class="membersignup">
        <form class="form" id="register" name="register" method="post" action="registermemberpost.php" onsubmit="return validateCaptcha();">
          <div class="input_title">
            <label for="first_name">First Name</label>
            <span>*</span></div>
          <div class="input">
            <input name="first_name" type="text" class="input_box" id="first_name" value="" maxlength="20" />
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="last_name">Last Name</label>
            <span>*</span></div>
          <div class="input">
            <input name="last_name" type="text" class="input_box" id="last_name" value="" maxlength="20" />
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="last_name">Gender</label>
            <span>*</span></div>
          <div class="input">
            <select name="gender">
              <option value="Male" selected="selected">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="last_name">Date Of Birth</label>
            <span>*</span></div>
          <div class="input">
            <input name="dateofbirth" type="text" class="input_box" id="dateofbirth" value="" maxlength="20" />
            (mm/dd/yyyy)</div>
          <br class="clear" />
          <div class="input_title">
            <label for="email">Email Address</label>
            <span>*</span></div>
          <div class="input">
            <input type="text" name="email" value="<?php echo $row['email']; ?>" class="input_box" id="email" maxlength="250" readonly="readonly" />
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="password">Password</label>
            <span>*</span></div>
          <div class="input">
            <input name="password" type="password" class="input_box" id="password" value="" maxlength="20" />
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="confirm_password">Confirm Password</label>
            <span>*</span></div>
          <div class="input">
            <input name="confirm_password" type="password" class="input_box" id="confirm_password" value="" maxlength="20" />
          </div>
          <br class="clear" />
          <div class="input_title">&nbsp;</div>
          <div class="input"><br/>
          </div>
          <br class="clear" />
          <div class="input_title">
            <label for="human_input">Input Verification <span>*</span></label>
          </div>
          <div class="input">
            <?php 
	include("recaptcha.php");
	echo recaptcha_get_html($publickey); ?>
            <span id="captchaStatus" class="error"></span> </div>
          <br class="clear" />
          <div class="input_title">&nbsp;</div>
          <div class="input">
            <input type="checkbox" name="terms_conditions" value="1" id="terms_conditions"  />
            <span>Agree with the <a onclick="window.open('pages1.php?pageid=7','','status=no,menubar=no,toolbars=no,width=800,height=500,scrollbars=yes');" style="color:#0033FF; font-style:italic"> terms and conditions </a></span>
            <label for="terms_conditions" class="error"><br />
              You have to agree with the terms &amp; conditions.</label>
          </div>
          <br class="clear" />
          <div class="input_title">&nbsp;</div>
          <div class="input">
            <input type="image" name="submit" src="images/blue_submit_button.jpg" />
          </div>
          <br class="clear" />
        </form>
      </div>
    </div>
     <br class="clear">
  </div>
  <div id="content_area_right"> <?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
<?php include("footer.php"); ?>