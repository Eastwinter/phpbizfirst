<div id="content_area_left">
    <?php 
	$i=0;
	$st='';
	$rs=mysql_query("select * from soe_shoe_category where active=1 and parent_id=0");
	while($row=mysql_fetch_array($rs))
	{
		if($i>0)
			$st=" style='display:none'";
		
		
	?>
		<div class="rightnav_head">        
        <h3 onmouseOver="checkvalue('<?php echo $row['name']; ?>')" style="cursor:pointer;" class="lfmenu"><?php echo $row['name']; ?></h3></div>
		<div id="<?php echo $row['name']; ?>"<?php echo $st; ?>>
			<ul>
            <?php 
				$rs1=mysql_query("select * from soe_shoe_category where active=1 and parent_id=".$row['shc_id']);
				while($row1=mysql_fetch_array($rs1))
				{
			?>
				<li><a href="searchresults.php?catid=<?php echo $row1['shc_id']; ?>" class="gray_linkn"><?php echo $row1['name']; ?></a></li>
              <?php
			  }
			  ?>
			</ul>
		</div>
    <?php
	$i++;
	}
	?>
		
	</div>