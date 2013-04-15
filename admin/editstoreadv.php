<?php include("top.php"); ?>

<?php

if($_SERVER['REQUEST_METHOD']=="POST")
{

$lang='';
for($i=0;$i<count($_POST['languages']);$i++)
{
if($lang=='')
	$lang=$_POST['languages'][$i];
else
	$lang.=",".$_POST['languages'][$i];
}


$pm='';
for($i=0;$i<count($_POST['payment_methods']);$i++)
{
if($pm=='')
	$pm=$_POST['payment_methods'][$i];
else
	$pm.=",".$_POST['payment_methods'][$i];
}

$hrs='';
if($_POST['hour_type']==2)
{
	for($i=0;$i<count($_POST['hour_fr']);$i++)
	{
		if($_POST['hour_fr']=='')
			$_POST['hour_fr']=' ';
	if($hrs=='')
		$hrs=$_POST['hour_fr'][$i];
	else
		$hrs.=",".$_POST['hour_fr'][$i];
	}
		
}

	$storeopen='';
if($_POST['hour_type']==2)
{
	$hrs=$hrs."|";

	for($i=0;$i<count($_POST['hour_to']);$i++)
	{
		if($_POST['hour_to']=='')
			$_POST['hour_to']=' ';
		if($i==0)
		{
			$hrs=$hrs.$_POST['hour_to'][$i];
			$storeopen=$_POST['storeopen'][$i];
		}
		else
		{
			$hrs.=",".$_POST['hour_to'][$i];
			$storeopen.=",".$_POST['storeopen'][$i];
		}
		
	}		
	
}

//die($hrs);

	$_POST['business_name']=mysql_real_escape_string($_POST['business_name']);
	$_POST['address']=mysql_real_escape_string($_POST['address']);
	
	if($_POST['display_address']==1)
		$dispaddr=1;
	else
		$dispaddr=0;
	$_POST['con_id']=mysql_real_escape_string($_POST['con_id']);
	$_POST['sta_id']=mysql_real_escape_string($_POST['sta_id']);	
	$_POST['city']=mysql_real_escape_string($_POST['cty_id']);		
	$_POST['zip_code']=mysql_real_escape_string($_POST['zip_code']);		



if($_GET['id']>0)
{	
$sql="update `soe_stores` set 
`mem_id`= '".$_GET['advid']."',
`slogan_text`='".mysql_real_escape_string($_POST['slogan_text'])."' ,
`store_name` ='".mysql_real_escape_string($_POST['store_name'])."',
`store_type`='".mysql_real_escape_string($_POST['store_type'])."' ,
`business_tax_id`='".mysql_real_escape_string($_POST['business_tax_id'])."' ,
`business_type`='".mysql_real_escape_string($_POST['business_type'])."' ,
`your_title` ='".mysql_real_escape_string($_POST['your_title'])."',
`business_since`='".mysql_real_escape_string($_POST['business_since'])."' ,
`phone` ='".mysql_real_escape_string($_POST['phone'])."',
`office_phone` ='".mysql_real_escape_string($_POST['office_phone'])."',
`fax`='".mysql_real_escape_string($_POST['fax'])."' ,
`website` ='".mysql_real_escape_string($_POST['website'])."',
`hour_type`='".mysql_real_escape_string($_POST['hour_type'])."' ,
`store_hours`='".mysql_real_escape_string($hrs)."' ,
`cross_street` ='".mysql_real_escape_string($_POST['cross_street'])."',
`transportation`='".mysql_real_escape_string($_POST['transportation'])."' ,
`directions` ='".mysql_real_escape_string($_POST['directions'])."',
`languages`='".mysql_real_escape_string($lang)."' ,
`payment_methods` ='".mysql_real_escape_string($pm)."',
`general_information` ='".mysql_real_escape_string($_POST['general_information'])."',
`certification`='".mysql_real_escape_string($_POST['certification'])."', 
`terms`='".mysql_real_escape_string($_POST['terms'])."',
`storeopen`='".mysql_real_escape_string($storeopen)."'  
 where sto_id=".$_GET['id']."";
mysql_query($sql) or die(mysql_error());
$id=$_GET['id'];
}
else
{

$sql="insert into `soe_stores` set 
`mem_id`= '".$_GET['advid']."',
`slogan_text`='".mysql_real_escape_string($_POST['slogan_text'])."' ,
`store_name` ='".mysql_real_escape_string($_POST['store_name'])."',
`store_type`='".mysql_real_escape_string($_POST['store_type'])."' ,
`business_tax_id`='".mysql_real_escape_string($_POST['business_tax_id'])."' ,
`business_type`='".mysql_real_escape_string($_POST['business_type'])."' ,
`your_title` ='".mysql_real_escape_string($_POST['your_title'])."',
`business_since`='".mysql_real_escape_string($_POST['business_since'])."' ,
`phone` ='".mysql_real_escape_string($_POST['phone'])."',
`office_phone` ='".mysql_real_escape_string($_POST['office_phone'])."',
`fax`='".mysql_real_escape_string($_POST['fax'])."' ,
`website` ='".mysql_real_escape_string($_POST['website'])."',
`hour_type`='".mysql_real_escape_string($_POST['hour_type'])."' ,
`store_hours`='".mysql_real_escape_string($hrs)."' ,
`cross_street` ='".mysql_real_escape_string($_POST['cross_street'])."',
`transportation`='".mysql_real_escape_string($_POST['transportation'])."' ,
`directions` ='".mysql_real_escape_string($_POST['directions'])."',
`languages`='".mysql_real_escape_string($lang)."' ,
`diff` ='".mysql_real_escape_string($_GET['diff'])."',
`payment_methods` ='".mysql_real_escape_string($pm)."',
`general_information` ='".mysql_real_escape_string($_POST['general_information'])."',
`certification`='".mysql_real_escape_string($_POST['certification'])."',
`terms`='".mysql_real_escape_string($_POST['terms'])."',
`storeopen`='".mysql_real_escape_string($storeopen)."' ,
added='".strtotime(date("Y-m-d"))."'";
mysql_query($sql) or die(mysql_error());
$id=mysql_insert_id();
}
	$sql="update soe_stores set business_name='".$_POST['business_name']."',address='".$_POST['address']."',zip_code='".$_POST['zip_code']."',con_id='".$_POST['con_id']."',sta_id='".$_POST['sta_id']."',cty_id='".$_POST['city']."',display_address='".$dispaddr."' where sto_id=".$id."";
	mysql_query($sql) or die(mysql_error().'<br/ >'.$sql);
	

					
		$nm='logo';
		$name=$_FILES[$nm]['name'];
		$tname=$_FILES[$nm]['tmp_name'];			
		if($name!='')
		{
			$name1=$id."_".$name;
			if(move_uploaded_file($tname,"../uploads/company_logo/".$name1))
			{
				mysql_query("update soe_stores set logo='".$name1."' where sto_id=".$id) or die(mysql_error());
					$basedir = ''; 				
					$phpThumb = new phpThumb();
					$f="../uploads/company_logo/".$name1;
					$f2=realpath("../uploads/company_logo/")."/thumb_".$name1;			
					$phpThumb->setSourceData(file_get_contents($f));
					$output_filename = $f2;
					$thumbnail_width = 100;
					$thumbnail_height = 36;
					$phpThumb->setParameter('w', $thumbnail_width);
					$phpThumb->setParameter('h', $thumbnail_height);

					$phpThumb->GenerateThumbnail();
					$phpThumb->RenderToFile($output_filename);
			}
		}
		if($_GET['frm']==1)
		{
		?>
        <script>
		location.href='storesadv1.php?advid=<?php echo $_GET['advid']; ?>';
		</script>
        <?php

		}
		else
		{
		?>
        <script>
		location.href='storesadv.php';
		</script>
        <?php
		}
}
	
