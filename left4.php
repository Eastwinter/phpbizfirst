<script type="text/javascript" src="autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" media="screen" href="autocomplete/jquery.autocomplete.css">
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	extract($_POST);
	//print_r($_POST);
}
?>

<script>

 function findCity1(li)
{
	if( li == null ) 
		return alert("No match!");
	if( !!li.extra ) 
		var sValue = li.extra[0];
	else 
		var sValue = li.selectValue;	
	$("#cty_id1").val(sValue);
}

 $j(document).ready(function() {
    $("select#con_id1").change(function () {		
		$('#sta_id1').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var con_id = $("#con_id1").val();		
		$.get("populatestate.php?con_id="+con_id,
		function(xml){
			$('#sta_id1').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("states",xml).each(function(id) {
			states = $("states",xml).get(id);	
				x='<?php echo $sta_id1; ?>';
				if($("sta_id",states).text()==x)
					c='selected';
				else
					c='';
				result = '<option value="'+$("sta_id",states).text()+'" ' + c + '>'+$("name",states).text()+'</option>'
//				states = $("states",xml).get(id);				
	//			result = '<option value="'+$("sta_id",states).text()+'">'+$("name",states).text()+'</option>'
				$("#sta_id1").append(result);
			});
		});
	});	
	
	$j("#city1").autocomplete("populatecity.php",
		{
			delay:10,
			minChars:2,
			matchSubset:1,
			matchContains:1,
			onItemSelect:selectCity,
			onFindValue:findCity1,
			formatItem:formatItem,
			extraParams:{con_id1:function() { return $("#con_id1").val(); },sta_id1:function() { return $("#sta_id1").val(); }}
		}
	);
	});
	</script>


  <!-- Navigation bar Start -->
  <div id="navigation2">
    <ul>
      <li class="navigation_current_link"><a href="moremarketing.php" class="white_link">More Marketing</a></li>
      <li class="navigation_current_link"><a href="advprofile.php" class="white_link">Edit Profile</a></li>
      <li class="navigation_current_link"><a href="mystores.php" class="white_link">My Stores</a></li>
      <li class="navigation_current_link"><a href="advshoes.php" class="white_link">Edit Inventory</a></li>
      <li class="navigation_current_link"><a href="sbdatabase.php" class="white_link">SB Database</a></li>
      <li class="navigation_current_link"><a href="advpurchaselot.php" class="white_link">Purchase Lot</a></li>
      <li class="navigation_current_link"><a href="advfeedback.php" class="white_link">Feed Back</a></li>
      <li class="navigation_current_link"><a href="advstatistics.php" class="white_link">Statistics</a></li>
      <li><a href="advsavedsearches.php" class="white_link">Saved Searches</a></li>
    </ul>
  </div>
  <!-- Navigation bar End -->
  <!-- Content Area Start -->
  <div class="hei"></div>
  <div id="content_area_left_inner">
  
  <form action="ajaxsbdb.php" method="post" name="srchfrm" id="srchfrm">
  
              <input type="hidden" name="cty_id1" id="cty_id1" value="" />
             <input type="hidden" name="sto_id" id="sto_id" value="" />
             <input type="hidden" name="loc_id" id="loc_id" value="" />
    <div id="content_area_left_inner_inner">
      <div><img src="images/search_again2.jpg" alt=""></div>
      <ul>
        <li> Product Name<br>
          
          <input name="shoe_name" type="text" class="txt_box" size="15" id="shoe_name" value="<?php echo $shoe_name; ?>" />
        </li>
        <li> Shoes Category<br>
          <select name="shc_id" class="txt_box" id="shc_id">
            <optgroup label="label">
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
        </li>
        <li> Brand<br>
          
          <select name="brn_id" class="txt_box" id="brn_id">
            <option value="" selected="selected">-- Select --</option>
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
        </li>
        <li> Footwear<br>
          
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
        </li>
        <li> Season<br>
          
          <select name="sea_id" class="txt_box" id="sea_id">
            <option value="" selected="selected">-- Select --</option>
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
        </li>
        <li> Price<br>
          
          <input name="price" type="text" class="txt_box" size="15" id="price" />
        </li>
        <li> Country <br>
          
          <select name="con_id1" class="txt_box" id="con_id1">
            <option value="" selected="selected">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($con_id1==$row['con_id'])
									$c='selected="selected"';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['con_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> State <br>
          
          <select name="sta_id1" class="txt_box" id="sta_id1">
            <option>-- Select --</option>
          </select>
        </li>
        <li> City <br>
          
          <input name="city1" type="text" class="txt_box" size="15" id="city1" autocomplete="off" value="<?php echo $city1; ?>" />
        </li>
        <li> Zipcode<br>
          
          <input name="zipcode" type="text" class="txt_box" size="15" id="zipcode" value="<?php echo $zipcode; ?>" />
        </li>
      </ul>
      <div><a id="srchfrmbtn"><img src="images/submit_search.jpg" alt="" border="0" class="img"></a></div>
    </div>
    
    </form>
  </div>
  
  <script>
$j(document).ready(function() {
    $("select#con_id1").trigger('change');


	});
</script>