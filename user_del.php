<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>계정 삭제</h4>\n";
$que="select * from ".$homename."_users where name='".$_COOKIE['user']."'";
@$check=mysqli_fetch_object(mysqli_query($connect,$que));
if($check->no==1) echo "관리자 계정은 삭제할 수 없습니다. <a href=index.php>돌아가기</a>\n";
else echo "계정 ".$_COOKIE['user']."을(를) 삭제하시겠습니까? <a href=user_del_ok.php>예</a> <a href=index.php>아니오</a>\n";

include "foot.php";
?>