?>
<div class="body" id="mk_height">
	
					

					<div class="divider_h">&nbsp;</div>
  <?php
  if($_GET['id']>0)
  {
	$rs=mysql_query("select * from soe_stores where sto_id=".$_GET['id']);
	$row=mysql_fetch_array($rs);
	extract($row);
}
	?>                  
                    
                    <script type="text/javascript" src="autocomplete/jquery.autocomplete.js"></script>
<link rel="stylesheet" media="screen" href="autocomplete/jquery.autocomplete.css">
<script type="text/javascript">
function findCity(li)
{
	if( li == null ) 
		return alert("No match!");
	if( !!li.extra ) 
		var sValue = li.extra[0];
	else 
		var sValue = li.selectValue;	
	$("#cty_id").val(sValue);
}
function selectCity(li)
{
	findCity(li);
}
function formatItem(row)
{
	return row[0];
}


$(document).ready(function() {
    $("select#con_id").change(function () {		
		$('#sta_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var con_id = $("#con_id").val();		
		$.get("populatestate.php?con_id="+con_id,
		function(xml){
			$('#sta_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("states",xml).each(function(id) {
				states = $("states",xml).get(id);	
				x='<?php echo $sta_id; ?>';
				if($("sta_id",states).text()==x)
					c='selected';
				else
					c='';
				result = '<option value="'+$("sta_id",states).text()+'" ' + c + '>'+$("name",states).text()+'</option>'
				$("#sta_id").append(result);
			});
		});
	});	
	$("#city").autocomplete("populatecity.php",
		{
			delay:10,
			minChars:2,
			matchSubset:1,
			matchContains:1,
			onItemSelect:selectCity,
			onFindValue:findCity,
			formatItem:formatItem,
			extraParams:{con_id:function() { return $("#con_id").val(); },sta_id:function() { return $("#sta_id").val(); }}
		}
	);

});
</script>
 <link rel="stylesheet" href="style1.css" type="text/css" />
