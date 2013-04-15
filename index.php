<?php include("header.php"); ?>
	<!-- Content Area Start -->
	<?php include("left.php"); ?>
<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin1.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
$(document).ready(function() {
	$('.mycarousel').jcarousel();
});

</script>
	<div id="content_area_mid">
		<div><img src="images/welcome.jpg" alt=""></div>
		<div>please replace from orignal text this is demo text  please replace from orignal text this is demo text please replace from orignal text this is demo text please replace from orignal text this is demo text please replace from orignal text this is demo text</div>
		<div><h2>Featured Shoes</h2></div>
           <?php
		$sql="select * from soe_shoe where active='1' and featured=1 and hide=0";
		
		$rs=mysql_query($sql) or die(mysql_error());	
		$totrec=mysql_num_rows($rs);
		$totpages=ceil($totrec/9);
		if($_GET['curpage']=='')
			$curpage=1;
		else
			$curpage=$_GET['curpage'];
		$start=($curpage-1)*9;	
		$sql=$sql." limit ".$start.",9";
		//echo $sql;
		$rs=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_array($rs))
		{
		
			$ph="uploads/shoe_photo/"."thumb98_".getcol($row['soe_id']);
				$str=''.$row['name'].'';
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
				{
					$row1=mysql_fetch_array($rs1);
					$str.='<br />'.$row1['name'];
				}
			$ph1="uploads/shoe_photo/".getcol($row['soe_id']);		
			if($ph=='' or !file_exists($ph))
				continue;			
				
		?>
		<div class="latest_shoes"><a href="detail-id-<?php echo $row['soe_id']; ?>.htm" rel="<?php echo $ph1; ?>" class="preview" ><img src="<?php echo $ph; ?>" alt="" border="0"></a></div>
        <?php
			if($i==3)
			{
				echo '<div class="clear"></div>';
				$i=1;
			}
			else
				$i++;
		}
		?>
		
        
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
   <li class="numbers"><a href="index.php?curpage=<?php echo $i; ?>" class="gray_link"><?php echo $i; ?></a></li>
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
	
	<div id="content_area_right"> <?php echo  showbanners('right'); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
<?php include("footer.php"); ?>