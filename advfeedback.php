<?php include("header.php");?>
  <!-- Navigation bar Start -->
  <?php include("left3.php");?>
<div id="content_area_mid_inner1">
  <div>
    <h2>Feed Back</h2>
  </div>
    <div class="feedback">
      <div class="feedbackform">
        <div class="reviewdetail">
          <?php
			$rvs=0;
			$sql="select * from soe_reviews where fldapprove=1 and fldtype='feedback' and fldshoeid in (select soe_id from soe_shoe where mem_id=".$_SESSION['memberid'].") order by flddate desc";
			$reviewrs=mysql_query($sql) or die(mysql_error());
			$totrec=mysql_num_rows($reviewrs);
			$totpages=ceil($totrec/5);
			if($_GET['curpage']=='')
				$curpage=1;
			else
				$curpage=$_GET['curpage'];
			$start=($curpage-1)*5;	
			$sql=$sql." limit ".$start.",5";
			$reviewrs=mysql_query($sql) or die(mysql_error());	

			while($reviewrow=mysql_fetch_array($reviewrs))
			{
			$rvs++;
			?>
          <div class="feedformlist">
            <div class="fdrwdt1">
              <p><b>Posted on:</b>&nbsp;&nbsp;<?php echo $reviewrow['flddate']; ?></p>
              <p><b>Name :</b>&nbsp;&nbsp;<?php echo $reviewrow['name']; ?></p>
            </div>
            <div class="fddis">
              <p><b>Description :</b></p>
              <p><?php echo nl2br($reviewrow['fldcomments']); ?></p>
            </div>
          </div>
          <?php
			 }
			 if($rvs==0)
			 	echo 'Sorry No Feedbacks !';
			 ?>
          <?php
			 if($totpages>1)
			 {
			 ?>
          <div class="feedbuttons">
            <p class="buttons">
              <?php 
		  if($curpage>1)
		  	$l='advfeedback.php?curpage='.($curpage-1);
		   else
		  	$l='advfeedback.php?curpage='.($curpage);
		  ?>
              <a href="<?php echo $l; ?>"> Previous </a> &nbsp;&nbsp;
              <?php 
		  if($curpage<$totpages)
		  	$l='advfeedback.php?curpage='.($curpage+1);
		   else
		  	$l='advfeedback.php?curpage='.($curpage);
		  ?>
              <a href="<?php echo $l; ?>"> Next </a>&nbsp;</p>
          </div>
          <?php
				}
				?>
        </div>
      </div>
    </div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right");?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  <!-- Footer Area Start -->
<?php include("footer.php");?>