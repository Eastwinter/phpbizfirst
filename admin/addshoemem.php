<?php
include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

if($_GET['stoid']=='')
	$_GET['stoid']=0;
if($_GET['id']>0)
{

$sql="update soe_shoe set
`name`='".mysql_real_escape_string($_POST['shoe_name'])."',
`description`='".mysql_real_escape_string($_POST['description'])."',
`link` ='".mysql_real_escape_string($_POST['link'])."',
`cnt_id`='".mysql_real_escape_string($_POST['cnt_id'])."', 
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
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);

$id=$_GET['id'];
}
else
{

$sql="INSERT INTO soe_shoe set
`mem_id`='".$_SESSION['admid']."' ,
`name`='".mysql_real_escape_string($_POST['shoe_name'])."',
`description`='".mysql_real_escape_string($_POST['description'])."',
`link` ='".mysql_real_escape_string($_POST['link'])."',
`cnt_id`='".mysql_real_escape_string($_POST['cnt_id'])."', 
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
//echo $sql;
	for($i=0;$i<=6;$i++)
	{
		if($i==0)
			$nm='main_picture';
		else
			$nm='main_picture'.$i;
		$name=$_FILES[$nm]['name'];
		$tname=$_FILES[$nm]['tmp_name'];			
		if($name!='')
		{
			$name1=$id."_".$name;
			if(move_uploaded_file($tname,"../uploads/shoe_photo/".$name1))
			{
				if($i==0)
					$fld='logo';
				else
					$fld="logo".$i;
					
				$sql="select * from soe_shoe where soe_id=".$id;
				$rs=mysql_query($sql);
				$row=mysql_fetch_array($rs);
				if($row[$fld]!='' and $row[$fld]!=$name1)
				{
					unlink("../uploads/".$row[$fld]);
					unlink("../uploads/thumb30_".$row[$fld]);
					unlink("../uploads/thumb98".$row[$fld]);
					unlink("../uploads/thumb260".$row[$fld]);
				}
				if($i==0)
					mysql_query("update soe_shoe set logo='".$name1."' where soe_id=".$id) or die(mysql_error());
				else
					mysql_query("update soe_shoe set logo".$i."='".$name1."' where soe_id=".$id) or die(mysql_error());

				$basedir = ''; 
				
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb98_".$name1;				
	$phpThumb = new phpThumb();		
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 98;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

$phpThumb = new phpThumb();
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb30_".$name1;			
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 30;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

$phpThumb = new phpThumb();
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb260_".$name1;			
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 260;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

			}
		}	
	}
		
?>
<script>
location.href='shoesmem.php';
</script>
<?php							

}
?>
<link rel="stylesheet" href="style1.css" type="text/css" />
<?php
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
			price: "required"
		},
		messages: {
			shoe_name: "<br/>Shoe Name can not be empty.",
			description: "<br/>Description can not be empty.",
			price: "<br /> Price cannot be empty"
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
			main_picture: "required"
		},
		messages: {
			shoe_name: "<br/>Shoe Name can not be empty.",
			description: "<br/>Description can not be empty.",
			main_picture: "<br/>Please Upload Main Image."
		}
	});
	
});
</script>			


<?php
}
?>				
				
                
                
                
                <div class="body" id="mk_height">	

					
					
					<div class="divider_h">&nbsp;</div>
					
					<div class="mid_body">
                      <div class="heading">
                        <h1>Add Shoe</h1>
                      </div>
					  <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data">
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
                        <?php
						if($logo!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture">Upload Main Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture" id="main_picture" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo1!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo1; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture1">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture1" id="main_picture1" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo2!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo2; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture2">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture2" id="main_picture2" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo3!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo3; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture3">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture3" id="main_picture3" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo4!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo4; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture4">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture4" id="main_picture4" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo5!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo5; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        <div class="input_title">
                          <label for="main_picture5">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture5" id="main_picture5" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
					    <br class="clear" />
                         <?php
						if($logo6!='')
						{
							
						?>
                         <div class="input_title">
                          <label for="main_picture">&nbsp;&nbsp;</label>
                          <span></span></div>
					    <div class="input">
					      <img src="../uploads/shoe_photo/thumb98_<?php echo $logo6; ?>" />
                        </div>
					    <br class="clear" />
                        <?php
                        }
						?>
                        
                        <div class="input_title">
                          <label for="main_picture6">Upload Sub Image</label>
                          <span>*</span></div>
					    <div class="input">
					      <input name="main_picture6" id="main_picture6" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size 1024 (in kilobytes)</span></div>
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
                          <select id="cnt_id" name="cnt_id">
                            <option selected="selected" value="">Please Select</option>
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
                          <label for="col_id">Color</label>
                        </div>
					    <div class="input">
                          <select id="col_id" name="col_id">
                            <option selected="selected" value="">Please Select</option>
                            <?php
						   $rs=mysql_query("select * from soe_color order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($col_id==$row['col_id'])
									$c='selected';
								else
									$c='';
						   ?>
                            <option value="<?php echo $row['col_id']; ?>"  <?php echo $c; ?> ><?php echo $row['name']; ?></option>
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
                            <option value="<?php echo $row['hlh_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
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
                
                
				<?php include("bottom.php"); ?>				
				
			