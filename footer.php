	<!-- Footer Area Start -->
	<div id="footer">
		<div>
         <?php
					$rs=mysql_query("select * from soe_static_pages where status='1' order by odering") or die(mysql_error());
					while($row=mysql_fetch_array($rs))
					{
						extract($row);
						if($enable_no_follow==1)
							$c='rel="nofollow"';
						else
							$c='';
					?>
        <a href="pages.php?pageid=<?php echo $pag_id; ?>" class="gray_link" <?php echo $c; ?> ><?php echo $page_title; ?></a> l
        <?php
					}
					?>
                    <a href="contactus.php" class="gray_link">Contact Us</a>
                    <?php
          if($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='adv')
		   {
		?>
         l <a href="advstatistics.php">Advertiser</a>
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='staff')
		   {
		   $a=redy();
		?>
         l <a href="<?php echo $a; ?>">Advertiser</a>
        <?php
		}
		elseif($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='mem')
		{
			echo '';
		}
		else
		{
		?>
         l <a href="advlogin.php">Advertiser</a>
        <?php
		}
		?>
        
        </div>
		<div>Copyright &copy; ShoeBreeze.com.Power by: INNOgenius.inc. All rights reserved</div>
	</div>
</div>
</body>
</html>
