<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['shoe_size']=="")
	{
		$msg="Please fill shoe_size";
	}
	else
	{
		$_POST['shoe_size']=mysql_real_escape_string($_POST['shoe_size']);
		$_POST['siz_id']=intval($_POST['siz_id']);
		$_POST['shc_id']=intval($_POST['shc_id']);
		if(chkunique('siz_id','soe_shoe_size',$_POST['shoe_size'],$_POST['siz_id']))
			$msg="This name already exists!";
		else
		{
	
	
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_shoe_size set name='".$_POST['shoe_size']."',active='".$_POST['status']."',shc_id=".$_POST['shc_id']." where siz_id=".$_POST['siz_id']);
		}
		else
			mysql_query("insert into soe_shoe_size set name='".$_POST['shoe_size']."',active='".$_POST['status']."',shc_id=".$_POST['shc_id']."");
	
?>
<script>
location.href="shoesizeman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
	chkdel('siz_id',$_GET['id'],'shoesizeman.php');
	mysql_query("delete from soe_shoe_size where siz_id=".$_GET['id']);
?>
<script>
location.href="shoesizeman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#siz_id").change(function () {
		var siz_id = $("#siz_id").val();		
		$.get("ajax.php?type=shoe_size&id="+siz_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			shoe_size = $("shoe_size",xml).text();
			shc_id = $("shc_id",xml).text();
			document.getElementById("status_"+active).checked=true;
			$("#shoe_size").val(shoe_size);
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
				<td class="header">shoe_sizes</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="shoe_size" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">shoe_size</td>
								<td class="tblcell1">
                                
                                
                                <select name="siz_id" id="siz_id" size="15" class="sCatWH">									
																					
                          <?php
						   $rs=mysql_query("select * from soe_shoe_category where shc_id in (select shc_id from soe_shoe_size) order by name");
						   while($row=mysql_fetch_array($rs))
						   {
		  								   $rs2=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
										   $row2=mysql_fetch_array($rs2);
						   ?>
                    <optgroup label="<?php echo $row2['name']; ?> - <?php echo $row['name']; ?>">
                    <?php
								 $rs1=mysql_query("select * from soe_shoe_size where shc_id=".$row['shc_id']);
						   			while($row1=mysql_fetch_array($rs1))
						  			 {
									 	if($siz_id==$row1['siz_id'])
											$c='selected';
										else
											$c='';
						   	?>
                    <option value="<?php echo $row1['siz_id']; ?>" <?php echo $c; ?> ><?php echo $row1['name']; ?></option>
                    <?php
									}
							?>
                    </optgroup>
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

									Inactive <input type="radio" name="status" id="status_0" value="0"  />								</td>
							</tr>							
							
							<tr>
								<td class="tblcell31">shoe_size</td>
								<td>
									<input type="text" name="shoe_size" id="shoe_size" class="defaultWH" />								</td>
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
									 	if($_POST['shc_id']==$row1['shc_id'])
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
		x=document.getElementById("siz_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("siz_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete ?");
				if(ans==true)
					location.href="shoesizeman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>