<?php include("header.php"); 


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
	<link rel="stylesheet" href="js/themes/base/jquery.ui.all.css">
	<script src="js/ui/jquery.ui.core.js"></script>
	<script src="js/ui/jquery.ui.widget.js"></script>
	<script src="js/ui/jquery.ui.datepicker.js"></script>
    <script>
	

var curdate='<?php echo date('m/d/Y'); ?>';
var selperiod='<?php echo $period; ?>';
	</script>
    <script src="setdate.js"></script>



    	<script type="text/javascript">
$().ready(function() {
	
	$("#datefrm").validate({
		rules: {
			from: "required",
			to: {
			required: true

			}
		},
		messages: {
			from: "<br/>From Date can not be empty.",
			to: {
			required: "<br/>ToDate can not be empty."
			}
		}
	});
	

	
	
	
});
</script>
<?php include("left3.php"); ?>
  
  <div id="content_area_mid_inner2">
  <div>
    <h2>Statistics</h2>
  </div>
    <div class="sbdatabase">
      <div class="edittable">
        <div align="left">
<form action="" method="post" name="datefrm" id="datefrm">
  <br />
  <strong>Select Dates:</strong>
  <label for="from">From</label>
  <input type="text" id="from" name="from" value="<?php echo $d1; ?>"/>
  <label for="to">to</label>
  <input type="text" id="to" name="to" value="<?php echo $d2; ?>"/>
  &nbsp;&nbsp;&nbsp;
  <select name="period" id="period">
    <option value="t" selected="selected">Total</option>
    <option value="d" <?php if($period=='d') { ?> selected="selected" <?php } ?> >Daily</option>
    <option value="w" <?php if($period=='w') { ?> selected="selected" <?php } ?> >Weekly</option>
    <option value="m" <?php if($period=='m') { ?> selected="selected" <?php } ?> >Monthly</option>
    <option value="y" <?php if($period=='y') { ?> selected="selected" <?php } ?> >Yearly</option>
  </select>
  <input type="submit" name="button" id="button" value="Submit" />
  <input type="submit" name="button2" id="button2" value="Clear" />
</form>
<div style="float:left; width:100%;" class="stats">
              <p align="center"><strong>Shoes:</strong></p>
              <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                <tr class="tableheader1">
                  <td width="29%">Date</td>
                  <td width="29%">Shoe Name</td>
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
		
		//  echo $s;	
		  $rs=mysql_query($s) or die(mysql_error());
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  	
		  			
			$sts=mysql_query("select * from soe_shoe where soe_id=".$row['soe_id']." and mem_id=".$_SESSION['memberid']) or die(mysql_error());
			if(mysql_num_rows($sts)<=0)
				continue;
			$stsrow=mysql_fetch_array($sts);
			$nm=$stsrow['name'];
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
                  <td><a href="detail-id-<?php echo $row['soe_id']; ?>.htm"><?php echo $nm; ?></a></td>
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
              <p align="center"><strong>Stores:</strong></p>
              <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                <tr class="tableheader1">
                  <td width="29%">Date</td>
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
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='clicks' group by sto_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='d')
			  $s="select sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond."  and type='clicks' group by year(date),month(date),day(date),sto_id,country,state,city order by cnt desc,date desc,soe_id";  	

		  if($period=='w')
			  $s="select week(date) as w,year(date) as y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='clicks'  group by year(date),week(date),soe_id,country,state,city order by cnt desc,date desc,sto_id";  	

		  if($period=='m')
			  $s="select year(date) as y,month(date) as m,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where sto_id>0 ".$cond." and type='clicks'  group by year(date),month(date),sto_id,country,state,city order by cnt desc,date desc,sto_id";  	

		  if($period=='y')
			  $s="select year(date) y,sto_id,count(*) as cnt,date,city,state,country from soe_statistics where soe_id>0 ".$cond." and type='clicks'  group by year(date),sto_id,country,state,city order by cnt desc,date desc,sto_id"; 	
			
		  $rs=mysql_query($s) or die(mysql_error());
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['sto_id']." and mem_id=".$_SESSION['memberid']) or die(mysql_error());
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
                  <td><a href="editbusiness.php?id=<?php echo $row['sto_id']; ?>"><?php echo $nm; ?></a></td>
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
              <p align="center"><strong>No. of times Stores Came in a Search:</strong></p>
              <table width="95%" border="1" cellpadding="5" cellspacing="1" align="center" >
                <tr class="tableheader1">
                  <td width="29%">Date</td>
                  <td width="29%">Store Name</td>
                  <td width="6%">Total</td>
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
	
		  					
		  $rs=mysql_query($s) or die(mysql_error());
		  $i=0;
		  while($row=mysql_fetch_array($rs))
		  {
		  		$i++;	
			$sts=mysql_query("select * from soe_stores where sto_id=".$row['sto_id']." and mem_id=".$_SESSION['memberid']) or die(mysql_error());
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
                  <td><a href="editbusiness.php?id=<?php echo $row['sto_id']; ?>"><?php echo $nm; ?></a></td>
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
            </div>
          
          
        </div>
      </div>
    </div>
  </div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei"></div>
<?php include("footer.php"); ?>