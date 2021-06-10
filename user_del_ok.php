<?
include "barrier.php";
include "data/db_access.php";

$que = "delete from ".$homename."_users where name='".$_COOKIE['user']."'";
mysqli_query($connect, $que);
setcookie("user", $_COOKIE['user'],time()-3600,".");
echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">\n";
?>