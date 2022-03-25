<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>고치기</h4>\n";
$que="select * from ".$homename."_board where no=".$_GET['no'];
@$check=mysqli_fetch_object(mysqli_query($connect,$que));
echo "<form method=post enctype=\"multipart/form-data\" action=modify_ok.php>\n";
echo "<table><tr><td>제목</td><td><input type=text name=title class=title value='".$check->title."'></td></tr>\n";
echo "<tr><td>상위</td><td><input type=text name=upper value=$check->upper>\n";
echo "<tr><td>순서</td><td><select name=order_lower>\n";
echo "<option value='time'";
if($check->order_lower=="time") echo " selected";
echo ">시간순</option>\n";
echo "<option value='time desc'";
if($check->order_lower=="time desc") echo " selected";
echo ">시간역순</option>\n";
echo "<option value='title'";
if($check->order_lower=="title") echo " selected";
echo ">가나다순</option>\n";
echo "<option value='subno'";
if($check->order_lower=="subno") echo " selected";
echo ">사용자지정</option>\n";
echo "</select></td></tr>\n";

echo "<tr><td></td><td>\n";
$samesub=0;
$que="select * from ".$homename."_board where upper=".$check->no;
$result_sub=mysqli_query($connect,$que);
while(@$check_sub=mysqli_fetch_object($result_sub)){
	$que="select * from ".$homename."_board where upper=".$check->no." and subno=".$check_sub->subno;
	$result_samesub=mysqli_query($connect,$que);
	$samesub1=0;
	while(@$check_samesub=mysqli_fetch_object($result_samesub)) $samesub1++;
	if($samesub1>1) $samesub++;
}
if($samesub>0) echo "$samesub <a href=subno_rearrange.php?no=$check->no>rearrange</a>\n";
echo "</td></tr>\n";
echo "<tr><td>내용</td><td><textarea name=content\n";
if(is_mobile()) echo "cols=40 rows=10";
else echo "cols=60 rows=20";
echo ">".$check->content."</textarea></td></tr>\n";

echo "<tr><td>파일</td><td>\n";
$que="select * from ".$homename."_files where boardno=$check->no";
$result_file=mysqli_query($connect,$que);
$i=0;
while(@$check_file=mysqli_fetch_object($result_file)){
	if($i==0) echo "파일을 삭제하려면 체크:<br>\n";
	echo "<input type=checkbox name=fdel[] value=$check_file->no>$check_file->filename<br>\n";
	$i++;
}
echo "새로 추가할 파일:<br>\n";
echo "<input type=file name=file></td></tr>\n";
echo "<tr><td colspan=2 align=center><input type=submit class=submit value=저장></td></tr>\n";
echo "</table>\n";
echo "<input type=hidden name=writer value='".$_COOKIE['user']."'>\n";
echo "<input type=hidden name=no value=$check->no>\n";
echo "</form>\n";

include "foot.php";
?>
