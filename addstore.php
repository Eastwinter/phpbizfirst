<?php
include("header.php");
$memshipid=$_GET['memshipid'];

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

if($_GET['stoid']>0)
{
$sql="update `soe_stores` set 
`mem_id`= '".$_SESSION['memberid']."',
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
`certification`='".mysql_real_escape_string($_POST['certification'])."' ,
`terms`='".mysql_real_escape_string($_POST['terms'])."' ,
`storeopen`='".mysql_real_escape_string($storeopen)."' ,
`active` ='0' where sto_id=".$_GET['stoid']."";
mysql_query($sql) or die(mysql_error());
$id=$_GET['stoid'];		
}
else
{
$sql="insert into `soe_stores` set 
`mem_id`= '".$_SESSION['memberid']."',
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
`certification`='".mysql_real_escape_string($_POST['certification'])."' ,
`terms`='".mysql_real_escape_string($_POST['terms'])."' ,
`storeopen`='".mysql_real_escape_string($storeopen)."' ,
`active` ='0'";
mysql_query($sql) or die(mysql_error());
$id=mysql_insert_id();

}
//	print_r($_FILES);
	//die("**********");		
		$nm='logo';
		$name=$_FILES[$nm]['name'];
		$tname=$_FILES[$nm]['tmp_name'];			
		if($name!='')
		{
			$name1=$id."_".$name;
			if(move_uploaded_file($tname,"uploads/company_logo/".$name1))
			{
				mysql_query("update soe_stores set logo='".$name1."' where sto_id=".$id) or die(mysql_error());
				$basedir = ''; 				
					$phpThumb = new phpThumb();
					$f="uploads/company_logo/".$name1;
					$f2=realpath("uploads/company_logo/")."/thumb_".$name1;			
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
		?>
        <script>
	location.href='paypal.php?memshipid=<?php echo $memshipid; ?>';
	</script>
        <?php
}
	
	$storesexist=0;
	if($_GET['stoid']>0)
	{
		$rs=mysql_query("select * from soe_stores where sto_id=".$_GET['stoid'].' order by sto_id');
		if(mysql_num_rows($rs)>0)
		{
		
		$row=mysql_fetch_array($rs);
		extract($row);
		$storesexist=1;
		}
	}
?>

<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>

<div style="top: 0px; opacity: 0.108826;" id="object" class="message_box">
	<span class="msg">Your account has done successfully.</span>	</div>



<link rel="stylesheet" media="screen" href="js/timePicker.css">
<script type="text/javascript" src="js/jquery.timePicker.js"></script>

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
			logo: "required",
			cross_street: "required",
			transportation: "required",
			directions: "required",
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
			terms_conditions:"<br /> terms and conditions required",
			logo: "<br /> Please upload your logo",
			cross_street: "<br/>Cross Street can not be empty.",
			transportation: "<br/>Transportation can not be empty.",
			directions: "<br/>Directions can not be empty.",
			terms: "<br/>Store Terms and Conditions can not be empty."
		}
	});	
	
			$("#completeregbtn").click(function() {
           $('#store_details').submit();
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

    
      <?php include("left.php"); ?>
  
  <div id="content_area_mid_inner1">
  
    <div class="border1">
    <div>
    <h2>Add Store </h2>
  </div>
      <form class="form" id="store_details" name="store_details" method="post" action="" enctype="multipart/form-data" style="padding-left:10px;">
        <div class="advertisersignup1">
          <div class="signup1column">
            <p> <b>Company Slogan Text</b><span class="mark">*</span> &nbsp; &nbsp;(50 Characters)<br />
              Ex: We have over 3,000 brands of shoes. Come see us today!<br />
              <input type="text"  style="width:300px;" name="slogan_text" id="slogan_text" />
            </p>
            <p> <b>Upload Logo Image:</b><br />
                <input name="logo" type="file" id="logo" />
            </p>
            <p><img src="images/eximg.jpg" border="0" alt="" /></p>
            <div class="signupinnerform">
              <div class="signupinnerformcol">
                <p><b>Store Name:</b><br />
                    <input name="store_name" type="text" id="store_name"  style="width:200px;" maxlength="40" />
                </p>
                <p><b>Business Telephone #:</b><br />
                    <input name="phone" type="text" id="phone"  style="width:200px;" maxlength="12" />
                  &nbsp;</p>
                <p><b>Languages Spoken:</b><br />
                    <span class="innertext">List languages spoken by your staff.</span><br />
                    <select id="languages[]" name="languages[]" style="width:120px;height:100px;" multiple="multiple">
                      <?php
							$n=1;
							$rs=mysql_query("select * from soe_lan_spoken where active=1");
							while($row=mysql_fetch_array($rs))
							{
							
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
                    <input name="business_tax_id" type="text" id="business_tax_id"  style="width:200px;" maxlength="20" />
                </p>
                <p><b>Fax</b><br />
                    <input name="fax" type="text" id="fax"  style="width:200px;" maxlength="12" />
                </p>
                <p><b>In Business Since:</b><br />
                    <span class="innertext">Enter the year your business stared.</span><br />
                    <select id="business_since" name="business_since" style="width:200px;">
                      <option selected="selected" value="">Please Select</option>
                      <option value="1961">1961</option>
                      <option value="1962">1962</option>
                      <option value="1963">1963</option>
                      <option value="1964">1964</option>
                      <option value="1965">1965</option>
                      <option value="1966">1966</option>
                      <option value="1967">1967</option>
                      <option value="1968">1968</option>
                      <option value="1969">1969</option>
                      <option value="1970">1970</option>
                      <option value="1971">1971</option>
                      <option value="1972">1972</option>
                      <option value="1973">1973</option>
                      <option value="1974">1974</option>
                      <option value="1975">1975</option>
                      <option value="1976">1976</option>
                      <option value="1977">1977</option>
                      <option value="1978">1978</option>
                      <option value="1979">1979</option>
                      <option value="1980">1980</option>
                      <option value="1981">1981</option>
                      <option value="1982">1982</option>
                      <option value="1983">1983</option>
                      <option value="1984">1984</option>
                      <option value="1985">1985</option>
                      <option value="1986">1986</option>
                      <option value="1987">1987</option>
                      <option value="1988">1988</option>
                      <option value="1989">1989</option>
                      <option value="1990">1990</option>
                      <option value="1991">1991</option>
                      <option value="1992">1992</option>
                      <option value="1993">1993</option>
                      <option value="1994">1994</option>
                      <option value="1995">1995</option>
                      <option value="1996">1996</option>
                      <option value="1997">1997</option>
                      <option value="1998">1998</option>
                      <option value="1999">1999</option>
                      <option value="2000">2000</option>
                      <option value="2001">2001</option>
                      <option value="2002">2002</option>
                      <option value="2003">2003</option>
                      <option value="2004">2004</option>
                      <option value="2005">2005</option>
                      <option value="2006">2006</option>
                      <option value="2007">2007</option>
                      <option value="2008">2008</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                    </select>
                </p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
              </div>
            </div>
            <br class="clear" />
            <p>
                <b>Hours of Opertaion:</b><br />
                <input name="hour_type" value="0" checked="checked" type="radio">
              Do not Display Operation Hours<br>
                <input name="hour_type" value="1" type="radio">
              24 Hours a Day<br>
                <input name="hour_type" value="2" type="radio">
              Use Hours of Operation Below<br>
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
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,1);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr1" >
                  <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr1" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to1" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,2);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr2" >
                    <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr2" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to2" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,3);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr3" >
                    <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr3" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to3" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,4);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr4" >
                  <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr4" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to4" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,5);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr5" >
                  <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr5" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to5" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,6);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr6" >
                  <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr6" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to6" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span></p>
                <p>
                  <select name="storeopen[]" onchange="javascript: showhours(this,7);" >
                    <option value="1" selected="selected">Open</option>
                    <option value="0">Closed</option>
                  </select>
                  &nbsp;&nbsp;<span id="hfr7" >
                  <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr7" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                    to
                    <input name="hour_to[]" type="text" class="input_box2" id="hour_to7" value="12:00 AM" readonly="readonly" autocomplete="OFF">
                </span> </p>
              </div>
            </div>
            <p><b>Payment Methods:</b><br />
                <?php
			$n=1;
			$rs=mysql_query("select * from soe_store_payment where active=1");
			while($row=mysql_fetch_array($rs))
			{
			?>
                <input name="payment_methods[]" value="<?php echo $row['pay_id']; ?>" type="checkbox">
                <?php echo $row['name']; ?>
                <?php
			  	if($n%2==0)
					echo '<br class="clear">';
				$n++;
			  }
			  ?>
            </p>
            <p><b>Cross Street:</b><br />
                <input name="cross_street" type="text" id="cross_street" value="" size="50" />
                <br />
            </p>
            <p><b>Public Transportation:</b><br />
                <textarea name="transportation" cols="50" rows="4" id="transportation"></textarea>
                <br />
            </p>
            <p><b>Directions:</b><br />
                <textarea name="directions" cols="50" rows="4" id="directions"></textarea>
                <br />
            </p>
            <p><b>General Information:</b><br />
              Describe your business and the types of products or services you offer.<br />
              <textarea name="general_information" cols="50" rows="4" id="general_information"></textarea>
              <br />
            </p>
            <p style="text-align:right; margin-right:150px;">Allowed Characters : 1000</p>
            <p><b>Affilication, Certifacations, or Licences:</b><br />
                <textarea name="certification" cols="50" rows="4" id="certification"></textarea>
                <br />
            </p>
            <p style="text-align:right; margin-right:150px;">Allowed Characters : 99</p>
            <p><b>Terms and Conditions:</b><span class="mark">*</span><br />
                <textarea name="terms" cols="50" rows="4" id="terms"></textarea>
            </p>
            <p>
              <input name="terms_conditions" value="1" id="terms_conditions" type="checkbox">
              Check here to accept the <a onclick="window.open('pages1.php?pageid=7','','status=no,menubar=no,toolbars=no,width=800,height=500,scrollbars=yes');" style="color:#0033FF; font-style:italic"> terms and conditions </a> and also read our<a onclick="window.open('pages1.php?pageid=9','','status=no,menubar=no,toolbars=no,width=800,height=500,scrollbars=yes');" style="color:#0033FF; font-style:italic"> Privacy Policy</a></p>
              
                <div id="loginpagelisting2">
         
            <a href="advlogin.php" class="listing">Cancel Registration</a>&nbsp;&nbsp;&nbsp; <a id="completeregbtn" class="listing">Complete Registration</a></p>    

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
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
<?php include("footer.php"); ?>