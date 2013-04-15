<?php include("header.php"); 
if($_SERVER['REQUEST_METHOD']=="POST")
{


		$size=round($_FILES['image']['size']/$settings['up_max_size']);		
		if($size>$settings['up_max_size'])
		{
			?>
            <script>
			location.href='sharepicture.php?msg=size';
			</script>
            <?php
			die();
			
            
		}
		
$sql="INSERT INTO soe_share set
`memid`='".$_SESSION['memberid']."' ,
`title`='".mysql_real_escape_string($_POST['title'])."'";
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
$id=mysql_insert_id();

		$name=$_FILES['image']['name'];
		$tname=$_FILES['image']['tmp_name'];
		$name1=$id."_".$name;
		move_uploaded_file($tname,"./uploads/sharephoto/".$name1);
		mysql_query("update soe_share set image='".$name1."' where id=".$id) or die(mysql_error());	
		
	$f="uploads/sharephoto/".$name1;
	$f2=realpath("uploads/sharephoto/")."/thumb_".$name1;				
	$phpThumb = new phpThumb();		
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 200;
	$thumbnail_height = 100;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->setParameter('h', $thumbnail_height);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);
	?>
    <script>
	location.href="sharepicture.php";
	</script>
    <?php
}

if($_GET['id']>0)
{
	$rs=mysql_query("select * from soe_share where id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	unlink("uploads/sharephoto/".$row['image']);
	mysql_query("delete from soe_share where id=".$_GET['id']);
	mysql_query("delete from soe_sharecomments where shareid=".$_GET['id']);
	?>
    <script>
	location.href="sharepicture.php";
	</script>
    <?php
	
}
?>

	<script type="text/javascript">
$().ready(function() {
	
	$("#sharefrm").validate({
		rules: {
			title: "required",
			image: "required"
		},
		messages: {
			title: "<br/>Title can not be empty.",
			image: "<br/>Image can not be empty."
		}
	});
	
});
</script>	

<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<?php
if($_GET['msg']=="size")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">File cannot be greater than <?php echo $settings['up_max_size']; ?> KB. Please upload less than <?php echo $settings['up_max_size']; ?> kb </span></div>
<?php
}
?>	<?php include("left2.php"); ?>
 <div id="content_area_mid_inner">
    <div>
      <h2>Share Picture </h2>
    </div>
    <div class="border1">
     <form action="" method="post" enctype="multipart/form-data" name="sharefrm" id="sharefrm">
      <div class="shareimgs">
        <div class="shareimgs_left" >
          <p> <b>Title :</b><br />
            <input name="title" type="text" id="title" style="width:130px;" />
            <br />
            <label style="display:none;">Enter minimun 6 character</label>
          </p>
        </div>
        <div class="shareimgs_left1" >
          <p> <b>Upload :</b><br />
            <input name="image" type="file" id="image" >
            <input type="submit" name="button" id="button" value="     UPLOAD     ">
            <br />
            <label><span>Maximum allowed size <?php echo $settings['up_max_size']; ?> (in kilobytes)</span></label>
          </p>
        </div>
      </div>
      </form>
      <div class="clear"></div>
      <div class="sharepicture">
       <?php
				$i=0;
		$sql="select * from soe_share where memid=".$_SESSION['memberid']." and approve=1 order by date desc";
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/12);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*12;	
		$sql=$sql." limit ".$start.",12";
		//echo $sql;
		$rs=mysql_query($sql) or die(mysql_error());	

			
				while($row=mysql_fetch_array($rs))
				{
				$i++;
				?>
        <div class="other_shoes2"><a href="sharepicturereview.php?id=<?php echo $row['id']; ?>"><img src="uploads/sharephoto/thumb_<?php echo $row['image']; ?>" alt="" border="0"  width="77" height="67" /></a><a onclick="javascript: ans=confirm('Are you sure to delete?'); if(ans==true) { location.href='sharepicture.php?id=<?php echo $row['id']; ?>'; } ">Delete</a></div>
       
       
         <?php
				}
				?>
        <div class="clear"></div>
      </div>
      <div id="style_point_right"> 
      <?php
		if($totpages>1)
		{
		?>
      <div id="numbring">
        <ul id="carousel" class="mycarousel jcarousel-skin-tango">
         <?php
		  
		  for($i=1;$i<=$totpages;$i++)
		  {
		  ?>
   <li class="numbers"><a href="sharepicture.php?curpage=<?php echo $i; ?>" class="gray_link"><?php echo $i; ?></a></li>
         <?php
		  }
		  ?>
          </ul>
        <div class="clear"></div>
      </div>
      <?php
	  }
	  ?>
    </div></div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
  <!-- Footer Area Start -->
<?php include("footer.php"); ?>