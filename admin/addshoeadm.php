<?php
include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
if(mysql_real_escape_string($_POST['shoe_lace'])=='')
	$_POST['shoe_lace']='0';

if($_GET['stoid']=='')
	$_GET['stoid']=0;
if($_GET['id']>0)
{

$sql="update soe_shoe set
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
`shc_id`='".mysql_real_escape_string($_POST['shc_id'])."',price='".$_POST['price']."' where soe_id=".$_GET['id'];
//die($sql);
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);

$id=$_GET['id'];
}
else
{

$sql="INSERT INTO soe_shoe set
`mem_id`=1 ,
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
`active` ='0',sto_id='".$_GET['stoid']."',
`added` ='".strtotime(date("Y-m-d"))."',
`shc_id`='".mysql_real_escape_string($_POST['shc_id'])."',price='".$_POST['price']."'";

mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
$id=mysql_insert_id();

}
if($_GET['id']>0)
{
?>
<script>
location.href='shoecolors.php?soeid=<?php echo $id; ?>';
</script>
<?php							

}
else
{		
?>
<script>
location.href='addshoecolors.php?soeid=<?php echo $id; ?>';
</script>
<?php							
}
}
?>
<link rel="stylesheet" href="style1.css" type="text/css" />

<script type="text/javascript" src="autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" media="screen" href="autocomplete/jquery.autocomplete.css">


<?php
if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);

?>
	


	
<script>

	
	
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
			price: 
			{
				required: "<br /> Price cannot be empty",
				number: "<br /> enter only numbers"
			}
		}
	});
	
});
</script>			


<?php
}
?>	
<script type="text/javascript">
function findCity(li)
{
	if( li == null ) 
		return alert("No match!");
	if( !!li.extra ) 
		var sValue = li.extra[0];
	else 
		var sValue = li.selectValue;	
	$("#cty_id").val(sValue);
}
function selectCity(li)
{
	findCity(li);
}
function formatItem(row)
{
	return row[0];
}

