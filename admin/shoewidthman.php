<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['shoe_width']=="")
	{
		$msg="Please fill shoe_width";
	}
	else
	{
		$_POST['shoe_width']=mysql_real_escape_string($_POST['shoe_width']);
		$_POST['shw_id']=intval($_POST['shw_id']);
		$_POST['shc_id']=intval($_POST['shc_id']);
		
	//	if(chkunique('shw_id','soe_shoe_width',$_POST['shoe_width'],$_POST['shw_id']))
	//		$msg="This name already exists!";
		//else
	//	{
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_shoe_width set name='".$_POST['shoe_width']."',active='".$_POST['status']."',shc_id=".$_POST['shc_id']." where shw_id=".$_POST['shw_id']);
		}
		else
			mysql_query("insert into soe_shoe_width set name='".$_POST['shoe_width']."',active='".$_POST['status']."',shc_id=".$_POST['shc_id']."");
	
?>
<script>
location.href="shoewidthman.php";
</script>
<?php
//}
}
}

if($_GET['action']=='del')
{
		chkdel('shw_id',$_GET['id'],'shoewidthman.php');

	mysql_query("delete from soe_shoe_width where shw_id=".$_GET['id']);
?>
<script>
location.href="shoewidthman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#shw_id").change(function () {
		var shw_id = $("#shw_id").val();		
		$.get("ajax.php?type=shoe_width&id="+shw_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			shoe_width = $("shoe_width",xml).text();
			shc_id = $("shc_id",xml).text();
			
			document.getElementById("status_"+active).checked=true;
			$("#shoe_width").val(shoe_width);
			$("#button").val("Update");
			document.getElementById("button2").style.display="inline-block";

			$("#action_type").val("edit");
						obj=document.getElementById('shc_id');
			n=document.getElementById('shc_id').options.length;
			//alert(n);
			if(shc_id==0)
				obj.options.selectedIndex=0;
			
			for(i=1;i<n;i++)
			{
				//alert(shc_id);
				//alert(obj.options[i].value);
				if(obj.options[i].value==shc_id)
					obj.options.selectedIndex=i;
			}
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
				<td class="header">shoe_widths</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="shoe_width" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">shoe_width</td>
								<td class="tblcell1">
                                
                                <select name="shw_id" id="shw_id" size="15" class="sCatWH">									
																					
                          <?php
						   $rs=mysql_query("select * from soe_shoe_category where shc_id in (select shc_id from soe_shoe_width) order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						    $rs2=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
										   $row2=mysql_fetch_array($rs2);
						   ?>
                    <optgroup label="<?php echo $row2['name']; ?> - <?php echo $row['name']; ?>">
                    <?php
								 $rs1=mysql_query("select * from soe_shoe_width where shc_id=".$row['shc_id']);
						   			while($row1=mysql_fetch_array($rs1))
						  			 {
									 	if($shw_id==$row1['shw_id'])
											$c='selected';
										else
											$c='';
						   	?>
                    <option value="<?php echo $row1['shw_id']; ?>" <?php echo $c; ?> ><?php echo $row1['name']; ?></option>
                    <?php
									}
							?>
                    </optgroup>
                    <?php
							}
							?>
                            
                            
                           
																			</select>
                                
                                
								
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
								<td class="tblcell31">shoe_width</td>
								<td>
									<input type="text" name="shoe_width" id="shoe_width" class="defaultWH" />								</td>
							</tr>
							<tr>
                              <td class="tblcell31">Shoe Category</td>
							  <td><select id="shc_id" name="shc_id" style="width:120px;">
                                  <option selected="selected" value="">Select....</option>
                                  <?php
						   $rs=mysql_query("select * from soe_shoe_category where active=1 and parent_id=0 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   ?>
                                  <optgroup label="<?php echo $row['name']; ?>">
                                  <?php
								 $rs1=mysql_query("select * from soe_shoe_category where active=1 and parent_id=".$row['shc_id']);
						   			while($row1=mysql_fetch_array($rs1))
						  			 {
									 	if($shc_id==$row1['shc_id'])
											$c='selected';
										else
											$c='';
						   	?>
                                  <option value="<?php echo $row1['shc_id']; ?>" <?php echo $c; ?> ><?php echo $row1['name']; ?></option>
                                  <?php
									}
							?>
                                  </optgroup>
                                  <?php
							}
							?>
                              </select></td>
						  </tr>
							
							<tr>
							  <td class="tblcell31">&nbsp;</td>
							  <td>&nbsp;</td>
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
		x=document.getElementById("shw_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("shw_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="shoewidthman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>