<?
include "data/db_access.php";
$que="select * from ".$homename."_users where name='".$_POST['username']."'";
$result=mysqli_query($connect,$que);
if(mysqli_num_rows($result)==0) $error_message="존재하지 않는 사용자입니다.";
else{
	$check=mysqli_fetch_object($result);
	if(crypt($_POST['password'],"onlyone")!=$check->password) $error_message="비밀번호가 틀렸습니다.";
	else{
		session_start();
		$_SESSION['user']=$check->name;
		echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">\n";
	}
}
if($error_message){
	include "lib.php";
	include "head.php";
	echo "ERROR: ".$error_message." <a href=index.php>돌아가기</a>\n";
	include "foot.php";
}
?>