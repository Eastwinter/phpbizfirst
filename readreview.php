<?php include("connect.php"); ?>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="css/css.css" type="text/css" />
<style>
	body{
		padding:0px;
		margin:0px;
		font-size:12px;
		color: #4F4F4F;
		background:#FFFFFF;
		background-image:none;		
		
		font-family:Verdana,Tahoma,Arial,sans-serif;
	}
</style>

  <?php ///////////////////////////////////////// FORM READING A REVIEW //////////////////////////////////////////// ?>                 
     
      
          <div id='inline_example3' style='padding:10px; background:#fff;'>
          <div id="readreview">
          <div class="reviewdetaillist">
            <h3>Latest 3 reviews from customers</h3>
            <?php
			$rvs=0;
			$reviewrs=mysql_query("select * from soe_reviews where fldapprove=1 and fldshoeid=".$_GET['id']." and fldtype='review' order by flddate desc limit 0,3");
			while($reviewrow=mysql_fetch_array($reviewrs))
			{
			$rvs++;
			?>
            <div class="reviewdetaillistitem">
              <div class="reviewdetail">
                <div class="rdrwdt1">
                  <p><b>Posted :</b></p>
                  <p><b>Reviewer :</b></p>
                </div>
                <div class="rdrwdt2">
                  <p><?php echo $reviewrow['flddate']; ?></p>
                  <p><?php echo $reviewrow['name']; ?> From <?php echo $reviewrow['country']; ?></p>
                </div>
              </div>
              <div class="rdrwratings">
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Overall :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['overall'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>
                    </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Comfort :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['comfort'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                  </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Style :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['style'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                   </div>
                </div>
              </div>
              <div class="rdrwdescrip">
                <p><b>Description :</b><br />
                  <?php echo nl2br($reviewrow['fldcomments']); ?>
                </p>
              </div>
            </div>
            <?php
			}
			if($rvs==0)
				echo '<br /><br /><br /><center><strong>No Reviews Added Yet !</strong></center> <br /><br /><br />';
			?>            
          </div>
        </div>
          </div>
