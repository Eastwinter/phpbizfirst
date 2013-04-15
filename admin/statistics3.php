<?php include("top.php");
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if($_POST['button2']!='')
	{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");


			$period='t';
	}
	else
	{
		$d1=$_POST['from'];
		$d2=$_POST['to'];
		$period=$_POST['period'];
	}
}
else
{
						$d1=date('m/d/Y');
			$d2=date("m/d/Y");

			$period='t';
}
?>
	<link rel="stylesheet" href="../js/themes/base/jquery.ui.all.css">
	<script src="../js/ui/jquery.ui.core.js"></script>
	<script src="../js/ui/jquery.ui.widget.js"></script>
	<script src="../js/ui/jquery.ui.datepicker.js"></script>

	<script>

var curdate='<?php echo date('m/d/Y'); ?>';
var selperiod='<?php echo $period; ?>';
	</script>
    <script src="setdate.js"></script>
		


<div class="body" id="mk_height">
	  <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
          <td class="header">Shoe Ratings
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="button3" id="button3" value="          EXPORT TO EXCEL          " onclick="javascript: location.href='exporttoexcel.php?stat=3&d1=<?php echo $d1; ?>&d2=<?php echo $d2; ?>&period=<?php echo $period; ?>';" /></td>
        </tr>
        <tr>
          <td><div id="advertiseraccountpage">
            <div class="advertiseraccount">
<form action="" method="post" name="datefrm" id="datefrm">
  <br />
  <label for="from">From</label>
  <input name="from" type="text" id="from" value="<?php echo $d1; ?>" size="20"/>
  <label for="to">To</label>
  <input name="to" type="text" id="to" value="<?php echo $d2; ?>" size="20"/>
  &nbsp;&nbsp;&nbsp;
  <select name="period" id="period">
    <option value="t" selected="selected">Total</option>
  </select>
  <input type="submit" name="button" id="button" value="Submit" />
  <input type="submit" name="button2" id="button2" value="Reset" />
  <p>&nbsp;</p>
</form>
<div style="float:left; width:100%;">
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
							echo '<img src="../images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
							echo '<img src="../images/stargrey.jpg" alt="" border="0" />';	
						}
							
					?></td>
                    <td><?php
                    if($row['c']>0)
						{
						for($i=1;$i<=round($row['c']);$i++)
							echo '<img src="../images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
							echo '<img src="../images/stargrey.jpg" alt="" border="0" />';	
						}
							
					?></td>
                    <td><?php
                    if($row['s']>0)
						{
						for($i=1;$i<=round($row['s']);$i++)
							echo '<img src="../images/staryellow.jpg" alt="" border="0" />';						
						}
						else
						{
							for($i=1;$i<=5;$i++)
							echo '<img src="../images/stargrey.jpg" alt="" border="0" />';	
						}
							
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
              <p>&nbsp;</p>
              </div>
            </div>
          </div></td>
        </tr>
      </table>
	</div>

	
	<?php include("bottom.php"); ?>