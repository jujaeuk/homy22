<?
include "lib.php";
include "data/db_access.php";
$que="insert into ".$homename."_ref (origin, ref) values(".$_POST['origin'].",".$_POST['ref'].")";
mysqli_query($connect,$que);
?>
<meta http-equiv="refresh" content="0;url=read.php?no=<? echo $_POST['origin'];?>">