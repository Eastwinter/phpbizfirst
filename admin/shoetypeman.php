<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['shoe_type']=="")
	{
		$msg="Please fill shoe_type";
	}
	else
	{

		$_POST['shoe_type']=mysql_real_escape_string($_POST['shoe_type']);
		$_POST['sht_id']=intval($_POST['sht_id']);
		if(chkunique('sht_id','soe_shoe_type',$_POST['shoe_type'],$_POST['sht_id']))
			$msg="This name already exists!";
		else
		{
	
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_shoe_type set name='".$_POST['shoe_type']."',active='".$_POST['status']."' where sht_id=".$_POST['sht_id']);
		}
		else
			mysql_query("insert into soe_shoe_type set name='".$_POST['shoe_type']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="shoetypeman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
	chkdel('sht_id',$_GET['id'],'shoetypeman.php');
	mysql_query("delete from soe_shoe_type where sht_id=".$_GET['id']);
?>
<script>
location.href="shoetypeman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#sht_id").change(function () {
		var sht_id = $("#sht_id").val();		
		$.get("ajax.php?type=shoe_type&id="+sht_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			shoe_type = $("shoe_type",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#shoe_type").val(shoe_type);
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
				<td class="header">shoe_types</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="shoe_type" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">shoe_type</td>
								<td class="tblcell1">
									<select name="sht_id" id="sht_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_shoe_type order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sht_id==$row['sht_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['sht_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
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
								<td class="tblcell31">shoe_type</td>
								<td>
									<input type="text" name="shoe_type" id="shoe_type" class="defaultWH" />
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
		x=document.getElementById("sht_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("sht_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="shoetypeman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>