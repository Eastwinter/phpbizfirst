<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	$rs=mysql_query("select * from soe_settings");
	while($row=mysql_fetch_array($rs))
	{
		$nm=$row['field'];
		$v=$_POST['settings'][$nm];
		if($v!='')
		{
			mysql_query("update soe_settings set value='".$v."' where field='".$row['field']."'");
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

				<td class="header">Update Global Settings</td>
			</tr>
			
			<tr>
				<td width="100%">								
					<form name="settings" method="post" action="">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell41">Site Name</td>

								<td><input type="text" name="settings[site_name]" value="<?php echo $settings['site_name']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell41">Site Email</td>
								<td><input type="text" name="settings[site_email]" value="<?php echo $settings['site_email']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell41">Item Per Page in Admin</td>

								<td><input type="text" name="settings[per_page_admin]" value="<?php echo $settings['per_page_admin']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell41">Item Per Page in User</td>
								<td><input type="text" name="settings[per_page_user]" value="<?php echo $settings['per_page_user']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell41">Item Per Page in Submenu</td>

								<td><input type="text" name="settings[per_page_submenu]" value="<?php echo $settings['per_page_submenu']; ?>" class="defaultWH" /></td>
							</tr>							
							
							<tr>
								<td class="tblcell41">Date Formate</td>
								<td><input type="text" name="settings[date_format]" value="<?php echo $settings['date_format']; ?>" class="defaultWH" /></td>
							</tr>							
							
							<tr>
								<td class="tblcell41">Sign up Email Verification</td>
								<td>

									<div class="left tblcell7">Yes<input type="radio" name="settings[email_verification]" value="yes" <?php if($settings['email_verification']=="yes") { ?> checked="checked" <?php } ?>  /></div>
									<div class="left tblcell7">No<input type="radio" name="settings[email_verification]" value="no"  <?php if($settings['email_verification']=="no") { ?> checked="checked" <?php } ?>  /></div>
								</td>
							</tr>
							
							<tr>
								<td class="tblcell41" valign="top">Price VAT (%)</td>
								<td><input type="text" name="settings[price_vat]" value="<?php echo $settings['price_vat']; ?>" class="defaultWH" /></td>

							</tr>							
							
							<tr>
								<td class="tblcell41" valign="top">Page Title Prefix</td>
								<td><input type="text" name="settings[title_prefix]" value="<?php echo $settings['title_prefix']; ?> " class="defaultWH" /><br/><span class="tblcell7">can be empty</span></td>
							</tr>
							
							<tr>
								<td class="tblcell41">&nbsp;</td>
								<td><input type="submit" name="submit" value="Update" class="button" /></td>

							</tr>
							
							<tr><td><br class="clear-both" /></td></tr>
						</table>					
							
					</form>			
				</td>
			</tr>
			
		</table>
	</div>

	
	<?php include("bottom.php"); ?>