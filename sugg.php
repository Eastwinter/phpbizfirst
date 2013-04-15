       
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 transitional//EN" "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Shoe Breeze.com</title>
<meta name="keywords" content="shoes,adidas,sandals,boots" />
<link rel="stylesheet" href="general.css" type="text/css" media="screen" />
<script src="js/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="popup.js" type="text/javascript"></script>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link media="screen" rel="stylesheet" href="colorbox.css" />
<script src="js/jquery.min.js"></script>

<script src="colorbox/jquery.colorbox.js"></script>
<script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">
<script src="js/jquery.form.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>

<script>
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to elements
			$(".example5").colorbox();
			$(".example7").colorbox({width:"70%", inline:true, href:"#inline_example2"});
			$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
			$(".example9").colorbox({width:"70%", inline:true, href:"#inline_example3"});
			$(".example10").colorbox({width:"40%", inline:true, href:"#inline_example4"});
			$(".example11").colorbox({width:"50%", inline:true, href:"#inline_example22"});
			$(".example99").colorbox({width:"70%",  href:"readreview.php"});
			
		

});
</script>


<script type="text/javascript">


function checkemail(){
var str=document.newsfrm.Email.value;
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
testresults=true
else{
alert("Please input a valid email address!")
testresults=false
}
return (testresults)
}


$(document).ready(function(){
  $("#mybutton").click(function () { // ATTACH CLICK EVENT TO MYBUTTON
if(document.newsfrm.Email.value=='' || document.newsfrm.ZipCode.value=='')
  	alert("All fields required");
else if(checkemail())
{
    $.post("newsletter.php",        // PERFORM AJAX POST
      $("#newsfrm").serialize(),      // WITH SERIALIZED DATA OF MYFORM
      function(data){                // DATA NEXT SENT TO COLORBOX
        $.fn.colorbox({
          html:   data,
          open:   true,
          iframe: false,            // NO FRAME, JUST DIV CONTAINER?
          width:  "50%",
        });
      },
      "html");
}
  });
}); 
</script> 
 
 
<script src="js/main.js" type="text/javascript"></script>

<style>
#preview{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:1px;
	display:none;
	color:#ccc;
	}

.zoomPreload{
	display:none !important;
}	
</style>

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
	
	
	    $("select#shc_id").change(function () {		
		$('#siz_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		$('#shw_id').children().remove().end().append("<option value=\"\">...Loading...</option>");
		var shc_id = $("#shc_id").val();		
		$.get("populatesize.php?shc_id="+shc_id,
		function(xml){
			$('#siz_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("size",xml).each(function(id) {
				size = $("size",xml).get(id);				
				result = '<option value="'+$("siz_id",size).text()+'">'+$("name",size).text()+'</option>'
				$("#siz_id").append(result);
			});
		});
		
		
		$.get("populatewidth.php?shc_id="+shc_id,
		function(xml){
			$('#shw_id').children().remove().end().append("<option value=\"\">Please Select</option>");
			$("width",xml).each(function(id) {
				width = $("width",xml).get(id);				
				result = '<option value="'+$("shw_id",width).text()+'">'+$("name",width).text()+'</option>'
				$("#shw_id").append(result);
			});
		});
		
	});	


	});
</script>




<SCRIPT TYPE="text/javascript">
<!--
//Disable right click script
//visit http://www.rainbow.arch.scriptmania.com/scripts/
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</SCRIPT> 


<script type='text/javascript'>
$('#flash3').mousedown(function (e){
   location.href='bannerclicked.php?id=3';
});

</script>


