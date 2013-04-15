<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

		$sql="update`soe_packages` set
`code` ='".$_POST['code']."',
`name`  ='".$_POST['name']."',
`shoes`  ='".$_POST['shoes']."',
`shoeprice`  ='".$_POST['shoeprice']."',
`stores`  ='".$_POST['stores']."',
`location`  ='".$_POST['location']."',
`adspot` ='".$_POST['adspot']."' ,
`price`  ='".$_POST['price']."',
`addstoresamestate` ='".$_POST['addstoresamestate']."' ,
`addstorediffstate` ='".$_POST['addstorediffstate']."' ,
`addlocation` ='".$_POST['addlocation']."' ,
`description` ='".mysql_real_escape_string($_POST['description'])."' 
where packageid=".$_GET['id']."
"
;
		mysql_query($sql) or die(mysql_error());
	?>
    <script>
	location.href='showadvpackages.php';
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_packages where packageid=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
}
?>
<script type="text/javascript">
$().ready(function() {
	
	$("#register").validate({
		rules: {
			code: "required",		
			name: "required",		
			price: 
			{
				required: true,
				number: true
			},
			shoes:  
			{
				required: true,
				number: true
			},		
			shoeprice:  
			{
				required: true,
				number: true
			},		
			stores: {
				required: true,
				number: true
			},
			location: "required",		
			adspot: "required",		
			addstoresamestate:  
			{
				required: true,
				number: true
			},
			addstorediffstate: 
			{
				required: true,
				number: true
			},		
			addlocation:  
			{
				required: true,
				number: true
			}		
		},
		messages: {
			code: "<br/>Code can not be empty.",
			name: "<br/>Name can not be empty.",
			price: {
				required: "<br /> Price cannot be empty",
				number: "<br /> enter only numbers"
			},
			shoes: {
				required: "<br /> No. Of shoes cannot be empty",
				number: "<br /> enter only numbers"
			},
			shoeprice: {
				required: "<br /> Shoe Price cannot be empty",
				number: "<br /> enter only numbers"
			},
			stores:{
				required: "<br /> No. of stores cannot be empty",
				number: "<br /> enter only numbers"
			},
			location: {
				required: "<br /> No. of locations cannot be empty",
				number: "<br /> enter only numbers"
			},
			adspot: "<br/>Ad Spot can not be empty.",
			addstoresamestate: {
				required: "<br /> Price for additional store same state cannot be empty",
				number: "<br /> enter only numbers"
			},
			addstorediffstate: {
				required: "<br /> Price for additional store diff state cannot be empty",
				number: "<br /> enter only numbers"
			},
			addlocation: {
				required: "<br /> Price for new location cannot be empty",
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
				<td class="header">Edit Package</td>
			</tr>
			<tr>
				<td width="100%">					
					
					<form class="form" id="register" name="register" method="post" action="" enctype="">

						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td width="39%" height="23" class="tblcell">Code<span>*</span></td>
							  <td width="61%"><input type="text" name="code" value="<?php echo $code; ?>" class="input_box" id="code" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Name <span>*</span></td>

						  <td><input type="text" name="name" value="<?php echo $name; ?>" class="input_box" id="name" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Cost <span>*</span></td>
							  <td><input type="text" name="price" value="<?php echo $price; ?>" class="input_box" id="price" maxlength="250" /></td>
							</tr>
							

							<tr>
								<td class="tblcell">No. of Stores</td>
								<td><input type="text" name="stores" value="<?php echo $stores; ?>" class="input_box" id="stores" maxlength="250" readonly="readonly" /></td>
							</tr>
							
							<tr>
                              <td class="tblcell">No. of Locations</td>
							  <td><input type="text" name="location" value="<?php echo $location; ?>" class="input_box" id="location" maxlength="250" /></td>
						  </tr>
							<tr>
								<td class="tblcell">No. of Shoes</td>
								<td><input type="text" name="shoes" value="<?php echo $shoes; ?>" class="input_box" id="shoes" maxlength="250" /></td>
							</tr>
							<tr>
                              <td class="tblcell">Shoe Price Limit</td>
							  <td><input type="text" name="shoeprice" value="<?php echo $shoeprice; ?>" class="input_box" id="shoeprice" maxlength="250" /></td>
						  </tr>
							<tr>
                              <td class="tblcell">Ad Spot</td>
							  <td><input type="text" name="adspot" value="<?php echo $adspot; ?>" class="input_box" id="adspot" maxlength="250" />
						      <br />
(give values 1-3 or 4 or 0) 1-3 rotates between rows 1 and 3, 4 means only on 4 and 0 means below 4</td>
						  </tr>
							<tr>
                              <td class="tblcell">Price for additional Store in same state</td>
							  <td><input type="text" name="addstoresamestate" value="<?php echo $addstoresamestate; ?>" class="input_box" id="addstoresamestate" maxlength="250" /></td>
						  </tr>
							<tr>
                              <td class="tblcell">Price for additional Store in different state</td>
							  <td><input type="text" name="addstorediffstate" value="<?php echo $addstorediffstate; ?>" class="input_box" id="addstorediffstate" maxlength="250" /></td>
						  </tr>
							
							<tr>
                              <td class="tblcell">Price for additional Location</td>
							  <td><input type="text" name="addlocation" value="<?php echo $addlocation; ?>" class="input_box" id="addlocation" maxlength="250" /></td>
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