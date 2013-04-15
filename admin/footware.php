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
	
    $("select#fot_id").change(function () {
		var fot_id = $("#fot_id").val();		
		$.get(script_url+"admin/ajax/foot_ware/"+fot_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			foot_ware = $("foot_ware",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#foot_ware").val(foot_ware);
			$("#button").val("Update");
			document.getElementById("button2").style.display="inline-block";

			$("#action_type").val("edit");
		}
	});
	
});
</script>

	
	<div class="body" id="mk_height">
	
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Foot Ware</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="foot_ware" method="post"action="http://www.quickworkz.com/dev/shoe/admin/utility/foot_ware">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">Foot Ware</td>
								<td class="tblcell1">
									<select name="fot_id" id="fot_id" size="15" class="sCatWH">									
																					<option value="11">aa</option>
																					<option value="9">Boots</option>

																					<option value="5">Clogs</option>
																					<option value="6">Flip Flops</option>
																					<option value="10">Mary Janes</option>
																					<option value="1">Others</option>
																					<option value="4">Pumps</option>
																					<option value="7">Sandals</option>

																					<option value="12">sisworld</option>
																					<option value="8">Sling Backs</option>
																					<option value="2">Sneakers</option>
																					<option value="3">Stilettos</option>
																			</select>
								</td>
							</tr>

							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td><a href="http://www.quickworkz.com/dev/shoe/admin/utility/foot_ware"><img src="http://www.quickworkz.com/dev/shoe/application/views/admin/images/but_add.gif" alt="*" title="click to add new" /></a></td>
							</tr>
							
							<tr><td class="height"></td></tr>							
							
							<tr style="display:none">
								<td class="tblcell31">Status</td>
								<td>
									Active <input type="radio" name="status" id="status_1" value="1" checked="checked" />

									Inactive <input type="radio" name="status" id="status_0" value="0"  />
								</td>
							</tr>							
							
							<tr>
								<td class="tblcell31">Foot Ware</td>
								<td>
									<input type="text" name="foot_ware" id="foot_ware" class="defaultWH" />
								</td>

							</tr>
							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td><input type="submit" name="submit" value="Add New" class="button" id="button" />
							    &nbsp;
                                
							    <input type="button" name="button2" value="Delete" class="button" id="button2" onclick="javascript: f();" style="display:none" />
                                &nbsp;
							    <input type="button" name="button3" value="Cancel" class="button" id="button3" onclick="javascript: window.location.reload();" /></td>
							</tr>
							
						</table>
					</form>
				</td>		
			</tr>

		</table>
		
	</div>

	
	<?php include("bottom.php"); ?>