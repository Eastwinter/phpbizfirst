<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['color']=="")
	{
		$msg="Please fill color";
	}
	else
	{
		$_POST['color']=mysql_real_escape_string($_POST['color']);
		$_POST['color_code']=mysql_real_escape_string($_POST['color_code']);
		$_POST['col_id']=intval($_POST['col_id']);
		if(chkunique('col_id','soe_color',$_POST['color'],$_POST['col_id']))
			$msg="This name already exists!";
		else
		{
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_color set name='".$_POST['color']."',active='".$_POST['status']."',code='".$_POST['color_code']."' where col_id=".$_POST['col_id']);
		}
		else
			mysql_query("insert into soe_color set name='".$_POST['color']."',active='".$_POST['status']."',code='".$_POST['color_code']."'");
	
?>
<script>
location.href="colorman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
chkdel('col_id',$_GET['id'],'colorman.php');

	mysql_query("delete from soe_color where col_id=".$_GET['id']);
?>
<script>
location.href="colorman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#col_id").change(function () {
		var col_id = $("#col_id").val();		
		$.get("ajax.php?type=color&id="+col_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			color = $("color",xml).text();
			code = $("code",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#color").val(color);
			$("#color_code").val(code);
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
				<td class="header">Colors</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="color" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">Colors</td>
								<td class="tblcell1">
									<select name="col_id" id="col_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_color order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($col_id==$row['col_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['col_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
                            <?php
							}
							?>
																			</select>								</td>
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

									Inactive <input type="radio" name="status" id="status_0" value="0"  />								</td>
							</tr>
							<tr>
                              <td class="tblcell31">Color <span>*</span></td>
							  <td><input type="text" name="color" id="color" class="defaultWH" />                              </td>
						  </tr>
							<tr>
                              <td class="tblcell31">Color Code</td>
							  <td><input type="text" name="color_code" id="color_code" class="defaultWH" />                              </td>
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
		x=document.getElementById("col_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("col_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="colorman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>