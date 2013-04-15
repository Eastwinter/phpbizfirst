<?php include("header.php"); 
//print_r($_GET);
if($_GET['id']=='')
{
?>
<script>
location.href='index.php';
</script>
<?php
}

$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']." and active='1' and hide=0");
if(mysql_num_rows($rs)<=0)
{
?>
<script>
location.href='index.php';
</script>
<?php
}
insertstats('clicks',$_GET['id']);
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
<link rel="stylesheet" type="text/css" href="skins/tango/skin.css" />
<link rel="stylesheet" type="text/css" href="skins/ie7/skin.css" />

<script type="text/javascript">
 var $j = jQuery.noConflict();
$j(document).ready(function() {
	$j('.mycarousel').jcarousel();
});

</script>


<script src="js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">

<script type="text/javascript">
var $n = jQuery.noConflict();
$n(document).ready(function() {
	$n('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });
	
});


</script>

<?php
function getval($id,$tname,$fname,$title)
{
	$nm='N/A';
	if($id>0)
	{
		$sql="select * from ".$tname." where ".$fname."=".$id;
		$rs=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_array($rs);
		if($fname=='shc_id')
		{
			$rs1=mysql_query("select * from soe_shoe_category where shc_id=".$row['parent_id']);
			$row1=mysql_fetch_array($rs1);
			$row['name']=$row1['name'].", ".$row['name'];
		}
		$nm=str_replace('""','',$row['name']);
	}
	echo $nm;
}
?>

<?php
if($_GET['msg']=="done")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">Item added to your wish list successfully!</span></div>
<?php
}
?>				

<?php
if($_GET['msg']=="notdone")
{
?>	
                
<div id="object" class="message_box">
		<span class="err">Item already in your wish list!</span></div>
<?php
}
?>	

  <?php include("left.php"); ?>
  
   <?php
					$rs=mysql_query("select * from soe_shoe where soe_id=".$_GET['id']);
					$row=mysql_fetch_array($rs);
					extract($row);
					
					if($_GET['colid']=='')
						$colid=0;
					else
						$colid=$_GET['colid'];
						
					$pars=mysql_query("select * from soe_shoe_category where shc_id=".$shc_id);
					if(mysql_num_rows($pars)>0)
					{
						$parsrow=mysql_fetch_array($pars);
						$parid=$parsrow['parent_id'];
					}
		?>  
        
  <div id="content_area_mid_inner_big"> <img src="images/shoe_detail.jpg">
    <div class="border">
      <div id="shoe_img_left">
        <div id="dtpagecol1">
          <div id="dtimg1" style="text-align:center; height:300px; vertical-align:middle"><a href="uploads/shoe_photo/<?php echo getcol($soe_id,'',$colid); ?>" class="jqzoom" rel="gal1"><img src="uploads/shoe_photo/thumb260_<?php echo getcol($soe_id,'',$colid); ?>" alt="" name="mainimg" width="260" border="0" align="absmiddle" id="mainimg" /></a></div>
          <a name="mymainimg"></a>
          <div id="dtthumbnail">
          <?php
		  		$nm='logo1';
				$img=getcol($soe_id,$nm,$colid);
          	if($img!='' and file_exists("uploads/shoe_photo/".$img) and file_exists("uploads/shoe_photo/thumb30_".$img))
			{
			?>
              <div class="thmb1" style="vertical-align:middle"><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'uploads/shoe_photo/thumb260_<?php echo getcol($soe_id,'',$colid); ?>',largeimage: 'uploads/shoe_photo/<?php echo getcol($soe_id,'',$colid); ?>'}"><img src="uploads/shoe_photo/thumb30_<?php echo getcol($soe_id,'',$colid); ?>" alt=" " width="30" border="0" align="absmiddle"  /></a></div>
            <?php
			}
			?>
              <?php
						for($i=1;$i<=6;$i++)
						{
							$nm='logo'.$i;
							$img=getcol($soe_id,$nm,$colid);
							if($img!='' and file_exists("uploads/shoe_photo/".$img) and file_exists("uploads/shoe_photo/thumb30_".$img))
							{
						?>
              <div class="thmb1"><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: 'uploads/shoe_photo/thumb260_<?php echo getcol($soe_id,$nm,$colid); ?>',largeimage: 'uploads/shoe_photo/<?php echo getcol($soe_id,$nm,$colid); ?>'}"><img src="uploads/shoe_photo/thumb30_<?php echo getcol($soe_id,$nm,$colid); ?>" alt=" " border="0" width="30"  /></a></div>
              	<?php
				}
				}
				?>
            </div>
        </div>
        <br class="clear">
         
         
         
         <div style="float:left; width:100%;">
