<?php include("connect.php"); 
insertstats('clicks',0,$_GET['id']);
?>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	body{
		padding:0px;
		margin:0px;
		font-size:12px;
		color: #4F4F4F;
		background:#F1E3F2;
		background-image:none;		
		font-family:Verdana,Tahoma,Arial,sans-serif;
	}
	
	input{
	border:none;
	}
.style13 {
	font-size: 14px;
	font-weight: bold;
}
.style14 {color: #CCCCCC}
.style15 {color: #FFFFFF}
.signupinnerformcol1 p
{
height:30px;
margin:0;
}
.signupinnerformcol22 p
{
height:30px;
margin:0px;
}

table td
{
font-size:12px;
}


</style>

  <?php ///////////////////////////////////////// FORM READING A REVIEW //////////////////////////////////////////// ?>                 
     
      <?php
			$rvs=0;
			$stors=mysql_query("select * from soe_stores where sto_id=".$_GET['id']."");
			$storsrow=mysql_fetch_array($stors);
			extract($storsrow);
			
			$cntrs=mysql_query("select * from soe_geo_countries where con_id=".$con_id);
			$cntrsrow=mysql_fetch_array($cntrs);
			$country=$cntrsrow['name'];

			$sttrs=mysql_query("select * from soe_geo_states where sta_id=".$sta_id);
			$sttrsrow=mysql_fetch_array($sttrs);
			$state=$sttrsrow['name'];


			$sttrs=mysql_query("select * from soe_geo_cities where cty_id=".$cty_id);
			$sttrsrow=mysql_fetch_array($sttrs);
			$city=$sttrsrow['name'];
			
			?>
         
            <h3><?php echo $store_name; ?></h3>
			<em><?php echo $slogan_text; ?></em>
            
            
            
             <table border="0" cellspacing="5" cellpadding="5" >
          <tr>
            <td align="center" valign="top">
             <div style="background-color:#FFFFFF;">
         <div id="fshare"><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo $url ?>" send="false" layout="button_count" width="150" show_faces="true" font="verdana"></fb:like></div><br />
          <img src="uploads/company_logo/<?php echo $logo; ?>" border="0" height="100" width="200" /><br />
            <br />
            </div>
            
           
</td>
            <td>
            
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
<?php
if($display_address==1)
{
?>            
  <tr bgcolor="#0000CC">
    <td class="style9 style14">Main Address:</td>
  </tr>
  <tr>
    <td><?php echo $address; ?>,<br />
		<?php echo $city; ?>,<?php echo $state; ?>,<br />
        <?php echo $country; ?> - <?php echo $zip_code; ?> </td>
    </tr>
 <?php
 }
 ?>
<?php
if($hour_type==1)
{
?>            
  <tr>
    <td class="style9">Store open 24 hours a day</td>
    </tr>
 <?php
 }
 ?>

<?php
if($hour_type==2)
{
?>            
  <tr>
    <td>
    
    <div class="signupinnerform11">
                <div class="signupinnerformcol1">
                  <p>Monday </p>
                  <p>Tuesday </p>
                  <p>Wednesday </p>
                  <p>Thursday </p>
                  <p>Friday </p>
                  <p>Saturday </p>
                  <p>Sunday </p>
                </div>
                <div class="signupinnerformcol22">
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
                 
				<?php if($storearr[0]==0) 
						echo "Closed" ; 
					 
                          
						  if($storearr[0]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr1" <?php echo $s; ?> ><input name="hour_fr[]" type="text" class="input_box2" id="hour_fr1" value="<?php echo $hfr[0]; ?>" size="15" readonly="readonly" autocomplete="OFF" /> 
				  to 
		  <input name="hour_to[]" type="text" class="input_box2" id="hour_to1" value="<?php echo $hto[0]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>          </p>
				<p>
				
                            <?php
						if($storearr[1]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						
						 if($storearr[1]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr2" <?php echo $s; ?> > <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr2" value="<?php echo $hfr[1]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to2" value="<?php echo $hto[1]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                      </p>
				<p>
				
                          
                            <?php
						if($storearr[2]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						
						  if($storearr[2]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr3" <?php echo $s; ?> > <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr3" value="<?php echo $hfr[2]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to3" value="<?php echo $hto[2]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                      </p>
				<p>
				
                            <?php
							if($storearr[3]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						   if($storearr[3]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr4" <?php echo $s; ?> ><input name="hour_fr[]" type="text" class="input_box2" id="hour_fr4" value="<?php echo $hfr[3]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to4" value="<?php echo $hto[3]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                      </p>
				<p>
				
                            <?php
								if($storearr[4]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						   if($storearr[4]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr5" <?php echo $s; ?> > <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr5" value="<?php echo $hfr[4]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to5" value="<?php echo $hto[4]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                      </p>
				<p>
				
                            <?php
							
								if($storearr[5]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						   if($storearr[5]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr6" <?php echo $s; ?> > <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr6" value="<?php echo $hfr[5]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to6" value="<?php echo $hto[5]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                      </p>
				<p>
		
                            <?php
							
								if($storearr[6]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						  if($storearr[6]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
                        <span id="hfr7" <?php echo $s; ?> >	 <input name="hour_fr[]" type="text" class="input_box2" id="hour_fr7" value="<?php echo $hfr[6]; ?>" size="15" readonly="readonly" autocomplete="OFF" > 
                          to <input name="hour_to[]" type="text" class="input_box2" id="hour_to7" value="<?php echo $hto[6]; ?>" size="15" readonly="readonly" autocomplete="OFF" >
                          </span>                  </p>
                    </div>
              </div>    </td>
    </tr>

 <?php
 }
 ?>
 
   <tr>
    <td><span class="style9"><strong>Phone:</strong></span><strong>&nbsp;&nbsp;&nbsp;</strong><?php echo $phone; ?></td>
  </tr>

   <tr>
    <td><span class="style9"><strong>Fax:</strong>&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $fax; ?></td>
  </tr>

   <tr>
    <td><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></td>
  </tr>
  
     <tr>
    <td><strong class="style9">Cross Streets:</strong><br />
      <br />
      <?php echo $cross_street; ?></td>
  </tr>
  
  <tr>
    <td><strong class="style9">Public Transportation:</strong><br />
      <br />
      <?php echo $transportation; ?></td>
  </tr>

<tr>
    <td><strong class="style9">Directions:</strong><br />
      <br />
      <a href="<?php echo $directions; ?>" target="_blank"><?php echo $directions; ?></a></td>
  </tr>
<tr>
  <td><p><strong class="style9">Languages Spoken:</strong></p>
    <p> <?php
							$n=1;
							$a=explode(",",$languages);
							$rsd=mysql_query("select * from soe_lan_spoken where active=1");
							while($rowd=mysql_fetch_array($rsd))
							{
								if(in_array($rowd['las_id'],$a))
									echo $rowd['name']."<br />";
							}
								
						   ?></p></td>
</tr>
 
  
  
  <?php
  $i=1;
  $locrs=mysql_query("select * from soe_storelocations where sto_id=".$_GET['id']);
  while($locrow=mysql_fetch_array($locrs))
  {
  extract($locrow);
if($display_address==1)
{
$i++;
?>            
  <tr bgcolor="#0000CC">
    <td class="style9 style15">Address - <?php echo $i ;?>:</td>
  </tr>
  <tr>
    <td><?php echo $address; ?>,<br />
		<?php echo $city; ?>,<?php echo $state; ?>,<br />
        <?php echo $country; ?> - <?php echo $zip_code; ?> </td>
    </tr>
 <?php
 }
 ?>
<?php
if($hour_type==1)
{
?>            
  <tr>
    <td class="style9">Store open 24 hours a day</td>
    </tr>
 <?php
 }
 ?>

<?php
if($hour_type==2)
{
?>            
  <tr>
    <td><div class="signupinnerform11">
      <div class="signupinnerformcol1">
        <p>Monday </p>
        <p>Tuesday </p>
        <p>wednesday </p>
        <p>Thursday </p>
        <p>Friday </p>
        <p>Saturday </p>
        <p>Sunday </p>
      </div>
      <div class="signupinnerformcol22">
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
          <?php if($storearr[0]==0) 
						echo "Closed" ; 
					 
                          
						  if($storearr[0]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr8" <?php echo $s; ?> >
            <input name="hour_fr" type="text" class="input_box2" id="hour_fr8" value="<?php echo $hfr[0]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to8" value="<?php echo $hto[0]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
						if($storearr[1]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						
						 if($storearr[1]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr9" <?php echo $s; ?> >
          <input name="hour_fr" type="text" class="input_box2" id="hour_fr9" value="<?php echo $hfr[1]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to9" value="<?php echo $hto[1]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
						if($storearr[2]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						
						  if($storearr[2]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr10" <?php echo $s; ?> >
          <input name="hour_fr" type="text" class="input_box2" id="hour_fr10" value="<?php echo $hfr[2]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to10" value="<?php echo $hto[2]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
							if($storearr[3]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						   if($storearr[3]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr11" <?php echo $s; ?> >
            <input name="hour_fr" type="text" class="input_box2" id="hour_fr11" value="<?php echo $hfr[3]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to11" value="<?php echo $hto[3]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
								if($storearr[4]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						   if($storearr[4]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr12" <?php echo $s; ?> >
          <input name="hour_fr" type="text" class="input_box2" id="hour_fr12" value="<?php echo $hfr[4]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to12" value="<?php echo $hto[4]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
							
								if($storearr[5]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						   if($storearr[5]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr13" <?php echo $s; ?> >
          <input name="hour_fr" type="text" class="input_box2" id="hour_fr13" value="<?php echo $hfr[5]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to13" value="<?php echo $hto[5]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
        <p>
          <?php
							
								if($storearr[6]==0) 
						  echo "&nbsp;&nbsp;&nbsp;Closed" ;
						  
						  if($storearr[6]==1)
						  	$s=' style="visibility:visible" ';
						  else
						  	$s=' style="visibility:hidden" ';
						  ?>
          <span id="hfr14" <?php echo $s; ?> >
          <input name="hour_fr" type="text" class="input_box2" id="hour_fr14" value="<?php echo $hfr[6]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
            to
            <input name="hour_to" type="text" class="input_box2" id="hour_to14" value="<?php echo $hto[6]; ?>" size="15" readonly="readonly" autocomplete="OFF" />
        </span> </p>
      </div>
    </div></td>
    </tr>

 <?php
 }
 ?>
     <tr>
    <td><strong class="style9">Cross Streets:</strong><br />
      <br />
      <?php echo $cross_street; ?></td>
  </tr>
  
  <tr>
    <td><strong class="style9">Public Transportation:</strong><br />
      <br />
      <?php echo $transportation; ?></td>
  </tr>

<tr>
    <td><strong class="style9">Directions:</strong><br />
      <br />
      <a href="<?php echo $directions; ?>" target="_blank"><?php echo $directions; ?></a></td>
  </tr>
  <tr>
  <td><p><strong class="style9">Languages Spoken:</strong></p>
    <p> <?php
							$n=1;
							$a=explode(",",$languages);
							$rsd=mysql_query("select * from soe_lan_spoken where active=1");
							while($rowd=mysql_fetch_array($rsd))
							{
								if(in_array($rowd['las_id'],$a))
									echo $rowd['name']."<br />";
							}
								
						   ?></p></td>
</tr>


  <?php
  }
  ?>
</table>            </td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><span class="style13">Other Shoes From The Store</span></td>
            </tr>
          <tr>
            <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF">
			
			<?php 
			$rs=mysql_query("select * from soe_shoe where sto_id=".$_GET['id']." and active='1' and hide=0 order by added desc limit 0, 9");
			$n=1;
          	 while($row=mysql_fetch_array($rs))
             {
				$t=strtotime(date('Y-m-d'))-$row['added'];
				if(getcol($row['soe_id'])=='')
					continue;
				$ph="uploads/shoe_photo/"."thumb98_".getcol($row['soe_id']);
				
				$str=''.$row['name'].'';
				$rs1=mysql_query("select * from soe_brand where brn_id=".$row['brn_id']);
				if(mysql_num_rows($rs1)>0)
				{
					$row1=mysql_fetch_array($rs1);
					$str.='<br />'.$row1['name'];
				}
								
				if($row['price']>0)
				{
					$str.='<br /><span style="color:#FF0000">$'.$row['price'].'</span>';
				}
				
			$ph1="uploads/shoe_photo/".getcol($row['soe_id']);
        ?>
						
                    
          <div id="searchresultdt">
            <div class="searchimg">
            <a rel="<?php echo $ph1; ?>" class="preview" onclick="ft('<?php echo $row['soe_id']; ?>');" ><img src="<?php echo $ph; ?>" alt="" border="0" width="98" height="55" style="cursor:pointer" /></a></div>
            <div class="searchimgdt"><center><?php echo $str; ?>
            
            <?php
					$reviewrs=mysql_query("select avg(overall) as avg from soe_reviews where fldapprove=1 and fldshoeid=".$row['soe_id']." group by fldshoeid order by flddate desc");
						$reviewrsrow=mysql_fetch_array($reviewrs);
						echo '<br />';
						if($reviewrsrow['avg']>0)
						{
						for($i=1;$i<=round($reviewrsrow['avg']);$i++)
							echo '<img src="images/star.jpg" alt="" border="0" />';						
						}
						else
							echo '<img src="images/starsgrey.gif" alt="" border="0" />';
							
			if($_GET['ja']==2)
				echo '<br />Clicks: '.$row['cnt'];
			
					?>
            </center>
            </div>
          </div>
          <?php
		  }
		  ?>
		  </td>
          </tr>
        </table>

<script>
function ft(a)
{
	window.opener.location.href='detail-id-'+a+".htm";
	window.close();
}

</script>
          </div>
          </div>
          </div>
