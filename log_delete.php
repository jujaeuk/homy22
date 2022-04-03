<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";
session_start();
if(isset($_COOKIE['user'])){
	$que="delete from ".$homename."_log where no=".$_GET['no'];
	mysqli_query($connect,$que);
}
?>
<meta http-equiv="refresh" content="0;url=log.php">
