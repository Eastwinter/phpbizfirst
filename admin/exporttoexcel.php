<?php include("../connect.php");
		$d1=$_GET['d1'];
		$d2=$_GET['d2'];
		$period=$_GET['period'];
		$stat=$_GET['stat'];
		$age=$_GET['age'];
		ob_start();
?>

<?php
if($stat==1)
{
?>
<table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="29%">ID#</td>
                    <td width="29%">Shoe Name</td>
                    <td width="29%">Location</td>
                    <td width="6%">Total Visits</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond."  and type='clicks' group by soe_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='d')
			  $s="select soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond."  and type='clicks' group by year(date),month(date),day(date),soe_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='clicks'  group by year(date),week(date),soe_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='clicks'  group by year(date),month(date),soe_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='y')
			  $s="select year(date) y,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='clicks'  group by year(date),soe_id,country,state,city order by cnt desc,date desc,soe_id";  	


			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_shoe where soe_id=".$row['soe_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['name'];

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['soe_id']; ?></td>
                    <td><?php echo $nm; ?></td>
                    <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
</table>             
<?php
}
?>                
 
 
 
 <?php
if($stat==9)
{
?>
 <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
   <tr class="tableheader1">
     <td width="31%">Date</td>
     <td width="34%">Store Name</td>
     <td width="27%">Location</td>
     <td width="8%">Total Visits</td>
   </tr>
   <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='clicks' group by sto_id,country,state,city order by cnt desc";  	

		  if($period=='d')
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='clicks' group by year(date),month(date),day(date),sto_id,country,state,city order by cnt desc";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='clicks'  group by year(date),week(date),sto_id,country,state,city order by cnt desc";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='clicks'  group by year(date),month(date),sto_id,country,state,city order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='clicks'  group by year(date),sto_id,country,state,city order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['sto_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['store_name'];

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
   <tr class="tbl_text">
     <td><?php echo $dt; ?></td>
     <td><?php echo $nm; ?></td>
     <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
     <td><?php echo $row['cnt']; ?></td>
   </tr>
   <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
 </table>
<?php
}
?>                

 
 
 <?php
if($stat==2)
{
?>
  <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
    <tr class="tableheader1">
      <td width="16%">Date</td>
      <td width="39%">Search Attributes</td>
      <td width="32%">Location</td>
      <td width="13%">Count</td>
    </tr>
    <?php
				  
			$ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";

		  if($period=='t')
			  $s="select attributes,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='search' group by attributes,country,state,city order by cnt desc,date desc,attributes";  	

		  if($period=='d')
			  $s="select attributes,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond."  and type='search' group by year(date),month(date),day(date),attributes,country,state,city order by cnt desc,date desc,attributes";  	

		  if($period=='w')
			  $s="select attributes,week(date) as w,year(date) as y,attributes,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='search'  group by year(date),week(date),attributes,country,state,city order by cnt desc,date desc,attributes";  	

		  if($period=='m')
			  $s="select attributes,year(date) as y,month(date) as m,attributes,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='search'  group by year(date),month(date),attributes,country,state,city order by cnt desc,date desc,attributes";  	

		  if($period=='y')
			  $s="select year(date) y,attributes,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='search'  group by year(date),attributes,country,state,city order by cnt desc,date desc,attributes";  	

			$array['shc_id']='Shoe Category';
			$array['fot_id']='Footwear';
			$array['brn_id']='Brand';
			$array['color1']='Color';
			$array['mtr_id']='Material';
			$array['hlh_id']='Heel Height';
			$array['hls_id']='Heel Size';
			$array['clo_id']='Closure';
			$array['shoe_lace']='Shoe Lace';
			$array['sht_id']='Shoe Type';
			$array['shw_id']='Shoe Width';
			$array['sea_id']='Season';
			$array['con_id']='Country';
			$array['store_name']='Store Name';
			$array['sta_id']='State';
			$array['cty_id']='City';
			$array['price']='Price';
			$array['zip_code']='ZipCode';
			$array['shoe_lace']='Shoe Lace';

			
			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

				if($row['attributes']=='')
					$attr='No Attribute Selected For Search';
				else
				{
					if(strpos($row['attributes'],",")>0)
						$a=explode(",",$row['attributes']);
					else
						$a[0]=$row['attributes'];
					
					$attr='';
					for($i=0;$i<count($a);$i++)
						if($attr=='')
							$attr=$array[$a[$i]];
						else
							$attr.=', '.$array[$a[$i]];
				}	
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
    <tr class="tbl_text">
      <td><?php echo $dt; ?></td>
      <td><?php echo $attr; ?></td>
      <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
      <td><?php echo $row['cnt']; ?></td>
    </tr>
    <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
  </table>
<?php
}
?>                


 
   <?php
if($stat==3)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
     <tr class="tableheader1">
       <td width="27%">Date</td>
       <td width="19%">Shoe Name</td>
       <td width="15%">Location</td>
       <td width="17%">Overall</td>
       <td width="12%">Comfort </td>
       <td width="10%">Style</td>
     </tr>
     <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and flddate>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and flddate<='".($ds)."'";


		  if($period=='t')
			  $s="select fldshoeid,avg(overall) as ov,avg(comfort) as c,avg(style) as s,flddate,country from soe_reviews where fldshoeid>0 ".$cond."  and fldtype='review' group by fldshoeid,country order by ov desc,c desc,s desc,flddate desc";  	

		  if($period=='d')
			  $s="select fldshoeid,avg(overall) as ov,avg(comfort) as c,avg(style) as s,flddate,country from soe_reviews where fldshoeid>0 ".$cond."  and fldtype='review' group by year(flddate),month(flddate),day(flddate),fldshoeid,flddate order by ov desc,c desc,s desc,flddate desc";  	

		  if($period=='w')
			  $s="select week(flddate) as w,year(flddate) as y,fldshoeid,avg(overall) as ov,avg(comfort) as c,avg(style) as s,flddate,country from soe_reviews where fldshoeid>0 ".$cond." and fldtype='review'  group by year(flddate),week(flddate),fldshoeid,flddate order by ov desc,c desc,s desc,flddate desc";  

		  if($period=='m')
			  $s="select year(flddate) as y,month(flddate) as m,fldshoeid,avg(overall) as ov,avg(comfort) as c,avg(style) as s,flddate,country from soe_reviews where fldshoeid>0 ".$cond." and fldtype='review'  group by year(flddate),month(flddate),fldshoeid,flddate order by ov desc,c desc,s desc,flddate desc";   	

		  if($period=='y')
			  $s="select year(flddate) y,fldshoeid,avg(overall) as ov,avg(comfort) as c,avg(style) as s,flddate,country from soe_reviews where fldshoeid>0 ".$cond." and fldtype='review'  group by year(flddate),fldshoeid,flddate order by ov desc,c desc,s desc,flddate desc";  	

			//echo $s;

		 		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_shoe where soe_id=".$row['fldshoeid']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['name'];

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['flddate']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}
			
		  ?>
     <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $nm; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php
                    if($row['ov']>0)
						{
						for($i=1;$i<=round($row['ov']);$i++)
							echo '*';						
						}
						else
							echo ' ';
							
					?></td>
                    <td><?php
                    if($row['c']>0)
						{
						for($i=1;$i<=round($row['c']);$i++)
							echo '*';							
						}
						else
							echo ' ';
							
					?></td>
                    <td><?php
                    if($row['s']>0)
						{
						for($i=1;$i<=round($row['s']);$i++)
							echo '*';							
						}
						else
							echo ' ';
							
					?></td>
                  </tr>
     <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
   </table>
