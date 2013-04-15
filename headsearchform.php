<form action="searchresults.php" method="post" name="hdsrchfrm">
<input type="hidden" name="cty_id" id="cty_id" value="" />
<div id="rightheaderbanner">
        <div class="headersearchcol">
          <div>
            <p>Product  : </p>
            <p>Footwear :</p>
            <p>Season : </p>
            <p>Store Name :</p>
            <p>State : </p>
            <p>Zipcode :</p>
          </div>
        </div>
        <div class="headersearchcol2">
          <div>
            <p>
              <input type="text" name="shoe_name" style="width:85px;" id="shoe_name">
            </p>
            <p >
              <select id="fot_id" name="fot_id" style="width:90px;">
                <option selected="selected" value="">Select....</option>
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
            </p>
            <p>
              <select id="sea_id" name="sea_id" style="width:90px">
                <option selected="selected" value="">Select....</option>
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
            </p>
            <p>
              <input type="text" name="store_name" style="width:85px;" id="store_name" />
            </p>
            <p>
              <select id="sta_id" name="sta_id" style="width:90px;">
					<option value="">Select....</option>
									</select>
            </p>
            <p>
              <input type="text" name="zip_code" style="width:85px;" id="zip_code">
            </p>
          </div>
        </div>
        <div class="headersearchcol">
          <div>
            <p>Category : </p>
            <p>Brand :</p>
            <p>Price : </p>
            <p>Country : </p>
            <p>City :</p>
            <div id="submit"  style="line-height:25px;"> <a href="#" style=" padding-top:0px; margin-left:0px; margin-top:10px;" onclick="javascript:document.hdsrchfrm.submit();">Submit</a> </div>
            
          </div>
        </div>
        <div class="headersearchcol3">
          <div>
            <p>
              <select id="shc_id" name="shc_id" style="width:90px;">
                <optgroup label>
                <option selected="selected" value="">Select....</option>
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
            </p>
            <p>
              <select id="brn_id" name="brn_id" style="width:90px;">
                <option selected="selected" value="">Select....</option>
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
            </p>
            <p>
              <input type="text" name="price" style="width:85px;" id="price" />
            </p>
            <p>
              <select id="con_id" name="con_id" style="width:90px">
                <option selected="selected" value="">Select....</option>
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
            </p>
            <p>
              <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text" style="width:85px;">
            </p>
          </div>
        </div>
      </div></form>