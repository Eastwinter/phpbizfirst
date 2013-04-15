<?php include("header.php"); 

$errmsg='';
if($_SERVER['REQUEST_METHOD']=="POST")
{

$rs=mysql_query("select * from soe_banned where banvalue like '".$_POST['email']."'");
if(mysql_num_rows($rs)<=0)
{
if(mysql_real_escape_string($_POST['shoe_lace'])=='')
	$_POST['shoe_lace']='0';

		$sql="INSERT INTO soe_shoe set
		`mem_id`='0' ,
		`name`='".mysql_real_escape_string($_POST['shoe_name'])."',
		`description`='".mysql_real_escape_string($_POST['description'])."',
		`link` ='".mysql_real_escape_string($_POST['link'])."',
		`cnt_id`='".mysql_real_escape_string($_POST['con_id'])."', 
		`sta_id`='".mysql_real_escape_string($_POST['sta_id'])."', 
		`cty_id`='".mysql_real_escape_string($_POST['cty_id'])."', 
		`zip_code`='".mysql_real_escape_string($_POST['zip_code'])."', 
		`brn_id` ='".mysql_real_escape_string($_POST['brn_id'])."',
		`fot_id` ='".mysql_real_escape_string($_POST['fot_id'])."',
		`col_id` ='".mysql_real_escape_string($_POST['col_id'])."',
		`mtr_id` ='".mysql_real_escape_string($_POST['mtr_id'])."',
		`hlh_id` ='".mysql_real_escape_string($_POST['hlh_id'])."',
		`hls_id` ='".mysql_real_escape_string($_POST['hls_id'])."',
		`sol_id` ='".mysql_real_escape_string($_POST['sol_id'])."',
		`clo_id` ='".mysql_real_escape_string($_POST['clo_id'])."',
		`lace` ='".mysql_real_escape_string($_POST['shoe_lace'])."',
		`siz_id` ='".mysql_real_escape_string($_POST['siz_id'])."',
		`sht_id` ='".mysql_real_escape_string($_POST['sht_id'])."',
		`shw_id` ='".mysql_real_escape_string($_POST['shw_id'])."',
		`price` ='".mysql_real_escape_string($_POST['price'])."',
		`sea_id` ='".mysql_real_escape_string($_POST['sea_id'])."',
		`active` ='0',
		`added` ='".strtotime(date("Y-m-d"))."',
		`shc_id`='".mysql_real_escape_string($_POST['shc_id'])."',
		`email`='".mysql_real_escape_string($_POST['email'])."'";
		
		mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
		$id=mysql_insert_id();
			
		?>
		<script>
		location.href='footwearsuggestions1.php?soeid=<?php echo $id; ?>';
		</script>
		<?php
}
else
{
	$errmsg='You are not allowed to upload shoes!';
}
}
?>

	<script type="text/javascript">
	
	
		function validateCaptcha()
{
	var responseField;
	var challengeField;
    challengeField = $("input#recaptcha_challenge_field").val();
    responseField = $("input#recaptcha_response_field").val();
	if(responseField=='')
	{
		alert('Human input verification can not be empty.');
		return false;
	}
	
	var html = $.ajax({
    type: "POST",
    url: "ajax.recaptcha.php",
    data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
    async: false
    }).responseText;
	
 
    if(html == "success")
    {
        $("#captchaStatus").html(" ");
		
        return true;
    }
    else
    {
        $("#captchaStatus").html("Your captcha is incorrect. Please try again");
        Recaptcha.reload();
        return false;
    }
}
	
$().ready(function() {
	



	$("#add_shoe").validate({
		rules: {
			email: {
				required: true,
				email: true
				},
			link: {
				required: true,
				url: true
				},

			shoe_name: "required",
			description: "required",
			price: 
			{
			required: true,
			number: true
			}
		},
		messages: {
			shoe_name: "<br />Shoe Name can not be empty.",
			description: "<br />Description can not be empty.",
			price: {
			required: "<br />Price cannot be empty",
			number: "<br />Price should be a number"
			},
			link: {
				required: '<br />Enter the link',
				url: '<br />Enter a valid url'
				},			
			email:
			{
				required: '<br />Email-Id is required',
				email: '<br />Enter a valid email id'
			}
		}
	});
	
});
</script>			

