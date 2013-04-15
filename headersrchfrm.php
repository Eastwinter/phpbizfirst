<form action="searchresults.php" method="post" name="hdsrchfrm">
<input type="hidden" name="cty_id" id="cty_id" value="" />


		<div id="search_pos">
			<div class="search_lable">Product :</div>
			<div class="search_txtbox"><input name="shoe_name" type="text" class="txt_box" size="15" id="shoe_name">
			</div>
			<div class="search_lable">Store Name :</div>
			<div class="search_txtbox">
		    <input name="store_name" type="text" class="txt_box" size="15" id="store_name">
			</div>
			<div class="clear"></div>
			<div class="search_lable">Category :</div>
			<div class="search_txtbox">
			  <select name="shc_id" class="txt_box" id="shc_id">
			    
                 <optgroup label>
                <option selected="selected" value="">-- Select --</option>
                </optgroup>
                <?php
						   $rs=mysql_query("select * from soe_shoe_category where active=1 and parent_id=0 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   ?>
                <optgroup label="<?php echo $row['name']; ?>">
                <?php
								 $rs1=mysql_query("select * from soe_shoe_category where active=1 and parent_id=".$row['shc_id']);
						   			while($row1=mysql_fetch_array($rs1))
						  			 {
									 	if($shc_id==$row1['shc_id'])
											$c='selected';
										else
											$c='';
						   	?>
                <option value="<?php echo $row1['shc_id']; ?>" <?php echo $c; ?> ><?php echo $row1['name']; ?></option>
                <?php
									}
							?>
                </optgroup>
                <?php
							}
							?>
		      </select>
			</div>
			<div class="search_lable">Country :</div>
			<div class="search_txtbox">
			  <select name="con_id" class="txt_box" id="con_id">
			    <option value="" selected>-- Select --</option>
                  <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($cnt_id==$row['con_id'])
									$c='selected';
								else
									$c='';
						   ?>
                <option value="<?php echo $row['con_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                <?php
							}
							?>
		      </select>
			</div>
			<div class="clear"></div>
			<div class="search_lable">Footwear :</div>
			<div class="search_txtbox">
				<select name="fot_id" class="txt_box" id="fot_id">
			     <option selected="selected" value="">-- Select --</option>
                <?php
						   $rs=mysql_query("select * from soe_foot_ware  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($fot_id==$row['fot_id'])
									$c='selected';
								else
									$c='';
						   ?>
                <option value="<?php echo $row['fot_id']; ?>" <?php echo $c; ?>><?php echo $row['name']; ?></option>
                <?php
							}
							?>
	          </select>
			</div>
			<div class="search_lable">State :</div>
			<div class="search_txtbox">
				<select name="sta_id" class="txt_box" id="sta_id">
			    <option value="">-- Select --</option>
	          </select>
			</div>
			<div class="clear"></div>
			<div class="search_lable">Brand :</div>
			<div class="search_txtbox">
				<select name="brn_id" class="txt_box" id="brn_id">
			    <option value="" selected>-- Select --</option>
                <?php
						   $rs=mysql_query("select * from soe_brand where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   if($brn_id==$row['brn_id'])
									$c='selected';
								else
									$c='';
						   ?>
                <option value="<?php echo $row['brn_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                <?php
							}
							?>
	          </select>
			</div>
			<div class="search_lable">City :</div>
			<div class="search_txtbox"><input name="city" type="text" class="txt_box" size="15" id="city" autocomplete="off">
			</div>
			<div class="clear"></div>
			<div class="search_lable">Season :</div>
			<div class="search_txtbox">
				<select name="sea_id" class="txt_box" id="sea_id">
			    <option value="" selected>-- Select --</option>
                <?php
						   $rs=mysql_query("select * from soe_season where active=1  order by name") or die(mysql_error());
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($sea_id==$row['sea_id'])
									$c='selected';
								else
									$c='';
						   ?>
                <option value="<?php echo $row['sea_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                <?php
							}
							?>
	          </select>
			</div>
			<div class="search_lable">Zip Code :</div>
			<div class="search_txtbox"><input name="zip_code" type="text" class="txt_box" size="15" id="zip_code">
			</div>
			<div class="clear"></div>
			<div class="search_lable">Price :</div>
			<div class="search_txtbox"><input name="price" type="text" class="txt_box" size="15" id="price">
			</div>
			<div id="search_submit"><a href="#" onclick="javascript:document.hdsrchfrm.submit();"><img src="images/submit_search_button.jpg" alt="" class="img"></a></div>
			<div class="clear"></div>
			
			
		</div>
</form>  