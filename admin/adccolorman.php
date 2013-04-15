<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['advcolor']=="")
	{
		$msg="Please fill advcolor";
	}
	else
	{
		$_POST['advcolor']=mysql_real_escape_string($_POST['advcolor']);
		$_POST['advcol_id']=intval($_POST['advcol_id']);
		if(chkunique('advcol_id','soe_advcolor',$_POST['advcolor'],$_POST['advcol_id']))
			$msg="This name already exists!";
		else
		{
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_advcolor set name='".$_POST['advcolor']."',active='".$_POST['status']."' where advcol_id=".$_POST['advcol_id']);
		}
		else
			mysql_query("insert into soe_advcolor set name='".$_POST['advcolor']."',active='".$_POST['status']."'");
	
?>
<script>
location.href="adccolorman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
chkdel('advcol_id',$_GET['id'],'adccolorman.php');
mysql_query("delete from soe_advcolor where advcol_id=".$_GET['id']);
?>
<script>
location.href="adccolorman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#advcol_id").change(function () {
		var advcol_id = $("#advcol_id").val();		
		$.get("ajax.php?type=advcolor&id="+advcol_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			advcolor = $("advcolor",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#advcolor").val(advcolor);
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
				<td class="header">Advance Color Options</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="advcolor" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">Option</td>
								<td class="tblcell1">
									<select name="advcol_id" id="advcol_id" size="15" class="sCatWH">									
																					
                             <?php
						   $rs=mysql_query("select * from soe_advcolor order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($advcol_id==$row['advcol_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['advcol_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
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
								<td class="tblcell31">Option</td>
								<td>
									<input type="text" name="advcolor" id="advcolor" class="defaultWH" />
								</td>

							</tr>
							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td><input type="submit" name="submit" value="Add New" class="button" id="button" />
							    &nbsp;
                                
							    <input type="button" name="button2" value="Delete" class="button" id="button2" onclick="javascript: f();" style="display:none" />
                                &nbsp;
							    <input type="button" name="button3" value="Cancel" class="button" id="button3" onclick="javascript: window.location.reload();" />
							    </td>
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
		x=document.getElementById("advcol_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("advcol_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="adccolorman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>