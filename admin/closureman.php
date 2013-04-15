<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['closure']=="")
	{
		$msg="Please fill closure";
	}
	else
	{
		$_POST['closure']=mysql_real_escape_string($_POST['closure']);
		$_POST['clo_id']=intval($_POST['clo_id']);
		if(chkunique('clo_id','soe_closure',$_POST['closure'],$_POST['clo_id']))
			$msg="This name already exists!";
		else
		{
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_closure set name='".$_POST['closure']."',active='".$_POST['status']."' where clo_id=".$_POST['clo_id']);
		}
		else
			mysql_query("insert into soe_closure set name='".$_POST['closure']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="closureman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
	chkdel('clo_id',$_GET['id'],'closureman.php');
	mysql_query("delete from soe_closure where clo_id=".$_GET['id']);
?>
<script>
location.href="closureman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#clo_id").change(function () {
		var clo_id = $("#clo_id").val();		
		$.get("ajax.php?type=closure&id="+clo_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			closure = $("closure",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#closure").val(closure);
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
				<td class="header">closures</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="closure" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">closure</td>
								<td class="tblcell1">
									<select name="clo_id" id="clo_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_closure order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($clo_id==$row['clo_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['clo_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
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
								<td class="tblcell31">closure</td>
								<td>
									<input type="text" name="closure" id="closure" class="defaultWH" />
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
		x=document.getElementById("clo_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("clo_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="closureman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>