<?php
}
?>                

 
 
    <?php
if($stat==4)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="29%">Location</td>
                    <td width="6%">Total Visits</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond."  and type='visit' group by country,state,city order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond."  and type='visit' group by year(date),month(date),day(date),country,state,city order by cnt desc";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='visit'  group by year(date),week(date),country,state,city order by cnt desc";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='visit'  group by year(date),month(date),country,state,city order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,count(*) as cnt,date,city,state,country from soe_statistics where 1=1 ".$cond." and type='visit'  group by year(date),country,state,city order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
   <?php
}
?>                

    <?php
if($stat==5)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="31%">Date</td>
                    <td width="23%">Category</td>
                    <td width="31%">Location</td>
                    <td width="15%">Total Search</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,date,city,state,country,attributes from soe_statistics where 1=1 ".$cond."  and type='category' group by attributes,country,state,city order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,date,city,state,country,attributes from soe_statistics where 1=1 ".$cond."  and type='category' group by year(date),month(date),day(date),attributes,country,state,city order by cnt desc";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,count(*) as cnt,date,city,state,country,attributes from soe_statistics where 1=1 ".$cond." and type='category'  group by year(date),week(date),attributes,country,state,city order by cnt desc";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,count(*) as cnt,date,city,state,country,attributes from soe_statistics where 1=1 ".$cond." and type='category'  group by year(date),month(date),attributes,country,state,city order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,count(*) as cnt,date,city,state,country,attributes from soe_statistics where 1=1 ".$cond." and type='visit'  group by year(date),attributes,country,state,city order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['attributes']; ?></td>
                    <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
