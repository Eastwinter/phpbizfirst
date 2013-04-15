<?php include("header.php"); ?>
  <?php include("left2.php"); ?>
  
  <?php
$rs=mysql_query("select * from soe_share where id=".$_GET['id']);
$row=mysql_fetch_array($rs);

?>

<!--
  jQuery library
-->
<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin1.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('.mycarousel').jcarousel();
});

</script>



  <div id="content_area_mid_inner">
    <div>
      <h2>Detailed Comments</h2>
    </div>
    <div class="border1">
      <div style="float:left; width:450px; padding-left:10px;"> <img src="uploads/sharephoto/thumb_<?php echo $row['image']; ?>" alt="" border="0" /> </div>
      <div class="shrw">
        
        
        <?php
		$n=0;
$sql="select * from soe_sharecomments where shareid=".$_GET['id'];
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/10);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*10;	
		//echo $sql;
		$sql=$sql." limit ".$start.",10";
		
		$rs=mysql_query($sql) or die(mysql_error());	

		
$rs=mysql_query($sql) or die(mysql_error());
while($row=mysql_fetch_array($rs))
{

$rs1=mysql_query("select * from soe_members where mem_id=".$row['memid']);
if(mysql_num_rows($rs1)<=0)
	continue;
$row1=mysql_fetch_array($rs1);
$n++;

?>
		<div class="rd1rwdt1">
          <p><b>Name :</b></p>
          <p><b>Posted :</b></p>
          <p><b>Comments :</b></p>
        </div>

        <div class="rd1rwdt2">
          <p><?php echo $row1['first_name']; ?></p>
          <p><?php echo date("m/d/Y",strtotime($row['date'])); ?></p>
          <p><?php echo nl2br($row['comments']); ?></p>
        </div>
        
<?php
}

if($n<=0)
	echo 'No Reviews Added Yet';
?>
      </div>
      <div class="clear"></div>
      
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
   <li class="numbers"><a href="sharepicturereview.php?curpage=<?php echo $i; ?>" class="gray_link"><?php echo $i; ?></a></li>
         <?php
		  }
		  ?>
          </ul>
        <div class="clear"></div>
      </div>
      <?php
	  }
	  ?>
      
    </div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
  <!-- Footer Area Start -->
<?php include("footer.php"); ?>