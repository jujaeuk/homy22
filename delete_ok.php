<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

$que="select * from ".$homename."_files where boardno=".$_GET['no'];
$result_file=mysqli_query($connect,$que);
while(@$check_file=mysqli_fetch_object($result_file)) unlink("files/".$check_file->filename);
$que="delete from ".$homename."_files where boardno=".$_GET['no'];
mysqli_query($connect,$que);
$que="delete from ".$homename."_board where no=".$_GET['no'];
mysqli_query($connect,$que);
if($_GET['upper']==0) echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">\n";
else echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_GET['upper']."\">\n";
?>