<div style="float:left; width:15%; margin-top:8px;" > <b>Color :</b> 	</div>
<div style="float:left; width:85%;" >
<?php
	$gh=mysql_query("select * from soe_shoecolors where soe_id=".$soe_id);
	while($ghrow=mysql_fetch_array($gh))
	{
	//print_r($ghrow);
	?>
<div class="thmb2" style=" cursor:pointer;background-color:<?php echo $ghrow['color']; ?>" onclick="javascript: location.href='detail-id-<?php echo $soe_id; ?>-colid-<?php echo $ghrow['id']; ?>.htm#mymainimg';"></div>

<?php
	 }
	 ?>
</div>
</div>
        <div align="center"><strong>Overall Rating:</strong> <?php
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
						echo " ( ".round($reviewrsrow['avg'])." / 5 )";			
					?></div>
        <div align="center"> <?php
			  $reviewrs=mysql_query("select avg(overall) as avg1,avg(comfort) as avg2,avg(style) as avg3 from soe_reviews where fldapprove=1 and fldtype='review' and fldshoeid=".$soe_id." group by fldshoeid order by flddate desc");
						$reviewrsrow=mysql_fetch_array($reviewrs);
						$imgnm=round($reviewrsrow['avg1']).round($reviewrsrow['avg2']).round($reviewrsrow['avg3']).".jpg";
						
						if(file_exists('ratingimg/'.$imgnm))
						{
				?>
                              <p><img src="ratingimg/<?php echo $imgnm; ?>" alt=" " border="0" /></p>
                           <?php
						   }
						   else
						   {
				?>
                              <p><img src="ratingimg/111.jpg" alt=" " border="0" /></p>
                           <?php
						   }
						   
						   ?></div>
                           