<link rel="stylesheet" media="screen" href="timePicker.css">
<script type="text/javascript" src="jquery.timePicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$("#store_details").validate({
		rules: {
			slogan_text: {
				required: true,
				maxlength: 99
			},
			store_name: "required",
			phone: "required",
			general_information: {maxlength: 1000},
			certification: {maxlength: 99},
			terms_conditions: "required",
			business_name: "required",
			address: "required",
			zip_code: "required",
			sta_id: "required",
			city: "required",
			terms: "required"
			
		},
		messages: {
			slogan_text: {
				required: "<br/>Slogan Text can not be empty.",
				maxlength: "<br/>Slogan Text can not be more than 99 characters."
			},
			store_name: "<br/>Store Name can not be empty.",
			phone: "<br/>Phone Number can not be empty.",		
			general_information: "<br/>Slogan Text can not be more than 1000 characters.",
			certification: "<br/>Slogan Text can not be more than 1000 characters.",
						business_name: "<br/>Business Name can not be empty.",
			address: "<br/>Address can not be empty.",
			zip_code: "<br/>Zip Code can not be empty.",
			sta_id: "<br/>State can not be empty.",
			city: "<br/>City can not be empty.",
			terms: "<br/>Store Terms and Conditions can not be empty."

		}
	});	
});

jQuery(function() {
	$("#hour_fr1,#hour_fr2,#hour_fr3,#hour_fr4,#hour_fr5,#hour_fr6,#hour_fr7").timePicker({
	startTime: "12:00",
	endTime: "23:00",
	show24Hours: false,
	step: 30});
  });
  
jQuery(function() {
	$("#hour_to1,#hour_to2,#hour_to3,#hour_to4,#hour_to5,#hour_to6,#hour_to7").timePicker({
	startTime: "12:00",
	endTime: "23:00",
	show24Hours: false,
	step: 30});
  });
