<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
		
	$rs=mysql_query("select * from soe_settings") or die(mysql_error());
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
				<td class="header">Update Upload Settings</td>

			</tr>
			
			<tr>
				<td width="100%">								
					<form name="settings" method="post" action="">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell">Image Extension</td>
								<td>
									<input type="text" name="settings[up_img_ext]" value="<?php echo $settings['up_img_ext']; ?>" class="defaultWH" />

									<!-- <span class="tblcell7">&nbsp;coma ( , ) separators</span> -->
								</td>
							</tr>
							
							<tr>
								<td class="tblcell">Upload max Size (kilobytes)</td>
								<td><input type="text" name="settings[up_max_size]" value="<?php echo $settings['up_max_size']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>

								<td class="tblcell">Upload Photo max Width</td>
								<td><input type="text" name="settings[up_max_width]" value="<?php echo $settings['up_max_width']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Upload Photo max Height</td>
								<td><input type="text" name="settings[up_max_height]" value="<?php echo $settings['up_max_height']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>

								<td class="tblcell">Thumbnail Image Width</td>
								<td><input type="text" name="settings[up_thumb_width]" value="<?php echo $settings['up_thumb_width']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Thumbnail Image Height</td>
								<td><input type="text" name="settings[up_thumb_height]" value="<?php echo $settings['up_thumb_height']; ?>" class="defaultWH" /></td>
							</tr>
							
							<tr>

								<td class="tblcell">Watermark on Photo</td>
								<td>
									<div class="left tblcell7">Yes<input type="radio" name="settings[up_watermark]" value="yes" <?php if($settings['up_watermark']=="yes") { ?> checked="checked" <?php } ?> /></div>
									<div class="left tblcell7">No<input type="radio" name="settings[up_watermark]" value="no" <?php if($settings['up_watermark']=="no") { ?> checked="checked" <?php } ?>   /></div>
								</td>
							</tr>
							
							<tr>

								<td class="tblcell">Watermark Text</td>
								<td><input type="text" name="settings[up_watermark_text]" value="<?php echo $settings['up_watermark_text']; ?>" class="defaultWH" /></td>
							</tr>							
							
							<tr>
								<td class="tblcell">&nbsp;</td>
								<td><input type="submit" name="submit" value="Update" class="button" /></td>
							</tr>
							
							<tr><td><br class="clear"/>&nbsp;</td></tr>
						</table>

						
					</form>			
				</td>
			</tr>
			
		</table>
	</div>

	
	<?php include("bottom.php"); ?>