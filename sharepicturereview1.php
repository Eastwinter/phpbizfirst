<?php include("header.php"); 

if($_SERVER['REQUEST_METHOD']=="POST")
{
$sql="INSERT INTO soe_sharecomments set
`memid`='".$_SESSION['memberid']."' ,
`comments`='".mysql_real_escape_string($_POST['comments'])."',
shareid=".intval($_GET['id'])."";
mysql_query($sql) or die("ERROR -> ".mysql_error().'<br>'.$sql);
	?>
    <script>
	location.href="sharepicture1.php";
	</script>
    <?php
}

?>
<?php include("left2.php"); ?>

<?php
$rs=mysql_query("select * from soe_share where id=".$_GET['id']);
$row=mysql_fetch_array($rs);

?>

  <div id="content_area_mid_inner">
    <div>
      <h2>Detailed Comments</h2>
    </div>
    <form action="" method="post" name="sharefrm">
    <div class="border1">
      <div style="float:left; width:450px; padding-left:10px; height:300px;"> <img src="uploads/sharephoto/<?php echo $row['image']; ?>" alt="" border="0" style="width:300px; height:300px;" /> </div>
      <div class="addcomments">
        <p><b>Comments :</b><br>
          <textarea name="comments" id="comments" cols="45" rows="5"></textarea>
          <br>
          <br>
          <input type="image" src="images/blue_submit_button.jpg" alt="" border="0"></a>  </p>
      </div>
      <div class="clear"></div>
    </div>
    </form>
  </div>
  <div id="content_area_right"><?php echo showbanners("right"); ?></div>
  <div class="clear"></div>
  <!-- Content Area End -->
  <div class="hei">&nbsp;</div>
<?php include("footer.php"); ?>