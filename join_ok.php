<?
include "lib.php";
include "data/db_access.php";
include "head.php";

echo "<h4>아이디 생성</h4>\n";
$que="select * from ".$homename."_users where name='".$_POST['username']."'";
$result=mysqli_query($connect,$que);
if(mysqli_num_rows($result)>0) $error_message="user name already exists";
if($_POST['password1']=="") $error_messsage="no password";
if($_POST['password1']!=$_POST['password2']) $error_message="different passwords";
if($error_message){
	echo "ERROR: ".$error_message."<br>\n";
	echo "<a href=join.php>돌아가기</a>\n";
}
else{
	$crypt_pass=crypt($_POST['password1'],"onlyone");
	$que="insert into ".$homename."_users (name, password) values('".$_POST['username']."','".$crypt_pass."')";
	if($_POST['username']){
		mysqli_query($connect,$que);
		echo "아이디 ".$_POST['username']." 생성되었음<br><a href=index.php>홈으로</a>\n";
	}
}
include "foot.php";
?>