<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

if($_POST['keep_ratio']=='')
	$_POST['keep_ratio']=0;
	
	if($_GET['id']>0)
	{
		$sql="update soe_banners set title='".$_POST['title']."',alt_text='".$_POST['alt_text']."',position='".$_POST['position']."',width='".$_POST['width']."',height='".$_POST['height']."',type='".$_POST['type']."',url='".$_POST['url']."',target='".$_POST['target']."',orginal_param='".$_POST['parameters']."',image_ratio='".$_POST['keep_ratio']."' where bnr_id=".$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		$id=$_GET['id'];
	}
	else
	{
		$sql="insert into soe_banners set title='".$_POST['title']."',alt_text='".$_POST['alt_text']."',position='".$_POST['position']."',width='".$_POST['width']."',height='".$_POST['height']."',type='".$_POST['type']."',url='".$_POST['url']."',target='".$_POST['target']."',orginal_param='".$_POST['parameters']."',image_ratio='".$_POST['keep_ratio']."'";
		mysql_query($sql) or die(mysql_error());
		$id=mysql_insert_id();
	}
	
	
	if($_POST['type']!='remote')
	{
		$name=$_FILES['upload']['name'];
		$tname=$_FILES['upload']['tmp_name'];			
		if($name!='')
		{
			$name1=$id."_".$name;
			if(move_uploaded_file($tname,"../uploads/banner/".$name1))
			{
					mysql_query("update soe_banners set url_file='".$name1."' where bnr_id=".$id) or die(mysql_error());

				$basedir = ''; 
				
			
				$f="../uploads/banner/".$name1;
				$f2="../uploads/banner/"."thumb_".$name1;
				$phpThumb = new phpThumb();		
				$phpThumb->setSourceData(file_get_contents($f));
				$output_filename = $f2;
				$thumbnail_width = 100;
				$phpThumb->setParameter('w', $thumbnail_width);
				$phpThumb->GenerateThumbnail();
				$phpThumb->RenderToFile($output_filename);

			}
		}	
	}
	?>
    <script>
	location.href='bannermanage.php';
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_banners where bnr_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
}
?>
<script type="text/javascript">
$().ready(function() {	
	$("#add_banner").validate({
		rules: {
			position: "required",
			type: "required",
			title: "required",
			file: "required"
		},
		messages: {
			position: "<br/>Please choose a Position.",
			type: "<br/>Please choose a Type.",
			title: "<br/>Please enter Title.",
			file: "<br/>Please upload Banner File."
		}
	});	
});
</script>

				<div class="body" id="mk_height">
		
		<Table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Add Banner</td>
			</tr>
			<tr>
				<td width="100%">					
					
					<form class="form" id="add_banner" name="add_banner" method="post" action="" enctype="multipart/form-data">

						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell">Position <span>*</span></td>
								<td>
									<select id="position" name="position">
										<option value="">Please Select</option>									
										<option value="top" <?php if($position=="top") { ?> selected="selected" <?php } ?> >Top</option>

										<option value="left" <?php if($position=="left") { ?> selected="selected" <?php } ?>  >Left side</option>
										<option value="right" <?php if($position=="right") { ?> selected="selected" <?php } ?>  >Right side</option>
										<option value="bottom" <?php if($position=="bottom") { ?> selected="selected" <?php } ?>  >Bottom</option>
									</select>								</td>
							</tr>
							
							<tr>
								<td class="tblcell">Banner Type <span>*</span></td>

								<td>
									<select id="type" name="type" onchange="banner_type(this.value)">
										<option value="">Please Select</option>									
										<option value="image" <?php if($type=="image") { ?> selected="selected" <?php } ?>  >Local (image)</option>
										<option value="flash"  <?php if($type=="flash") { ?> selected="selected" <?php } ?> >Local (flash)</option>
										<option value="remote"  <?php if($type=="remote") { ?> selected="selected" <?php } ?> >Remote</option>
									</select>								</td>
							</tr>
							
							<tr>
								<td class="tblcell">Banner Title <span>*</span></td>
								<td><input type="text" name="title" value="<?php echo $title; ?>" class="input_box" id="title" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td colspan="2">
                                

									<div id="local" style="display:block;">
										<table width="100%" border="0" cellpadding="0" cellspacing="5">	
											<tr>
												<td class="tblcell">Banner File <span>*</span></td>
												<td class="font11">
                                                <input type="file" name="upload" id="upload" size="27" /><br/><span>Maximum allowed size 1024 (in kilobytes)</span></td>
											</tr>											
											<tr>
												<td class="tblcell">Banner Alternative Text</td>

												<td><input type="text" name="alt_text" value="<?php echo $alt_text; ?>" class="input_box" id="alt_text" maxlength="250" /></td>
											</tr>											
											<tr>
												<td class="tblcell">Keep image ratio</td>
												<td><input type="checkbox" name="keep_ratio" id="keep_ratio" value="1" <?php if($image_ratio==1) { ?> checked="checked" <?php } ?>  /></td>
											</tr>											
										</table>
									</div>
									
									<div id="remote" style="display:none;">									
										<table width="100%" border="0" cellpadding="0" cellspacing="5">									
											<tr>

												<td class="tblcell">Banner image URL <span>*</span></td>
												<td><input type="text" name="external_url" value="<?php echo $url_file; ?>" class="input_box" id="external_url" maxlength="250" /></td>
											</tr>
										</table>											
									</div>								</td>
							</tr>
							
							<tr>
								<td class="tblcell">Use Orginal Parameters</td>

								<td>
									Yes <input type="radio" name="parameters" value="1"  onclick="banner_parameters(this.value);"  <?php if($orginal_param=="1") { ?> checked <?php } ?>  />
									No <input type="radio" name="parameters" value="0"  onclick="banner_parameters(this.value);" <?php if($orginal_param=="0") { ?> checked <?php } ?>   />								</td>
							</tr>
							
							<tr>
								<td colspan="2">
									<div id="parameters" style="display:none;">									
										<table width="100%" border="0" cellpadding="0" cellspacing="5">	
											<tr>

												<td class="tblcell">Image Width</td>
												<td><input type="text" name="width" value="<?php echo $width; ?>" class="input" id="width" maxlength="3" /></td>
											</tr>							
											<tr>
												<td class="tblcell">Image Height</td>
												<td><input type="text" name="height" value="<?php echo $height; ?>" class="input" id="height" maxlength="4" /></td>
											</tr>
										</table>											
									</div>								</td>
							</tr>
							
							<tr>
								<td class="tblcell">Banner URL</td>
								<td><input type="text" name="url" value="<?php echo $url; ?>" class="input_box" id="url" maxlength="250" /></td>
							</tr>
							
							<tr>
								<td class="tblcell">Target Window</td>
								<td>

									<select name="target">
										<option value="_blank" <?php if($target=="_blank") { ?> selected="selected" <?php } ?>  >New window</option>
										<option value="_self" <?php if($target=="_self") { ?> selected="selected" <?php } ?>  >Current window</option>
									</select>								</td>
							</tr>
							
							<tr>
								<td class="tblcell">&nbsp;</td>

								<td class="pb_5"><input type="submit" name="submit" value="Submit" class="button" /></td>
							</tr>
							<tr>
							  <td colspan="2" class="tblcell"><?php
								if($type=='remote')
								{
								?>
                                <img src="<?php echo $url_file; ?>" />
                                <?php
								}
								else
								{
								?>
                                <img src="../uploads/banner/<?php echo $url_file; ?>" />
                                <?php
								}
								?>&nbsp;</td>
						  </tr>
						</table>						
					</form>
					<br class="clear" />
				</td>
			</tr>
		</table>
		
	</div>

	<script>
		banner_type('<?php echo $type; ?>');
		banner_parameters('<?php echo $orginal_param; ?>');
</script>
	<?php include("bottom.php"); ?>