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
			settings[up_max_size]: {
				required: true,
				number: true
			}
		},
		messages: {
			settings[up_max_size]: {
				required: "<br/>Please enter a number.",
				number: "<br/>Please enter a number."
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
								<td class="tblcell">Upload max Size (kilobytes)</td>
								<td><input type="text" name="settings[up_max_size]" value="<?php echo $settings['up_max_size']; ?>" class="defaultWH" id="settings[up_max_size]" /></td>
							</tr>							
							
							<tr>
								<td class="tblcell">&nbsp;</td>
								<td><input type="submit" name="submit" value="Update" class="button" /></td>
							</tr>
						</table>

						
				  </form>			
				</td>
			</tr>
			
		</table>
	</div>

	
	<?php include("bottom.php"); ?>