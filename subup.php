<?
include "lib.php";
include "data/db_access.php";
$que="select * from ".$homename."_board where no=".$_GET['sub'];
$check=mysqli_fetch_object(mysqli_query($connect,$que));

$que="select * from ".$homename."_board where upper=".$_GET['no']." and subno < ".$_GET['subno']." order by subno desc limit 1";
$check_up=mysqli_fetch_object(mysqli_query($connect,$que));

$que="update ".$homename."_board set subno=".$check_up->subno." where no=".$_GET['sub'];
mysqli_query($connect,$que);

$que="update ".$homename."_board set subno=".$check->subno." where no=".$check_up->no;
mysqli_query($connect,$que);

if($_GET['no']==0) echo "<meta http-equiv=\"refresh\" content=\"0;url=index.html\">\n";
else echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_GET['no']."\">\n";
?>