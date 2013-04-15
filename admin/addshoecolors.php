<?php
include("top.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{


	for($i=0;$i<=6;$i++)
	{
		if($i==0)
			$nm='main_picture';
		else
			$nm='main_picture'.$i;
		$name=$_FILES[$nm]['name'];
		$tname=$_FILES[$nm]['tmp_name'];			
		$size=round($_FILES[$nm]['size']/1024);		
		//echo '<br />'.$nm." =".$size;	
		if($size>$settings['up_max_size'])
		{
			//die('<br />'.$nm." =".$size);

			?>
            <script>
			location.href='addshoecolors.php?msg=size&soeid=<?php echo $_GET['soeid']; ?>';
			</script>
            <?php
			die();
		}
	}

if($_GET['stoid']=='')
	$_GET['stoid']=0;
if($_GET['id']>0)
{
$sql="update soe_shoecolors set
`color`='".mysql_real_escape_string($_POST['maincolor'])."' 
 where id=".$_GET['id'];
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);

$id=$_GET['id'];

mysql_query("delete from advcolorvalues where colid=".$id);
}
else
{

$sql="INSERT INTO soe_shoecolors set
`color`='".mysql_real_escape_string($_POST['maincolor'])."',
`soe_id`='".intval($_GET['soeid'])."'";

mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
$id=mysql_insert_id();
}

$rs=mysql_query("select * from soe_advcolor");
while($row=mysql_fetch_array($rs))
{
	$nm="color".$row['advcol_id'];
	$v=$_POST[$nm];
	mysql_query("insert into advcolorvalues set colid=".$id.",soeid=".intval($_GET['soeid']).",advcolid=".$row['advcol_id'].",value='".$v."'") or die(mysql_error());
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
			$name1=$id."_".$_GET['soeid']."_".$name;
			if(move_uploaded_file($tname,"../uploads/shoe_photo/".$name1))
			{
				if($i==0)
					$fld='logo';
				else
					$fld="logo".$i;
					
				$sql="select * from soe_shoecolors where id=".$id;
				$rs=mysql_query($sql);
				$row=mysql_fetch_array($rs);
				//print_r($row);
				if($row[$fld]!='' and $row[$fld]!=$name1)
				{
					unlink("../uploads/shoe_photo/".$row[$fld]);
					unlink("../uploads/shoe_photo/thumb30_".$row[$fld]);
					unlink("../uploads/shoe_photo/thumb98_".$row[$fld]);
					unlink("../uploads/shoe_photo/thumb260_".$row[$fld]);
				}
				if($i==0)
					mysql_query("update soe_shoecolors set logo='".$name1."' where id=".$id) or die(mysql_error());
				else
					mysql_query("update soe_shoecolors set logo".$i."='".$name1."' where id=".$id) or die(mysql_error());

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



if($_POST['submit']!='')
{		
?>
<script>
location.href='addshoecolors.php?soeid=<?php echo $_GET['soeid']; ?>';
</script>
<?php							

}

if($_POST['submit2']!='')
{		
?>
<script>
location.href='shoecolors.php?soeid=<?php echo $_GET['soeid']; ?>';
</script>
<?php							

}

}
?>
<link rel="stylesheet" href="style1.css" type="text/css" />
<?php
if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_shoecolors where id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);

?>
	

				
	<script type="text/javascript">
	var $jk = jQuery.noConflict();
