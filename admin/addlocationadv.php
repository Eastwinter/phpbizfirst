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
	$_POST['address']=mysql_real_escape_string($_POST['address']);
	
	if($_POST['display_address']==1)
		$dispaddr=1;
	else
		$dispaddr=0;
	$_POST['con_id']=mysql_real_escape_string($_POST['con_id']);
	$_POST['sta_id']=mysql_real_escape_string($_POST['sta_id']);	
	$_POST['cty_id']=mysql_real_escape_string($_POST['cty_id']);		
	$_POST['zip_code']=mysql_real_escape_string($_POST['zip_code']);		


if($_GET['id']>0)
{
$rs=mysql_query("select * from soe_stores where sto_id=".$_GET['stoid']);
						$row=mysql_fetch_array($rs);						
						$con_id=$row['con_id'];
						$sta_id=$row['sta_id'];
						
$sql="update `soe_storelocations` set 
`hour_type`='".mysql_real_escape_string($_POST['hour_type'])."' ,
`store_hours`='".mysql_real_escape_string($hrs)."' ,
`cross_street` ='".mysql_real_escape_string($_POST['cross_street'])."',
`transportation`='".mysql_real_escape_string($_POST['transportation'])."' ,
`directions` ='".mysql_real_escape_string($_POST['directions'])."',
`active` ='1',address='".$_POST['address']."',zip_code='".$_POST['zip_code']."',con_id='".$con_id."',sta_id='".$sta_id."',cty_id='".$_POST['cty_id']."',display_address='".$dispaddr."',`storeopen`='".mysql_real_escape_string($storeopen)."'   where loc_id=".$_GET['id'];
mysql_query($sql) or die(mysql_error());
}
else
{

$rs=mysql_query("select * from soe_stores where sto_id=".$_GET['stoid']);
$row=mysql_fetch_array($rs);						
$con_id=$row['con_id'];
$sta_id=$row['sta_id'];
						
$sql="insert into `soe_storelocations` set 
`sto_id`= '".$_GET['stoid']."',
`hour_type`='".mysql_real_escape_string($_POST['hour_type'])."' ,
`store_hours`='".mysql_real_escape_string($hrs)."' ,
`cross_street` ='".mysql_real_escape_string($_POST['cross_street'])."',
`transportation`='".mysql_real_escape_string($_POST['transportation'])."' ,
`directions` ='".mysql_real_escape_string($_POST['directions'])."',
`active` ='1',address='".$_POST['address']."',zip_code='".$_POST['zip_code']."',con_id='".$con_id."',sta_id='".$sta_id."',cty_id='".$_POST['cty_id']."',display_address='".$dispaddr."',`storeopen`='".mysql_real_escape_string($storeopen)."'  ,added='".time()."'";
mysql_query($sql) or die(mysql_error());
$locid=mysql_insert_id();

}

if($_GET['pay']=='true')
{


	$rs=mysql_query("select * from soe_settings where field='price_vat'");
	$row=mysql_fetch_array($rs);
	$price_vat=$row[2];
	
	$p="select price,p.packageid,m.subscription,addlocation from soe_packages p,soe_membership m where m.packageid=p.packageid and m.sto_id=".$_GET['stoid']." and m.mem_id=".$_SESSION['memberid'];
	$rs=mysql_query($p) or die(mysql_error().'<br />'.$p);
	$row=mysql_fetch_array($rs);
	//print_r($row);
	//die();
	$price=$row['addlocation'];
	
	$package=$row['packageid'];
	if($row['subscription']=='monthly')
		$price_exc_vat = $price;

	if($row['subscription']=='sixmonthly')
		$price_exc_vat = $price*6;
		
	if($row['subscription']=='yearly')
		$price_exc_vat = $price*12;
	
					if(empty($price_vat))
					{
						$vat = 0;
						$total = $price_exc_vat;
					}
					else
					{
						$vat = (($price_exc_vat*$price_vat)/100);
						$total = $price_exc_vat+$vat;
					}
	
$sql="insert into soe_membership set mem_id='".$_GET['advid']."',sto_id=".$_GET['stoid'].",loc_id=".$locid.",packageid='".$row['packageid']."',price_exc_vat='".floatval($price_exc_vat)."',vat='".floatval($vat)."',total='".floatval($total)."',subscription='".$row['subscription']."',payment='paid'";

mysql_query($sql) or die(mysql_error());
$memshipid=mysql_insert_id();

?>
        <script>
		location.href='locationsadv.php?stoid=<?php echo $_GET['stoid']; ?>';
		</script>
 <?php

}
else
{
?>
        <script>
		location.href='locationsadv.php?id=<?php echo $_GET['stoid']; ?>';
		</script>
 <?php
 }
}

	
?>
	

 <?php
					if($_GET['id']>0)
					{
						$rs=mysql_query("select * from soe_storelocations where loc_id=".$_GET['id']);
						$row=mysql_fetch_array($rs);
						extract($row);
						
					}
					else
					{
						$rs=mysql_query("select * from soe_stores where sto_id=".$_GET['stoid']);
						$row=mysql_fetch_array($rs);						
						$con_id=$row['con_id'];
						$sta_id=$row['sta_id'];
					}
					?>
					<div class="divider_h">&nbsp;</div>
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
	$("#basic_info").validate({
		rules: {
			first_name: "required",		
			last_name: "required",
			password: "required",
			confirm_password: {
				required: true,
				equalTo: "#password"
			},
			business_name: "required",
			address: "required",
			zip_code: "required",
			sta_id: "required",
			city: "required"
		},
		messages: {
			first_name: "<br/>First Name can not be empty.",		
			last_name: "<br/>Last Name can not be empty.",
			password: "<br/>Password can not be empty.",
			confirm_password: {
				required: "<br/>Please repeat your password.",
				equalTo: "<br/>Password & Confirm Password mismatch."
			},
			business_name: "<br/>Business Name can not be empty.",
			address: "<br/>Address can not be empty.",
			zip_code: "<br/>Zip Code can not be empty.",
			sta_id: "<br/>State can not be empty.",
			city: "<br/>City can not be empty."
		}
	});	
});
</script>

