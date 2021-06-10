<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

$que="update ".$homename."_log set end=".time()." where no=".$_GET['no'];
mysqli_query($connect,$que);
?>
<meta http-equiv="refresh" content="0;url=log.php">
