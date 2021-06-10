<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>로그 수정</h4>\n";

$que="select * from ".$homename."_log where no=".$_GET['no'];
@$check=mysqli_fetch_object(mysqli_query($connect,$que));
$this_start_year=date("Y",$check->start);
$this_start_month=date("m",$check->start);
$this_start_day=date("d",$check->start);
$this_start_hour=date("H",$check->start);
$this_start_min=date("i",$check->start);
if($check->end){
	$this_end_year=date("Y",$check->end);
	$this_end_month=date("m",$check->end);
	$this_end_day=date("d",$check->end);
	$this_end_hour=date("H",$check->end);
	$this_end_min=date("i",$check->end);
}
echo "<form method=post action=log_edit_ok.php>\n";
echo "<table>\n";
echo "<tr><td>start</td><td>\n";
echo "<select name=start_year>\n";
$current_year=date("Y",time());
for($i=0;$i<30;$i++){
	echo "<option value=".($current_year-$i);
	if($this_start_year==($current_year-$i)) echo " selected";
	echo ">".($current_year-$i)."</option>\n";
}
echo "</select>\n";
echo "<select name=start_month>\n";
for($i=1;$i<=12;$i++){
	echo "<option value=$i";
	if($this_start_month==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=start_day>\n";
for($i=1;$i<=31;$i++){
	echo "<option value=$i";
	if($this_start_day==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=start_hour>\n";
for($i=0;$i<=23;$i++){
	echo "<option value=$i";
	if($this_start_hour==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=start_min>\n";
for($i=0;$i<=59;$i++){
	echo "<option value=$i";
	if($this_start_min==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td>end</td><td>\n";
echo "<select name=end_year>\n";
if(!isset($check->end)) echo "<option value=>---</option>\n";
for($i=0;$i<=30;$i++){
	echo "<option value=".($current_year-$i);
	if($this_end_year==$current_year-$i) echo " selected";
	echo ">".($current_year-$i)."</option>\n";
}
echo "</select>\n";
echo "<select name=end_month>\n";
if(!isset($check->end)) echo "<option value=>---</option>\n";
for($i=1;$i<=12;$i++){
	echo "<option value=$i";
	if($this_end_month==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=end_day>\n";
if(!isset($check->end)) echo "<option value=>---</option>\n";
for($i=1;$i<=31;$i++){
	echo "<option value=$i";
	if($this_end_day==$i) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=end_hour>\n";
if(!isset($check->end)) echo "<option value=>---</option>\n";
for($i=0;$i<=23;$i++){
	echo "<option value=$i";
	if(isset($check->end)&&($this_end_hour==$i)) echo " selected";
	echo ">$i</option>\n";
}
echo "</select>\n";
echo "<select name=end_min>\n";
if(!isset($check->end)) echo "<option value=>---</option>\n";
for($i=0;$i<=59;$i++){
	echo "<option value=$i";
	if(isset($check->end)&&($this_end_min==$i)) echo " selected";
	echo ">$i</option>\n";
}
echo "</select></td></tr>\n";
echo "<tr><td>category</td><td>\n";
echo "<select name=category>\n";
$que="select * from ".$homename."_log order by category";
$result_category=mysqli_query($connect,$que);
$temp="";
while(@$check_category=mysqli_fetch_object($result_category)){
	if($temp!=$check_category->category) $category[]=$check_category->category;
	$temp=$check_category->category;
}
for($i=0;$i<sizeof($category);$i++){
	echo "<option value='".$category[$i]."'";
	if($category[$i]==$check->category) echo " selected";
	echo ">".$category[$i]."</option>\n";
}
echo "<option value='직접 입력'>직접 입력</option>\n";
echo "</select>\n";
echo "loss <input type=text name=loss value=\"$check->loss\">"; 
echo "</td></tr>\n";
echo "<tr><td>content</td><td>\n";
echo "<input type=text name=content value=\"$check->content\">";
echo "</td></tr>\n";
echo "<input type=hidden name=no value=".$_GET['no'].">\n";
echo "<tr><td colspan=2 align=center><input type=submit value=save>\n";
echo "<a href=log_delete.php?no=".$_GET['no'].">delete</a></td></tr>\n";
echo "</table>\n";
echo "</form>\n";

include "log_menu.php";

include "foot.php";
?>