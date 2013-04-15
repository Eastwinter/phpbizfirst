<?php include("header.php"); 

$sql="select * from soe_verification where code like '".$_GET['code']."'";
$rs=mysql_query($sql);

if(mysql_num_rows($rs)>0)
{
	$row=mysql_fetch_array($rs);
		$sql="select * from soe_members where email='".$row['email']."'";
		$rs=mysql_query($sql);
		if(mysql_num_rows($rs)>0)
		{
			$row=mysql_fetch_array($rs);
			$id=$row['mem_id'];
			if($row['first_name']!='' and $row['last_name']!='')
			{
		?>
			<script>
			location.href='memberlogin.php?msg=alreadyregistered&id=<?php echo $id; ?>';
			</script>
        <?php
			
			}
			else
			{
		?>
			<script>
			location.href='memberregister.php?msg=alreadyverified&id=<?php echo $id; ?>';
			</script>
        <?php
			}
		}
		else
		{			
			$sql="insert into soe_members set email='".$row['email']."',member_type='mem',from_ip='".$_SERVER['REMOTE_ADDR']."',joined='".time()."',verified='1'";
			$rs=mysql_query($sql);
			$id=mysql_insert_id();
			?>
			<script>
			location.href='memberregister.php?msg=verify&id=<?php echo $id; ?>';
			</script>
			<?php
		}
}
else
{
?>
			<script>
			location.href='memberlogin.php?msg=invalidcode&id=<?php echo $id; ?>';
			</script>
        <?php
}
?>	
  <?php include("left.php"); ?>
 
  <div id="content_area_mid_inner1"><h2>Email Verification</h2>
    <div> <p>An email has been sent to you with a verification link.<br />
              Please click on the link to continue with the registration process. </p></div>
   
              <br class="clear" />
    <div class="clear"></div>
  </div>
  
  </form>
  <div id="content_area_right"><?php echo  showbanners('right'); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
<?php include("footer.php"); ?>