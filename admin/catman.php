<?php include("top.php");
$msg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['category']=="")
	{
		$msg="Please fill category";
	}
	else
	{
		$_POST['category']=mysql_real_escape_string($_POST['category']);
		$_POST['parent_id']=mysql_real_escape_string($_POST['parent_id']);
		$_POST['sch_id']=intval($_POST['shc_id']);
		if(chkunique('shc_id','soe_shoe_category',$_POST['category'],$_POST['shc_id'],$_POST['parent_id']))
			$msg="This name already exists!";
		else
		{
		if($_POST['action_type']=='edit')
		{
			mysql_query("update soe_shoe_category set name='".$_POST['category']."',active='".$_POST['status']."',parent_id='".$_POST['parent_id']."' where shc_id=".$_POST['shc_id']);
		}
		else
			mysql_query("insert into soe_shoe_category set name='".$_POST['category']."',active='".$_POST['status']."',parent_id='".$_POST['parent_id']."'");
	
?>
<script>
location.href="catman.php";
</script>
<?php
}
}
}

if($_GET['action']=='del')
{
chkdel('shc_id',$_GET['id'],'catman.php');

	mysql_query("delete from soe_shoe_category where shc_id=".$_GET['id']);
?>
<script>
location.href="catman.php";
</script>
<?php

}

?>
<script type="text/javascript">
$().ready(function() {
	
    $("select#shc_id").change(function () {
		var shc_id = $("#shc_id").val();		
		$.get("ajax.php?type=category&id="+shc_id,
		function(xml){
			assign_val(xml);
		});
		function assign_val(xml) {
			active = $("active",xml).text();
			category = $("category",xml).text();
			code = $("parent_id",xml).text();
			//alert(active);
			document.getElementById("status_"+active).checked=true;
			$("#category").val(category);
			obj=document.getElementById('parent_id');
			n=document.getElementById('parent_id').options.length;
			//alert(n);
			if(code==0)
				obj.options.selectedIndex=0;
			
			for(i=1;i<n;i++)
			{
				//alert(code);
				//alert(obj.options[i].text);
				if(obj.options[i].value==code)
					obj.options.selectedIndex=i;
			}
				
			
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
				<td class="header">Categories</td>
			</tr>
				
			<tr>
				<td width="100%">								
					
					<form name="category" method="post"action="">

						<input type="hidden" name="action_type" value="add" id="action_type" />
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell31" valign="top">Categories</td>
								<td class="tblcell1">
									<select name="shc_id" id="shc_id" size="15" class="sCatWH">									
																					
                          <?php
						   $rs=mysql_query("select * from soe_shoe_category where parent_id=0 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   ?>
                    <optgroup label="<?php echo $row['name']; ?>">
                    <?php
								 $rs1=mysql_query("select * from soe_shoe_category where parent_id=".$row['shc_id']);
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
                            
                            
                            <?php
								 $rs1=mysql_query("select * from soe_shoe_category where parent_id=0");
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
																			</select>								</td>
							</tr>

							
							<tr>
								<td class="tblcell31">&nbsp;</td>
								<td>&nbsp;</td>
						  </tr>
							
							<tr><td class="height"></td></tr>							
							
							<tr>
                              <td class="tblcell31">Status</td>
							  <td> Active
							    <input type="radio" name="status" id="status_1" value="1" checked="checked" />
							    Inactive
							    <input type="radio" name="status" id="status_0" value="0"  />
                              </td>
						  </tr>
							<tr>
                              <td class="tblcell31">Name <span>*</span></td>
							  <td><input type="text" name="category" id="category" class="defaultWH" />                              </td>
						  </tr>
							<tr>
                              <td class="tblcell31">Parent</td>
							  <td><select name="parent_id" id="parent_id">
                              <option value="0">TOP</option>
                              <?php
						   $rs=mysql_query("select * from soe_shoe_category where parent_id=0 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($parent_id==$row['shc_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['shc_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
                            <?php
							}
							?>
							    </select>							  </td>
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
		x=document.getElementById("shc_id").options.selectedIndex;
		if(x>=0)
		{
			v=document.getElementById("shc_id").options[x].value;
			
			if(v>0)
			{
				ans=confirm("Are you sure to delete?");
				if(ans==true)
					location.href="catman.php?action=del&id="+v;
			}
		}
		else
			alert("Please select a value to delete");
	}
	</script>
	<?php include("bottom.php"); ?>