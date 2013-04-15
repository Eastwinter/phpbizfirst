<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['heel_height']=="")
	{
		$msg="Please fill heel_height";
	}
	else
	{
		$_POST['heel_height']=mysql_real_escape_string($_POST['heel_height']);
		$_POST['hlh_id']=intval($_POST['hlh_id']);
		if(chkunique('hlh_id','soe_heel_height',$_POST['heel_height'],$_POST['hlh_id']))
			$msg="This name already exists!";
		else
		{
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_heel_height set name='".$_POST['heel_height']."',active='".$_POST['status']."' where hlh_id=".$_POST['hlh_id']);
		}
		else
			mysql_query("insert into soe_heel_height set name='".$_POST['heel_height']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="heelheightman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
		chkdel('hlh_id',$_GET['id'],'heelheightman.php');

	mysql_query("delete from soe_heel_height where hlh_id=".$_GET['id']);
?>
<script>
location.href="heelheightman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#hlh_id").change(function () {
		var hlh_id = $("#hlh_id").val();		
		$.get("ajax.php?type=heel_height&id="+hlh_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			heel_height = $("heel_height",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#heel_height").val(heel_height);
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
				<td class="header">heel_heights</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="heel_height" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">heel_height</td>
								<td class="tblcell1">
									<select name="hlh_id" id="hlh_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_heel_height order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($hlh_id==$row['hlh_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['hlh_id']; ?>" <?php echo $c; ?>><?php echo str_replace('""','',stripslashes($row['name'])); ?></option>
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
								<td class="tblcell31">heel_height</td>
								<td>
									<input type="text" name="heel_height" id="heel_height" class="defaultWH" />
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
		x=document.getElementById("hlh_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("hlh_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="heelheightman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>