<?php
if($errmsg!='')
{
?>
<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
<div id="object" class="message_box">
		<span class="err"><?php echo $errmsg; ?></span></div>
<?php
}
?>
  <?php include("left.php"); ?>
   <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data" onsubmit="return validateCaptcha();">
            <input type="hidden" name="cty_id" id="cty_id" value="" />
  <div id="content_area_mid_inner1">
    <div><img src="images/fs_head.jpg" alt=""></div>
    <div class="search_lable_innerpage">Your Email*</div>
    <div class="search_txtbox_innerpage">
      <input name="email" type="text" class="txt_box1" id="email" value="<?php echo $email; ?>" size="35">
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Shoe Name*</div>
    <div class="search_txtbox_innerpage">
      <input name="shoe_name" type="text" class="txt_box1" id="shoe_name" value="<?php echo $name; ?>" size="35">
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Product Description*</div>
    <div class="search_txtbox_innerpage">
      <textarea name="description" cols="32" rows="5" class="txt_box1" id="description"><?php echo $description; ?></textarea>
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Link</div>
    <div class="search_txtbox_innerpage">
      <input name="link" type="text" class="txt_box1" id="link" value="<?php echo $link; ?>" size="35">
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Price</div>
    <div class="search_txtbox_innerpage">
      <input name="price" type="text" class="txt_box1" id="price" value="<?php echo $price; ?>" size="35">
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Country</div>
    <div class="search_txtbox_innerpage">
      <select name="con_id" class="txt_box1" id="con_id">
        <option selected value="">-- Select --</option>
         <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($_POST['cnt_id']==$row['con_id'])
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
    <div class="search_lable_innerpage">State</div>
    <div class="search_txtbox_innerpage">
      <select name="sta_id" class="txt_box1" id="sta_id">
        <option>-- Select --</option>
      </select>
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">City</div>
    <div class="search_txtbox_innerpage">
      <input name="city" type="text" class="txt_box1" size="35" id="city" autocomplete="off" >
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Zip Code</div>
    <div class="search_txtbox_innerpage">
      <input name="zip_code" type="text" class="txt_box1" size="35" id="zip_code">
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Brand</div>
    <div class="search_txtbox_innerpage">
      <select name="brn_id" class="txt_box1" id="brn_id">
       
        <option selected="selected" value="">-- Select --</option>
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
    <div class="clear"></div>
    <div class="search_lable_innerpage">Category</div>
    <div class="search_txtbox_innerpage">
      <select name="shc_id" class="txt_box1" id="shc_id">
         <optgroup label="label">
                    <option selected="selected" value=""><span class="input">-- Select --</span></option>
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
                    <option value="<?php echo $row1['shc_id']; ?>" <?php echo $c; ?> ><span class="input"><?php echo $row1['name']; ?></span></option>
                    <?php
									}
							?>
                    </optgroup>
                    <?php
							}
							?>
      </select>
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Footware</div>
    <div class="search_txtbox_innerpage">
      <select name="fot_id" class="txt_box1" id="fot_id">
       
          <option selected="selected" value="">-- Select --</option>
                <?php
						   $rs=mysql_query("select * from soe_foot_ware order by name");
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
    <div class="clear"></div>
    <div class="search_lable_innerpage">Material</div>
    <div class="search_txtbox_innerpage">
      <select name="mtr_id" class="txt_box1" id="mtr_id" >
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Heel Height</div>
    <div class="search_txtbox_innerpage">
      <select name="hlh_id" class="txt_box1" id="hlh_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Heel Size</div>
    <div class="search_txtbox_innerpage">
      <select name="hls_id" class="txt_box1" id="hls_id">
        
          <option selected="selected" value="">-- Select --</option>
                    <?php
						   $rs=mysql_query("select * from soe_heel_size order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($hls_id==$row['hls_id'])
									$c='selected';
								else
									$c='';
						   ?>
                    <option value="<?php echo $row['hls_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                    <?php
							}
							?>
      </select>
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Type of Sole</div>
    <div class="search_txtbox_innerpage">
      <select name="sol_id" class="txt_box1" id="sol_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Type of Closure</div>
    <div class="search_txtbox_innerpage">
      <select name="clo_id" class="txt_box1" id="clo_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Shoe Lace</div>
    <div class="search_txtbox_innerpage">
      <input name="shoe_lace" value="1" type="radio" <?php if($_POST['lace']=='1') { ?> checked="checked" <?php } ?>  />
Yes
<input name="shoe_lace" value="0" type="radio" <?php if($_POST['lace']=='0') { ?> checked="checked" <?php } ?>  />
No</div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Shoe Size</div>
    <div class="search_txtbox_innerpage">
      <select name="siz_id" class="txt_box1" id="siz_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Shoe Type</div>
    <div class="search_txtbox_innerpage">
      <select name="sht_id" class="txt_box1" id="sht_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Shoe Width</div>
    <div class="search_txtbox_innerpage">
      <select name="shw_id" class="txt_box1" id="shw_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Season</div>
    <div class="search_txtbox_innerpage">
      <select name="sea_id" class="txt_box1" id="sea_id">
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
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage">Input Verification</div>
    <div class="search_txtbox_innerpage">
       <?php 
	include("recaptcha.php");
	echo recaptcha_get_html($publickey); ?>
    <span id="captchaStatus" class="error"></span>
    </div>
    <div class="clear"></div>
    <div class="search_lable_innerpage"></div>
    <div class="search_txtbox_innerpage"><input type="image" src="images/submit_button.jpg" name="submit"></a> </div>
    <div class="clear"></div>
  </div>
  
  </form>
  <div id="content_area_right"><?php echo  showbanners('right'); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
<?php include("footer.php"); ?>