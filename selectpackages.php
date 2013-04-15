<?php include("connect.php"); ?>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	body{
		padding:0px;
		margin:0px;
		font-size:12px;
		color: #4F4F4F;
		background:#FFFFFF;
		background-image:none;		
		
		font-family:Verdana,Tahoma,Arial,sans-serif;
	}
</style>

    <div class="container">
      <div class="mid_body">
        <div class="heading">
          <h1><img src="images/icon_Featuerprojects.gif" width="66" height="41">Listing Packages</h1>
        </div>
        <div id="advertiserlistingpage">
          <div class="advertiserpackages">
          
          <?php
				$rs=mysql_query("select * from soe_packages order by price desc");
				while($row=mysql_fetch_array($rs))
				{
					if($_GET['packid']==$row['packageid'])
						$c='checked';
					else
						$c='';
				?>
            <div class="packages">
              <div class="listoptn">
                <h3>
                  <input type="radio" name="packid" id="packid" onClick="javascript: fn1(this.value);" value="<?php echo $row['packageid']; ?>" <?php echo $c; ?> />
                  <?php echo $row['name']; ?> Listing</h3>
                <h2>$<?php echo $row['price']; ?> per month </h2>
              </div>
             <?php echo $row['description']; ?>
            </div>
            
            
                        <div id="hidpack<?php echo $row['packageid']; ?>" style="display:none">
             <p> <b>Selected Products</b></p>
              
                <input name="packid" type="hidden" value="<?php echo $row['packageid']; ?>" id="packid" />
              <p><?php echo $row['name']; ?>  Listing -<?php echo $row['code']; ?> $<?php echo $row['price'];?> per month</p>
                
             <?php echo $row['description']; ?>
              <p  class="listing"><a onclick="window.open('selectpackages.php?packid=<?php echo $row['packageid']; ?>','','status=no,menubar=no,toolbars=no,width=900,height=900,scrollbars=yes');"><img src="images/select.jpg" /></a></p>
              
             
            </div>

           <?php
		   }
		   ?>
            <input name="packid1" type="hidden" value="<?php echo $_GET['packid']; ?>" id="packid1">
            
            
          </div>
        </div>
        <div id="listingpagelisting1">
          <div class="listingcol1">
            <p><a href="#" onClick="javascript: fn();"><img src="images/done.jpg" /></a></p>
          </div>
          <div class="listingcol2">
         
            <p><a onclick='window.close();'><img src="images/cancel.jpg" /></a></p>
          </div>
          <div class="listingcol2">
         
          
          </div>
        </div>
      </div>
    </div>
  
<script>
function fn1(p)
{
	document.getElementById('packid1').value=p;
}

function fn()
{
	var nm;
	nm='hidpack'+document.getElementById('packid1').value;
	//alert(nm);
	window.opener.document.getElementById('package').innerHTML=document.getElementById(nm).innerHTML;
	window.opener.document.getElementById('packid').value=document.getElementById('packid1').value;
	if(document.getElementById('packid1').value>1)
	{
		str='<input name="subscription" value="monthly" type="radio" checked="checked">Monthly<br> <input name="subscription" value="sixmonthly" type="radio">6 Months<br><input name="subscription" value="yearly" type="radio">Yearly<br>';
		window.opener.document.getElementById('subscr').innerHTML=str;
	}
	else
	{
		str='<input name="subscription" type="hidden" value="monthly" /> <a <a class="style1" onclick="window.open(\'defaultpackage.php\',\'\',\'status=no,menubar=no,toolbars=no,width=700,height=300,scrollbars=yes\');">Click Here To View Subscription Details For Default Package</a>';
		window.opener.document.getElementById('subscr').innerHTML=str;
	}
	
	window.close();
}
</script>