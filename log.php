<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>로그</h4>\n";
echo "<form method=post action=start.php>\n";
echo "<table>\n";
echo "<tr><td>category</td><td><select name=category>\n";
$que="select * from ".$homename."_log order by category";
$result=mysqli_query($connect,$que);
$temp="";
while(@$check=mysqli_fetch_object($result)){
	if($temp!=$check->category) $category[]=$check->category;
	$temp=$check->category;
}
echo "<option value=>---</option>\n";
for($i=0;$i<sizeof($category);$i++){
	echo "<option value='".$category[$i]."'>".$category[$i]."</option>\n";
}
echo "<option value='직접 입력'>직접 입력</option>\n";
echo "</select>\n";
echo "cont. <input type=checkbox name=cont value=yes>\n";
echo "</td></tr>\n";
echo "<tr><td>content</td><td><input type=text name=content>\n";
echo "<input type=submit value=start>\n";
echo "</td></tr></table></form>\n";

$rownum=30;
if(!isset($_GET['page'])) $page=1;
else $page=$_GET['page'];
if(($_POST['category_filter'])||($_GET['category_filter'])){
	if($_POST['category_filter']) $category_filter=$_POST['category_filter'];
	elseif($_GET['category_filter']) $category_filter=$_GET['category_filter'];
	echo "category: ".$category_filter."<br>\n";
	$que="select * from ".$homename."_log where category='".$category_filter."' order by start desc limit ".($rownum*$page);
}
else{
	echo "list - category: all<br>\n";
	$que="select * from ".$homename."_log order by start desc, no desc limit ".($rownum*$page);
}
$result=mysqli_query($connect,$que);
$i=0;
while(@$check=mysqli_fetch_object($result)){
	$i++;
	if($i>$rownum*($page-1)){
		echo date("ymd H:i - ",$check->start);
		if($check->end) echo date("H:i ",$check->end);
		else echo "<a href=end.php?no=$check->no>end</a>\n";
		if($check->loss>0) echo "(-:$check->loss)\n";
		echo "($check->category) $check->content (<a href=log_edit.php?no=$check->no>edit</a>)\n";
		echo "<br>\n";
	}
}
$next=$page+1;
$prev=$page-1;
if($category_filter){
	$que="select * from ".$homename."_log where category='".$category_filter."' order by start desc limit ".($rownum*$prev);
	if(mysqli_num_rows(mysqli_query($connect,$que)))
		echo "<a href=$PHP_SELF?page=$prev&category_filter=".urlencode($category_filter).">prev</a>\n";
	else echo "prev\n";
	$que="select * from ".$homename."_log where category='".$category_filter."' order by start desc limit ".($rownum*$next);
	if(mysqli_num_rows(mysqli_query($connect,$que))>$rownum*($next-1))
		echo "<a href=$PHP_SELF?page=$next&category_filter=".urlencode($category_filter).">next</a>\n";
	else echo "next\n";
}
else{
	$que="select * from ".$homename."_log order by start desc limit ".($rownum*$prev);
	if(mysqli_num_rows(mysqli_query($connect,$que)))
		echo "<a href=$PHP_SELF?page=$prev>prev</a>\n";
	else echo "prev\n";
	$que="select * from ".$homename."_log order by start desc limit ".($rownum*$next);
	if(mysqli_num_rows(mysqli_query($connect,$que))>$rownum*($next-1))
		echo "<a href=$PHP_SELF?page=$next>next</a>\n";
	else echo "next\n";
}
echo "<form name=frm_filter method=post action=".$_SERVER['PHP_SELF'].">\n";
echo "category filter: <select name=category_filter onChange=\"JavaScript:document.frm_filter.submit();\">\n";
echo "<option value=>---</option>\n";
for($i=0;$i<sizeof($category);$i++){
	echo "<option value='".$category[$i]."'>".$category[$i]."</option>\n";
}
echo "</select></form>\n";
include "log_menu.php";

include "foot.php";
?>
