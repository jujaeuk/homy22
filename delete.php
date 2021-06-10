<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>삭제</h4>\n";

$que="select * from ".$homename."_board where upper=".$_GET['no'];
$result=mysqli_query($connect,$que);
if(mysqli_num_rows($result)){
	echo "ERROR: 연결된 글이 있어 삭제할 수 없습니다.\n";
	echo "<a href=read.php?no=".$_GET['no'].">back</a>\n";
}
else{
  $que="select * from ".$homename."_board where no=".$_GET['no'];
  $check=mysqli_fetch_object(mysqli_query($connect,$que));
  echo "delete '".$check->title."' (".date("Ymd H:i",$check->time).") are you sure? <a href=delete_ok.php?no=".$_GET['no']."&upper=".$_GET['upper'].">yes</a> <a href=read.php?no=".$_GET['no'].">no</a>\n";
}
include "foot.php";
?>
