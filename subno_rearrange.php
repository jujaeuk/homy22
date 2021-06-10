<?
include "lib.php";
include "data/db_access.php";
$que="select * from ".$homename."_board where upper=".$_GET['no']." order by time";
$result_sub=mysqli_query($connect,$que);
$i=1;
while(@$check_sub=mysqli_fetch_object($result_sub)){
	$que="update ".$homename."_board set subno=$i where no=".$check_sub->no;
	mysqli_query($connect,$que);
	$i++;
}
if($_GET['no']==0) echo "<meta http-equiv=\"refresh\" content=\"0;url=index.html\">\n";
else echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_GET['no']."\">\n";
?>