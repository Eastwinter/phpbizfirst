<?php include("top.php");

if($_GET['action']=='del')
{
	mysql_query("delete from cart where ocn like '".$_GET['ocn']."'");
}



$msg='';
if($_POST['hfld']==1)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$s="update soe_stores set active='1' where sto_id=".$value;
	//	echo $s;
		mysql_query($s) or die(mysql_error());
	} 
}


if($_POST['hfld']==2)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		mysql_query("update soe_stores set active='0' where sto_id=".$value) or die(mysql_error());
	} 
}

if($_POST['hfld']==3)
{
	foreach($_POST['checkbox'] as $key=>$value) 
	{
		$rs=mysql_query('delete from soe_stores where sto_id='.$value) or die(mysql_error());
		mysql_query("update soe_shoe set sto_id=0 and mem_id=1 where sto_id=".$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_storelocations where sto_id='.$value) or die(mysql_error());
		$rs=mysql_query('delete from soe_membership where sto_id='.$value) or die(mysql_error());
		
	} 
}


?>

	
	<div class="body" id="mk_height">
		<script type="text/javascript">
$().ready(function()
{
	$("#object").animate({ 
		top: "0px"
	  }, 2000 ).fadeOut(11111);
});
</script>
				<div class="body" id="mk_height">
		
		<table width="95%" border="0" cellpadding="0" cellspacing="0" align="center">		
			<tr>
				<td class="header">Order History</td>
		  </tr>
			
			<tr><td class="height">&nbsp;</td></tr>
		</table>		
		
		<?php
		$maintot=0;
			$rs=mysql_query("select * from cart where stoid='".intval($_GET['stoid'])."' group by ocn order by date desc");
			if(mysql_num_rows($rs)>0)
			{
		?>
        <table class="marginTop" align="center" border="1" cellpadding="0" cellspacing="0"  width="90%"  style=" text-align:center;" >
          <tr bgcolor="#fff" style="color:#009ade; background-color:#e4e4e4;">
            <th width="5%" >Order Number</th>
            <th width="5%" height="50" >Date</th>
            <th width="13%" >Total Amount</th>
            <th width="5%" >Status</th>
            <th width="5%" >&nbsp;</th>
            <th width="5%" >&nbsp;</th>
          </tr>
          <?php
			
			while($row=mysql_fetch_array($rs))
			{
				extract($row);
				$rs1=mysql_query("select * from soe_members where mem_id=".$row['memid']);
				$row1=mysql_fetch_array($rs1);
				
				$maintot+=$row['total'];
				$rsmt=mysql_query("select sum(price*qty) from cart where ocn like '".$ocn."' and stoid='".intval($_GET['stoid'])."' group by ocn order by date desc");
				$rsmtrow=mysql_fetch_array($rsmt);
				$tot=$rsmtrow[0];
				
			?>
          <tr bgcolor="#fff">
            <td><?php echo $ocn; ?></td>
            <td height="40"><?php echo date('F d, Y',strtotime($date)); ?></td>
            <td><?php echo $tot; ?></td>
            <td><?php echo $paid; ?>            </td>
            <td><a style="cursor:pointer" onclick="javascript: showhd(<?php echo $id; ?>);"><strong>DETAILS</strong></a></td>
            <td><a href="javascript: show('<?php echo $row['ocn']; ?>','<?php echo $_GET['stoid']; ?>');"><img src="../images/delete.png" alt="" border="0" /></a></td>
          </tr>
          <tr bgcolor="#fff" id="mytr" >
            <td colspan="6">
            
            
            
            <div id="row<?php echo $id; ?>" style="display:none">
              <table style="text-align:center; color:#000000; margin:20px;"  align="center" bgcolor="#fff"   border="1px solid gray" cellpadding="0" cellspacing="0">
                  <tr style="color:#009ade; background-color:#e4e4e4;">
                    <th width="137" height="50" >&nbsp;</th>
                    <th width="176" >Item Code</th>
                    <th width="102" >Quantity</th>
                    <th width="95" >Price</th>
                    <th width="128" >Amount</th>
                  </tr>
                  <?php
					$maintot1=0;
			$rs11=mysql_query("select * from cart where ocn like '".$ocn."' and stoid='".intval($_GET['stoid'])."'") or die(mysql_error());

			while($row11=mysql_fetch_array($rs11))
			{
				
				$rs1=mysql_query("select * from soe_shoe where active='1' and soe_id=".$row11['itemid']);
				$row1=mysql_fetch_array($rs1);
				
				$img='<img src="../uploads/shoe_photo/thumb98_'.getcol($row11['itemid'],'',$row11['colid']).'" alt="" border="0"  />' ;
				
				
				
				
			?>
                  <tr>
                    <td height="40"><?php echo $img; ?></td>
                    <td><?php echo $row1['name']; ?></td>
                    <td><?php echo $row11['qty']; ?></td>
                    <td><?php echo $row11['price']; ?></td>
                    
                    <td><?php echo $row11['qty']*$row11['price']; ?></td>
                  </tr>
                  
                  <?php
			}
			
			
			$rsmem=mysql_query("select * from soe_members where mem_id=".$memid);
			$rowmem=mysql_fetch_array($rsmem);
			
			
			?>
            
            <tr>
                    <td colspan="5" align="center" valign="middle">
                    
                    <table width="80%"   border="1px solid gray"  align="center" cellpadding="4" cellspacing="0" bgcolor="#fff" style="text-align:center; color:#000000; margin:20px;">
                      <tr>
                        <th colspan="2"><span class="style5">Customer Details</span></th>
                      </tr>
                      <tr>
                        <td><span class="style7"> Name</span></td>
                        <td><?php echo $rowmem['first_name']." ".$rowmem['last_name']; ?></td>
                      </tr>
                      <tr>
                        <td><span class="style7">Email</span></td>
                        <td><?php echo $rowmem['email']; ?></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
                <p>&nbsp;</p>
            </div></td>
          </tr>
          <?php
				   }
				   ?>
        </table>
        <?php
		  }
		  else
		  {
		  ?>
            <div align="center"><span style="font-variant:small-caps; font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif"><strong>No Orders Yet!</strong></span><br></div>
<br>
<br>
<br>
<br>

            <?php
		  }
		  ?>
</div>

	<script>
function selactiv(d,msg)
{
	var chks = document.getElementsByName('checkbox[]');
	var x = 0;
	var n = 0;
	for(i=0;i<chks.length;i++)
	{
		if(chks[i].checked)
		{
			x=chks[i].value;
			n++;
		}
	}

if(n==0)
	alert("Select a record to "+msg);
else
{
	ans=confirm('Are you sure to '+msg+" ?");
	if(ans==true)
	{
	document.site_banners.hfld.value=d;
	document.site_banners.submit();
	}
}
}
	</script>
    
     <script>
				function showhd(i)
				{
					nm="row"+i;
		obj=document.getElementById(nm);
		
		if(obj.style.display=='none')
			obj.style.display='inline';
		else
			obj.style.display='none';
				}
				</script>
                
                <script>
		function show(ocn,stoid)
		{
			ans=confirm("Are you sure to delete?");
			if(ans==true)
				location.href="orderhistoryadv.php?action=del&ocn="+ocn+'&stoid='+stoid;
		}
		</script>  
	<?php include("bottom.php"); ?>