<?php
}
?>                

    <?php
if($stat==6)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="18%">Date</td>
                    <td width="15%">Count</td>
                  </tr>
                  <?php
				  
		  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='adv' order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='adv' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)),day(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(joined)) as w,year(FROM_UNIXTIME(joined)) as y,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv' group by year(FROM_UNIXTIME(joined)),week(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(joined)) as y,month(FROM_UNIXTIME(joined)) as m,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(joined)) y,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='adv'  group by year(FROM_UNIXTIME(joined)) order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('d/m/Y',$row['joined']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              
              <table width="95%" border="1" cellpadding="0" cellspacing="1" align="center">
              
              <tr class="tableheader1">
                    <td width="8%">ID</td>
                    <td width="26%">Name</td>
                    <td width="20%">Email</td>
                    <td width="14%">Status</td>
                    <td width="14%">Joined On</td>
                  </tr>
                  <?php

		  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";
					$i=0;				
			$rs=mysql_query("select * from soe_members where member_type='adv'".$cond) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
				?>
                  <tr class="tbl_text">
                    <td><?php echo $mem_id; ?></td>
                    <td><?php echo $first_name." ".$last_name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $a; ?></td>
                    <td><?php echo date('F d, Y',$joined); ?></td>
                  </tr>
                  <?php
				}
				if($i==0)
				 {
				 	echo '<tr><td colspan=5><strong>No Results!</strong></td></tr>';
				 }
				?>
               
</table>
<?php
}
?>                

    <?php
if($stat==7)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="18%">Date</td>
                    <td width="15%">Count</td>
                  </tr>
                  <?php
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";

		if($age=='under20')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) <= 20";

		if($age=='21-30')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) BETWEEN 21 AND 30";

		if($age=='31-40')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) BETWEEN 31 AND 40";
		
		if($age=='above40')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) > 40";
			
		  if($period=='t')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='mem' order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,joined from soe_members where 1=1 ".$cond."  and member_type='mem' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)),day(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(joined)) as w,year(FROM_UNIXTIME(joined)) as y,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='mem' group by year(FROM_UNIXTIME(joined)),week(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(joined)) as y,month(FROM_UNIXTIME(joined)) as m,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='mem' group by year(FROM_UNIXTIME(joined)),month(FROM_UNIXTIME(joined)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(joined)) y,count(*) as cnt,count(*) as cnt,joined from soe_members where 1=1 ".$cond." and member_type='mem'  group by year(FROM_UNIXTIME(joined)) order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('d/m/Y',$row['joined']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              
              <table width="95%" border="1" cellpadding="0" cellspacing="1" align="center">
               
              <tr class="tableheader1">
                    <td width="8%">ID</td>
                    <td width="26%">Name</td>
                    <td width="20%">Email</td>
                    <td width="14%">AGE</td>
                    <td width="14%">Status</td>
                    <td width="14%">Joined On</td>
                  </tr>
                  <?php

		  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and joined>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and joined<='".strtotime($ds)."'";
				
				
			if($age=='under20')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) <= 20";

		if($age=='21-30')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) BETWEEN 21 AND 30";

		if($age=='31-40')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) BETWEEN 31 AND 40";
		
		if($age=='above40')
			$cond.=" and FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) )) / 365.25) > 40";

									$i=0;
						$s="SELECT *, FLOOR((TO_DAYS( NOW( ) ) - TO_DAYS( STR_TO_DATE( dateofbirth, '%m/%d/%Y' ) ) ) / 365.25) AS age FROM soe_members WHERE member_type = 'mem' ".$cond;
						//echo $s;
			$rs=mysql_query($s) or die(mysql_error());
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($banned==1 and $first_name!='' and $last_name!='')
						$a='banned';
					elseif($banned==1 and $first_name=='' and $last_name=='')
						$a='inactive';
					else
						$a='active';
				?>
                  <tr class="tbl_text">
                    <td><?php echo $mem_id; ?></td>
                    <td><?php echo $first_name." ".$last_name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $age; ?></td>
                    <td><?php echo $a; ?></td>
                    <td><?php echo date('F d, Y',$joined); ?></td>
                  </tr>
                  <?php
				}
				
				if($i==0)
				 {
				 	echo '<tr><td colspan=5><strong>No Results!</strong></td></tr>';
				 }
				?>
               