$(document).ready(function() {
    $("select#con_id").change(function () {		
		$('#sta_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var con_id = $("#con_id").val();		
		$.get("populatestate.php?con_id="+con_id,
		function(xml){
			$('#sta_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("states",xml).each(function(id) {
				states = $("states",xml).get(id);	
				x='<?php echo $sta_id; ?>';
				if($("sta_id",states).text()==x)
					c='selected';
				else
					c='';
				result = '<option value="'+$("sta_id",states).text()+'" ' + c + '>'+$("name",states).text()+'</option>'
				$("#sta_id").append(result);
			});
		});
	});	
	$("#city").autocomplete("populatecity.php",
		{
			delay:10,
			minChars:2,
			matchSubset:1,
			matchContains:1,
			onItemSelect:selectCity,
			onFindValue:findCity,
			formatItem:formatItem,
			extraParams:{con_id:function() { return $("#con_id").val(); },sta_id:function() { return $("#sta_id").val(); }}
		}
	);
	
	
	    $("select#shc_id").change(function () {		
		$('#siz_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		$('#shw_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var shc_id = $("#shc_id").val();		
		$.get("populatesize.php?shc_id="+shc_id,
		function(xml){
			$('#siz_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("size",xml).each(function(id) {
				size = $("size",xml).get(id);				
				result = '<option value="'+$("siz_id",size).text()+'">'+$("name",size).text()+'</option>'
				$("#siz_id").append(result);
			});
		});
		
		
		$.get("populatewidth.php?shc_id="+shc_id,
		function(xml){
			$('#shw_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("width",xml).each(function(id) {
				width = $("width",xml).get(id);				
				result = '<option value="'+$("shw_id",width).text()+'">'+$("name",width).text()+'</option>'
				$("#shw_id").append(result);
			});
		});
		
	});	


	});
	</script>
			
				
                
                
                
                <div class="body1" id="mk_height">	

					
					
					<div class="divider_h">&nbsp;</div>
					
					<div class="mid_body">
                      <div class="heading">
                        <h1>Add Shoe 
                        <?php
						if($_GET['id']>0)
						{
						?>
                        ( <a href="shoecolors.php?soeid=<?php echo $_GET['id']; ?>">Click here to Add/Edit Shoe Colors and Images</a> )
                        <?php
						}
						?>
                        
                        </h1>
                      </div>
					  <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data">
                      <input type="hidden" name="cty_id" id="cty_id" value="" />
                        <div class="input_title">
                          <label for="shoe_name">Name</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="shoe_name" class="input_box" id="shoe_name" type="text" value="<?php echo $name; ?>" />
				        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="description">Product Description</label>
                          <span>*</span></div>
					    <div class="input">
					      <textarea name="description" rows="6" cols="40" id="description"><?php echo $description; ?></textarea>
				        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="link">Link</label>
                        </div>
					    <div class="input">
					      <input name="link" class="input_box" id="link" type="text" value="<?php echo $link; ?>" />
				        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="cnt_id">Country</label>
                        </div>
					    <div class="input">
                          <select id="con_id" name="con_id" style="width:120px">
                    <option selected="selected" value="">Select....</option>
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


					    <br class="clear" />
                        <div class="input_title">
                          <label for="cnt_id">State</label>
                        </div>
					    <div class="input">
                         <select id="sta_id" name="sta_id" style="width:120px;">
                    <option value="">Select....</option>
                  </select>
                        </div>


					    <br class="clear" />
                        <div class="input_title">
                          <label for="cnt_id">City</label>
                        </div>
					    <div class="input">
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
        <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text" value="<?php echo $cityname; ?>" />
                        </div>
                        
                         <br class="clear" />
                        <div class="input_title">
                          <label for="cnt_id">ZipCode</label>
                        </div>
					    <div class="input">
                        <input type="text" name="zip_code" style="width:120px;" id="zip_code" value="<?php echo $zip_code; ?>" />
                        </div>


					    <br class="clear" />
                        <div class="input_title">
                          <label for="brn_id">Brand</label>
                        </div>
					    <div class="input">
                          <select id="brn_id" name="brn_id">
                            <option selected="selected" value="">Please Select</option>
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
                         <br class="clear" />
                        <div class="input_title">
                          <label for="brn_id">Category</label>
                        </div>
					    <div class="input">
                          <select id="shc_id" name="shc_id">
                            <optgroup label>
                            <option selected="selected" value="">Please Select</option>
                            </optgroup>
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
                          </select>
                        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="fot_id">Foot Ware</label>
                        </div>
					    <div class="input">
                          <select id="fot_id" name="fot_id">
                            <option selected="selected" value="">Please Select</option>
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
					 
					    <br class="clear" />
                        <div class="input_title">
                          <label for="mtr_id">Material</label>
                        </div>
					    <div class="input">
                          <select id="mtr_id" name="mtr_id">
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="hlh_id">Heel Height</label>
                        </div>
					    <div class="input">
                          <select id="hlh_id" name="hlh_id">
                            <option selected="selected" value="">Please Select</option>
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
							?>                          </select>
                        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="hls_id">Heel Size</label>
                        </div>
					    <div class="input">
                          <select id="hls_id" name="hls_id">
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="sol_id">Type of Sole</label>
                        </div>
					    <div class="input">
                          <select id="sol_id" name="sol_id">
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="clo_id">Type of Closure</label>
                        </div>
					    <div class="input">
                          <select id="clo_id" name="clo_id">
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="shoe_lace">Shoe lace</label>
                        </div>
					    <div class="input"> Yes
					      <input name="shoe_lace" value="1" type="radio" <?php if($lace=='1') { ?> checked="checked" <?php } ?>  />
					      No
					      <input name="shoe_lace" value="0" type="radio" <?php if($lace=='0') { ?> checked="checked" <?php } ?>  />
                        </div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="siz_id">Shoe Size</label>
                        </div>
					    <div class="input">
					      <select name="siz_id" id="siz_id" >
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="sht_id">Shoe Type</label>
                        </div>
					    <div class="input">
                          <select id="sht_id" name="sht_id">
                            <option selected="selected" value="">Please Select</option>
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
					    <br class="clear" />
                        <div class="input_title">
                          <label for="shw_id">Shoe Width</label>
                        </div>
					    <div class="input"><span class="tblcell1">
					      <select name="shw_id" id="shw_id">
                            <option selected="selected" value="">Please Select</option>
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
					    </span></div>
					    <br class="clear" />
                        <div class="input_title">
                          <label for="sea_id">Season</label>
                        </div>
					    <div class="input">
                          <select id="sea_id" name="sea_id">
                            <option selected="selected" value="">Please Select</option>
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
                        <br class="clear" />
                        <div class="input_title">
                          <label for="sea_id">Price</label>
                        </div>
					    <div class="input">
                          <input name="price" class="input_box" id="price" type="text" value="<?php echo $price; ?>" />
                        </div>
					    <br class="clear" />
                        <div class="input_title">&nbsp;</div>
					    <div class="input">
					      <input name="submit" value="Submit" class="bttn" type="submit" />
				        </div>
					    <br class="clear" />
                      </form>
				  </div>
                    
				</div>
                
                
			  <script>
$(document).ready(function() {
    $("select#con_id").trigger('change');
	});
	
</script>


            	<?php include("bottom.php"); ?>				
				
			