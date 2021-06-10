<?
include "lib.php";
include "data/db_access.php";
include "head.php";
$que="select * from ".$homename."_users where name='".$_COOKIE['user']."'";
@$check=mysqli_fetch_object(mysqli_query($connect,$que));
if($check->no==1){
	echo "홈페이지를 삭제합니다. <a href=uninstall_ok.php>yes</a> <a href=./>no</a>\n";
}
else{
  echo "관리자만 사용할 수 있는 권한입니다.\n";
}
include "foot.php";
?>
