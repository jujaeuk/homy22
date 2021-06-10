<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>비밀번호 변경</h4>\n";

$que = "select * from ".$homename."_users where name='".$_COOKIE['user']."'";
@$check = mysqli_fetch_object(mysqli_query($connect, $que));
if(crypt($_POST['old_pass'],"onlyone")!=$check->password){
	echo "ERROR: 현재 비밀번호가 틀렸습니다. <a href=user_pass.php>돌아가기</a>\n";
}
elseif($_POST['new_pass1']!=$_POST['new_pass2']){
	echo "ERROR: 새 비밀번호가 다릅니다. <a href=user_pass.php>돌아가기</a>\n";
}
else{
	$que="update ".$homename."_users set password='".crypt($_POST['new_pass1'],"onlyone")."' where name='".$_COOKIE['user']."'";
	mysqli_query($connect, $que);
	echo "비밀번호가 변경되었습니다. <a href=index.php>홈으로</a>\n";
}

include "foot.php";
?>