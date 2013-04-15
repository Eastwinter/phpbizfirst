<?php
include("header.php"); 
$_SESSION['cond']='';
?>



    <!--
  jQuery library
-->
<script type="text/javascript" src="lib/jquery-1.4.2.min.js"></script>
<!--
  jCarousel library
-->
<script type="text/javascript" src="lib/jquery.jcarousel.min.js"></script>
<!--
  jCarousel skin stylesheets
-->
<link rel="stylesheet" type="text/css" href="skins/tango/skin1.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('.mycarousel').jcarousel();
});

</script>


<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: medium;
}

.errstyle{
width:670px; 
float:left; margin-top:10px; margin-left:30px; margin-bottom:10px; color:#FF0000; font-weight:bold;
}
-->
</style>

    <?php include("left4.php"); ?>             



<script>
$(document).ready(function() { 
    var options = { 
		beforeSubmit: function () { $('#myresults').html('<center><img src="throbber.gif"></center>')},
        target:        '#myresults',   // target element(s) to be updated with server response 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#srchfrm').ajaxForm(options); 
	
	
	$("#srchfrmbtn").click(function() {
           $('#srchfrm').submit();
        });
		
	  var options = { 
		beforeSubmit: function () { $('#myresults').html('<center><img src="throbber.gif"></center>')},
        target:        '#myresults',   // target element(s) to be updated with server response 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#mysbfrm').ajaxForm(options); 
	
	
	$("#mysub").click(function() {
			document.mysbfrm.subval.value=0;
		$('#mysbfrm').bind('chkbox[]');
           $('#mysbfrm').submit();
        });
		
		$("#storeid").change(function() {
			document.mysbfrm.subval.value=1;
				a=document.mysbfrm.storeid.options.selectedIndex;
				b=document.mysbfrm.storeid.options[a].value;
				c=b.split("-");
			document.srchfrm.sto_id.value=c[0];
			document.srchfrm.loc_id.value=c[1];
			$('#mysbfrm').bind('chkbox[]');
			<?php
			if($_SERVER['REQUEST_METHOD']=="POST")
  {
  ?>

   $('#srchfrm').submit();

  <?php
  }
  else
  {
  ?>
           $('#mysbfrm').submit();
	<?php
	}
	?>
        });
}); 
 
</script>
 
  <div id="content_area_mid_inner2">
  <div>
    <h2>SB Database</h2>
  </div>
  
  <form action="ajaxsbdb1.php" name="mysbfrm" method="post" id="mysbfrm">    
        
       <input type="hidden" name="subval" id="subval" value="0" />
       
       
    <div class="sbdatabase">
    
     <?php
				  
if($_GET['stoid']=='')
{
  $s="select * from soe_stores where active='1' and mem_id=".$_SESSION['memberid'];
  $rs=mysql_query($s) or die(mysql_error());
  $row=mysql_fetch_array($rs);
  $n=mysql_num_rows($rs);
  $_GET['stoid']=$row['sto_id'];
  $_GET['locid']=0;
}
?>
  <?php
  $s="select * from soe_stores where mem_id=".$_SESSION['memberid']." and active='1' order by sto_id";
  $rs=mysql_query($s) or die(mysql_error());
  if(mysql_num_rows($rs)>0)
  {
?>
    
    
    
    
      <div class="editinfo">
        <p><b>Select Store/Location To Add Shoes To :</b>&nbsp;
          <select name="storeid" id="storeid">
  <?php
  while($row=mysql_fetch_array($rs))
  {
  	$grs=mysql_query("select * from soe_geo_states where sta_id=".$row['sta_id']);
	$grsrow=mysql_fetch_array($grs);
	$state=$grsrow['name'];

  	$grs=mysql_query("select * from soe_geo_cities where cty_id=".$row['cty_id']);
	$grsrow=mysql_fetch_array($grs);
	$city=$grsrow['name'];
	if($_GET['stoid']==$row['sto_id'])
		$c='selected="selected"';
	else
		$c='';

  ?>
  <option value="<?php echo $row['sto_id']; ?>-0" <?php echo $c; ?> ><?php echo $row['store_name']; ?> - <?php echo $state; ?>, <?php echo $city; ?></option>
  <?php
  	  $rs1=mysql_query("select * from soe_storelocations where active='1' and sto_id=".$row['sto_id']." order by loc_id desc");
	  while($row1=mysql_fetch_array($rs1))
	  {
	  
	$grs=mysql_query("select * from soe_geo_states where sta_id=".$row1['sta_id']);
	$grsrow=mysql_fetch_array($grs);
	$state=$grsrow['name'];

  	$grs=mysql_query("select * from soe_geo_cities where cty_id=".$row1['cty_id']);
	$grsrow=mysql_fetch_array($grs);
	$city=$grsrow['name'];
	
		if($_GET['locid']==$row1['loc_id'] and $_GET['stoid']==$row['sto_id'])
		$c='selected="selected"';
	else
		$c='';


  ?>
  <option value="<?php echo $row['sto_id']; ?>-<?php echo $row1['loc_id']; ?>" <?php echo $c; ?> ><?php echo $row['store_name']; ?> - <?php echo $state; ?>, <?php echo $city; ?></option>
  <?php
	  
	  }
  }
?>
</select>
 &nbsp;&nbsp;<img src="images/upload.gif" alt="" border="0"  id="mysub" style="cursor:pointer" ></p>
      </div>
<?php
}
else
	echo '<strong>No Stores Added Yet!</strong>';


?>
         
      
      <div id="myresults">
      </div>
          
    </div>
    
    </form>
  </div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<script>
$j(document).ready(function() {
   // $("select#con_id1").trigger('change');
	$("select#storeid").trigger('change');

	});


  function fnt(obj)
  {
  	a=obj.options.selectedIndex;
	b=obj.options[a].value;
	c=b.split("-");
	location.href="sbdatabase.php?stoid="+c[0]+"&locid="+c[1];
  }




			
			function createRequestObject(){

	var request_o; //declare the variable to hold the object.

	var browser = navigator.appName; //find the browser name

	if(browser == "Microsoft Internet Explorer"){

		/* Create the object using MSIE's method */

		request_o = new ActiveXObject("Microsoft.XMLHTTP");

	}else{

		/* Create the object using other browser's method */

		request_o = new XMLHttpRequest();

	}

	return request_o; //return the object

}


var http = createRequestObject();

			function shcalc(curpage,stoid,locid)
			{
				c='ajaxsbdb1.php?stoid='+stoid+'&curpage='+curpage+'&locid='+locid;
				http.open('get', c);
				http.onreadystatechange = handlecalc; 
				http.send(null);
			}
			
			function handlecalc()
			{
					if(http.readyState == 1){
						document.getElementById("myresults").innerHTML="<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><center><img src='throbber.gif' border=0 /> </center>";
					}
		
					if(http.readyState == 4)
					{
						//alert(http.responseText);
						document.getElementById("myresults").innerHTML=http.responseText;
						$j('.mycarousel').jcarousel();
					}
			}
			
			
			
  </script>
  

<?php include("footer.php"); ?>