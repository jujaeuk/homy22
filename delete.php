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
  echo "'".$check->title."' (".date("Ymd H:i",$check->time).") 글을 삭제합니다. <a href=delete_ok.php?no=".$_GET['no']."&upper=".$_GET['upper'].">예</a> <a href=read.php?no=".$_GET['no'].">아니오</a>\n";
}
include "foot.php";
?>