</table>
<?php
}
?>                

    <?php
if($stat==8)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="27%">Date</td>
                    <td width="16%">User Type</td>
                    <td width="23%">Email</td>
                    <td width="27%">Location</td>
                    <td width="7%">Total Logins</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond."  and type='login' group by soe_id,country,state,city order by cnt desc";  	

		  if($period=='d')
			  $s="select soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond."  and type='login' group by year(date),month(date),day(date),soe_id,country,state,city order by cnt desc";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='login'  group by year(date),week(date),soe_id,country,state,city order by cnt desc";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='login'  group by year(date),month(date),soe_id,country,state,city order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,soe_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='login'  group by year(date),soe_id,country,state,city order by cnt desc";  	

			//echo $s;

		 // $s="select  soe_id,count(*) as cnt from soe_statistics where soe_id>0 ".$cond." group by soe_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_members where mem_id=".$row['soe_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['first_name']." ".$stsrow['last_name'];

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $stsrow['member_type']; ?></td>
                    <td><?php echo $stsrow['email']; ?></td>
                    <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
<?php
}
?>                

    <?php
if($stat==10)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="6%">Total #</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";


		 if($period=='t')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='mem') order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='mem') group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)),day(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(added)) as w,year(FROM_UNIXTIME(added)) as y,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='mem')  group by year(FROM_UNIXTIME(added)),week(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(added)) as y,month(FROM_UNIXTIME(added)) as m,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='mem')  group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(added)) y,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='mem')  group by year(FROM_UNIXTIME(added)) order by cnt desc";   		

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y h:i:s',$row['added']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              <table width="95%" border="1" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By (Email)</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";
					
		$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='mem') ".$cond;
		$rs=mysql_query($sql) or die(mysql_error());	
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
					
					if($featured=='1')
						$b='Yes';
					else
						$b='No';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
					if($row1['member_type']=='adm')
						$nm='Administrator';
					if($row1['member_type']=='adv')	
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	

					if($row1['member_type']=='mem')	
						$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $row1['email']; ?></td>
					  <td><?php echo date('F d, Y',$added); ?></td>
					  <td><?php echo $a; ?></td>
				    </tr>
                <?php
				}
				 if($i==0)
				 {
				 	echo '<tr><td colspan=8><strong>No Results!</strong></td></tr>';
				 }
				?>
								
			</form>
		</table>
<?php
}
?>                

    <?php
