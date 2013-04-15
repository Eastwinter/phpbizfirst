<?php include("header.php"); 

if($_SERVER['REQUEST_METHOD']=="POST")
{

if($_GET['stoid']=='')
	$_GET['stoid']=0;
if(mysql_real_escape_string($_POST['shoe_lace'])=='')
	$_POST['shoe_lace']='0';
if($_GET['id']>0)
{

$sql="update soe_shoe set
`mem_id`='".$_SESSION['memberid']."' ,
`name`='".mysql_real_escape_string($_POST['shoe_name'])."',
`description`='".mysql_real_escape_string($_POST['description'])."',
`link` ='".mysql_real_escape_string($_POST['link'])."',
		`cnt_id`='".mysql_real_escape_string($_POST['con_id'])."', 
		`sta_id`='".mysql_real_escape_string($_POST['sta_id'])."', 
		`cty_id`='".mysql_real_escape_string($_POST['cty_id'])."', 
		`zip_code`='".mysql_real_escape_string($_POST['zip_code'])."', 
`brn_id` ='".mysql_real_escape_string($_POST['brn_id'])."',
`fot_id` ='".mysql_real_escape_string($_POST['fot_id'])."',
`col_id` ='".mysql_real_escape_string($_POST['col_id'])."',
`mtr_id` ='".mysql_real_escape_string($_POST['mtr_id'])."',
`hlh_id` ='".mysql_real_escape_string($_POST['hlh_id'])."',
`hls_id` ='".mysql_real_escape_string($_POST['hls_id'])."',
`sol_id` ='".mysql_real_escape_string($_POST['sol_id'])."',
`clo_id` ='".mysql_real_escape_string($_POST['clo_id'])."',
`lace` ='".mysql_real_escape_string($_POST['shoe_lace'])."',
`siz_id` ='".mysql_real_escape_string($_POST['siz_id'])."',
`sht_id` ='".mysql_real_escape_string($_POST['sht_id'])."',
`shw_id` ='".mysql_real_escape_string($_POST['shw_id'])."',
`sea_id` ='".mysql_real_escape_string($_POST['sea_id'])."',
`price` ='".mysql_real_escape_string($_POST['price'])."',
`shc_id`='".mysql_real_escape_string($_POST['shc_id'])."' where soe_id=".$_GET['id'];
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);

$id=$_GET['id'];
}
else
{

$sql="INSERT INTO soe_shoe set
`mem_id`='".$_SESSION['memberid']."' ,
`name`='".mysql_real_escape_string($_POST['shoe_name'])."',
`description`='".mysql_real_escape_string($_POST['description'])."',
`link` ='".mysql_real_escape_string($_POST['link'])."',
		`cnt_id`='".mysql_real_escape_string($_POST['con_id'])."', 
		`sta_id`='".mysql_real_escape_string($_POST['sta_id'])."', 
		`cty_id`='".mysql_real_escape_string($_POST['cty_id'])."', 
		`zip_code`='".mysql_real_escape_string($_POST['zip_code'])."', 
`brn_id` ='".mysql_real_escape_string($_POST['brn_id'])."',
`fot_id` ='".mysql_real_escape_string($_POST['fot_id'])."',
`col_id` ='".mysql_real_escape_string($_POST['col_id'])."',
`mtr_id` ='".mysql_real_escape_string($_POST['mtr_id'])."',
`hlh_id` ='".mysql_real_escape_string($_POST['hlh_id'])."',
`hls_id` ='".mysql_real_escape_string($_POST['hls_id'])."',
`sol_id` ='".mysql_real_escape_string($_POST['sol_id'])."',
`clo_id` ='".mysql_real_escape_string($_POST['clo_id'])."',
`lace` ='".mysql_real_escape_string($_POST['shoe_lace'])."',
`siz_id` ='".mysql_real_escape_string($_POST['siz_id'])."',
`sht_id` ='".mysql_real_escape_string($_POST['sht_id'])."',
`shw_id` ='".mysql_real_escape_string($_POST['shw_id'])."',
`price` ='".mysql_real_escape_string($_POST['price'])."',
`sea_id` ='".mysql_real_escape_string($_POST['sea_id'])."',
`active` ='0',sto_id='".$_GET['stoid']."',
`added` ='".strtotime(date("Y-m-d"))."',
`shc_id`='".mysql_real_escape_string($_POST['shc_id'])."'";

mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
$id=mysql_insert_id();
}		