</head>
<body>
<div class="mainbody">
  <div class="content">
    <div class="header">
      <div class="logo"><img src="images/logo.jpg" alt=" "   border="0"/> </div>
      <div class="menu">
        <div class="search"> <a href="advancesearch.php" title="Advance Search"><img src="images/advance_search.gif" width="140px" height="25px" alt="" /></a> <br class="clear" />

                 <a href="memberlogin.php">Member Log in</a>&nbsp; </div>
           
         
        <div class="menu_bar">
          <div class="menu_lr"><img src="images/menu_left.gif" width="15px" height="37px" alt="" /></div>
          <div class="menu_list"><a href="index.php">Home</a></div>
          <div class="menu_divider">&nbsp;</div>
          <div class="menu_list"><a href="searchresults.php?ja=1">Just Added</a></div>
          <div class="menu_divider">&nbsp;</div>

           <div class="menu_list"><a href="searchresults.php?ja=2">Most Popular</a></div>
          <div class="menu_divider">&nbsp;</div>
          <div class="menu_list" ><a href="#" class='example8'>Newsletter</a></div>
                     <div class="menu_divider">&nbsp;</div>
          <div class="menu_list"><a href="footwearsuggestions.php">Footwear Suggestions</a></div>
                    <div class="menu_divider">&nbsp;</div>
          <div class="menu_list">

                  <a href="advlogin.php">Advertiser</a>
                
        </div>
        
          
          <div class="menu_lr"><img src="images/menu_right.gif" width="15px" height="37px" alt="" /></div>
        </div>
      </div>
    </div>
    	 <div id="headerimg">
     	 	
		
   
      <div id="leftheaderbanner"> &nbsp;

        <!-- This contains the hidden content for inline calls -->
        <div style='display:none'>
          <div id='inline_example1' style='padding:10px; background:#fff;'>
            <h3>Newsletter</h3>
            <form action="newsletter.php" method="post" name="newsfrm" id="newsfrm"><div id="loginform">
              <div class="log1">
                <p> Email<br />

                  <input type="text" style=" width:180px; " name="Email" id="Email"/>
                </p>
                <p> Zip code<br />
                  <input type="text"  style=" width:180px; " name="ZipCode" id="ZipCode" />
                </p>
              </div>
              <div class="log1">
                <p>Gender<br />

                  <select name="gender" style="width:180px;">
                    
                    <option value="Male" selected="selected">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </p>
                <p>
                <div id="popupsubmit">
                  <div class="submitbtn">

                    <p class="advsubmit"><a id="mybutton">Submit</a></p>
                  </div>
                  <div class="submitbtn">
                    <p class="advsubmit"><a onclick="javascript: document.newsfrm.reset();">Clear</a></p>
                  </div>
                </div>
                <p> 
              </div>

              <br />
              <br />
            </div></form>
            <div id="newsreply"></div>
          </div>
        </div>
      </div>
      
      
      
     
        
      
      <form action="searchresults.php" method="post" name="hdsrchfrm"><div id="rightheaderbanner">
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
              <input type="text" name="shoe_name" style="width:90px;" id="shoe_name">
            </p>

            <p >
              <select id="fot_id" name="fot_id" style="width:90px;">
                <option selected="selected" value="">Select....</option>
                                <option value="29" >A-test</option>
                                <option value="5" >Clogs</option>
                                <option value="6" >Flip Flops</option>
                                <option value="30" >J-test</option>

                                <option value="10" >Mary Janes</option>
                                <option value="1" >Others</option>
                                <option value="4" >Pumps</option>
                                <option value="7" >Sandals</option>
                                <option value="12" >sisworld</option>
                                <option value="8" >Sling Backs</option>

                                <option value="2" >Sneakers</option>
                                <option value="3" >Stilettos</option>
                                <option value="28" >test</option>
                              </select>
            </p>
            <p>
              <select id="sea_id" name="sea_id" style="width:90px">

                <option selected="selected" value="">Select....</option>
                                <option value="4"  >Fall</option>
                                <option value="2"  >Spring</option>
                                <option value="3"  >Summer</option>
                                <option value="1"  >Winter</option>
                              </select>

            </p>
            <p>
              <input type="text" name="store_name" style="width:90px;" id="store_name" />
            </p>
            <p>
              <select id="sta_id" name="sta_id" style="width:90px;">
					<option value="">Select....</option>
									</select>

            </p>
            <p>
              <input type="text" name="zip_code" style="width:90px;" id="zip_code">
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
            <div id="submit"  style="line-height:25px;"> <a href="#" style=" padding-top:50px; margin-left:0px; margin-top:10px;" onclick="javascript:document.hdsrchfrm.submit();">Submit</a> </div>

          </div>
        </div>
        <div class="headersearchcol3">
          <div>
            <p>
              <select id="shc_id" name="shc_id" style="width:90px;">
                <optgroup label>
                <option selected="selected" value="">Select....</option>

                </optgroup>
                                <optgroup label="Kids">
                                <option value="8"  >Boots</option>
                                <option value="9"  >Casual</option>
                                </optgroup>
                                <optgroup label="Men">
                                <option value="6"  >Dress</option>

                                <option value="7"  >Casual</option>
                                <option value="10"  >Athletic</option>
                                <option value="11"  >Boots</option>
                                <option value="12"  >Sandals</option>
                                </optgroup>
                                <optgroup label="Women">
                                <option value="4"  >Dress</option>

                                <option value="5"  >Casual</option>
                                <option value="13"  >Athletic</option>
                                <option value="14"  >Boots</option>
                                <option value="15"  >Sandals</option>
                                </optgroup>
                              </select>
            </p>

            <p>
              <select id="brn_id" name="brn_id" style="width:90px;">
                <option selected="selected" value="">Select....</option>
                                <option value="34"  >a-test</option>
                                <option value="29"  >Addidas</option>
                                <option value="28"  >Champion</option>
                                <option value="16"  >Deisel</option>

                                <option value="26"  >Dexter</option>
                                <option value="14"  >Durango</option>
                                <option value="17"  >Ecko</option>
                                <option value="9"  >Feragamo</option>
                                <option value="15"  >Frye</option>
                                <option value="31"  >GAP</option>

                                <option value="20"  >GAP</option>
                                <option value="11"  >Gucci</option>
                                <option value="36"  >H-test</option>
                                <option value="13"  >Jimmy Choo</option>
                                <option value="35"  >k-test</option>
                                <option value="12"  >Luis Vitton</option>

                                <option value="8"  >Manolo Blanik</option>
                                <option value="1"  >Others</option>
                                <option value="22"  >Parade</option>
                                <option value="24"  >Phat Farm</option>
                                <option value="10"  >Prada</option>
                                <option value="18"  >Pro-Keds</option>

                                <option value="4"  >Puma</option>
                                <option value="7"  >Reebok</option>
                                <option value="25"  >Roca Wear</option>
                                <option value="6"  >Sketchers</option>
                                <option value="21"  >Steve Madden</option>
                                <option value="33"  >test</option>

                                <option value="23"  >Timberland</option>
                              </select>
            </p>
            <p>
              <input type="text" name="price" style="width:90px;" id="price" />
            </p>
            <p>
              <select id="con_id" name="con_id" style="width:90px">

                <option selected="selected" value="">Select....</option>
                                <option value="157"  >Afghanistan</option>
                                <option value="176"  >Albania</option>
                                <option value="134"  >Algeria</option>
                                <option value="34"  >American Samoa</option>
                                <option value="185"  >Andorra</option>

                                <option value="32"  >Angola</option>
                                <option value="1"  >Antarctica</option>
                                <option value="124"  >Antigua and Barbuda</option>
                                <option value="2"  >Argentina</option>
                                <option value="175"  >Armenia</option>
                                <option value="226"  >Australia</option>

                                <option value="197"  >Austria</option>
                                <option value="174"  >Azerbaijan</option>
                                <option value="137"  >Bahamas</option>
                                <option value="148"  >Bahrain</option>
                                <option value="136"  >Bangladesh</option>
                                <option value="106"  >Barbados</option>

                                <option value="210"  >Belarus</option>
                                <option value="207"  >Belgium</option>
                                <option value="121"  >Belize</option>
                                <option value="83"  >Benin</option>
                                <option value="160"  >Bermuda</option>
                                <option value="150"  >Bhutan</option>

                                <option value="21"  >Bolivia</option>
                                <option value="187"  >Bosnia and Herzegovina</option>
                                <option value="17"  >Botswana</option>
                                <option value="10"  >Brazil</option>
                                <option value="132"  >British Virgin Islands</option>
                                <option value="74"  >Brunei</option>

                                <option value="183"  >Bulgaria</option>
                                <option value="91"  >Burkina Faso</option>
                                <option value="52"  >Burundi</option>
                                <option value="93"  >Cambodia</option>
                                <option value="63"  >Cameroon</option>
                                <option value="224"  >Canada</option>

                                <option value="116"  >Cape Verde</option>
                                <option value="133"  >Cayman Islands</option>
                                <option value="67"  >Central African Republic</option>
                                <option value="87"  >Chad</option>
                                <option value="4"  >Chile</option>
                                <option value="131"  >China</option>

                                <option value="51"  >Colombia</option>
                                <option value="38"  >Comoros</option>
                                <option value="48"  >Congo</option>
                                <option value="40"  >Congo (Dem. Rep.)</option>
                                <option value="24"  >Cook Islands</option>
                                <option value="89"  >Costa Rica</option>

                                <option value="186"  >Croatia</option>
                                <option value="135"  >Cuba</option>
                                <option value="165"  >Cyprus</option>
                                <option value="202"  >Czech Republic</option>
                                <option value="213"  >Denmark</option>
                                <option value="96"  >Djibouti</option>

                                <option value="119"  >Dominica</option>
                                <option value="128"  >Dominican Republic</option>
                                <option value="47"  >East Timor</option>
                                <option value="50"  >Ecuador</option>
                                <option value="141"  >Egypt</option>
                                <option value="109"  >El Salvador</option>

                                <option value="56"  >Equatorial Guinea</option>
                                <option value="105"  >Eritrea</option>
                                <option value="216"  >Estonia</option>
                                <option value="68"  >Ethiopia</option>
                                <option value="39"  >External Territories of Australia</option>
                                <option value="3"  >Falkland Islands</option>

                                <option value="220"  >Faroe Islands</option>
                                <option value="29"  >Fiji Islands</option>
                                <option value="218"  >Finland</option>
                                <option value="182"  >France</option>
                                <option value="65"  >French Guiana</option>
                                <option value="13"  >French Polynesia</option>

                                <option value="5"  >French Southern Territories</option>
                                <option value="53"  >Gabon</option>
                                <option value="108"  >Gambia</option>
                                <option value="180"  >Georgia</option>
                                <option value="200"  >Germany</option>
                                <option value="77"  >Ghana</option>

                                <option value="166"  >Greece</option>
                                <option value="219"  >Greenland</option>
                                <option value="99"  >Grenada</option>
                                <option value="120"  >Guadeloupe</option>
                                <option value="110"  >Guam</option>
                                <option value="112"  >Guatemala</option>

                                <option value="205"  >Guernsey and Alderney</option>
                                <option value="86"  >Guinea</option>
                                <option value="97"  >Guinea-Bissau</option>
                                <option value="66"  >Guyana</option>
                                <option value="130"  >Haiti</option>
                                <option value="107"  >Honduras</option>

                                <option value="195"  >Hungary</option>
                                <option value="221"  >Iceland</option>
                                <option value="88"  >India</option>
                                <option value="44"  >Indonesia</option>
                                <option value="147"  >Iran</option>
                                <option value="156"  >Iraq</option>

                                <option value="209"  >Ireland</option>
                                <option value="212"  >Isle of Man</option>
                                <option value="155"  >Israel</option>
                                <option value="169"  >Italy</option>
                                <option value="73"  >Ivory Coast</option>
                                <option value="127"  >Jamaica</option>

                                <option value="145"  >Japan</option>
                                <option value="203"  >Jersey</option>
                                <option value="154"  >Jordan</option>
                                <option value="178"  >Kazakhstan</option>
                                <option value="49"  >Kenya</option>
                                <option value="54"  >Kiribati</option>

                                <option value="173"  >Korea (North)</option>
                                <option value="164"  >Korea (South)</option>
                                <option value="153"  >Kuwait</option>
                                <option value="177"  >Kyrgyzstan</option>
                                <option value="117"  >Laos</option>
                                <option value="215"  >Latvia</option>

                                <option value="163"  >Lebanon</option>
                                <option value="11"  >Lesotho</option>
                                <option value="72"  >Liberia</option>
                                <option value="143"  >Libya</option>
                                <option value="199"  >Liechtenstein</option>
                                <option value="211"  >Lithuania</option>

                                <option value="206"  >Luxembourg</option>
                                <option value="179"  >Macedonia</option>
                                <option value="19"  >Madagascar</option>
                                <option value="33"  >Malawi</option>
                                <option value="62"  >Malaysia</option>
                                <option value="59"  >Maldives</option>

                                <option value="95"  >Mali</option>
                                <option value="167"  >Malta</option>
                                <option value="75"  >Marshall Islands</option>
                                <option value="114"  >Martinique</option>
                                <option value="118"  >Mauritania</option>
                                <option value="27"  >Mauritius</option>

                                <option value="37"  >Mayotte</option>
                                <option value="115"  >Mexico</option>
                                <option value="69"  >Micronesia</option>
                                <option value="194"  >Moldova</option>
                                <option value="190"  >Monaco</option>
                                <option value="188"  >Mongolia</option>

                                <option value="152"  >Morocco</option>
                                <option value="18"  >Mozambique</option>
                                <option value="101"  >Myanmar</option>
                                <option value="12"  >Namibia</option>
                                <option value="60"  >Nauru</option>
                                <option value="149"  >Nepal</option>

                                <option value="208"  >Netherlands</option>
                                <option value="100"  >Netherlands Antilles</option>
                                <option value="22"  >New Caledonia</option>
                                <option value="6"  >New Zealand</option>
                                <option value="94"  >Nicaragua</option>
                                <option value="98"  >Niger</option>

                                <option value="71"  >Nigeria</option>
                                <option value="113"  >Northern Mariana Islands</option>
                                <option value="217"  >Norway</option>
                                <option value="123"  >Oman</option>
                                <option value="142"  >Pakistan</option>
                                <option value="64"  >Palau</option>

                                <option value="158"  >Palestine</option>
                                <option value="85"  >Panama</option>
                                <option value="43"  >Papua New Guinea</option>
                                <option value="14"  >Paraguay</option>
                                <option value="30"  >Peru</option>
                                <option value="76"  >Philippines</option>

                                <option value="204"  >Poland</option>
                                <option value="162"  >Portugal</option>
                                <option value="129"  >Puerto Rico</option>
                                <option value="146"  >Qatar</option>
                                <option value="25"  >Reunion</option>
                                <option value="189"  >Romania</option>

                                <option value="181"  >Russia</option>
                                <option value="55"  >Rwanda</option>
                                <option value="7"  >Saint Helena</option>
                                <option value="125"  >Saint Kitts and Nevis</option>
                                <option value="111"  >Saint Lucia</option>
                                <option value="198"  >Saint Pierre and Miquelon</option>

                                <option value="104"  >Saint Vincent and The Grenadines</option>
                                <option value="36"  >Samoa</option>
                                <option value="191"  >San Marino</option>
                                <option value="122"  >Saudi Arabia</option>
                                <option value="61"  >SÃ£o TomÃ© and PrÃ­ncipe</option>
                                <option value="102"  >Senegal</option>

                                <option value="184"  >Serbia and Montenegro</option>
                                <option value="84"  >Sierra Leone</option>
                                <option value="201"  >Slovakia</option>
                                <option value="193"  >Slovenia</option>
                                <option value="16"  >Smaller Territories of Chile</option>
                                <option value="20"  >Smaller Territories of the UK</option>

                                <option value="41"  >Solomon Islands</option>
                                <option value="58"  >Somalia</option>
                                <option value="9"  >South Africa</option>
                                <option value="151"  >Spain</option>
                                <option value="81"  >Sri Lanka</option>
                                <option value="70"  >Sudan</option>

                                <option value="78"  >Suriname</option>
                                <option value="222"  >Svalbard and Jan Mayen</option>
                                <option value="15"  >Swaziland</option>
                                <option value="214"  >Sweden</option>
                                <option value="196"  >Switzerland</option>
                                <option value="161"  >Syria</option>

                                <option value="139"  >Taiwan</option>
                                <option value="171"  >Tajikistan</option>
                                <option value="42"  >Tanzania</option>
                                <option value="80"  >Thailand</option>
                                <option value="82"  >Togo</option>
                                <option value="45"  >Tokelau</option>

                                <option value="26"  >Tonga</option>
                                <option value="92"  >Trinidad and Tobago</option>
                                <option value="159"  >Tunisia</option>
                                <option value="168"  >Turkey</option>
                                <option value="172"  >Turkmenistan</option>
                                <option value="138"  >Turks and Caicos Islands</option>

                                <option value="46"  >Tuvalu</option>
                                <option value="57"  >Uganda</option>
                                <option value="192"  >Ukraine</option>
                                <option value="144"  >United Arab Emirates</option>
                                <option value="225"  >United Kingdom</option>
                                <option value="223"  >United States</option>

                                <option value="8"  >Uruguay</option>
                                <option value="170"  >Uzbekistan</option>
                                <option value="28"  >Vanuatu</option>
                                <option value="79"  >Venezuela</option>
                                <option value="90"  >Vietnam</option>
                                <option value="126"  >Virgin Islands of the United States</option>

                                <option value="35"  >Wallis and Futuna</option>
                                <option value="140"  >Western Sahara</option>
                                <option value="103"  >Yemen</option>
                                <option value="31"  >Zambia</option>
                                <option value="23"  >Zimbabwe</option>
                              </select>

            </p>
            <p>
              <input autocomplete="off" name="city" class="input_box ac_input" id="city" type="text" style="width:90px;">
            </p>
          </div>
        </div>
      </div></form>    </div>
    <div class="space_top">&nbsp;</div>

	<script type="text/javascript">
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
			main_picture: "required",
			price: "required"
		},
		messages: {
			shoe_name: "Shoe Name can not be empty.",
			description: "Description can not be empty.",
			main_picture: "Please Upload Main Image.",
			price: "Please Enter Price.",
			email: {
				required: 'Enter the link',
				url: 'Enter a valid url'
				},			
			email:
			{
				required: 'Email-Id is required',
				email: 'Enter a valid email id'
			}
		}
	});
	
});
</script>			

    <div class="container">
      <div class="left_menu">
						
						
                                                <div class="left_box">
							<div class="box_top">
								<div class="box_top_l">Men</div>
								<div class="box_top_r"><img src="images/men_women.gif" width="50" height="40" alt="" title="" /></div>
							</div>							
							<div class="box_mid">

								<ul>
                                 									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=6">Dress</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=7">Casual</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=10">Athletic</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=11">Boots</a></li>

                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=12">Sandals</a></li>
                                								</ul>
								
								<br class="clear"/>
							</div>
						</div>
						<div class="divider_v">&nbsp;</div>
                                              <div class="left_box">
							<div class="box_top">

								<div class="box_top_l">Women</div>
								<div class="box_top_r"><img src="images/men_women.gif" width="50" height="40" alt="" title="" /></div>
							</div>							
							<div class="box_mid">
								<ul>
                                 									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=4">Dress</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=5">Casual</a></li>

                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=13">Athletic</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=14">Boots</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=15">Sandals</a></li>
                                								</ul>
								
								<br class="clear"/>
							</div>

						</div>
						<div class="divider_v">&nbsp;</div>
                                              <div class="left_box">
							<div class="box_top">
								<div class="box_top_l">Kids</div>
								<div class="box_top_r"><img src="images/men_women.gif" width="50" height="40" alt="" title="" /></div>
							</div>							
							<div class="box_mid">
								<ul>

                                 									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=8">Boots</a></li>
                                									<li><img src="images/arrow.gif" width="15" height="20" alt="" title="" />&nbsp; <a href="searchresults.php?catid=9">Casual</a></li>
                                								</ul>
								
								<br class="clear"/>
							</div>
						</div>
						<div class="divider_v">&nbsp;</div>

                      						<div class="divider_v">&nbsp;</div>
						
					</div>      <div class="mid_body">
        <div class="heading">
          <h1><img src="images/icon_Featuerprojects.gif" width="66" height="41">Suggest A Footwear</h1>
        </div>
        <div id="advertiseraccountpage">
          <div class="advertiseraccount">
            <form class="form" id="add_shoe" name="add_shoe" method="post" action="" enctype="multipart/form-data">

            <div class="myshoeform">
              <div class="leftmyshoeform1">
               <p><b>Your Email <span class="mark">*</span></b>:</p>
                <p><b>Shoe Name <span class="mark">*</span></b>:</p>
                <p style="height:100px;"><b>Product Description <span class="mark">*</span></b>:</p>

                <p style="height:30px;">&nbsp;</p>
                <p><b>Link <span class="mark"></span></b>:</p>
                <p><b>Price <span class="mark"></span></b>:</p>
                <p><b>Country <span class="mark"></span></b>:</p>
                <p><b>Brand <span class="mark"></span></b>:</p>

                <p><b>Category <span class="mark"></span></b>:</p>
                <p><b>Footware <span class="mark"></span></b>:</p>
                <p><b>Material <span class="mark"></span></b>:</p>
                <p><b>Heel Height <span class="mark"></span></b>:</p>
                <p><b>Heel Size<span class="mark"></span></b>:</p>

                <p><b>Type of Sole<span class="mark"></span></b>:</p>
                <p><b>Type of Closure<span class="mark"></span></b>:</p>
                <p><b>Shoe Lace<span class="mark"></span></b>:</p>
                <p><b>Shoe Size<span class="mark"></span></b>:</p>
                <p><b>Shoe Type<span class="mark"></span></b>:</p>

                <p><b>Shoe Width<span class="mark"></span></b>:</p>
                <p><b>Season<span class="mark"></span></b>:</p>
              </div>
              <div class="leftmyshoeform2">
               <p>
                  <input type="text"  style="width:150px;" name="email" id="email" value=""/>
                </p>

                <p>
                  <input type="text"  style="width:150px;" name="shoe_name" id="shoe_name" value=""/>
                </p>
                <p style="height:100px;">
                 <textarea name="description" rows="6" cols="30" id="description"></textarea>
                </p>
                <p style="height:30px;">&nbsp;</p>
                <p><span class="input">

                <input name="link" class="input_box" id="link" type="text" value=""  style="width:150px" />
                </span></p>
                <p><span class="input">
                <input name="price" class="input_box" id="price" type="text" value="" style="width:150px" />
                </span></p>
                <p><span class="input">
                <select id="cnt_id" name="cnt_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>

                                        <option value="157"  >Afghanistan</option>
                                        <option value="176"  >Albania</option>
                                        <option value="134"  >Algeria</option>
                                        <option value="34"  >American Samoa</option>
                                        <option value="185"  >Andorra</option>
                                        <option value="32"  >Angola</option>

                                        <option value="1"  >Antarctica</option>
                                        <option value="124"  >Antigua and Barbuda</option>
                                        <option value="2"  >Argentina</option>
                                        <option value="175"  >Armenia</option>
                                        <option value="226"  >Australia</option>
                                        <option value="197"  >Austria</option>

                                        <option value="174"  >Azerbaijan</option>
                                        <option value="137"  >Bahamas</option>
                                        <option value="148"  >Bahrain</option>
                                        <option value="136"  >Bangladesh</option>
                                        <option value="106"  >Barbados</option>
                                        <option value="210"  >Belarus</option>

                                        <option value="207"  >Belgium</option>
                                        <option value="121"  >Belize</option>
                                        <option value="83"  >Benin</option>
                                        <option value="160"  >Bermuda</option>
                                        <option value="150"  >Bhutan</option>
                                        <option value="21"  >Bolivia</option>

                                        <option value="187"  >Bosnia and Herzegovina</option>
                                        <option value="17"  >Botswana</option>
                                        <option value="10"  >Brazil</option>
                                        <option value="132"  >British Virgin Islands</option>
                                        <option value="74"  >Brunei</option>
                                        <option value="183"  >Bulgaria</option>

                                        <option value="91"  >Burkina Faso</option>
                                        <option value="52"  >Burundi</option>
                                        <option value="93"  >Cambodia</option>
                                        <option value="63"  >Cameroon</option>
                                        <option value="224"  >Canada</option>
                                        <option value="116"  >Cape Verde</option>

                                        <option value="133"  >Cayman Islands</option>
                                        <option value="67"  >Central African Republic</option>
                                        <option value="87"  >Chad</option>
                                        <option value="4"  >Chile</option>
                                        <option value="131"  >China</option>
                                        <option value="51"  >Colombia</option>

                                        <option value="38"  >Comoros</option>
                                        <option value="48"  >Congo</option>
                                        <option value="40"  >Congo (Dem. Rep.)</option>
                                        <option value="24"  >Cook Islands</option>
                                        <option value="89"  >Costa Rica</option>
                                        <option value="186"  >Croatia</option>

                                        <option value="135"  >Cuba</option>
                                        <option value="165"  >Cyprus</option>
                                        <option value="202"  >Czech Republic</option>
                                        <option value="213"  >Denmark</option>
                                        <option value="96"  >Djibouti</option>
                                        <option value="119"  >Dominica</option>

                                        <option value="128"  >Dominican Republic</option>
                                        <option value="47"  >East Timor</option>
                                        <option value="50"  >Ecuador</option>
                                        <option value="141"  >Egypt</option>
                                        <option value="109"  >El Salvador</option>
                                        <option value="56"  >Equatorial Guinea</option>

                                        <option value="105"  >Eritrea</option>
                                        <option value="216"  >Estonia</option>
                                        <option value="68"  >Ethiopia</option>
                                        <option value="39"  >External Territories of Australia</option>
                                        <option value="3"  >Falkland Islands</option>
                                        <option value="220"  >Faroe Islands</option>

                                        <option value="29"  >Fiji Islands</option>
                                        <option value="218"  >Finland</option>
                                        <option value="182"  >France</option>
                                        <option value="65"  >French Guiana</option>
                                        <option value="13"  >French Polynesia</option>
                                        <option value="5"  >French Southern Territories</option>

                                        <option value="53"  >Gabon</option>
                                        <option value="108"  >Gambia</option>
                                        <option value="180"  >Georgia</option>
                                        <option value="200"  >Germany</option>
                                        <option value="77"  >Ghana</option>
                                        <option value="166"  >Greece</option>

                                        <option value="219"  >Greenland</option>
                                        <option value="99"  >Grenada</option>
                                        <option value="120"  >Guadeloupe</option>
                                        <option value="110"  >Guam</option>
                                        <option value="112"  >Guatemala</option>
                                        <option value="205"  >Guernsey and Alderney</option>

                                        <option value="86"  >Guinea</option>
                                        <option value="97"  >Guinea-Bissau</option>
                                        <option value="66"  >Guyana</option>
                                        <option value="130"  >Haiti</option>
                                        <option value="107"  >Honduras</option>
                                        <option value="195"  >Hungary</option>

                                        <option value="221"  >Iceland</option>
                                        <option value="88"  >India</option>
                                        <option value="44"  >Indonesia</option>
                                        <option value="147"  >Iran</option>
                                        <option value="156"  >Iraq</option>
                                        <option value="209"  >Ireland</option>

                                        <option value="212"  >Isle of Man</option>
                                        <option value="155"  >Israel</option>
                                        <option value="169"  >Italy</option>
                                        <option value="73"  >Ivory Coast</option>
                                        <option value="127"  >Jamaica</option>
                                        <option value="145"  >Japan</option>

                                        <option value="203"  >Jersey</option>
                                        <option value="154"  >Jordan</option>
                                        <option value="178"  >Kazakhstan</option>
                                        <option value="49"  >Kenya</option>
                                        <option value="54"  >Kiribati</option>
                                        <option value="173"  >Korea (North)</option>

                                        <option value="164"  >Korea (South)</option>
                                        <option value="153"  >Kuwait</option>
                                        <option value="177"  >Kyrgyzstan</option>
                                        <option value="117"  >Laos</option>
                                        <option value="215"  >Latvia</option>
                                        <option value="163"  >Lebanon</option>

                                        <option value="11"  >Lesotho</option>
                                        <option value="72"  >Liberia</option>
                                        <option value="143"  >Libya</option>
                                        <option value="199"  >Liechtenstein</option>
                                        <option value="211"  >Lithuania</option>
                                        <option value="206"  >Luxembourg</option>

                                        <option value="179"  >Macedonia</option>
                                        <option value="19"  >Madagascar</option>
                                        <option value="33"  >Malawi</option>
                                        <option value="62"  >Malaysia</option>
                                        <option value="59"  >Maldives</option>
                                        <option value="95"  >Mali</option>

                                        <option value="167"  >Malta</option>
                                        <option value="75"  >Marshall Islands</option>
                                        <option value="114"  >Martinique</option>
                                        <option value="118"  >Mauritania</option>
                                        <option value="27"  >Mauritius</option>
                                        <option value="37"  >Mayotte</option>

                                        <option value="115"  >Mexico</option>
                                        <option value="69"  >Micronesia</option>
                                        <option value="194"  >Moldova</option>
                                        <option value="190"  >Monaco</option>
                                        <option value="188"  >Mongolia</option>
                                        <option value="152"  >Morocco</option>

                                        <option value="18"  >Mozambique</option>
                                        <option value="101"  >Myanmar</option>
                                        <option value="12"  >Namibia</option>
                                        <option value="60"  >Nauru</option>
                                        <option value="149"  >Nepal</option>
                                        <option value="208"  >Netherlands</option>

                                        <option value="100"  >Netherlands Antilles</option>
                                        <option value="22"  >New Caledonia</option>
                                        <option value="6"  >New Zealand</option>
                                        <option value="94"  >Nicaragua</option>
                                        <option value="98"  >Niger</option>
                                        <option value="71"  >Nigeria</option>

                                        <option value="113"  >Northern Mariana Islands</option>
                                        <option value="217"  >Norway</option>
                                        <option value="123"  >Oman</option>
                                        <option value="142"  >Pakistan</option>
                                        <option value="64"  >Palau</option>
                                        <option value="158"  >Palestine</option>

                                        <option value="85"  >Panama</option>
                                        <option value="43"  >Papua New Guinea</option>
                                        <option value="14"  >Paraguay</option>
                                        <option value="30"  >Peru</option>
                                        <option value="76"  >Philippines</option>
                                        <option value="204"  >Poland</option>

                                        <option value="162"  >Portugal</option>
                                        <option value="129"  >Puerto Rico</option>
                                        <option value="146"  >Qatar</option>
                                        <option value="25"  >Reunion</option>
                                        <option value="189"  >Romania</option>
                                        <option value="181"  >Russia</option>

                                        <option value="55"  >Rwanda</option>
                                        <option value="7"  >Saint Helena</option>
                                        <option value="125"  >Saint Kitts and Nevis</option>
                                        <option value="111"  >Saint Lucia</option>
                                        <option value="198"  >Saint Pierre and Miquelon</option>
                                        <option value="104"  >Saint Vincent and The Grenadines</option>

                                        <option value="36"  >Samoa</option>
                                        <option value="191"  >San Marino</option>
                                        <option value="122"  >Saudi Arabia</option>
                                        <option value="61"  >SÃ£o TomÃ© and PrÃ­ncipe</option>
                                        <option value="102"  >Senegal</option>
                                        <option value="184"  >Serbia and Montenegro</option>

                                        <option value="84"  >Sierra Leone</option>
                                        <option value="201"  >Slovakia</option>
                                        <option value="193"  >Slovenia</option>
                                        <option value="16"  >Smaller Territories of Chile</option>
                                        <option value="20"  >Smaller Territories of the UK</option>
                                        <option value="41"  >Solomon Islands</option>

                                        <option value="58"  >Somalia</option>
                                        <option value="9"  >South Africa</option>
                                        <option value="151"  >Spain</option>
                                        <option value="81"  >Sri Lanka</option>
                                        <option value="70"  >Sudan</option>
                                        <option value="78"  >Suriname</option>

                                        <option value="222"  >Svalbard and Jan Mayen</option>
                                        <option value="15"  >Swaziland</option>
                                        <option value="214"  >Sweden</option>
                                        <option value="196"  >Switzerland</option>
                                        <option value="161"  >Syria</option>
                                        <option value="139"  >Taiwan</option>

                                        <option value="171"  >Tajikistan</option>
                                        <option value="42"  >Tanzania</option>
                                        <option value="80"  >Thailand</option>
                                        <option value="82"  >Togo</option>
                                        <option value="45"  >Tokelau</option>
                                        <option value="26"  >Tonga</option>

                                        <option value="92"  >Trinidad and Tobago</option>
                                        <option value="159"  >Tunisia</option>
                                        <option value="168"  >Turkey</option>
                                        <option value="172"  >Turkmenistan</option>
                                        <option value="138"  >Turks and Caicos Islands</option>
                                        <option value="46"  >Tuvalu</option>

                                        <option value="57"  >Uganda</option>
                                        <option value="192"  >Ukraine</option>
                                        <option value="144"  >United Arab Emirates</option>
                                        <option value="225"  >United Kingdom</option>
                                        <option value="223"  >United States</option>
                                        <option value="8"  >Uruguay</option>

                                        <option value="170"  >Uzbekistan</option>
                                        <option value="28"  >Vanuatu</option>
                                        <option value="79"  >Venezuela</option>
                                        <option value="90"  >Vietnam</option>
                                        <option value="126"  >Virgin Islands of the United States</option>
                                        <option value="35"  >Wallis and Futuna</option>

                                        <option value="140"  >Western Sahara</option>
                                        <option value="103"  >Yemen</option>
                                        <option value="31"  >Zambia</option>
                                        <option value="23"  >Zimbabwe</option>
                                      </select>
                </span></p>
                <p><span class="input">

                <select id="brn_id" name="brn_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="34"  >a-test</option>
                                        <option value="29"  >Addidas</option>
                                        <option value="28"  >Champion</option>
                                        <option value="16"  >Deisel</option>

                                        <option value="26"  >Dexter</option>
                                        <option value="14"  >Durango</option>
                                        <option value="17"  >Ecko</option>
                                        <option value="9"  >Feragamo</option>
                                        <option value="15"  >Frye</option>
                                        <option value="31"  >GAP</option>

                                        <option value="20"  >GAP</option>
                                        <option value="11"  >Gucci</option>
                                        <option value="36"  >H-test</option>
                                        <option value="13"  >Jimmy Choo</option>
                                        <option value="35"  >k-test</option>
                                        <option value="12"  >Luis Vitton</option>

                                        <option value="8"  >Manolo Blanik</option>
                                        <option value="1"  >Others</option>
                                        <option value="22"  >Parade</option>
                                        <option value="24"  >Phat Farm</option>
                                        <option value="10"  >Prada</option>
                                        <option value="18"  >Pro-Keds</option>

                                        <option value="4"  >Puma</option>
                                        <option value="7"  >Reebok</option>
                                        <option value="25"  >Roca Wear</option>
                                        <option value="6"  >Sketchers</option>
                                        <option value="21"  >Steve Madden</option>
                                        <option value="33"  >test</option>

                                        <option value="23"  >Timberland</option>
                                    </select>
                </span></p>
                <p>
                  <select id="shc_id" name="shc_id" style="width:150px">
                    <optgroup label="label">
                    <option selected="selected" value=""><span class="input">Please Select</span></option>
                    </optgroup>

                                        <optgroup label="Kids">
                                        <option value="8"  ><span class="input">Boots</span></option>
                                        <option value="9"  ><span class="input">Casual</span></option>
                                        </optgroup>
                                        <optgroup label="Men">
                                        <option value="6"  ><span class="input">Dress</span></option>
                                        <option value="7"  ><span class="input">Casual</span></option>

                                        <option value="10"  ><span class="input">Athletic</span></option>
                                        <option value="11"  ><span class="input">Boots</span></option>
                                        <option value="12"  ><span class="input">Sandals</span></option>
                                        </optgroup>
                                        <optgroup label="Women">
                                        <option value="4"  ><span class="input">Dress</span></option>
                                        <option value="5"  ><span class="input">Casual</span></option>

                                        <option value="13"  ><span class="input">Athletic</span></option>
                                        <option value="14"  ><span class="input">Boots</span></option>
                                        <option value="15"  ><span class="input">Sandals</span></option>
                                        </optgroup>
                                      </select>
                </p>
                <p><span class="input">

                <select id="fot_id" name="fot_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                    <option value="29" >A-test</option>
                                        <option value="9" >Boots</option>
                                        <option value="5" >Clogs</option>
                                        <option value="6" >Flip Flops</option>

                                        <option value="30" >J-test</option>
                                        <option value="10" >Mary Janes</option>
                                        <option value="1" >Others</option>
                                        <option value="4" >Pumps</option>
                                        <option value="7" >Sandals</option>
                                        <option value="12" >sisworld</option>

                                        <option value="8" >Sling Backs</option>
                                        <option value="2" >Sneakers</option>
                                        <option value="3" >Stilettos</option>
                                        <option value="28" >test</option>
                                      </select>
                </span></p>
              <p><span class="input">

                  <select id="mtr_id" name="mtr_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="4"  >Cotton</option>
                                        <option value="7"  >Croc</option>
                                        <option value="2"  >Leather</option>
                                        <option value="5"  >Mesh</option>

                                        <option value="1"  >Others</option>
                                        <option value="9"  >Pony skin</option>
                                        <option value="8"  >Rubber</option>
                                        <option value="10"  >Skin</option>
                                        <option value="6"  >Snake skin</option>
                                        <option value="3"  >Suede</option>

                                      </select>
                </span></p>
                <p><span class="input">
                  <select id="hlh_id" name="hlh_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="1"  >1"</option>
                                        <option value="2"  >2"</option>

                                        <option value="3"  >3"</option>
                                        <option value="4"  >4"</option>
                                        <option value="5"  >5"</option>
                                        <option value="6"  >6"</option>
                                        <option value="7"  >7"</option>
                                        <option value="8"  >8"</option>

                                      </select>
                </span></p>
                <p><span class="input">
                  <select id="hls_id" name="hls_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="2"  >1-8 Inch</option>
                                        <option value="4"  >Platform</option>

                                        <option value="5"  >test</option>
                                        <option value="3"  >Wedge</option>
                                      </select>
                </span></p>
                <p><span class="input">
                  <select id="sol_id" name="sol_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>

                                        <option value="2"  >Cork</option>
                                        <option value="1"  >Others</option>
                                        <option value="3"  >Rubber</option>
                                        <option value="4"  >Wood</option>
                                      </select>
                </span></p>
                <p><span class="input">

                  <select id="clo_id" name="clo_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="7"  >Buckle</option>
                                        <option value="2"  >Laces</option>
                                        <option value="8"  >Others</option>
                                        <option value="4"  >Straps</option>

                                        <option value="3"  >Velcro</option>
                                        <option value="5"  >Wrap Around</option>
                                        <option value="6"  >Zipper</option>
                                      </select>
                </span></p>
                <p><span class="input">Yes
                    <input name="shoe_lace" value="1" type="radio"   />
