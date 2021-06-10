<?
include "lib.php";
include "data/db_access.php";
$que="delete from ".$homename."_ref where no=".$_GET['refno'];
mysqli_query($connect,$que);
?>
<meta http-equiv="refresh" content="0;url=read.php?no=<? echo $_GET['no'];?>">