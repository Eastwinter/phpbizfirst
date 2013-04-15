<?php include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{

	if($_GET['id']>0)
	{
		$sql="update soe_static_pages set page_url='".$_POST['page_url']."',	enable_no_follow='".$_POST['enable_no_follow']."',page_content='".mysql_real_escape_string($_POST['content'])."',page_title='".$_POST['page_title']."',meta_keywords='".$_POST['meta_keywords']."',meta_description='".$_POST['meta_description']."',status='".$_POST['status']."' where pag_id=".$_GET['id'];
		mysql_query($sql) or die(mysql_error());
		$id=$_GET['id'];
	}
	else
	{
		$sql="insert into soe_static_pages set page_url='".$_POST['page_url']."',	enable_no_follow='".$_POST['enable_no_follow']."',page_content='".mysql_real_escape_string($_POST['page_content'])."',page_title='".$_POST['page_title']."',meta_keywords='".$_POST['meta_keywords']."',meta_description='".$_POST['meta_description']."',status='".$_POST['status']."'";
		mysql_query($sql) or die(mysql_error());
		$id=mysql_insert_id();
		mysql_query("update soe_static_pages set odering='".$id."' where pag_id=".$id) or die(mysql_error());
	}
	
	
	if($_POST['type']!='remote')
	{
		$name=$_FILES['photo']['name'];
		$tname=$_FILES['photo']['tmp_name'];			
		if($name!='')
		{
			$name1=$id."_".$name;
			if(move_uploaded_file($tname,"../uploads/static_photo/".$name1))
			{
					mysql_query("update soe_static_pages set photo='".$name1."' where pag_id=".$id) or die(mysql_error());

				$basedir = ''; 
				
				$thumb   = '../phpthumb/thumb.php';
				$f="../uploads/static_photo/".$name1;
				$f2="../uploads/static_photo/"."thumb_".$name1;

				$I = new Image($f);
				$I->resize(100,100);
				$I->write($f2);
				$I->destroy();
			}
		}	
	}
	?>
    <script>
	location.href='static_pagesmanage.php';
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_static_pages where pag_id=".$_GET['id']);
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
  <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td class="header">Edit Static Page </td>
    </tr>
    <tr>
      <td width="100%"><form action="" method="post" enctype="multipart/form-data" name="edit_static_page" id="edit_static_page">
        <input type="hidden" name="pag_id" value="5" />
        <input type="hidden" name="lan_id" value="" />
        <table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
          <tr>
            <td class="tblcell31">Enable NO-Follow</td>
            <td><span class="tblcell7"> Yes
                <input type="radio" name="enable_no_follow" value="1" <?php if($enable_no_follow==1) { ?> checked="checked" <?php } ?>  />
              &nbsp;&nbsp;
              No
              <input type="radio" name="enable_no_follow" value="0" <?php if($enable_no_follow==1) { ?> checked="checked" <?php } ?> />
            </span> </td>
          </tr>
          <tr>
            <td class="tblcell31">Status</td>
            <td><select name="status">
              <option value="0" <?php if($status==1) { ?> selected="selected" <?php } ?>  >Inactive</option>
              <option value="1"  <?php if($status==1) { ?> selected="selected" <?php } ?> >Active</option>
            </select>
            </td>
          </tr>
          <tr>
            <td class="tblcell31">Page URL<span class="mark">&nbsp;*</span></td>
            <td class="p_r_80"><input type="text" name="page_url" value="<?php echo $page_url; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell31">Page Title<span class="mark">&nbsp;*</span></td>
            <td><input type="text" name="page_title" value="<?php echo $page_title; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell31">Photo</td>
            <td><input type="file" name="photo" size="28" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Page Content<span class="mark">&nbsp;*</span></td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><script type="text/javascript" src="tiny_mce/jquery.tinymce.js"></script>
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
			content_css : "lobal.css",
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
                <textarea class="rte" cols="100" rows="20" id="content" name="content"><?php echo $page_content; ?></textarea>
            </td>
          </tr>
          <tr>
            <td class="tblcell31">Meta-keywords</td>
            <td><input type="text" name="meta_keywords" value="<?php echo $meta_keywords; ?>" class="defaultWH" /></td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2">Meta-description</td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><textarea name="meta_description" rows="5" class="taWidth"><?php echo $meta_description; ?></textarea></td>
          </tr>
          <tr>
            <td class="tblcell34" colspan="2"><input type="submit" name="submit" value="Update" class="button" />
                  <input type="button" value="Back" onclick="javascript:back_page('')" class="button" />
            </td>
          </tr>
          <tr>
							  <td colspan="2" class="tblcell">
                                <img src="../uploads/static_photo/<?php echo $photo; ?>" />
                                
								&nbsp;</td>
						  </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
	<?php include("bottom.php"); ?>