$jk().ready(function() {
	
	$jk("#add_shoe").validate({
		rules: {
			color: "required"
		},
		messages: {
			color: "<br/>Select a color.",
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
	var $jk = jQuery.noConflict();
$jk().ready(function() {


$jk.validator.addMethod("uploadFile", function(val, element) {
var ext = element.value.split('.').pop().toLowerCase();
var allow = new Array('gif','png','jpg','jpeg');
if(jQuery.inArray(ext, allow) == -1) {
   // document.getElementById("imgHolder").src= "product_small.jpg"
   return false
}else{
  //  document.getElementById("imgHolder").src= "282116628.jpg"
    return true
  }
 
}, "File trype error");

	
	$jk("#add_shoe").validate({
		rules: {
			maincolor: "required",
			main_picture: 
			{
			required: true,
			uploadFile: true
			}
		},
		messages: {
			maincolor: "<br/>Select a color.",
			main_picture: "<br />Please Upload Main Image."
		}
	});
	
});
</script>			


<?php
}
?>				
		
        
        <script type="text/javascript">
$jk().ready(function()
{
	$jk("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<?php
if($_GET['msg']=="size")
{
?>
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<div id="object" class="message_box">
		<span class="err">One of your files is greater than <?php echo $settings['up_max_size']; ?> KB. Please upload less than <?php echo $settings['up_max_size']; ?> kb </span></div>
<?php
}
?>	
		

<link media="screen" rel="stylesheet" href="../css/colorbox.css" />
<script src="../js/jquery.min.js"></script>
<script src="../colorbox/jquery.colorbox.js"></script>

<script>
 var $j = jQuery.noConflict();
 $j(document).ready(function(){
 $j(".example7").colorbox({width:"55%", inline:true, href:"#inline_example2"});
});
</script>


                
<script language="javascript" src="picker.js"></script>
<link href="picker.css" rel="stylesheet" type="text/css" />
         
         
        

         
         
           
                
                <div class="body1" id="mk_height">	

					
					
					<div class="divider_h">&nbsp;</div>
					
					<div class="mid_body">
                      <div class="heading">
                        <h1>Add Shoe Color and Images</h1>
                      </div>
					  <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data">
                      
                      
                      
                       <div style="display:none" >
         <div id='inline_example2' style='padding:10px; background:#fff;'>
          <div id="writereview">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <?php
		  
		  $rsadvc=mysql_query("select * from soe_advcolor where active='1'");
		  while($rowadvc=mysql_fetch_array($rsadvc))
		  {
		  		if($_GET['id']>0)
				{
					$rsadvcval=mysql_query("select * from advcolorvalues where soeid=".$_GET['soeid']." and colid=".$_GET['id']." and advcolid=".$rowadvc['advcol_id']);
					$rowadvcval=mysql_fetch_array($rsadvcval);
					$val=$rowadvcval['value'];
				}
				else
					$val='';
		  ?>
          <tr>
            <td><strong><?php echo $rowadvc['name']; ?> :</strong></td>
            <td><input name="color<?php echo $rowadvc['advcol_id']; ?>" type="text" id="color<?php echo $rowadvc['advcol_id']; ?>" size="7" maxlength="80" value="<?php echo $val; ?>" style="background-color:<?php echo $val; ?>" /> 
<img src="color.png" align="absmiddle" style="cursor:pointer;" onclick="openPicker('color<?php echo $rowadvc['advcol_id']; ?>')" /></td>
          </tr>
          <?php
		  }
		  ?>
          
            <tr>
          <td colspan="2">
          <a onclick="javascript: $j.colorbox.close();" /><img src="../images/done.jpg" border="0" /></td>
          </td>
          </tr>
	</table>
        
        </div>
          </div>
        </div>
        
                         <div class="input_title">
                          <label for="main_picture">Select Color</label>
                          <span></span></div>
					    <div class="input">
					      <input name="maincolor" type="text" id="maincolor" size="7" maxlength="80" value="<?php echo $color; ?>" style="background-color:<?php echo $color; ?>" /> 
<img src="color.png" align="absmiddle" style="cursor:pointer;" onclick="openPicker('maincolor')" />&nbsp;&nbsp;

                        <a href="#" class="example7 orange style1"><strong>Advance Color Options</strong></a></div>
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
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture1" id="main_picture1" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture2" id="main_picture2" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture3" id="main_picture3" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture4" id="main_picture4" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture5" id="main_picture5" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
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
                        </div>
					    <div class="input">
					      <input name="main_picture6" id="main_picture6" size="40" type="file" />
					      <br />
					      <span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></div>
					    <br class="clear" />
                       
                        <div class="input_title">&nbsp;</div>
					    <div class="input">
					      <input name="submit" value="Save and Add More Colors" class="bttn" type="submit" />
              <input name="submit2" value="Save and Exit" class="bttn" type="submit" />
              <input name="submit3" value="CANCEL" class="bttn" type="button" onclick="javascript: location.href='shoesadm.php';" />
				        </div>
					    <br class="clear" />
                      </form>
				  </div>
                    
				</div>
                
                
				<?php include("bottom.php"); ?>				
				
			