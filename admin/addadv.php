<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

	
	if($_GET['id']>0)
	{
		$sql="update soe_members set first_name='".$_POST['first_name']."',last_name='".$_POST['last_name']."',dateofbirth='".$_POST['dateofbirth']."',gender='".$_POST['gender']."',email='".$_POST['email']."' where mem_id=".$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		$id=$_GET['id'];
		if($_POST['password']!='')
		{
		$sql="update soe_members set password='".md5($_POST['password'])."' where mem_id=".$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		}
	}
	?>
    <script>
	location.href='showadv.php?t=<?php echo $_GET['t']; ?>';
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_members where mem_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
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
			required: function(element) {
			        return $("#password").val() != "";
      				},
			minlength: 6,
			maxlength: 20,
			noSpace: function(element) {
			        return $("#password").val() != "";
      				}
			},
			confirm_password: {
				required: function(element) {
			        return $("#password").val() != "";
      				},
				equalTo: "#password"
			},
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
	
	
	$("#submit").click(function() {
  $("#password").valid();
  $("#confirm_password").valid();
});

	
});

</script>
<div class="body" id="mk_height">
		
		<Table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Edit Advertiser</td>
			</tr>
			<tr>
				<td width="100%">					
					
					<form class="form" id="register" name="register" method="post" action="" enctype="">

						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell">First Name <span>*</span></td>
								<td><input type="text" name="first_name" value="<?php echo $first_name; ?>" class="input_box" id="first_name" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Last Name <span>*</span></td>

						  <td><input type="text" name="last_name" value="<?php echo $last_name; ?>" class="input_box" id="last_name" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Email <span>*</span></td>
							  <td><input type="text" name="email" value="<?php echo $email; ?>" class="input_box" id="email" maxlength="250" readonly="readonly" /></td>
							</tr>
							

							<tr>
							  <td class="tblcell">Gender*</td>
							  <td><select name="gender">
                                <option value="Male" <?php if($row['gender']=='Male') { ?> selected="selected" <?php } ?> >Male</option>
                                <option value="Female" <?php if($row['gender']=='Female') { ?> selected="selected" <?php } ?> >Female</option>
                              </select></td>
						  </tr>
							<tr>
							  <td class="tblcell">Date Of Birth*</td>
							  <td><input type="text" name="dateofbirth" value="<?php echo $dateofbirth; ?>" class="input_box" id="dateofbirth" maxlength="250" />
						      (mm/dd/yy)</td>
						  </tr>
							<tr>
								<td class="tblcell">New Password</td>
								<td><input type="password" name="password" class="input_box" id="password" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Confirm New Password</td>
								<td><input type="password" name="confirm_password" class="input_box" id="confirm_password" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">&nbsp;</td>

								<td class="pb_5"><input type="submit" name="submit" value="Submit" class="button" /></td>
							</tr>
						</table>						
				  </form>
					<br class="clear" />
				</td>
			</tr>
		</table>
		
	</div>

	
	<?php include("bottom.php"); ?>