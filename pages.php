<?php include("header.php"); ?>
	
	<!-- Content Area Start -->
	<?php include("left.php"); ?>
	<?php
					$rs=mysql_query("select * from soe_static_pages where pag_id=".$_GET['pageid']);
					$row=mysql_fetch_array($rs);
					extract($row);
					?>
	<div id="content_area_mid"> 
		<div><h2><?php echo $page_title; ?></h2></div>
		<div>
		  <div>
            <div>
              <div>
                <div style="text-align:justify">
                <?php
                if($photo!='')
					echo '<img src="uploads/static_photo/'.$photo.'" align="left" width="250" height="250" />';
				echo stripslashes($page_content);
				?>
                                    </div>
                </div>
              </div>
            </div>
	      </div>
		</div>

	
	<div id="content_area_right"> <?php echo  showbanners('right'); ?></div>
	<div class="clear"></div>
	<!-- Content Area End -->
	
<?php include("footer.php"); ?>