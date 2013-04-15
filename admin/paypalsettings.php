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

				<td class="header">Update Paypal Settings</td>
			</tr>
			
			<tr>
				<td width="100%">
					<form name="settings" method="post" action="">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							<tr>
								<td class="tblcell41">Enable Test Mode</td>

								<td>
									<div class="left tblcell7">Yes<input type="radio" name="settings[paypal_test_mode]" value="yes" <?php if($settings['paypal_test_mode']=="yes") { ?> checked="checked" <?php } ?> /></div>
									<div class="left tblcell7">No<input type="radio" name="settings[paypal_test_mode]" value="no" <?php if($settings['paypal_test_mode']=="no") { ?> checked="checked" <?php } ?>   /></div>
								</td>
							</tr>
							
							<tr>
								<td class="tblcell41">Paypal Currency</td>

								<td>
									<select name="settings[paypal_currency]">
										<option value="USD"  <?php if($settings['paypal_currency']=="USD") { ?> selected="selected" <?php } ?> >USD Dollar</option>
										<option value="EUR"  <?php if($settings['paypal_currency']=="EUR") { ?> selected="selected" <?php } ?> >EUR Euro</option>
										<option value="GBP"  <?php if($settings['paypal_currency']=="GBP") { ?> selected="selected" <?php } ?> >GBP Pound</option>
									</select>									
								</td>
							</tr>

							
							<tr>
								<td class="tblcell41">Paypal Contact Name</td>
								<td><input type="text" name="settings[paypal_contact_name]" value="<?php echo $settings['paypal_contact_name']; ?>" class="defaultWH" /></td>
							</tr>							
							
							<tr>
								<td class="tblcell41">Paypal E-mail</td>
								<td><input type="text" name="settings[paypal_email]" value="<?php echo $settings['paypal_email']; ?>" class="defaultWH" /></td>
							</tr>

							
							<tr>
								<td class="tblcell41">&nbsp;</td>
								<td><input type="submit" name="submit" value="Update" class="button" /></td>
							</tr>        
						</table>
							
					</form>			
				</td>
			</tr>
			
		</table>
	</div>

	
	<?php include("bottom.php"); ?>