<?php
  $gr=mysql_query("select * from soe_brand where brn_id=".$brn_id);
  $grow=mysql_fetch_array($gr);
  ?> 
  
  <?php
  $cont='<div id="sampleshoe" style="display: block; width: 180px; text-align: center; border: 5px solid rgb(196, 231, 253); background-color: rgb(234, 247, 255); min-height: 230px; margin-left: auto; margin-right: auto; max-height: 1000px;">
   <br />
  
   I LIKE:<br /><br />
  <div id="sam_shoe" style="background-image:url(http://www.innogenius.com/shoebreeze/images/preview%20badge.gif);height:150px;width:165px;text-align:center;margin-left:auto;margin-right:auto;border:1px solid #c4e7fd;">
  <img src="http://www.innogenius.com/shoebreeze/uploads/shoe_photo/thumb260_'.getcol($soe_id).'" height="150" width="165">
  </div>
  <br />
 '.$name.'<br /><br />
  By '.$grow['name'].'<br />
 <div style="height:100px;">
 <br />
 <br />

  <div style="height:40;	width:110px;	text-align:center;	margin-left:auto;	margin-right:auto;">
  <img src="http://www.innogenius.com/shoebreeze/images/logo1.jpg" alt="Zappos " border="0" />
  </div>
   
  </div> 
   </div>';
   ?>                            
        <div align="center">
          <p style="cursor: pointer;font-size:12px; color:#0066CC;">Blog About this item:</p>
          <textarea  cols="20"  class="txt_box1" rows="2"><?php echo htmlentities($cont); ?></textarea>
        </div>
        <br />
        <div align="center"><a onclick="javascript: showbadge()" style="cursor: pointer; font-size:12px; color:#0066CC;">Preview Badge</a></div>
        <br>
        <div id="sampleshoe" style="display: none; width: 180px; text-align: center; border: 5px solid rgb(196, 231, 253); background-color: rgb(234, 247, 255); min-height: 230px; margin-left: auto; margin-right: auto; max-height: 1000px;">
   <br />
  <?php
  $gr=mysql_query("select * from soe_brand where brn_id=".$brn_id);
  $grow=mysql_fetch_array($gr);
  ?> 
   I LIKE:<br /><br />
  <div id="sam_shoe" style="background-image:url(http://www.innogenius.com/shoebreeze/images/preview%20badge.gif);height:150px;width:165px;text-align:center;margin-left:auto;margin-right:auto;border:1px solid #c4e7fd;">
  <img src="http://www.innogenius.com/shoebreeze/uploads/shoe_photo/thumb260_<?php echo getcol($soe_id); ?>" height="150" width="165">
  </div>
  <br />
  <?php echo $name; ?><br /><br />
  By <?php echo $grow['name']; ?><br />
 <div id="imgsam" style="height:100px;">
 <br />
 <br />

  <div id="sam_logo"  style="height:40;	width:110px;	text-align:center;	margin-left:auto;	margin-right:auto;">
  <img src="http://www.innogenius.com/shoebreeze/images/logo1.jpg" alt="Zappos " border="0" />
  </div>
   
  </div> 
   </div>
      </div>
      <?php
  $gr=mysql_query("select * from soe_brand where brn_id=".$brn_id);
  if(mysql_num_rows($gr)>0)
  {
  	$grow=mysql_fetch_array($gr);
	$brname=" , ".$grow['name'];
  }
  else
  	$brname='';
  

  ?> 
      <div id="shoe_img_right">
        <div><strong><?php echo $name; ?></strong> Item #<?php echo $soe_id; ?><?php echo $brname; ?></div>
        <div class="hei">&nbsp;</div>
        <div class="blue_bold">Price : $<?php echo $price; ?></div>
        <div class="hei">&nbsp;</div>
        <div> <strong>Description </strong><br>
         <?php echo nl2br($description); ?></div>
        <div class="hei">&nbsp;</div>
        <div id="li_txt1">Shoe category<br>
          Footware <br>
		  Material<br />
          Heel Height <br>
          Heel Size <br>
          Sole Type </div>
        <div id="li_txt2">: <?php getval($shc_id,'soe_shoe_category','shc_id','Shoe Category:&nbsp;&nbsp;'); ?> <br>
          : <?php getval($fot_id,'soe_foot_ware','fot_id','Footware:&nbsp;&nbsp;'); ?> <br>
          : <?php getval($mtr_id,'soe_material','mtr_id','Material:&nbsp;&nbsp;'); ?><br />
          : <?php getval($hlh_id,'soe_heel_height','hlh_id','Heel Height:&nbsp;&nbsp;'); ?> <br>
          : <?php getval($hls_id,'soe_heel_size','hls_id','Heel Size:&nbsp;&nbsp;'); ?>   <br>
          : <?php getval($sol_id,'soe_sole_type','sol_id','Sole Type:&nbsp;&nbsp;'); ?>
          </div>
        <div id="li_txt3">Shoe Laces <br>
          Shoe Size <br>
          Shoe Type <br>
          Shoe Width <br>
          Season <br>
          Closure 
          <br>
        </div>
        <div id="li_txt4">:  <?php
						 if($lace=='1')
						 echo 'Yes';
						 else
						 echo 'No';
					?> <br>
          : <?php getval($siz_id,'soe_shoe_size','siz_id','Shoe Size:&nbsp;&nbsp;'); ?>   <br>
          : <?php getval($sht_id,'soe_shoe_type','sht_id','Shoe Type:&nbsp;&nbsp;'); ?>   <br>
          : <?php getval($shw_id,'soe_shoe_width','shw_id','Shoe Width:&nbsp;&nbsp;'); ?> <br>
          : <?php getval($sea_id,'soe_season','sea_id','Season:&nbsp;&nbsp;'); ?><br />
		  : <?php getval($clo_id,'soe_closure','clo_id','Closure:&nbsp;&nbsp;'); ?>     </div>
        <div class="clear"></div>
        <div>
        
        <a href="#" class="example7 cboxElement"><img src="images/wr_button.jpg" width="100" border="0" height="32"></a>
        
        
        <a href="#" class="example9 cboxElement"><img src="images/rr_button.jpg" width="100" border="0" height="32"></a>
        
		<?php if($parid==1)
			 echo '<a href="PSSSizingChart_MENS.pdf" target="_blank" ><img src="images/sc_button.jpg" width="100" border="0" height="32"></a>';
			if($parid==2)
			 echo '<a href="PSSSizingChart_WOMENS.pdf" target="_blank"><img src="images/sc_button.jpg" width="100" border="0" height="32"></a>';

			if($parid==3 or $parid==4)
			 echo '<a href="PSSSizingChart_KIDS.pdf" target="_blank"><img src="images/sc_button.jpg" width="100" border="0" height="32"></a>';

			?>
        
       <a href="#" class="example10 cboxElement"><img src="images/sf_button.jpg" width="100" border="0" height="32"></a></div>
        <div class="hei">&nbsp;</div>
                <div id="buttons_left2" style="padding-right:10px"> <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
				<style> 
				html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:0px 20px 0 5px; height:20px; border:1px solid #d8dfea; background:url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:#3b5998 url(http://static.ak.facebook.com/images/share/facebook_share_icon.gif?6:26981) no-repeat top right; text-decoration:none; } </style> <a rel="nofollow" href="http://www.facebook.com/share.php?u=<?php echo $url; ?>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">Share</a></div>
                 <div id="buttons_left2"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none" style="padding-top:35px">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>
        <div id="buttons_left3">
        <?php
  if($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='mem')
  {
  ?>
  <a href="save.php?id=<?php echo $_GET['id']; ?>"><img src="images/add_cloest_button.jpg" alt="" class="img"></a>
  <?php
  }
  elseif($_SESSION['memtype']!='adv')
  {
   ?>
  <a href="memberlogin.php"><img src="images/add_cloest_button.jpg" alt="" class="img"></a>  
  <?php

  }
  ?> </div>
        <div id="buttons_left4"><a href="#" class="example11 cboxElement"><img src="images/tell_friend_ico.jpg" alt=""  class="img"></a></div>
      </div>
       <?php
	   if($sto_id>0)
	   {
	   	  $adstrs=mysql_query("select * from soe_stores where sto_id=".$sto_id) or die(mysql_error());
		  if(mysql_num_rows($adstrs)>0)
		  {
		  $adstrsrow=mysql_fetch_array($adstrs);
		  extract($adstrsrow);
		 // print_r($adstrsrow);
		  if($onlinestore==1)
		  {
	   ?>       
         <div align="center"><a href="#" class="example777"><img src="images/buy-now-button.png" width="100" height="74" border="0" align="absmiddle" /></a></div>
         
         
         
         <div style='display:none'>
          <div id='inline_example233' style='padding:10px; background:#fff;'>
           <div class="morebuying">
           <?php
		  if($_SESSION['memberlogged']=='yes' and $_SESSION['memtype']=='mem')
		   {
		   ?>
        <div class="morebuyhead">More Buying Choices</div>
        <?php
			$sql="select a.sto_id,store_name,name,price from soe_stores a,soe_shoe b where a.mem_id=".$mem_id." and onlinestore=1 and a.sto_id=b.sto_id and b.name like '".$name."' and b.brn_id='".$brn_id."' and b.active='1' and b.hide='0'";
			$adstrs1=mysql_query($sql) or die(mysql_error().'<br>'.$sql);
			while($adstrsrow1=mysql_fetch_array($adstrs1))
			{
				if($adstrsrow1['paypalurl']=='url')
					$l=$adstrsrow1['paypalid'];
				else
					$l="addtocart.php?colid=".$colid."&id=".$soe_id."&stoid=".$adstrsrow1['sto_id'];
			
		?>
        
        <div class="morebuydetail">
          <div class="morebuylist">
            <p><?php echo $adstrsrow1['store_name']; ?><span class="costdet" style="margin-left:10px;">$<?php echo $adstrsrow1['price']; ?></span></p>
          </div>
          <div class="morebuybutton">
            <p><a href="<?php echo $l; ?>"><img src="images/addcart.gif" border="0" alt=""></a></p>
          </div>
         
        </div>
        <?php
		}
		}
		else
			 echo '<span style="font-variant:small-caps; font-size:18px;"><center><strong>You should be a member of our site. Please <a href="memberlogin.php">Log-in</a> or <a href="memberlogin.php">Register</a> as a member to use this feature.</strong><center></span>';
		?>
		
      </div>
            
          </div>
         </div>
         
         
         
         <?php
		 }
		 ?>
       <?php
	   }
	   }
	   ?>
       
      <div class="clear"></div>
      
      
      
      
      
      <a name="readreviews2"></a>
      <div class="reviewborder"  id="showreviews" style="display:none">
      <div id="readreview">
          <div class="reviewdetaillist">
            <h3>All reviews from customers</h3>
            <?php
			$rvs=0;
			$reviewrs=mysql_query("select * from soe_reviews where fldapprove=1 and fldshoeid=".$_GET['id']." and overall>0 and email<>'' and fldtype='review' order by flddate desc ") or die(mysql_error());
			while($reviewrow=mysql_fetch_array($reviewrs))
			{
			$rvs++;
			?>
            <div class="reviewdetaillistitem">
              <div class="reviewdetail">
                <div class="rdrwdt1">
                  <p><b>Posted :</b></p>
                  <p><b>Reviewer :</b></p>
                </div>
                <div class="rdrwdt2">
                  <p><?php echo $reviewrow['flddate']; ?></p>
                  <p><?php echo $reviewrow['name']; ?> From <?php echo $reviewrow['country']; ?></p>
                </div>
              </div>
              <div class="rdrwratings">
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Overall :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['overall'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>
                    </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Comfort :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['comfort'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                  </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Style :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['style'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                   </div>
                </div>
              </div>
              <div class="rdrwdescrip">
                <p><b>Description :</b><br />
                  <?php echo nl2br($reviewrow['fldcomments']); ?>
                </p>
              </div>
            </div>
            <?php
			}
			if($rvs==0)
				echo '<br /><br /><br /><center><strong>No Reviews Added Yet !</strong></center> <br /><br /><br />';
			?>            
          </div>
        </div>
    </div>
      
      
      
      
      
    </div>
    <div class="hei">&nbsp;</div>
    
    
    
    <div id="storelogos">
          <div style="width:750px; float:left;"><em>Click to view store profiles</em></div>
        
       
             <?php
			 		$x=2;
					  $n=0;
					  $j=1;
				$rs=mysql_query("select * from soe_stores where active='1' and sto_id in (select sto_id from soe_membership where packageid in (select packageid from soe_packages where adspot='1-3')) ORDER BY logo desc, RAND()");
				$tot=mysql_num_rows($rs);
				
				if($tot<=18)
				{
					$perrow=6;
					$tot1=18;
				}
				else
				{
				 	$perrow=ceil($tot/3);
					$tot1=$tot;
				}
					  while($row=mysql_fetch_array($rs) or $n<$tot1)
					  {
					  	
							if($j==1)
								echo 	'<div id="adv"><ul id="carousel'.$x.'" class="mycarousel jcarousel-skin-tango">';	
							$n++;
							if($row['logo']=='')
							{
							 ?>
                          
                           <li class="advimg"><img src="uploads/company_logo/blank.png" border="0" height="36" width="103" /></li>
					<?php
							
							}
							else
							{
								
								insertstats('came',0,$row['sto_id']);
					  ?>
                          
                           <li class="advimg"> <a onclick="window.open('advstorepop.php?id=<?php echo $row['sto_id']; ?>','','status=no,menubar=no,toolbars=no,width=700,height=800,scrollbars=yes');"> <img src="uploads/company_logo/thumb_<?php echo $row['logo']; ?>" border="0" height="36" width="103" /></a></li>
					<?php
					}
						if($j==$perrow)
						{
							echo '</ul></div>';
							$j=1;
							$x++;
						}
						else
							$j++;
							
					}
					?>  
          
          
  <?php
			 		$x=2;
					  $n=0;
					  $j=1;
				$rs=mysql_query("select * from soe_stores where active='1' and sto_id in (select sto_id from soe_membership where packageid in (select packageid from soe_packages where adspot='4')) ORDER BY logo desc, RAND()");
				$tot=mysql_num_rows($rs);
				
				if($tot<6)
				{
					$perrow=6;
					$tot1=6;
				}
				else
				{
				 	$perrow=$tot;
					$tot1=$tot;
				}
					  while($row=mysql_fetch_array($rs) or $n<$tot1)
					  {
					  	
							if($j==1)
								echo 	'<div id="adv"><ul id="carousel'.$x.'" class="mycarousel jcarousel-skin-tango">';	
							$n++;
							if($row['logo']=='')
							{
							 ?>
                          
                           <li class="advimg"><img src="uploads/company_logo/blank.png" border="0" height="36" width="103" /></li>
					<?php
							
							}
							else
							{
								
								insertstats('came',0,$row['sto_id']);
					  ?>
                          
                           <li class="advimg"> <a onclick="window.open('advstorepop.php?id=<?php echo $row['sto_id']; ?>','','status=no,menubar=no,toolbars=no,width=700,height=800,scrollbars=yes');"> <img src="uploads/company_logo/thumb_<?php echo $row['logo']; ?>" border="0" height="36" width="103" /></a></li>
					<?php
					}
						if($j==$perrow)
						{
							echo '</ul></div>';
							$j=1;
							$x++;
						}
						else
							$j++;
							
					}
					?>  
             



  <?php
			 		$x=2;
					  $n=0;
					  $j=1;
				$rs=mysql_query("select * from soe_stores where active='1' and sto_id in (select sto_id from soe_membership where packageid in (select packageid from soe_packages where adspot='0')) ORDER BY logo desc, RAND()");
				$tot=mysql_num_rows($rs);
				
				if($tot<=18)
				{
					$perrow=6;
					$tot1=18;
				}
				else
				{
				 	$perrow=ceil($tot/3);
					$tot1=$tot;
				}
					  while($row=mysql_fetch_array($rs) or $n<$tot1)
					  {
					  	
							if($j==1)
								echo 	'<div id="adv"><ul id="carousel'.$x.'" class="mycarousel jcarousel-skin-tango">';	
							$n++;
							if($row['logo']=='')
							{
							 ?>
                          
                           <li class="advimg"><img src="uploads/company_logo/blank.png" border="0" height="36" width="103" /></li>
					<?php
							
							}
							else
							{
								
								insertstats('came',0,$row['sto_id']);
					  ?>
                          
                           <li class="advimg"> <a onclick="window.open('advstorepop.php?id=<?php echo $row['sto_id']; ?>','','status=no,menubar=no,toolbars=no,width=700,height=800,scrollbars=yes');"> <img src="uploads/company_logo/thumb_<?php echo $row['logo']; ?>" border="0" height="36" width="103" /></a></li>
					<?php
					}
						if($j==$perrow)
						{
							echo '</ul></div>';
							$j=1;
							$x++;
						}
						else
							$j++;
							
					}
					?>  

		   


        </div>
    
  </div>
  
  
  
  
  
  <?php ///////////////////////////////////////// FORM SEND FEEDBACK //////////////////////////////////////////// ?>                 
       
        
        <div style='display:none'>
          <div id='inline_example4' style='padding:10px; background:#fff;'>
          <form action="feedback.php" method="post" name="fdbackfrm" id="fdbackfrm"><div class="signin">
          <input type="hidden" name="soe_id" value="<?php echo $_GET['id']; ?>" />
          <input type="hidden" name="sto_id" value="<?php echo $sto_id; ?>" />
                      <div >
                        <h3>Send Feedback</h3>
                      </div>
                      <div > 
                        <div > <br />
                          <p class="input">Name :<br />
                            <input type="text"  name="name"  class="txt_box1"  id="name"   />
                          </p>
                          <br />
                          <p class="input">Comments :<br />
                          <textarea cols="30" rows="3" name="comments" id="comments" class="txt_box1" ></textarea>
                            
                          </p>
                        </div>
                         <div style="float:left;">
              <div id="popupsubmit">
                <div class="submitbtn">  <a id="feedbacksubmit"><img src="images/send.jpg" alt="" border="0"></a></div>
                 <div class="submitbtn"> <a onclick="javascript: document.fdbackfrm.reset();"><img src="images/clear_buton.jpg" alt="" border="0"></a></div>
                        </div></div>
                      </div>
                    </div></form>
          </div>
        </div>
        
    <?php ///////////////////////////////////////// FORM READING A REVIEW //////////////////////////////////////////// ?>                 
     
        <div style='display:none' id="readreview1">
          <div id='inline_example3' style='padding:10px; background:#fff;'>
          <div id="readreview">
          <div class="reviewdetaillist">
            <h3>Latest 3 reviews from customers</h3>
            <?php
			$rvs=0;
			$reviewrs=mysql_query("select * from soe_reviews where fldapprove=1 and fldshoeid=".$_GET['id']." and overall>0 and email<>'' and fldtype='review' order by flddate desc limit 0,3") or die(mysql_error());
			while($reviewrow=mysql_fetch_array($reviewrs))
			{
			$rvs++;
			?>
            <div class="reviewdetaillistitem">
              <div class="reviewdetail">
                <div class="rdrwdt1">
                  <p><b>Posted :</b></p>
                  <p><b>Reviewer :</b></p>
                </div>
                <div class="rdrwdt2">
                  <p><?php echo $reviewrow['flddate']; ?></p>
                  <p><?php echo $reviewrow['name']; ?> From <?php echo $reviewrow['country']; ?></p>
                </div>
              </div>
              <div class="rdrwratings">
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Overall :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['overall'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>
                    </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Comfort :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['comfort'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                  </div>
                </div>
                <div class="rating1">
                  <div class="rdrwrl">
                    <p><b>Style :</b></p>
                  </div>
                  <div class="rdrwrr">
                  <?php
				  for($i=1;$i<=$reviewrow['style'];$i++)
				    echo '<img src="images/staryellow.jpg" alt="" border="0" />';
				  ?>

                   </div>
                </div>
              </div>
              <div class="rdrwdescrip">
                <p><b>Description :</b><br />
                  <?php echo nl2br($reviewrow['fldcomments']); ?>
                </p>
              </div>
            </div>
            <?php
			}

			if($rvs==0)
				echo '<br /><br /><br /><center><strong>No Reviews Added Yet !</strong></center> <br /><br /><br />';
			else
			{
			?>
            <a href="#readreviews2" onclick="javascript: document.getElementById('storelogos').style.display='none';$.fn.colorbox.close();document.getElementById('showreviews').style.display='block';">Read More Reviews</a>
            <?php
			}
			?>            
          </div>
        </div>
          </div>
        </div>
        
                  
                  
                  
 <?php ///////////////////////////////////////// FORM WRITING A REVIEW //////////////////////////////////////////// ?>                 
                  
                  
        <div style='display:none'>
          <div id='inline_example2' style='padding:10px; background:#fff;'>
          <div id="writereview">
          <form action="" method="post" name="reviewfrm" id="reviewfrm">
          <input type="hidden" name="soe_id" value="<?php echo $_GET['id']; ?>" />
          <div class="writedetail">
            <h3>Write Review</h3>
            <div class="writereviewform">
              <div class="writereviewformlr">
                <p> <b>Name:</b><br />
                  <input type="text" style="width:250px;" name="yourname" class="txt_box1"  />
                </p>
                <p> <b>Country:</b><br />
                  <select id="country" name="country" style="width:90px" class="txt_box1" >
                <?php
						   $rs=mysql_query("select * from soe_geo_countries order by name");
						   while($row=mysql_fetch_array($rs))
						   {						   		
						   ?>
                <option value="<?php echo $row['name']; ?>" <?php echo $c; ?> ><?php echo $row['name']; ?></option>
                <?php
							}
							?>
              </select>
                </p>
                <p> <b>Email:</b><br />
                  <input type="text" style="width:250px;" name="email" class="txt_box1"  />
                </p>
              </div>
              <div class="writereviewformlr">
                <p> <b>Overall:</b><br />
                  <select name="overall" style="width:250px" class="txt_box1" >
                    <option value="1"> 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5" selected="selected"> 5</option>
                  </select>
                </p>
                <p> <b>Comfort:</b><br />
                  <select name="comfort" style="width:250px" class="txt_box1" >
                    <option value="1"> 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5" selected="selected"> 5</option>
                  </select>
                </p>
                <p> <b>Style:</b><br />
                  <select name="style" style="width:250px" class="txt_box1" >
                    <option value="1"> 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5" selected="selected"> 5</option>
                  </select>
                </p>
              </div>
              <div class="wrrvdes">
                <p> <b>Description:</b><br />
                  <textarea cols="72" rows="3" name="description" class="txt_box1" ></textarea>
                </p>
              </div>
              <div class="wrrwsubmit">
                <p class="rdrwsub"><a id="reviewsubmit"><img src="images/blue_submit_button.jpg" alt="" border="0"></a> &nbsp; &nbsp;&nbsp;&nbsp;<a onclick="javascript: document.reviewfrm.reset();"><img src="images/clear_buton.jpg" alt="" border="0"></a></p>
              </div>
            </div>

          </div></form>
        </div>
          </div>
        </div>
              
              
          <?php ///////////////////////////////////////// TELL A FRIEND //////////////////////////////////////////// ?>                 
                  
                  
        <div style='display:none'>
          <div id='inline_example22' style='padding:10px; background:#fff;'>
       
                <form id="tellfrm" method="post" action="tell_a_friend.php" name="tellfrm" >
		<table border="0" cellpadding="5" cellspacing="0">
			   

			   <tr>
				   <td colspan="2" style="border-bottom:1px solid black;">

					  <font size="+2"><b>Tell A Friend</b></font>				   </td>
		       </tr>
				

				<tr>
				   <td width="180">
					   <?php
							global $errors;
							if(count($errors) != 0){
								print_error($errors);
							}
						?>				   </td>
			       <td width="414" colspan="-1">&nbsp;</td>
			   </tr>


			   <tr>
				   <td align="left" valign="middle">
						
						<b>Your Name:*</b>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			       <td colspan="-1" align="left" valign="middle"><input type="text" name="your_name" id="name" size="20" maxlength="25" value="<?php echo $_POST["your_name"]?>" class="txt_box1"></td>
			   </tr>
				
				<tr>
				  <td align="left" valign="middle"><b>Your Email:*
			      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
		          <td colspan="-1" align="left" valign="middle"><b>
		            <input type="text" name="your_email" id="email" size="31" maxlength="80" value="<?php echo $_POST["your_email"]?>" class="txt_box1">
		          </b></td>
		  </tr>
				<tr>
				   <td align="left" valign="middle">
						<b>Friend's Email:</b>*					    </td>
			       <td colspan="-1" align="left" valign="middle"><input type="text" name="friend_email1" id="friend_email1" size="36" maxlength="80" value="<?php echo $_POST["friend_email1"]?>" class="txt_box1"></td>
			   </tr>

			   <tr>
			     <td align="left" valign="middle">						
				   <b>Friend's Email:</b>
				   &nbsp;<br/></td>
				 <td colspan="-1" align="left" valign="middle"><input type="text" name="friend_email2" id="friend_email2" size="36" maxlength="80" value="<?php echo $_POST["friend_email2"]?>" class="txt_box1"></td>
			   </tr>
				
				<tr>
				   <td align="left" valign="middle">						
						<b>Friend's Email:</b>&nbsp;&nbsp;<br/></td>
				   <td colspan="-1" align="left" valign="middle"><input type="text" name="friend_email3" id="friend_email3" size="36" maxlength="80" value="<?php echo $_POST["friend_email3"]?>" class="txt_box1"></td>
				</tr>

			    <tr>
			      <td align="left" valign="middle"><b>Message:*</b> <br>
		          <i>(min 10 and max 250<br> 
		          characters allowed)</i></td>
			      <td colspan="-1" align="left" valign="middle"><textarea name="message" id="message" cols="42" rows="5" class="txt_box1"><?php echo $_POST["message"]?></textarea></td>
	      </tr>
		       
			   <tr>
				   <td colspan="2" align="center" valign="middle">
						<i>(* required fields)</i> <a id="tell"><img src="images/blue_submit_button.jpg" align="bottom" /></a>				   </td>
		       </tr>
		</table>
		</form>
             </div>
             </div>  
             
  
  

  
  
  
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
  <!-- Footer Area Start -->
  <script>
  function showbadge()
  {
  	obj=document.getElementById('sampleshoe');
	if(obj.style.display=='none')
		obj.style.display='block';
	else
		obj.style.display='none';
  }

</script>

<?php include("footer.php"); ?>