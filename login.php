<?
if(!isset($_COOKIE['user'])){
	echo "<h4>로그인</h4>\n";
	echo "<table>\n";
	echo "<form method=post action=login_ok.php>\n";
	echo "<tr><td>user</td><td><input type=text name=username></td></tr>\n";
	echo "<tr><td>password</td><td><input type=password name=password></td></tr>\n";
	echo "<tr><td colspan=2 align=center><input type=submit value=로그인>\n";

	// echo "<a href=join.php>아이디 생성</a>\n";
	
	echo "</td></tr>\n";
	echo "</form>\n";
	echo "</table>\n";
	include "foot.php";
	exit;
}
else{
	$que="select * from ".$homename."_users where name='".$_COOKIE['user']."'";
	@$check=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "이름 : ".$_COOKIE['user'];
	if($check->no==1) echo "(관리자)\n";
	echo "<a href=logout.php>로그아웃</a> |\n";
	echo "<a href=index.php>대문</a> | <a href=log.php>로그</a>\n";
}
?>
