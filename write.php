<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>쓰기</h4>\n";
echo "<form method=post enctype=\"multipart/form-data\" action=write_ok.php>\n";
echo "<table><tr><td>제목</td><td><input type=text name=title class=title></td></tr>\n";
if($_GET['upper']){
	$que="select * from ".$homename."_board where no=".$_GET['upper'];
	$check_upper=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "<tr><td>상위</td><td>$check_upper->title</td></tr>\n";
}
echo "<tr><td>순서</td><td><select name=order_lower>\n";
echo "<option value='time' selected>시간순</option>\n";
echo "<option value='time desc'>시간역순</option>\n";
echo "<option value='title'>가나다순</option>\n";
echo "<option value='subno'>사용자지정</option>\n";
echo "</select></td></tr>\n";
echo "<tr><td>내용</td><td><textarea name=content\n";
if(is_mobile()) echo "cols=40 rows=10";
else echo "cols=60 rows=20";
echo "></textarea></td></tr>\n";
echo "<tr><td>파일</td><td><input type=file name=file></td></tr>\n";
echo "<tr><td colspan=2 align=center><input type=submit class=submit value=저장></td></tr>\n";
echo "</table>\n";
echo "<input type=hidden name=upper value=".$_GET['upper'].">\n";
echo "<input type=hidden name=writer value='".$_COOKIE['user']."'>\n";
echo "</form>\n";

include "foot.php";
?>
