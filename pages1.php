<?php include("connect.php"); ?>
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

	<?php
					$rs=mysql_query("select * from soe_static_pages where pag_id=".$_GET['pageid']);
					$row=mysql_fetch_array($rs);
					extract($row);
					?>
	<div id="content_area_mid" style="width:750px"> 
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

	
	