<link rel="stylesheet" media="screen" href="../js/timePicker.css">
<script type="text/javascript" src="../js/jquery.timePicker.js"></script>

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
			address: "required",
			zip_code: "required",
			sta_id: "required",
			city: "required"
			
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
			address: "<br/>Address can not be empty.",
			zip_code: "<br/>Zip Code can not be empty.",
			sta_id: "<br/>State can not be empty.",
			city: "<br/>City can not be empty."
			
		}
	});	
});

jQuery(function() {
	$("#hour_fr1,#hour_fr2,#hour_fr3,#hour_fr4,#hour_fr5,#hour_fr6,#hour_fr7").timePicker({
	startTime: "12:00",
	endTime: "23:00",
	show24Hours: false,
	show24Hours: false,
	step: 30});
  });
jQuery(function() {
	$("#hour_to1,#hour_to2,#hour_to3,#hour_to4,#hour_to5,#hour_to6,#hour_to7").timePicker({
	startTime: "12:00",
	endTime: "23:00",
	show24Hours: false,
	show24Hours: false,
	step: 30});
  });
</script>
<link rel="stylesheet" href="style1.css" type="text/css" />


	<div class="body" id="mk_height">
<div class="heading">
                        <h1>Add/Edit Location 
                        
                        </h1>
                      </div> <?php
		  $s="select * from soe_stores where sto_id=".$_GET['stoid'];
		  $rs=mysql_query($s) or die(mysql_error());
		  $row=mysql_fetch_array($rs);
		  
			
		  ?>
				<div class="body" id="mk_height">
		
				
		 <div class="advertisersignup1">
          <div class="signup1column">
		  <form class="form" id="store_details" name="store_details" method="post" action="" enctype="multipart/form-data">
            <input name="sto_id" value="10" id="sto_id" type="hidden" />
            <input name="cty_id" id="cty_id" type="hidden" value="<?php echo $cty_id; ?>" />
            <br class="clear" />
            <br class="clear" />
            <div class="input_title">
              <label for="address">Address</label>
              <span>*</span></div>
		    <div class="input">
              <textarea name="address" rows="4" cols="20" id="address"><?php echo $address; ?> </textarea>
              <br />
              <input name="display_address" value="1" id="display_address" checked="checked" type="checkbox" />
              <span>Display address on listing.<br />
                (Uncheck to hide your address, city, state, and zip on listing)</span> </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="con_id">Country</label>
              <span>*</span></div>
		    <div class="input">
              <select id="con_id" name="con_id" onclick="javascript: alert('you cannot change the country'); return false; " >
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
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="sta_id">State</label>
              <span>*</span></div>
		    <div class="input">
              <select id="sta_id" name="sta_id" onclick="javascript: alert('you cannot change the country'); return false; " >
                <option selected="selected" value="">Please Select</option>
              </select>
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="city">City</label>
              <span>*</span></div>
		    <div class="input">
              <?php
	  
	  		if($_GET['id']>0)
			{
			
				$n="select * from soe_geo_cities WHERE con_id=".$con_id." AND sta_id=".$sta_id." and cty_id=".$cty_id." order by name";
			   $rscity=mysql_query($n);
			   $rowcity=mysql_fetch_array($rscity);
			   $cityname=$rowcity['name'];
		   }

		?>
              <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text" value="<?php echo $cityname; ?>" />
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="zip_code">Zip Code</label>
              <span>*</span></div>
		    <div class="input">
              <input name="zip_code" class="input_box" id="zip_code" type="text" value="<?php echo $zip_code; ?>" />
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="cross_street">Cross Street</label>
            </div>
		    <div class="input">
              <input name="cross_street" type="text" id="cross_street" value="<?php echo $cross_street; ?>" size="60" />
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="transportation">Public Transportation</label>
            </div>
		    <div class="input">
              <textarea name="transportation" cols="60" rows="4" id="transportation"><?php echo $transportation; ?></textarea>
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="directions">Directions</label>
            </div>
		    <div class="input">
              <textarea name="directions" cols="60" rows="4" id="directions"><?php echo $directions; ?></textarea>
            </div>
		    <br class="clear" />
            <div class="input_title">
              <label for="hour_type">Hours of Operation</label>
            </div>
		    <input name="hour_type" value="0" type="radio" <?php if($hour_type==0) { ?> checked="checked" <?php } ?> />
		    Do not Display Operation Hours<br />
            <input name="hour_type" value="1" type="radio" <?php if($hour_type==1) { ?> checked="checked" <?php } ?> />
		    24 Hours a Day<br />
            <input name="hour_type" value="2" type="radio" <?php if($hour_type==2) { ?> checked="checked" <?php } ?> />
		    Use Hours of Operation Below
            
            
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
            </p>
		    <br class="clear" />
            <div class="input_title">&nbsp;</div>
		    <div class="input">
		      <input name="submit" value="Submit" class="bttn" type="submit" />
	        </div>
		    <br class="clear" />
          </form>
		</div>
        </div>
</div>

	<script>
function selactiv(d)
{
	var chks = document.getElementsByName('checkbox[]');
	var x = 0;
	var n = 0;
	for(i=0;i<chks.length;i++)
	{
		if(chks[i].checked)
		{
			x=chks[i].value;
			n++;
		}
	}

if(n==0)
	alert("Select a record");
else
{
	ans=confirm('Are you sure?');
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
    
    
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