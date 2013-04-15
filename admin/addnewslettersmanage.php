<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_GET['id']>0)
	{
		$sql="update soe_newsletter set title='".mysql_real_escape_string($_POST['title'])."',short_description='".mysql_real_escape_string($_POST['short_description'])."',description='".mysql_real_escape_string($_POST['description'])."',month='".strtotime($_POST['month']."/01/".date('Y'))."',zipcode='".mysql_real_escape_string($_POST['zipcode'])."',gender='".mysql_real_escape_string($_POST['gender'])."' where nws_id=".$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		$id=$_GET['id'];
	}
	else
	{
		$sql="insert into soe_newsletter set title='".mysql_real_escape_string($_POST['title'])."',short_description='".mysql_real_escape_string($_POST['short_description'])."',description='".mysql_real_escape_string($_POST['description'])."',month='".strtotime($_POST['month']."/01/".date('Y'))."',zipcode='".mysql_real_escape_string($_POST['zipcode'])."',gender='".mysql_real_escape_string($_POST['gender'])."'";
		mysql_query($sql) or die(mysql_error());
		$id=mysql_insert_id();
	}
	?>
    <script>
	location.href='newslettersmanage.php';
	</script>
    <?php
	
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_newsletter where nws_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
	$month=date("m",$month);
	
}
?>
<script type="text/javascript">
$().ready(function() {
	$("#add_newsletter").validate({
		rules: {
			title: "required",
			month: "required",
			description: "required",
			zipcode: "required",
			gender: "required"

		},
		messages: {
			title: "<br/>News Title can not be empty.",
			month: "<br/>Select a month.",
			description: "<br/>Description required.",
			zipcode: "<br/>zipcode required.",
			gender: "<br/>Please select a gender."
			
		}
	});	
});
</script>

				<div class="body" id="mk_height">
		
		<Table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Add Newsletter</td>
			</tr>
			<tr>
				<td width="100%">

					
					<form class="form" id="add_newsletter" name="add_newsletter" method="post" action="">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
							
							<tr>
								<td class="tblcell"><label for="title">News Title</label> <span>*</span></td>
								<td><input type="text" name="title" class="defaultWH" id="title" maxlength="250" value="<?php echo $title; ?>" /></td>
							</tr>
							
							<tr>								
								<td class="tblcell"><label for="month">Month</label> <span>*</span></td>

								<td>
									<select id="month" name="month">
										<option value="">Please Select</option>
                                        <option value="01" <?php if($month=='01') { ?> selected="selected" <?php } ?>  >January</option>
                                        <option value="02"  <?php if($month=='02') { ?> selected="selected" <?php } ?> >February</option>
                                        <option value="03"  <?php if($month=='03') { ?> selected="selected" <?php } ?> >March</option>
                                        <option value="04"  <?php if($month=='04') { ?> selected="selected" <?php } ?> >April</option>
                                        <option value="05" <?php if($month=='05') { ?> selected="selected" <?php } ?>  >May</option>
                                        <option value="06" <?php if($month=='06') { ?> selected="selected" <?php } ?>  >June</option>
                                        <option value="07"  <?php if($month=='07') { ?> selected="selected" <?php } ?> >July</option>
                                        <option value="08"  <?php if($month=='08') { ?> selected="selected" <?php } ?> >August</option>
                                        <option value="09" <?php if($month=='09') { ?> selected="selected" <?php } ?>  >September</option>
                                        <option value="10" <?php if($month=='10') { ?> selected="selected" <?php } ?>  >October</option>
                                        <option value="11" <?php if($month=='11') { ?> selected="selected" <?php } ?>  >November</option>
                                        <option value="12"  <?php if($month=='12') { ?> selected="selected" <?php } ?> >December</option>
																			</select>
									
									<?php echo date('Y'); ?>
									<label for="month" class="error"><br/>Please select Month for Newsletter.</label>								</td>
							</tr>							
							
							<tr>
							  <td class="tblcell" valign="top">Zipcode:</td>
							  <td><input type="text" name="zipcode" class="defaultWH" id="zipcode" maxlength="250" value="<?php echo $zipcode; ?>" /></td>
						  </tr>
							<tr>
							  <td class="tblcell" valign="top">Gender:</td>
							  <td><select name="gender" style="width:180px;">
                    
                    <option value="Male" <?php if($gender=='Male') { ?> selected="selected" <?php } ?> >Male</option>
                    <option value="Female" <?php if($gender=='Female') { ?> selected="selected" <?php } ?> >Female</option>
                  </select>&nbsp;</td>
						  </tr>
							<tr>				
								<td class="tblcell" valign="top"><label for="short_description">Short description</label></td>

								<td><textarea name="short_description" rows="8" cols="40" id="short_description"><?php echo $short_description; ?></textarea></td>
							</tr>
							
							<tr>
								<td class="tblcell32" colspan="2"><label for="description">Description</label> <span>*</span></td>
							</tr>
							<tr>
								<td class="tblcell34" colspan="2">

									<script type="text/javascript" src="tiny_mce/jquery.tinymce.js"></script>

<script type="text/javascript">
function tinyMCEInit(element)
{
	$().ready(function() {
		$(element).tinymce({
			// Location of TinyMCE script
			script_url : 'tiny_mce/tiny_mce.js',
			// General options
			theme : "advanced",
			plugins : "safari,pagebreak,style,layer,table,advimage,advlink,inlinepopups,media,searchreplace,contextmenu,paste,directionality,fullscreen",
			// Theme options
			theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			width : "100",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			content_css : "global.css",
			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
			elements : "nourlconvert",
			convert_urls : false,
			language : "en"
		});
	});
}
tinyMCEInit('textarea.rte');
toggleVirtualProduct(getE('is_virtual_good'));
</script>
									<textarea class="rte" cols="100" rows="20" id="description" name="description"><?php echo $description; ?></textarea>
									<label for="description" class="error"><br/>Description can not be empty.</label>								</td>
							</tr>
							
							<tr>

								<td class="tblcell34" colspan="2"><input type="submit" name="submit" value="Submit" class="button" /></td>
							</tr>
						</table>						
				  </form>
					<br class="clear"/>
				</td>
			</tr>
		</table>
		
	</div>

	<?php include("bottom.php"); ?>