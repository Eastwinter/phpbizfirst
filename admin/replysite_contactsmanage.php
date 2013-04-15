<?php include("top.php");
include_once "../class.phpmailer.php";

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_contact_us where con_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
}


if($_SERVER['REQUEST_METHOD']=="POST")
{
$mailcontent='
	<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Home</title>
	<meta name="description" content="Home | ShoeBreeze.com" />

	<meta name="keywords" content="Home | ShoeBreeze.com" />
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="generator" content="shoe.com" />
	<link rel="stylesheet" href="http://www.quickworkz.com/dev/shoe/style2.css" type="text/css" />
    <link rel="stylesheet" href="http://www.quickworkz.com/dev/shoe/style1.css" type="text/css" />

	

</head>
	<body>
		
		<div class="mainbody">
			<div class="content">
				
				<div class="header">
					<div class="logo">&nbsp;</div>						
			  </div>
				<div class="space_top">&nbsp;</div>		 
<div class="divider_h">&nbsp;</div>



<div class="mid_body">
  <div class="mid_body">

    <p>Dear '.$name.',</p>
    <p><br />
      '.$_POST['content'].' 
      <br />
      Thanks,<br>
	  Shoesite Team.
      
    </p>
  </div>
  </div>
            </div>
			<div class="footer"><br class="clear"/>		
					Copyright &copy; ShoeBreeze.com All rights reserved.
		  </div>				
				
	</div>			
		</div>

		
		<!-- footer -->
		
	</body>
</html>				
				
			
	';
	
			$mail = new PHPMailer();
			$mail->IsHTML(true);
			$mail->Subject ="Re: ".$subject;
			$mail->Body    = $mailcontent;
			$mail->From = "quickonline.us1@gmail.com";
			$mail->FromName="Shoe Site";
			$mail->AddAddress($email);
			$mail->AddBCC('quickonline.us1@gmail.com');


			$mail->AltBody ="Your mail is not supporting html format";
			$mail->IsMail();
			if(!$mail->Send())
			{
				$msg =$mail->ErrorInfo;
				echo("STATUS = <font color=red>".$msg."</font>");
			}
	?>
    <script>
	location.href="site_contactsmanage.php";
	</script>
    <?php
			
}

?>
<script type="text/javascript">
$().ready(function() {	
	$("#edit_static_page").validate({
		rules: {
			rte: "required"
			
		},
		messages: {
			rte: "<br/>Please enter Message."
			
		}
	});	
});
</script>
<div class="body" id="mk_height">
  <table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td class="header">Edit Contacts</td>
    </tr>
    <tr>
      <td width="100%"><form action="" method="post" name="edit_static_page" id="edit_static_page">
        
        
        <table width="100%" border="0" cellpadding="0" cellspacing="5" align="ceneter" class="marginTop">
          
          <tr>
            <td class="tblcell32" colspan="2">
            <strong>User's Message:</strong><hr />
<br />

			<?php echo wordwrap($message, 80, "<br />\n","true"); ?>
            <hr />
            </td>
          </tr>
          <tr>
            <td class="tblcell32" colspan="2"><strong>Reply Message</strong><span class="mark">*</span></td>
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
                <textarea class="rte" cols="100" rows="20" id="content" name="content"><?php echo $page_content; ?></textarea>            </td>
          </tr>
          
          <tr>
            <td class="tblcell34" colspan="2"><input type="submit" name="submit" value="Send" class="button" /></td>
          </tr>
        </table>
      </form></td>
    </tr>
  </table>
</div>
	<?php include("bottom.php"); ?>