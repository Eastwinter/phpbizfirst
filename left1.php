     <script language="javascript" src="picker.js"></script>
<link href="picker.css" rel="stylesheet" type="text/css" />

<script>
$(document).ready(function() { 
    var options = { 
	beforeSubmit: function () { $('#content_area_mid_inner1').html('<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><center><img src="throbber.gif"></center>')},
        target:        '#content_area_mid_inner1',   // target element(s) to be updated with server response 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#leftsrchfrm').ajaxForm(options); 
	
	
	$("#subsrchbtn").click(function() {
           $('#leftsrchfrm').submit();
        });
}); 
 
 

</script>


<script type="text/javascript" src="autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" media="screen" href="autocomplete/jquery.autocomplete.css">
<?php
if($_SERVER['REQUEST_METHOD']=="POST")
{
	extract($_POST);
	//print_r($_POST);
}

if($_GET['catid']>0)
	$shc_id=$_GET['catid'];
	
?>



<div id="content_area_left_inner">
  <form action="srchajax.php" method="post" name="leftsrchfrm" id="leftsrchfrm">
  
  
  
  
  <div style="display:none" >
         <div id='inline_example88' style='padding:10px; background:#fff;'>
          <div id="writereview" style="width:500px;">
          
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <?php
		  
		  $rsadvc=mysql_query("select * from soe_advcolor where active='1'");
		  while($rowadvc=mysql_fetch_array($rsadvc))
		  {
		  		if($_GET['id']>0)
				{
					$rsadvcval=mysql_query("select * from advcolorvalues where soeid=".$_GET['soeid']." and colid=".$_GET['id']." and advcolid=".$rowadvc['advcol_id']);
					$rowadvcval=mysql_fetch_array($rsadvcval);
					$val=$rowadvcval['value'];
				}
				else
					$val='';
		  ?>
          <tr>
            <td><strong><?php echo $rowadvc['name']; ?> :</strong></td>
            <td><input name="color<?php echo $rowadvc['advcol_id']; ?>" type="text" id="color<?php echo $rowadvc['advcol_id']; ?>" size="7" maxlength="80" value="<?php echo $val; ?>" style="background-color:<?php echo $val; ?>" /> 
<img src="images/color.png" align="absmiddle" style="cursor:pointer;" onclick="openPicker('color<?php echo $rowadvc['advcol_id']; ?>')" /></td>
          </tr>
          <?php
		  }
		  ?>
          <tr>
          <td colspan="2">
          <a onclick="javascript: $.colorbox.close();" /><img src="images/done.jpg" border="0" /></td>
          </td>
          </tr>
	</table>
        
        </div>
          </div>
        </div>
  
  
  
        <input type="hidden" name="cty_id" id="cty_id" value="" />
    <div id="content_area_left_inner_inner">
      <div><img src="images/search_again.jpg" alt=""></div>
      <ul>
        <li> Product Name<br>
          <input type="text" name="shoe_name" class="txt_box" id="shoe_name" value="<?php echo $shoe_name; ?>" />
        </li>
        <li> Shoes Category<br>
          <select name="shc_id" class="txt_box" id="shc_id">
            <optgroup label="label">
            <option selected="selected" value=""><span class="search_txtbox">-- Select --</span></option>
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
            <option value="<?php echo $row1['shc_id']; ?>" <?php echo $c; ?> ><span class="search_txtbox"><?php echo $row1['name']; ?></span></option>
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
        <li> Shoe Type<br>
          <select name="sht_id" class="txt_box" id="sht_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_shoe_type  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['sht_id']==$row['sht_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['sht_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> Type of sole<br>
          <select name="sol_id" class="txt_box" id="sol_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_sole_type  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['sol_id']==$row['sol_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['sol_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> Type of Closure<br>
          <select name="clo_id" class="txt_box" id="clo_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_closure  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['clo_id']==$row['clo_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['clo_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> Shoe Lace<br>
          <input name="shoe_lace" value="1" type="radio" <?php if($_POST['lace']=='1') { ?> checked="checked" <?php } ?>  />
Yes
<input name="shoe_lace" value="0" type="radio" <?php if($_POST['lace']=='0') { ?> checked="checked" <?php } ?>  />
No </li>
        <li> Material<br>
          <select name="mtr_id[]" size="5" class="txt_box" multiple="multiple" id="mtr_id[]" >
            <option selected="selected" value="">Any....</option>
            <?php
						   $rs=mysql_query("select * from soe_material where active=1  order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['mtr_id']==$row['mtr_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['mtr_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li><br /><br /><br /><br />
        <li> Color<br />
            <input name="maincolor" id="maincolor" size="7" maxlength="80" value="" style="width: 90px; " type="text" />
            <img src="images/color.png" width="16" height="16" align="absmiddle" style="cursor: pointer;" onclick="openPicker('maincolor')" /> </li>
            
           <li><strong>Advance Color Options</strong><a href="#" class="example88 orange style1"><img src="images/color.png" width="16" height="16" border="0" align="absmiddle" style="cursor: pointer;" /></a></li>
         
        <li> Shoe size <br>
          <select name="siz_id" class="txt_box" id="siz_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_shoe_size  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['siz_id']==$row['siz_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['siz_id']; ?>" <?php echo $c; ?> ><?php echo htmlentities($row['name']); ?></option>
            <?php
							}
							?>
          </select>
        </li>
      
        <li> Shoe Width<br>
          <select name="shw_id" class="txt_box" id="shw_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_shoe_width  where active=1 order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['shw_id']==$row['shw_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['shw_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> Heel Height<br />
            <select name="hlh_id" class="txt_box" id="hlh_id">
              <option selected="selected" value="">-- Select --</option>
              <?php
						   $rs=mysql_query("select * from soe_heel_height where active=1  order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['hlh_id']==$row['hlh_id'])
									$c='selected';
								else
									$c='';
						   ?>
              <option value="<?php echo $row['hlh_id']; ?>" <?php echo $c; ?> ><?php echo str_replace('""','',$row['name']); ?></option>
              <?php
							}
							?>
            </select>
        </li>
        <li> Heel size<br>
          <select name="hls_id" class="txt_box" id="hls_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_heel_size where active=1  order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['hls_id']==$row['hls_id'])
									$c='selected';
								else
									$c='';
						   ?>
            <option value="<?php echo $row['hls_id']; ?>" <?php echo $c; ?> ><?php echo str_replace('""','',$row['name']); ?></option>
            <?php
							}
							?>
          </select>
        </li>
        <li> Season<br>
          <select name="sea_id" class="txt_box" id="sea_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_season where active=1  order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['sea_id']==$row['sea_id'])
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
          <input type="text" name="price" class="txt_box" id="price" value="<?php echo $price; ?>" />
        </li>
        <li> Store name <br>
          <input type="text" name="store_name" class="txt_box" id="store_name" value="<?php echo $store_name; ?>" />
        </li>
        <li> Country <br>
          <select name="con_id" class="txt_box" id="con_id">
            <option selected="selected" value="">-- Select --</option>
            <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['con_id']==$row['con_id'])
									$c='selected';
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
          <select name="sta_id" class="txt_box" id="sta_id">
            <option selected="selected" value="">-- Select --</option>
           
          </select>
        </li>
        <li> City <br>
          <input autocomplete="off" name="city" class="input_box txt_box" id="city" type="text" value="<?php echo $city; ?>" />
        </li>
        <li> Zipcode<br>
          <input type="text" name="zip_code" class="txt_box" id="zip_code" value="<?php echo $zip_code; ?>" />
        </li>
      </ul>
      <div><input type="image" src="images/submit_search.jpg" alt="" border="0" class="img"></div>
    </div>
    </form>
  </div>
   <script>
$(document).ready(function() {
    $("select#con_id").trigger('change');


	});
</script>