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
          <td class="header">Shoe Visits
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="button3" id="button3" value="          EXPORT TO EXCEL          " onclick="javascript: location.href='exporttoexcel.php?stat=1&d1=<?php echo $d1; ?>&d2=<?php echo $d2; ?>&period=<?php echo $period; ?>';" /></td>
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
  <input type="submit" name="button2" id="button2" value="Reset" />&nbsp;&nbsp;&nbsp;&nbsp;
  <p>&nbsp;</p>
</form>
<div style="float:left; width:100%;">
<table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                  <tr class="tableheader1">
                    <td width="38%">Date</td>
                    <td width="8%">ID#</td>
                    <td width="23%">Shoe Name</td>
                    <td width="23%">Location</td>
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
              <p>&nbsp;</p>
              </div>
            </div>
          </div></td>
        </tr>
      </table>
</div>
<script>

	
	<?php include("bottom.php"); ?>