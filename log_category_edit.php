<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>카테고리 수정</h4>\n";

echo "<form method=post action=log_category_edit_ok.php>\n";
echo "<select name=category>\n";
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
echo "</select>\n";
echo "merge to:\n";
echo "<select name=merge>\n";
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
echo "<option value='직접입력'>직접입력</option>\n";
echo "</select>\n";
echo "<input type=submit value=edit>\n";
echo "</form>\n";

include "log_menu.php";

include "foot.php";
?>
