<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['languages_spoken']=="")
	{
		$msg="Please fill languages_spoken";
	}
	else
	{
		$_POST['languages_spoken']=mysql_real_escape_string($_POST['languages_spoken']);
		$_POST['las_id']=intval($_POST['las_id']);
		if(chkunique('las_id','soe_lan_spoken',$_POST['languages_spoken'],$_POST['las_id']))
			$msg="This name already exists!";
		else
		{
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_lan_spoken set name='".$_POST['languages_spoken']."',active='".$_POST['status']."' where las_id=".$_POST['las_id']);
		}
		else
			mysql_query("insert into soe_lan_spoken set name='".$_POST['languages_spoken']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="languagesspokenman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
	mysql_query("delete from soe_lan_spoken where las_id=".$_GET['id']);
?>
<script>
location.href="languagesspokenman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#las_id").change(function () {
		var las_id = $("#las_id").val();		
		$.get("ajax.php?type=languages_spoken&id="+las_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			languages_spoken = $("languages_spoken",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#languages_spoken").val(languages_spoken);
			$("#button").val("Update");
			document.getElementById("button2").style.display="inline-block";

			$("#action_type").val("edit");
		}
	});
	
});
</script>

	
	<div class="body" id="mk_height">
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				<div class="container">	
<?php
if($msg!="")
{
?>	
                
<div id="object" class="message_box">
		<span class="err"><?php echo $msg; ?></span>
</div>
<?php
}
?>	
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">languages_spokens</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="languages_spoken" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">languages_spoken</td>
								<td class="tblcell1">
									<select name="las_id" id="las_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_lan_spoken order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($las_id==$row['las_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['las_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
                            <?php
							}
							?>
																			</select>
								</td>
							</tr>

							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td>&nbsp;</td>
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
								<td class="tblcell31">languages_spoken</td>
								<td>
									<input type="text" name="languages_spoken" id="languages_spoken" class="defaultWH" />
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

	<script>
	function f()
	{
		x=document.getElementById("las_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("las_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="languagesspokenman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>