if($stat==11)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="6%">Total #</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";


		  if($period=='t')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='adv') order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and mem_id in (select mem_id from soe_members where member_type='adv') group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)),day(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(FROM_UNIXTIME(added)) as w,year(FROM_UNIXTIME(added)) as y,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)),week(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(FROM_UNIXTIME(added)) as y,month(FROM_UNIXTIME(added)) as m,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)),month(FROM_UNIXTIME(added)) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(FROM_UNIXTIME(added)) y,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and mem_id in (select mem_id from soe_members where member_type='adv')  group by year(FROM_UNIXTIME(added)) order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y h:i:s',$row['added']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              <table width="95%" border="1" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By (Email)</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";
					
		$sql="select * from soe_shoe where mem_id in (select mem_id from soe_members where member_type='adv') ".$cond;
		$rs=mysql_query($sql) or die(mysql_error());	
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
					
					if($featured=='1')
						$b='Yes';
					else
						$b='No';
						$rs1=mysql_query("select * from soe_members where mem_id=".$mem_id) or die(mysql_error());
						$row1=mysql_fetch_array($rs1);
					if($row1['member_type']=='adm')
						$nm='Administrator';
					if($row1['member_type']=='adv')	
						$nm='<a href="addadv.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	

					if($row1['member_type']=='mem')	
						$nm='<a href="addmem.php?id='.$row1['mem_id'].'" >'.$row1['first_name']." ".$row1['last_name'].'</a>';	
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $row1['email']; ?></td>
					  <td><?php echo date('F d, Y',$added); ?></td>
					  <td><?php echo $a; ?></td>
				    </tr>
                <?php
				}
				 if($i==0)
				 {
				 	echo '<tr><td colspan=8><strong>No Results!</strong></td></tr>';
				 }
				?>
								
			</form>
		</table>
<?php
}
?>                

    <?php
if($stat==12)
{
?>
   <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="6%">Total #</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";


		    if($period=='t')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and email!='' order by cnt desc";  	

		  if($period=='d')
			  $s="select count(*) as cnt,added from soe_shoe where 1=1 ".$cond."  and email!='' group by year(added),month(added),day(added) order by cnt desc";  	

		  if($period=='w')
			  $s="select week(added) as w,year(added) as y,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and email!=''  group by year(added),week(added) order by cnt desc";  	

		  if($period=='m')
			  $s="select year(added) as y,month(added) as m,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and email!=''  group by year(added),month(added) order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,sto_id,count(*) as cnt,added from soe_shoe where 1=1 ".$cond." and email!=''  group by year(added) order by cnt desc";   	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y h:i:s',$row['added']);
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
              <p>&nbsp;</p>
              <table width="95%" border="1" cellpadding="0" cellspacing="1" align="center">
<form name="site_banners" method="post" action="">

				<input type="hidden" name="page" value="1" />
                <input type="hidden" name="memtype" value="<?php echo $memtype; ?>" />
				
				<tr class="tableheader1">
				  <td width="2%">ID</td>
				  <td width="23%">Name</td>
				  <td width="7%">Price</td>
				  <td width="20%">Added By (Email)</td>
				  <td width="12%">Added On</td>
				  <td width="11%">Status</td>
				  </tr>
                <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and added>='".strtotime($d1)."'";

		  	if($d2!='')
				$cond.=" and added<='".strtotime($ds)."'";
					
		$sql="select * from soe_shoe where email!='' ".$cond;
		$rs=mysql_query($sql) or die(mysql_error());	
				$i=0;
				while($row=mysql_fetch_array($rs))
				{
					$i++;
					extract($row);
					if($active=='1')
						$a='active';
					else
						$a='inactive';
					
					if($featured=='1')
						$b='Yes';
					else
						$b='No';
						$nm=$email;
						
				?>
					<tr class="tbl_text">
					  <td><?php echo $soe_id; ?></td>
					  <td><?php echo $name; ?></td>
					  <td><?php echo $price; ?></td>
					  <td><?php echo $email; ?></td>
					  <td><?php echo date('F d, Y',$added); ?></td>
					  <td><?php echo $a; ?></td>
				    </tr>
                <?php
				}
				 if($i==0)
				 {
				 	echo '<tr><td colspan=8><strong>No Results!</strong></td></tr>';
				 }
				?>
								
			</form>
		</table>
<?php
}
?>                

