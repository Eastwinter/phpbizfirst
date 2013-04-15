<?php include("header.php");


$c='';
for($i=0;$i<count($_POST['chkbox']);$i++)
{
	if($i==0)
		$c=$_POST['chkbox'][$i];
	else
		$c.=",".$_POST['chkbox'][$i];
	
}

?>
  
  <?php include("left.php");?>
  <div id="content_area_mid_inner2">
    
    <div><h2>Compare <span>Shoe</span></h2></div>
    <div id="search_result_top_l">&nbsp;</div>
    <div id="search_result_top_l">&nbsp;</div>
    <div id="search_result_top_r">&nbsp;&nbsp;<a href="#" onclick="javascript: history.back(); "><img src="images/back.jpg" alt="" border="0"></a></div>
    <div class="clear"></div>
    <div class="border" style="float:left;">
    
     <?php 
		            /////////////////////////////////////////////////////////////////////////////////////////

		  	$sql="select * from soe_shoe where active='1' and soe_id in(".$c.")";
			$sql=$sql.$cond." order by name";
			$rs=mysql_query($sql) or die(mysql_error());	
		  	 while($row=mysql_fetch_array($rs))
             {
			 	//$ph="uploads/shoe_photo/".$row['logo'];		
				$ph="uploads/shoe_photo/"."thumb260_".getcol($row['soe_id']);	
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
					$row1=mysql_fetch_array($rs1);
				else
					$row1['name']='N/A';
				
				if($price>0)
					$pr="$ ".$price;
				else
					$pr='N/A';	
				extract($row);
				
				

			
		?>
    
      <div class="shoecomparelist">
        <div class="cmpimg"><a href="detail-id-<?php echo $soe_id; ?>.htm"><img src="<?php echo $ph; ?>" width="178px" height="93px" border="0" /></a></div>
        <div class="compareshoedt">
          <div class="cmphd">
            <div class="cmphd1">
              <h3> Product Details</h3>
            </div>
            <div class="cmphd2">
            <?php
				  $url="http://www.innogenius.com/shoebreeze/detail-id-".$soe_id.".htm";
				  ?>
                  <div id="fshare"><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo $url ?>" send="false" layout="button_count" width="150" show_faces="true" font="verdana"></fb:like></div>
            </div>
          </div>
          <div class="cmpdt">
            <div class="cmpdt1"><p><b>Name :</b></p></div>
            <div class="cmpdt2"><p><?php echo substr($name,0,15); ?>..</p></div>
              
            <div class="cmpdt1"><p><b>Brand :</b></p></div>
            <div class="cmpdt2"> <p><?php echo $row1['name']; ?></p></div>
            
            
              <div class="cmpdt1"><p><b>Rating :</b></p></div>
              <div class="cmpdt2">
              
               <p style="height:20px;">
              
              <?php
						$reviewrs=mysql_query("select avg(overall) as avg from soe_reviews where fldapprove=1 and fldtype='review' and fldshoeid=".$soe_id." group by fldshoeid order by flddate desc");
						$reviewrsrow=mysql_fetch_array($reviewrs);
						if($reviewrsrow['avg']>0)
						{
						for($i=1;$i<=round($reviewrsrow['avg']);$i++)
							echo '<img src="images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
							echo '<img src="images/stargrey.jpg" alt="" border="0" />';	
						}
							
					?>
              
              
              </p>
              
              </div>
              
              
              <div class="cmpdt1"><p><b>Price :</b></p></div>
            <div class="cmpdt2"><p><?php echo $pr; ?></p></div>
          </div>
          
          <div class="descrip">
            <p><b>Description :</b><br />
              <?php echo nl2br($description); ?> </p>
          </div>
          
           <?php
			$reviewrs=mysql_query("select * from soe_reviews where fldapprove=1 and fldshoeid=".$soe_id." and fldtype='review' order by flddate desc limit 0,2");
			if(mysql_num_rows($reviewrs)>0)
			{
				$r1=mysql_fetch_array($reviewrs);
				$r2=mysql_fetch_array($reviewrs);
				
				$d=array('Very Poor','Bad','Average','Good','Very Good','Excellent');
				//if($r1['overall']>0)
					$h1=$d[$r1['overall']];

				//if($r2['overall']>0)
					$h2=$d[$r2['overall']];
				
			?>
            
        
          <div class="reviewcmp">
           <p><b>Reviews : </b></p>
            <div class="reviewcmp1"><p><b><?php echo $r1['name']; ?> : </b></p></div>
            <div class="reviewcmp2"> <p><?php echo $h1; ?></p></div>
			<br class="clear">

            <?php
            if(is_array($r2))
			{
			?>
             <div class="reviewcmp1"><p><b><?php echo $r2['name']; ?> : </b></p></div>
             <div class="reviewcmp2"><p><?php echo $h2; ?></p></div>
             <?php
			 }
			 ?>
           
                  
                   
                    
                  
         </div>
          <?php
		  
		  }
		  ?>
          <br />
          <div class="morecmpbtn">
             <a href="detail-id-<?php echo $soe_id; ?>.htm" ><img src="images/more.jpg" alt="" border="0"></a>
          </div>
          <br />
          
           </div>
        </div>
      
      
       <?php
		  }
		  ?>
      
     </div>
  </div>
</div>
<div class="clear"></div>
<div class="hei"></div>
<div class="clear"></div>
<!-- Content Area End -->

<?php include("footer.php");?>