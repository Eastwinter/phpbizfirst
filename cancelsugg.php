<?php 
session_start();
session_regenerate_id();
include("header.php"); 
mysql_query("delete from soe_shoe where soe_id=".$_GET['soe_id']);
if($_SESSION['membertype']=='mem')
{
?>
 <script>
 location.href='memshoes.php';
 </script>
 <?php
 }
 elseif($_SESSION['membertype']=='adv')
{
?>
 <script>
 location.href='advshoes.php';
 </script>
 <?php
 }
  else
{
?>
 <script>
 location.href='index.php';
 </script>
 <?php
 }
?>

 