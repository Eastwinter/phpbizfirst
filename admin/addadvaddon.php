<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

	$sql="insert into`soe_addons` set
`name`  ='".$_POST['name']."',
`price`  ='".$_POST['price']."',
`description` ='".mysql_real_escape_string($_POST['description'])."'"
;
		mysql_query($sql) or die(mysql_error());
	?>
    <script>
	location.href='showadvaddons.php';
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_addons where addonid=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
}
?>
<script type="text/javascript">
$().ready(function() {
	
	$("#register").validate({
		rules: {
			name: "required",		
			price: 
			{
				required: true,
				number: true
			},
			description: "required"
	
		},
		messages: {
			name: "<br/>Name can not be empty.",
			price: {
				required: "<br /> Price cannot be empty",
				number: "<br /> enter only numbers"
			}
		
		}
	});
	
	
	$("#submit").click(function() {
  $("#password").valid();
  $("#confirm_password").valid();
});

	
});

</script>
<div class="body" id="mk_height">
		
		<Table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Add New ADDON</td>
			</tr>
			<tr>
				<td width="100%">					
					
					<form class="form" id="register" name="register" method="post" action="" enctype="">

						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							

							<tr>
								<td width="39%" class="tblcell">Name <span>*</span></td>

						  <td width="61%"><input type="text" name="name" value="<?php echo $name; ?>" class="input_box" id="name" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Cost <span>*</span></td>
							  <td><input type="text" name="price" value="<?php echo $price; ?>" class="input_box" id="price" maxlength="250" /></td>
							</tr>
							<tr>
							  <td class="tblcell">Description:</td>
							  <td><textarea name="description" id="description" cols="75" rows="8"><?php echo $description; ?></textarea></td>
						  </tr>
							<tr>
								<td class="tblcell">&nbsp;</td>

								<td class="pb_5"><input type="submit" name="submit" value="Submit" class="button" /></td>
							</tr>
						</table>						
				  </form>
					<br class="clear" />
				</td>
			</tr>
		</table>
		
	</div>


	<?php include("bottom.php"); ?>