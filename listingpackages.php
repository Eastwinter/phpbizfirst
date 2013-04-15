<?php include("connect.php"); ?>
<link rel="stylesheet" href="css/css.css" type="text/css" />
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
            <div class="packages" style="text-align:left">
              <div class="listoptn">
                <h3>
                  
                  <?php echo $row['name']; ?> Listing</h3>
                <h2>$<?php echo $row['price']; ?> per month </h2>
              </div>
             <?php echo $row['description']; ?>
            </div>
            
            
                        <div id="hidpack<?php echo $row['packageid']; ?>" style="display:none">
             <p> <b>Selected Products</b></p>
              
                <input name="packid" type="hidden" value="<?php echo $row['packageid']; ?>" />
              <p><?php echo $row['name']; ?>  Listing -<?php echo $row['code']; ?> $<?php echo $row['price'];?> per month</p>
                
             <?php echo $row['description']; ?>
              <p  class="listing"><a onclick="window.open('selectpackages.php?packid=<?php echo $row['packageid']; ?>','','status=no,menubar=no,toolbars=no,width=900,height=900,scrollbars=yes');">Select a Different Product</a></p>
              
             
            </div>

           <?php
		   }
		   ?>
            <input name="packid1" type="hidden" value="<?php echo $_GET['packid']; ?>" id="packid1">
            
            
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
	window.opener.document.getElementById('packid').value=document.getElementById('packid1').value;
	window.opener.document.getElementById('package').innerHTML=document.getElementById(nm).innerHTML;
	window.close();
}
</script>