if($_GET['id']>0)
{
?>
<script>
location.href='memshoes.php';
</script>
<?php							
}
else
{
?>
<script>
location.href='addshoecolor.php?soeid=<?php echo $id; ?>';
</script>
<?php
}
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);

?>

				
	<script type="text/javascript">
$().ready(function() {
	
	$("#add_shoe").validate({
		rules: {
			shoe_name: "required",
			description: "required",
			price: 
			{
			required: true,
			number: true
			}
		},
		messages: {
			shoe_name: "<br/>Shoe Name can not be empty.",
			description: "<br/>Description can not be empty.",
			price: {
			required: "<br /> Price cannot be empty",
			number: "<br /> Price should be a number"
			}
			
		}
	});
	
});
</script>			
<?php
}
else
{
?>

	<script type="text/javascript">
$().ready(function() {
	
	$("#add_shoe").validate({
		rules: {
			shoe_name: "required",
			description: "required",
			price: 
			{
			required: true,
			number: true
			}
		},
		messages: {
			shoe_name: "<br/>Shoe Name can not be empty.",
			description: "<br/>Description can not be empty.",
			price: {
			required: "<br /> Price cannot be empty",
			number: "<br /> Price should be a number"
			}
		}
	});
	
});
</script>			


<?php
}
?>	
  <?php include("left2.php"); ?>
  <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="cty_id" id="cty_id" value="<?php echo $cty_id; ?>" />
  <div id="content_area_mid_inner">
    <div>
      <h2>Add/Edit Shoes</h2>
    </div>
    <div class="border1">
      <div class="search_lable_innerpage">Name*</div>
      <div class="search_txtbox_innerpage">
        <input name="shoe_name" type="text" class="txt_box1" id="shoe_name" value="<?php echo $name; ?>" size="35">
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Product Description*</div>
      <div class="search_txtbox_innerpage">
        <textarea name="description" cols="32" rows="5" class="txt_box1" id="description"><?php echo $description; ?></textarea>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Link</div>
      <div class="search_txtbox_innerpage">
        <input name="link" type="text" class="txt_box1" id="link" value="<?php echo $link; ?>" size="35">
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Price</div>
      <div class="search_txtbox_innerpage">
        <input name="price" type="text" class="txt_box1" id="price" value="<?php echo $price; ?>" size="35">
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Country</div>
      <div class="search_txtbox_innerpage">
        <select name="con_id" class="txt_box1" id="con_id">
          <option selected="selected" value="">-- Select --</option>
          
                    <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($cnt_id==$row['con_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['con_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">State</div>
      <div class="search_txtbox_innerpage">
        <select name="sta_id" class="txt_box1" id="sta_id">
          <option>-- Select --</option>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">City</div>
      <div class="search_txtbox_innerpage">
      <?php
                 	mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());
  if($_GET['id']>0)
  {
  			if($cty_id>0)
			{
	  		$n="select * from soe_geo_cities WHERE con_id=".$cnt_id." AND sta_id=".$sta_id." and cty_id=".$cty_id." order by name";
		   $rscity=mysql_query($n);
		   $rowcity=mysql_fetch_array($rscity);
		   $cityname=$rowcity['name'];
		   }
		   else
		   	$cityname='';
}
		?>
        <input autocomplete="off" name="city" type="text" class="txt_box1" size="35" id="city" value="<?php echo $cityname; ?>">
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Zip Code</div>
      <div class="search_txtbox_innerpage">
        <input name="zip_code" type="text" class="txt_box1" id="zip_code" value="<?php echo $zip_code; ?>" size="35">
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Brand</div>
      <div class="search_txtbox_innerpage">
        <select name="brn_id" class="txt_box1" id="brn_id">
          
           <option selected="selected" value="">-- Select --</option>
                    <?php
						   $rs=mysql_query("select * from soe_brand where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   if($brn_id==$row['brn_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['brn_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Category</div>
      <div class="search_txtbox_innerpage">
        <select name="shc_id" class="txt_box1" id="shc_id">
          <option selected="selected" value="">-- Select --</option>
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
                    <option value="<?php echo $row1['shc_id']; ?>" <?php echo $c; ?> ><span class="input"><?php echo $row1['name']; ?></span></option>
                    <?php
									}
							?>
                    </optgroup>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Footware</div>
      <div class="search_txtbox_innerpage">
        <select name="fot_id" class="txt_box1" id="fot_id">
          <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_foot_ware order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($fot_id==$row['fot_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['fot_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Material</div>
      <div class="search_txtbox_innerpage">
        <select name="mtr_id" class="txt_box1" id="mtr_id">
          <option selected="selected" value="">-- Select --</option>
          <?php
						   $rs=mysql_query("select * from soe_material order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($mtr_id==$row['mtr_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['mtr_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                     <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Heel Height</div>
      <div class="search_txtbox_innerpage">
        <select name="hlh_id" class="txt_box1" id="hlh_id">
          <option selected="selected" value="">-- Select --</option>
          
           <?php
						   $rs=mysql_query("select * from soe_heel_height order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($hlh_id==$row['hlh_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['hlh_id']; ?>" <?php echo $c; ?> ><?php echo str_replace('""','',$row['name']); ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Heel Size</div>
      <div class="search_txtbox_innerpage">
        <select name="hls_id" class="txt_box1" id="hls_id">
          <option selected="selected" value="">-- Select --</option>
           <?php
						   $rs=mysql_query("select * from soe_heel_size order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($hls_id==$row['hls_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['hls_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Type of Sole</div>
      <div class="search_txtbox_innerpage">
        <select name="sol_id" class="txt_box1" id="sol_id">
          <option selected="selected" value="">-- Select --</option>
          <?php
						   $rs=mysql_query("select * from soe_sole_type order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sol_id==$row['sol_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['sol_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Type of Closure</div>
      <div class="search_txtbox_innerpage">
        <select name="clo_id" class="txt_box1" id="clo_id">
<option selected="selected" value="">-- Select --</option>
<?php
						   $rs=mysql_query("select * from soe_closure order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($clo_id==$row['clo_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['clo_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Shoe Lace</div>
      <div class="search_txtbox_innerpage">
        Yes
                    <input name="shoe_lace" value="1" type="radio" <?php if($lace=='1') { ?> checked="checked" <?php } ?>  />
No
<input name="shoe_lace" value="0" type="radio" <?php if($lace=='0') { ?> checked="checked" <?php } ?>  /></div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Shoe Size</div>
      <div class="search_txtbox_innerpage">
        <select name="siz_id" class="txt_box1" id="siz_id">
          <option selected="selected" value="">-- Select --</option>
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
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Shoe Type</div>
      <div class="search_txtbox_innerpage">
        <select name="sht_id" class="txt_box1" id="sht_id">
          <option selected="selected" value="">-- Select --</option>
          <?php
						   $rs=mysql_query("select * from soe_shoe_type order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sht_id==$row['sht_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['sht_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Shoe Width</div>
      <div class="search_txtbox_innerpage">
        <select name="shw_id" class="txt_box1" id="shw_id">
          <option selected="selected" value="">-- Select --</option>
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
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage">Season</div>
      <div class="search_txtbox_innerpage">
        <select name="sea_id" class="txt_box1" id="sea_id">
          <option selected="selected" value="">-- Select --</option>
          <?php
						   $rs=mysql_query("select * from soe_season order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sea_id==$row['sea_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['sea_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
        </select>
      </div>
      <div class="clear"></div>
      <div class="search_lable_innerpage"></div>
      <div class="search_txtbox_innerpage"><input type="image" src="images/blue_submit_button.jpg" alt="" name="submit"></div>
      <div class="clear"></div>
    </div>
  </div>
  </form>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
   <script>
$(document).ready(function() {
    $("select#con_id").trigger('change');
	});
	
</script>
<?php include("footer.php"); ?>