<?php
 if($stat==13)
 {
 ?>
 <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="29%">Date</td>
                    <td width="29%">Location</td>
                    <td width="29%">Store Name</td>
                    <td width="6%">Total Visits</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";


		  if($period=='t')
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='came' group by sto_id order by cnt desc";  	

		  if($period=='d')
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='came' group by year(date),month(date),day(date),sto_id order by cnt desc";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='came'  group by year(date),week(date),sto_id order by cnt desc";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='came'  group by year(date),month(date),sto_id order by cnt desc";  	

		  if($period=='y')
			  $s="select year(date) y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='came'  group by year(date),sto_id order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['sto_id']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['store_name'];

					
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row['city'].", ".$row['state'].", ".$row['country']; ?></td>
                    <td><?php echo $nm; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=2><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
 <?php
 }
 ?>
 
 
 
 <?php
 if($stat==14)
 {
 ?>
 <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="9%">Date</td>
                    <td width="29%">Advertiser</td>
                    <td width="29%">Store Name</td>
                    <td width="6%">Total Number Of Orders</td>
                    <td width="6%">Total Amount</td>
                  </tr>
                  <?php
				  
				  $ds = date('Y-m-d',strtotime(date("Y-m-d", strtotime($d2)) . " +1 day"));
			$cond='';
		  	if($d1!='')
				$cond.=" and date>='".date('Y-m-d',strtotime($d1))."'";

		  	if($d2!='')
				$cond.=" and date<='".($ds)."'";

			$cond.=" and paid='paid'";
			
		  if($period=='t')
			  $s="select ocn,stoid,count(distinct ocn) as cnt,date,sum(price*qty) as total from cart where stoid>0 ".$cond."  group by stoid,ocn order by cnt desc";  	

		  if($period=='d')
			  $s="select ocn,stoid,count(distinct ocn) as cnt,date,sum(price*qty) as total from cart where stoid>0 ".$cond."  group by year(date),month(date),day(date),stoid,ocn order by cnt desc";  	

		  if($period=='w')
			  $s="select ocn,week(date) as w,year(date) as y,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond." group by year(date),week(date),stoid,ocn order by cnt desc";  	

		  if($period=='m')
			  $s="select ocn,year(date) as y,month(date) as m,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond."   group by year(date),month(date),stoid,ocn order by cnt desc";  	

		  if($period=='y')
			  $s="select ocn,year(date) y,stoid,count(distinct ocn) as cnt,date,city,state,country,sum(price*qty) as total from cart where stoid>0 ".$cond." group by year(date),stoid,ocn order by cnt desc";  	

			//echo $s;

		 // $s="select  sto_id,count(*) as cnt from soe_statistics where sto_id>0 ".$cond." group by sto_id order by cnt desc";  		
		  $rs=mysql_query($s) or die(mysql_error().'<br />'.$s);
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['stoid']."") or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['store_name'];

					
			$rs1=mysql_query("select * from soe_members where mem_id=".$stsrow['mem_id']) or die(mysql_error());
			$row1=mysql_fetch_array($rs1);
			
				if($period=="w")
				{
					$arr=week_limits($row['w'],$row['y'],"m/d/Y");
					$dt=$arr[0]. " <strong>to</strong> ".$arr[1];
				}

				if($period=="m")
				{
					$dt=$row['m']. "/".$row['y'];
				}

				if($period=="y")
				{
					$dt=$row['y'];
				}

				if($period=="d")
				{
					$dt=date('m/d/Y',strtotime($row['date']));
				}
				
				if($period=="t")
				{
					$dt=$d1." <strong>to</strong> ".$d2;
				}

			
		  ?>
                  <tr class="tbl_text">
                    <td><?php echo $dt; ?></td>
                    <td><?php echo $row1['first_name']." ".$row1['last_name']; ?></td>
                    <td><?php echo $nm; ?></td>
                    <td><?php echo $row['cnt']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                  </tr>
                  <?php
				 }
				 
				 if($i==0)
				 {
				 	echo '<tr><td colspan=5><strong>No Results!</strong></td></tr>';
				 }
				 ?>
                </table>
 <?php
 }
 ?>
 
 
<?php
$filename='statistics.xls';
header('Content-type: application/excel');
header('Content-Disposition: attachment; filename="'.$filename.'"');
?>                