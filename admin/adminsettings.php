<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$rs=mysql_query("update soe_settings set value='".$_POST['admin_name']."' where field='admin_name'");
	$rs=mysql_query("update soe_settings set value='".$_POST['admin_email']."' where field='admin_email'");
	
if($_POST["new_password"]!="")
{
	$rs=mysql_query("select * from soe_members where member_type='adm' and email like '".$_POST['admin_email']."' and password like '".md5($_POST['old_password'])."'");
	if(mysql_num_rows($rs)>0)
	{
		mysql_query("update soe_members set password='".md5($_POST['new_password'])."' where email like '".$_POST['admin_email']."'");
	}
}

}

$settings=array();
$rs=mysql_query("select * from soe_settings");
while($row=mysql_fetch_array($rs))
{
	$settings[$row['field']]=$row['value'];
}
?>
						
	<script type="text/javascript">
$().ready(function() {
	
	$("#settings").validate({
		rules: {
			admin_name: "required",		
			admin_email: {
				required: true,
				email: true
			},
			old_password: {
				required: function(element) {					
			        return $("#new_password").val() != "";
      				}
			},
			new_password: {
				required: function(element) {					
			        return $("#new_password").val() != "";
      				}
			},
			confirm_password: {
				required: function(element) {
			        return $("#new_password").val() != "";
      				},
				equalTo: "#new_password"
			},

			
		},
		messages: {
			admin_name: "<br/>First Name can not be empty.",		
			admin_email: {
				required: "<br/>Email Address can not be empty.",
				email: "<br/>Please enter a valid email address."
			},
			old_password: "<br/>Old Password can not be empty.",
			new_password: "<br/>New Password can not be empty.",
			confirm_password: {
				required: "<br/>Please repeat your New Password.",
				equalTo: "<br/>New Password & Confirm New Password mismatch."
			}
		}
	});
	
	$("#submit").click(function() {
  $("#old_password").valid();
  $("#new_password").valid();  
  $("#confirm_password").valid();
});
	
});
</script>	
	
	<div class="body" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Update Admin Settings</td>
			</tr>
			
			<tr>

				<td width="100%">
					<form name="settings" id="settings" method="post" action="">
						<input type="hidden" name="mem_id" value="1" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">							
							
							<tr>
								<td class="tblcell31">Admin Name <span class="mark">*</span></td>
								<td><input type="text" name="admin_name" id="admin_name" value="<?php echo $settings['admin_name']; ?>" class="defaultWH" /></td>
							</tr> 
							
							<tr>

								<td class="tblcell31">Admin Email <span class="mark">*</span></td>
								<td><input type="text" name="admin_email" id="admin_email" value="<?php echo $settings['admin_email']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell31">Old Password</td>
								<td><input type="password" name="old_password" id="old_password" class="defaultWH" /></td>
							</tr>

							
							<tr>
								<td class="tblcell31">New Password</td>
								<td><input type="password" name="new_password" id="new_password" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell31">Confirm Password</td>
								<td><input type="password" name="confirm_password" id="confirm_password"  class="defaultWH" /></td>
							</tr>

							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td><input type="submit" name="submit" value="Update" class="button" id="submit" /></td>
							</tr>        
						</table>					
							
					</form>			
				</td>
			</tr>
			
		</table>
	</div>

	
	<?php include("bottom.php"); ?>