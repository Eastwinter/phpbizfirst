<?php include("header.php"); ?>
<?php
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$_POST['email']=mysql_real_escape_string($_POST['email']);
	$_POST['first_name']=mysql_real_escape_string($_POST['first_name']);
	$_POST['last_name']=mysql_real_escape_string($_POST['last_name']);
	$_POST['password']=mysql_real_escape_string($_POST['password']);	
$arr=explode(" ",$_POST['name']);

$sql="update soe_members set email='".$_POST['email']."',first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',dateofbirth='".$_POST['dateofbirth']."',gender='".$_POST['gender']."',from_ip='".$_SERVER['REMOTE_ADDR']."' where mem_id=".$_SESSION['memberid'];
mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
if(trim($_POST['password'])!='')
{
$sql="select * from soe_members where mem_id=".$_SESSION['memberid'];
$rs=mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
$row=mysql_fetch_array($rs);
if($row['password']==md5($_POST['oldpassword']))
{
	$sql="update soe_members set password='".md5($_POST['password'])."' where mem_id=".$_SESSION['memberid'];
	mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
}
else
{
	$msg="Could not update password. Wrong Old_password!";
}
}
if($msg=='')
	$msg='Profile Updated Successfully!';
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

  <?php
  
$rs=mysql_query("select * from soe_members where mem_id=".$_SESSION['memberid']);
$row=mysql_fetch_array($rs);
?>
      
      
  
  <div id="content_area_mid_inner1">
  <form action="" method="post" name="editprofilefrm" id="editprofilefrm">
  <div class="border1" style="padding-left:10px;">
  <div>
    <h2>Edit Profile</h2>
  </div>
    <div class="editprofile">
      <div class="editprofile_left" >
        <p> <b>First Name :</b><br />
          <input name="first_name" type="text" id="first_name" style="width:200px;" value="<?php echo $row['first_name']; ?>" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        <p> <b>Last Name :</b><br />
          <input name="last_name" type="text" id="last_name" style="width:200px;" value="<?php echo $row['last_name']; ?>" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        <p> <b>Gender :</b><br />
          <select name="gender" id="gender">
            <option  <?php if($row['gender']=='Male') { ?> selected="selected" <?php } ?> value="Male" >Male</option>
            <option <?php if($row['gender']=='Female') { ?> selected="selected" <?php } ?> value="Female" >Female</option>
          </select>
          <br />
          <label style="display:none;">Select..</label>
        </p>
        <p> <b>Date of Birth :</b><br />
          <input name="dateofbirth" type="text" id="dateofbirth" style="width:200px;" value="<?php echo $row['dateofbirth']; ?>" />
          <br />
          <label>(mm/dd/yy)</label>
        </p>
      </div>
      <div class="editprofile_left">
        <p> <b>Email :</b><br />
          <input name="email" type="text" id="email" style="width:200px;" value="<?php echo $row['email']; ?>" />
          <br />
          <label style="display:none;">Enter...</label>
        </p>
        <p> <b>Old Password :</b><br />
          <input name="oldpassword" type="password" id="oldpassword" style="width:200px;" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        <p> <b>New Password :</b><br />
          <input name="password" type="password" id="password" style="width:200px;" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
        </p>
        <p> <b>Confirm Password :</b><br />
          <input name="confirmpassword" type="password" id="confirmpassword" style="width:200px;" />
          <br />
          <label style="display:none;">Enter minimun 6 character</label>
          <br />
        </p>
      </div>
      <div class="clear"><a id="editbtn" ><img src="images/blue_submit_button.jpg" alt="" border="0"></a> &nbsp;<a onclick="javascript: document.editprofilefrm.reset();"><img src="images/clear_buton.jpg" alt="" border="0"></a> </div>
    </div>
    </div>
    </form>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>