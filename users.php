<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>users</h4>\n";
$que="select * from ".$homename."_users order by name";
$result=mysqli_query($connect,$que);
echo "<ul>\n";
while(@$check=mysqli_fetch_object($result)){
  echo "<li>".$check->name."</li>\n";
}
echo "</ul>\n";

include "foot.php";
?>