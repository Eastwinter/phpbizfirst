<?php
include("../connect.php");


$handle = opendir('../uploads/shoe_photo/');
while (false !== ($filename = readdir($handle))){
  	 $arr=explode("_",$filename);
	 print_r($arr);
	 echo '<hr>';
	 if($arr[0]!='thumb98' and $arr[0]!='thumb30' and $arr[0]!='thumb260')
	 {
	 	$soeid=intval($arr[1]);
		$file=$arr[1]."_".$arr[2];
		
		$rs=mysql_query("select * from soe_shoe where soe_id=".$soeid);
		if(mysql_num_rows($rs)>0)
		{
				$row=mysql_fetch_array($rs);
		
				$sql="select * from soe_shoecolors where soe_id=".$soeid;
				$rs1=mysql_query($sql);
				$row1=mysql_fetch_array($rs1);
				$n=$row1['id'];
				
				for($i=0;$i<=6;$i++)
				{
					if($i==0)
						$fld='logo';
					else
						$fld='logo'.$i;
			
					$nm=$row[$fld];
					echo '<br />'.$nm."-=====".$file;
					if($nm==$file)
					{
						$nm1=$n."_".$nm;
						$sql="update soe_shoecolors set ".$fld."='".$nm1."' where soe_id=".$soeid;
						mysql_query($sql) or die(mysql_error());
						rename("../uploads/shoe_photo/".$filename,"../uploads/shoe_photo/".$nm1);
						rename("../uploads/shoe_photo/thumb98_".$filename,"../uploads/shoe_photo/thumb98_".$nm1);				
						rename("../uploads/shoe_photo/thumb30_".$filename,"../uploads/shoe_photo/thumb30_".$nm1);				
						rename("../uploads/shoe_photo/thumb260_".$filename,"../uploads/shoe_photo/thumb260_".$nm1);												
					}
				}
		}
	}
} 


?>