</script>

	
	<div class="mid_body">
	  <form class="form" id="store_details" name="store_details" method="post" action="" enctype="multipart/form-data">
        <input name="cty_id" id="cty_id" type="hidden" value="<?php echo $cty_id; ?>" />
        <div class="advertisersignup1">
          <div class="signup1column">
            <p><strong>Business Name</strong><br />
                <input name="business_name" class="input_box" id="business_name" type="text" value="<?php echo $business_name; ?>"/>
            </p>
            <p> <b>Country<br />
              </b>
                <select id="con_id" name="con_id" >
                  <option selected="selected" value="">Please Select</option>
                  <?php
		  				$cnid=0;
		  				$cnid1=0;						
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {
						   		if($con_id==$row['con_id'])
								{
									$c='selected';
									$cnid=$cnid1;
								}
								else
									$c='';
						   ?>
                  <option value="<?php echo $row['con_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                  <?php
		  			$cnid1++;
							}
							?>
                </select>
            </p>
            <p> <strong>State</strong><br />
                <select id="sta_id" name="sta_id"  >
                  <option selected="selected" value="">Please Select</option>
                </select>
            </p>
            <p> <strong>City</strong><br />
                <?php
	  
	  		mysql_query("SET NAMES 'utf8'") or die(mysql_error());
		mysql_query("SET CHARACTER SET utf8") or die(mysql_error());
		mysql_query("SET COLLATION_CONNECTION = 'utf8_general_ci'") or die(mysql_error());
 	if($cty_id>0 and $sta_id>0 and $con_id>0)
		{
	  	   $n="select * from soe_geo_cities WHERE con_id=".$con_id." AND sta_id=".$sta_id." and cty_id=".$cty_id." order by name";
		   $rscity=mysql_query($n);
		   $rowcity=mysql_fetch_array($rscity);
		   $cityname=$rowcity['name'];
		}

		?>
                <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text" value="<?php echo $cityname; ?>" />
            </p>
            <p> <strong>Address</strong><br />
                <textarea name="address" rows="4" cols="20" id="address"><?php echo $address; ?></textarea>
                <br />
                <input name="display_address" value="1" id="display_address" type="checkbox" <?php if($display_address==1) { ?> checked="checked" <?php } ?> />
                <span>Display address on listing.<br />
                  (Uncheck to hide your address, city, state, and zip on listing)</span> </p>
            <p> <strong> ZipCode</strong>
                <input name="zip_code" class="input_box" id="zip_code" type="text" value="<?php echo $zip_code; ?>" />
            </p>
            <p> <b>Company Slogan Text</b><span class="mark">*</span> &nbsp; &nbsp;(50 Characters)<br />
              Ex: We have over 3,000 brands of shoes. Come see us today!<br />
              <input name="slogan_text" type="text" id="slogan_text"  style="width:400px;" value="<?php echo $slogan_text; ?>" />
            </p>
            <p> <b>Upload Logo Image:</b><br />
                <input name="logo" type="file" id="logo" />
            </p>
            <p> <img src="../uploads/company_logo/thumb_<?php echo $logo; ?>" /></p>
            <div class="signupinnerform">
              <div class="signupinnerformcol">
                <p><b>Store Name:</b><br />
                    <input name="store_name" type="text" id="store_name"  style="width:200px;" value="<?php echo $store_name; ?>" maxlength="40" />
                </p>
                <p><b>Business Telephone #:</b><br />
                    <input name="phone" type="text" id="phone"  style="width:200px;" value="<?php echo $phone; ?>" maxlength="12" />
                  &nbsp;</p>
                <p><b>Languages Spoken:</b><br />
                    <span class="innertext">List languages spoken by your staff.</span><br />
                    <select id="languages[]" name="languages[]" style="width:120px;height:100px;" multiple="multiple">
                      <?php
							$n=1;
							$a=explode(",",$languages);
							$rs=mysql_query("select * from soe_lan_spoken where active=1");
							while($row=mysql_fetch_array($rs))
							{
							
							if(in_array($row['las_id'],$a))
								$c='selected';
							else
								$c='';
						   ?>
                      <option value="<?php echo $row['las_id']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                      <?php
							}
							?>
                    </select>
                </p>
              </div>
              <div class="signupinnerformcol">
                <p><b>Business TAX Id #:</b><br />
                    <input name="business_tax_id" type="text" id="business_tax_id"  style="width:200px;" value="<?php echo $business_tax_id; ?>" maxlength="20" />
                </p>
                <p><b>Fax</b><br />
                    <input name="fax" type="text" id="fax"  style="width:200px;" value="<?php echo $fax; ?>" maxlength="12" />
                </p>
                <p><b>In Business Since:</b><br />
                    <span class="innertext">Enter the year your business stared.</span><br />
                    <span class="input">
                    <select id="business_since" name="business_since" style="width:200px">
                      <option selected="selected" value="">Please Select</option>
                      <?php 
					$y=date('Y');
					for($i=1961;$i<=$y;$i++)
					{
						if($i==$business_since)
							$c='selected';
						else
							$c='';
					?>
                      <option value="<?php echo $i;?>" <?php echo $c; ?> ><?php echo $i; ?></option>
                      <?php
					}
					?>
                    </select>
                  </span></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
            </div>
            <br />
            <p> <b><br />
                  <br />
                  <br />
              Hours of Opertaion:</b><br />
              <input name="hour_type" value="0" checked="checked" type="radio" />
              Do not Display Operation Hours<br />
              <input name="hour_type" value="1" type="radio" <?php if($hour_type==1) { ?> checked="checked" <?php } ?>  />
              24 Hours a Day<br />
              <input name="hour_type" value="2" type="radio" <?php if($hour_type==2) { ?> checked="checked" <?php } ?>  />
              Use Hours of Operation Below<br />
            </p>
            <div class="signupinnerform1">
              <div class="signupinnerformcol1">
                <p>Monday </p>
                <p>Tuesday </p>
                <p>wednesday </p>
                <p>Thursday </p>
                <p>Friday </p>
                <p>Saturday </p>
                <p>Sunday </p>
              </div>
              <div class="signupinnerformcol2">
                <?php
				if($hour_type==2)
				{
					$a=explode("|",$store_hours);
					$hfr=explode(",",$a[0]);
					$hto=explode(",",$a[1]);
					$storearr=explode(",",$storeopen);
					
				}
				?>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,1);" >
                    <option value="1" <?php if($storearr[0]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[0]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						  if($storearr[0]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr1" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr1" readonly="readonly" type="text" value="<?php echo $hfr[0]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to1" readonly="readonly" type="text" value="<?php echo $hto[0]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,2);" >
                    <option value="1" <?php if($storearr[1]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[1]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						 if($storearr[1]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr2" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr2" readonly="readonly" type="text" value="<?php echo $hfr[1]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to2" readonly="readonly" type="text" value="<?php echo $hto[1]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,3);" >
                    <option value="1" <?php if($storearr[2]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[2]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						  if($storearr[2]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr3" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr3" readonly="readonly" type="text" value="<?php echo $hfr[2]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to3" readonly="readonly" type="text" value="<?php echo $hto[2]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,4);" >
                    <option value="1" <?php if($storearr[3]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[3]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						   if($storearr[3]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr4" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr4" readonly="readonly" type="text" value="<?php echo $hfr[3]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to4" readonly="readonly" type="text" value="<?php echo $hto[3]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,5);" >
                    <option value="1" <?php if($storearr[4]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[4]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						   if($storearr[4]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr5" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr5" readonly="readonly" type="text" value="<?php echo $hfr[4]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to5" readonly="readonly" type="text" value="<?php echo $hto[4]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,6);" >
                    <option value="1"  <?php if($storearr[5]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[5]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						   if($storearr[5]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr6" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr6" readonly="readonly" type="text" value="<?php echo $hfr[5]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to6" readonly="readonly" type="text" value="<?php echo $hto[5]; ?>" />
                  </span> </p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,7);" >
                    <option value="1" <?php if($storearr[6]==1) { ?> selected="selected" <?php } ?> >Open</option>
                    <option value="0" <?php if($storearr[6]==0) { ?> selected="selected" <?php } ?> >Closed</option>
                  </select>
                  &nbsp;&nbsp;
                  <?php
						  if($storearr[6]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                  <span id="hfr7" <?php echo $s; ?> >
                    <input autocomplete="OFF" name="hour_fr[]" class="input_box2" id="hour_fr7" readonly="readonly" type="text" value="<?php echo $hfr[6]; ?>" />
                    to
                    <input autocomplete="OFF" name="hour_to[]" class="input_box2" id="hour_to7" readonly="readonly" type="text" value="<?php echo $hto[6]; ?>" />
                  </span> </p>
              </div>
            </div>
            <p><b>Payment Methods:</b><br />
                <?php
			 $a=explode(",",$payment_methods);
			$n=1;
			$rs=mysql_query("select * from soe_store_payment where active=1");
			while($row=mysql_fetch_array($rs))
			{
				if(in_array($row['pay_id'],$a))
					$c='checked';
				else
					$c='';
			?>
                <input name="payment_methods[]" value="<?php echo $row['pay_id']; ?>" type="checkbox" <?php echo $c; ?> />
                <?php echo $row['name']; ?>
                <?php
			  	if($n%2==0)
					echo '<br class="clear">';
				$n++;
			  }
			  ?>
            </p>
            <p><b>Cross Street:</b><br />
                <input name="cross_street" type="text" id="cross_street" value="<?php echo $cross_street; ?>" size="60" />
                <br />
            </p>
            <p><b>Public Transportation:</b><br />
                <textarea name="transportation" cols="60" rows="4" id="transportation"><?php echo $transportation; ?></textarea>
                <br />
            </p>
            <p><b>Directions:</b><br />
                <textarea name="directions" cols="60" rows="4" id="directions"><?php echo $directions; ?></textarea>
                <br />
            </p>
            <p><b>General Information:</b><br />
              Describe your business and the types of products or services you offer.<br />
              <textarea name="general_information" cols="60" rows="4" id="general_information"><?php echo $general_information; ?></textarea>
              <br />
            </p>
            <p style="text-align:right; margin-right:150px;">Allowed Characters : 1000</p>
            <p><b>Affilication, Certifacations, or Licences:</b><br />
                <textarea name="certification" cols="60" rows="4" id="certification"><?php echo $certification;?></textarea>
                <br />
            </p>
            <p style="text-align:right; margin-right:150px;">Allowed Characters : 99</p>
            <p><b>Terms and Conditions:</b><span class="mark">*</span><br />
                <textarea name="terms" cols="60" rows="4" id="terms"><?php echo $terms; ?></textarea>
            </p>
            <p>
              <input name="submit" value="Submit" class="bttn" type="submit" />
            </p>
          </div>
        </div>
      </form>
	</div>
					
  <div class="divider_h">&nbsp;</div>
					
					
				</div>
				
				
	
<div style="top: 964px; left: 596.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 991px; left: 598.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1018px; left: 622.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1045px; left: 605.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1072px; left: 585.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1099px; left: 604.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1126px; left: 594.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 964px; left: 693.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 991px; left: 695.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1018px; left: 719.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1045px; left: 702.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1072px; left: 682.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1099px; left: 701.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div><div style="top: 1126px; left: 691.233px; display: none;" class="time-picker time-picker-12hours"><ul><li>06:00 AM</li><li>06:30 AM</li><li>07:00 AM</li><li>07:30 AM</li><li>08:00 AM</li><li>08:30 AM</li><li>09:00 AM</li><li>09:30 AM</li><li>10:00 AM</li><li>10:30 AM</li><li>11:00 AM</li><li>11:30 AM</li><li>12:00 PM</li><li>12:30 PM</li><li>01:00 PM</li><li>01:30 PM</li><li>02:00 PM</li><li>02:30 PM</li><li>03:00 PM</li><li>03:30 PM</li><li>04:00 PM</li><li>04:30 PM</li><li>05:00 PM</li><li>05:30 PM</li><li>06:00 PM</li><li>06:30 PM</li><li>07:00 PM</li><li>07:30 PM</li><li>08:00 PM</li><li>08:30 PM</li><li>09:00 PM</li><li>09:30 PM</li><li>10:00 PM</li></ul></div>
<script>
$(document).ready(function() {
    $("select#con_id").trigger('change');
	});
	
	function showhours(obj,n)
	{
		v=obj.options.selectedIndex;
		if(v==0)
			document.getElementById('hfr'+n).style.visibility='visible';
		else
			document.getElementById('hfr'+n).style.visibility='hidden';
	}

</script>

<?php include("bottom.php"); ?>