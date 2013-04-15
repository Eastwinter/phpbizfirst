<?php
set_time_limit (600);
include("../connect.php");
require_once('phpthumb/phpthumb.class.php');
$start=$_GET['start'];
$rs=mysql_query("select * from soe_shoecolors limit ".$start.", 5");
while($row=mysql_fetch_array($rs))
{
	
	for($i=0;$i<=6;$i++)
	{
		if($i==0)
			$fld='logo';
		else
			$fld='logo'.$i;
	
		$name1=$row[$fld];
		
		
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb98_".$name1;				
	$phpThumb = new phpThumb();		
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 98;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

$phpThumb = new phpThumb();
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb30_".$name1;			
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 30;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

$phpThumb = new phpThumb();
	$f="../uploads/shoe_photo/".$name1;
	$f2=realpath("../uploads/shoe_photo/")."/thumb260_".$name1;			
	$phpThumb->setSourceData(file_get_contents($f));
	$output_filename = $f2;
	$thumbnail_width = 260;
	$phpThumb->setParameter('w', $thumbnail_width);
	$phpThumb->GenerateThumbnail();
	$phpThumb->RenderToFile($output_filename);

	}
	
}

$start=$start+5;
?>
<script>
location.href='script.php?start=<?php echo $start; ?>';
</script>