<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['season']=="")
	{
		$msg="Please fill season";
	}
	else
	{
		$_POST['season']=mysql_real_escape_string($_POST['season']);
		$_POST['sea_id']=intval($_POST['sea_id']);
		if(chkunique('sea_id','soe_season',$_POST['season'],$_POST['sea_id']))
			$msg="This name already exists!";
		else
		{
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_season set name='".$_POST['season']."',active='".$_POST['status']."' where sea_id=".$_POST['sea_id']);
		}
		else
			mysql_query("insert into soe_season set name='".$_POST['season']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="seasonman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
	
chkdel('sea_id',$_GET['id'],'seasonman.php');
mysql_query("delete from soe_season where sea_id=".$_GET['id']);
?>
<script>
location.href="seasonman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#sea_id").change(function () {
		var sea_id = $("#sea_id").val();		
		$.get("ajax.php?type=season&id="+sea_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			season = $("season",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#season").val(season);
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
				<td class="header">seasons</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="season" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">season</td>
								<td class="tblcell1">
									<select name="sea_id" id="sea_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_season order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sea_id==$row['sea_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['sea_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
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
								<td class="tblcell31">season</td>
								<td>
									<input type="text" name="season" id="season" class="defaultWH" />
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
		x=document.getElementById("sea_id").options.selectedIndex;
		//alert(x);
		if(x>=0)
		{
			v=document.getElementById("sea_id").options[x].value;
		//	alert(v);
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="seasonman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>