No

<input name="shoe_lace" value="0" type="radio"  checked="checked"   />
                </span></p>
                <p><span class="input">
                  <select name="siz_id" id="siz_id"  style="width:150px">
                            <option selected="selected" value="">Please Select</option>
                                                        <optgroup label="Women - Athletic">
                                                        <option value="9"  >9</option>
                                                        </optgroup>

                                                        <optgroup label="Kids - Boots">
                                                        <option value="2"  >5</option>
                                                        </optgroup>
                                                        <optgroup label="Men - Boots">
                                                        <option value="6"  >7½</option>
                                                        </optgroup>
                                                        <optgroup label="Kids - Casual">
                                                        <option value="3"  >6</option>

                                                        </optgroup>
                                                        <optgroup label="Men - Dress">
                                                        <option value="4"  >6½</option>
                                                        </optgroup>
                                                        <optgroup label="Women - Sandals">
                                                        <option value="5"  >7</option>
                                                        </optgroup>
                                                      </select>

                </span></p>
                <p><span class="input">
                  <select id="sht_id" name="sht_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>
                                        <option value="2"  >Flats</option>
                                        <option value="3"  >Heels</option>
                                        <option value="4"  >Strappy</option>

                                      </select>
                </span></p>
                <p><span class="input">
                  <select name="shw_id" id="shw_id" style="width:150px">
                            <option selected="selected" value="">Please Select</option>
                                                        <optgroup label="Women - Casual">
                                                        <option value="14"  >test</option>
                                                        </optgroup>

                                                        <optgroup label="Women - Dress">
                                                        <option value="7"  >2A (AA)</option>
                                                        <option value="8"  >S</option>
                                                        <option value="9"  >N</option>
                                                        <option value="10"  >SS</option>
                                                        <option value="11"  >4A (AAAA)</option>

                                                        <option value="12"  >3A (AAA)</option>
                                                        </optgroup>
                                                        <optgroup label="Men - Dress">
                                                        <option value="1"  >N</option>
                                                        <option value="2"  >C</option>
                                                        <option value="3"  >B</option>
                                                        <option value="4"  >3A (AAA) </option>

                                                        <option value="5"  >2A (AA)</option>
                                                        <option value="6"  >A</option>
                                                        </optgroup>
                                                      </select>
                </span></p>
                <p><span class="input">
                  <select id="sea_id" name="sea_id" style="width:150px">
                    <option selected="selected" value="">Please Select</option>

                                        <option value="4"  >Fall</option>
                                        <option value="2"  >Spring</option>
                                        <option value="3"  >Summer</option>
                                        <option value="1"  >Winter</option>
                                      </select>
                </span></p>
                <p><input name="submit" value="Submit" class="bttn" type="submit" /></p>

              </div>
            </div></form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>

<div id="footerbg">
  <div class="footer">
    <ul>
                         <li><a href="pages.php?pageid=5">About Us</a> |</li>
                                        <li><a href="pages.php?pageid=7">Terms and Conditions</a> |</li>
                                        <li><a href="pages.php?pageid=8">Shipping Info</a> |</li>

                                        <li><a href="contactus.php">Contact Us</a> |</li>
                   <li>
							                                <a href="advlogin.php">Advertisers</a>
                                 </ul>
    <br class="clear"/>
    Copyright &copy; ShoeBreeze.com.Power by: INNOgenius.inc. All rights reserved. </div>

</div>
<!-- footer -->
</body>
</html>
