<?php include("header.php"); 
?>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>


    
	<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				
<?php
if($_GET['msg']=="verify")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">Your email has been verified. Please continue with the registration!</span></div>
<?php
}
?>				

<?php
if($_GET['msg']=='alreadyverified')
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
		<span class="err">You have already verified your email! Please complete the registration process.</span></div>
<?php
}
?>
    
     
      

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


	jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0; 
}, "No space please and don't leave it empty");



jQuery.validator.addMethod("CheckDOB", function (value, element) {
       var  minDate = Date.parse("12/12/2000");  
        var today=new Date();
        var DOB = Date.parse(value);  
        if((DOB <= minDate)) {  
            return true;  
        }  
        return false;  
    }, "NotValid");


    $("select#con_id").change(function () {		
	
		$('#sta_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var con_id = $("#con_id").val();		
		//alert(con_id);
		$.get("populatestate.php?con_id="+con_id,
		function(xml){
			$('#sta_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("states",xml).each(function(id) {
				states = $("states",xml).get(id);		
			//	alert(states);		
				result = '<option value="'+$("sta_id",states).text()+'">'+$("name",states).text()+'</option>'
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
	
	
	$.validator.addMethod("DateFormat", function(value,element) {
        return value.match(/^(0[1-9]|1[012])[- //.](0[1-9]|[12][0-9]|3[01])[- //.](19|20)\d\d$/);
            },
                "Please enter a date in the format mm/dd/yyyy"
            );


	$("#basic_info").validate({
		rules: {
			first_name: {
			required: true,
			minlength: 4,
			maxlength: 20,
			noSpace: true
			},
			last_name: {
			required: true,
			minlength: 4,
			maxlength: 20,
			noSpace: true
			},
			password: {
			required: true,
			minlength: 6,
			maxlength: 20,
			noSpace: true
			},
			confirm_password: {
				required: true,
				equalTo: "#password"
			},
			business_name: "required",
			address: "required",
			zip_code: "required",
			sta_id: "required",
			city: "required",
			securityanswer: "required",
						gender: 'required',
			dateofbirth:
			{
			required: true,
			DateFormat: true,
			CheckDOB: true
			}

		},
		messages: {
			first_name: {
						required: "First Name can not be empty.",
			minlength: "Minimum 4 chars required",
			maxlength: "FirstName cannot exceed 20 chars"
			},
			last_name:  {
						required: "Last Name can not be empty.",
			minlength: "Minimum 4 chars required",
			maxlength: "LastName cannot exceed 20 chars"
			},
			password: {
						required: "Password can not be empty.",
			minlength: "Minimum 6 chars required",
			maxlength: "Password cannot exceed 20 chars"
			},
			confirm_password: {
				required: "Please repeat your password.",
				equalTo: "Password & Confirm Password mismatch."
			},
			business_name: "Business Name can not be empty.",
			address: "Address can not be empty.",
			zip_code: "Zip Code can not be empty.",
			sta_id: "State can not be empty.",
			city: "City can not be empty.",
			securityanswer: "Security Answer cannot be empty",
			dateofbirth:
			{
			required: "<br />Date of birth required",
			DateFormat: '<br /> Please enter in correct format',
			CheckDOB: '<br /> Enter valid DOB'
			},

		}
	});	
		$("#nextbtn").click(function() {
           $('#basic_info').submit();
        });


});
</script>
  <!-- Navigation bar Start -->
   <?php include("left.php"); ?>
  <div id="content_area_mid_inner1">
    <div>
      <h2>Advertiser _ Signup</h2>
    </div>
    <?php
$sql="select * from soe_members where mem_id= ".intval($_GET['id'])."";
$rs=mysql_query($sql) or die(mysql_error());
$row=mysql_fetch_array($rs);
?>

    <div class="border1">
      <form class="form" id="basic_info" name="basic_info" method="post" action="advregisterpost.php?id=<?php echo $_GET['id']; ?>">
        <input name="cty_id" id="cty_id" type="hidden">
          <div class="advertisersignup">
            <div class="advertiserleft1">
              <p> Email-ID<span class="mark">*</span></p>
              <p>&nbsp; </p>
              <p> Password<span class="mark">*</span></p>
              <p>&nbsp; </p>
              <br />
              <p> Verify Password<span class="mark">*</span></p>
              <p>&nbsp; </p>
              <p> Security Question<span class="mark">*</span></p>
              <p> Answers<span class="mark">*</span></p>
              <br />
              <p>&nbsp; </p>
              <p> Date Of Birth<span class="mark">*</span></p>
              <p> Gender<span class="mark">*</span></p>
              <p> First Name<span class="mark">*</span></p>
              <p>&nbsp; </p>
              <p> Last Name<span class="mark">*</span></p>
            </div>
            <div class="advertiserleft2">
              <p>
                <input type="text"  style="width:150px;" readonly="readonly" name="email" id="email" value="<?php echo $row['email']; ?>"/>
              </p>
              <p>&nbsp;</p>
              <p>
                <input name="password" type="password" id="password"  style="width:150px;" maxlength="20"/>
              </p>
              <p>Password can be 6 - 20 characters(no spaces).
                Please use a combination of letters and numbers.</p>
              <br />
              <p>
                <input name="confirm_password" type="password" id="confirm_password"  style="width:150px;" maxlength="20"/>
              </p>
              <p>Type your password again.</p>
              <p>
                <select  name="securityquestion" id="securityquestion">
  <option style="font-style:italic;" value="choosequestion">
  Choose a question ...
  </option>
  <option value="What is the name of your best friend from childhood?">What is the name of your best friend from childhood?</option>
  <option value="What was the name of your first teacher?">What was the name of your first teacher?</option>
  <option value="What is the name of your manager at your first job?">What is the name of your manager at your first job?</option>
  <option value="What was your first phone number?">What was your first phone number?</option>
  <option value="What is your vehicle registration number?">What is your vehicle registration number?</option>

</select>
              </p>
              
              <p>
                <input type="text"  style="width:150px;" name="securityanswer" id="securityanswer"/>
              </p>
              If your lose your password or sign-in name, we ask for your security answer and date of birth to verify your identity.


              <p>
                
                
                <input type="text"  style="width:150px;" name="dateofbirth" id="dateofbirth" />
                (mm/dd/yyyy)</p>
              <p>
                <select name="gender">
        <option value="Male" selected="selected">Male</option>
        <option value="Female">Female</option>
      </select>
      </p>
              <p>
                <input type="text"  style="width:150px;" name="first_name" id="first_name"/>
              </p>
              <p>Your name can be 4 - 20 characters(no spaces).</p>
              <p>
                <input type="text"  style="width:150px;" name="last_name" id="last_name"/>
              </p>
            </div>
          </div>
          <div class="advertisersignup">
            <div class="advertiserleft11" id="package">
              <p> <b>Selected Products</b></p>
              <?php
				$rs=mysql_query("select * from soe_packages where packageid=1");
				$row=mysql_fetch_array($rs);
				?>
                <input name="packid" type="hidden" value="<?php echo $row['packageid']; ?>" id="packid" />
              <p><?php echo $row['name']; ?>  Listing -<?php echo $row['code']; ?> $<?php echo $row['price'];?> per month</p>
                
             <?php echo $row['description']; ?>
              
              <p  class="listing"><a onclick="window.open('selectpackages.php?packid=<?php echo $row['packageid']; ?>','','status=no,menubar=no,toolbars=no,width=900,height=900,scrollbars=yes');"><img src="images/select.jpg" /></a></p>
            </div>
            <br class="clear">
            
            	<div class="input_title"><label for="package"><strong>Subscription</strong></label></div>
		  <div class="input" id="subscr">
	           <input name="subscription" type="hidden" value="monthly" />
               <a class="style1" onclick="window.open('defaultpackage.php?pr=<?php echo $row['price'];?>','','status=no,menubar=no,toolbars=no,width=700,height=300,scrollbars=yes');">Click Here To View Subscription Details For Default Package</a>			</div>
			<br class="clear">
          </div>
          <div class="advertisersignup">
            <div class="advertiserleft1">
              <p>Business Name<span class="mark">*</span></p>
              
              <p> Street Address<span class="mark">*</span></p>
              <p>&nbsp; </p>
              <p>&nbsp; </p>
              <p>&nbsp; </p>
              <p>&nbsp; </p>
              
              <p> Country<span class="mark">*</span></p>
              
              <p>State<span class="mark">*</span></p>
              <p>City<span class="mark">*</span></p>
              
              
              <p> Zip<span class="mark">*</span></p>
              
            </div>
            <div class="advertiserleft2">
              <p>
                <input type="text"  style="width:150px;" name="business_name" id="business_name"/>
              </p>
              
              <p  style="height:120px;">
                <textarea   cols="16" rows="4" name="address" id="address"></textarea>
              
              <br /><input name="display_address" value="1" id="display_address" checked="checked" type="checkbox"> Display address on listing
(Uncheck to hide your address,
city, state and zip on listing)</p>
             
              <p>
                <select id="con_id" name="con_id" style="width:150px;">
                  <option selected="selected" value="">Please Select</option>
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
                <select id="sta_id" name="sta_id">
					<option selected="selected" value="">Please Select</option>
							</select>
              </p>
              
              <p>
                <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text">
              </p>
              
              <p>
               <input name="zip_code" class="input_box" id="zip_code" type="text">
              </p>
              
            </div>
          </div>
        </form>
      <br class="clear">
      <div >
      <a href="advlogin.php"><img src="images/cancel.jpg" alt="" border="0"></a> &nbsp;&nbsp;<a id="nextbtn" style="margin-left:300px;"><img src="images/next.jpg" alt="" border="0"></a></div>
    </div>
  </div>
  <div id="content_area_right"> <?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
 <?php include("footer.php"); ?>