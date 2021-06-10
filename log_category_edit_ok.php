<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";
if($_POST['merge']=='직접입력'){
	include "head.php";
	include "login.php";
	
	echo "<h4>카테고리 수정</h4>\n";
	echo "<form method=post action=$PHP_SELF>\n";
	echo "new category name: <input type=text name=merge>\n";
	echo "<input type=submit value=save>\n";
	echo "<input type=hidden name=category value='".$_POST['category']."'>\n";
	echo "</form>\n";
	
	include "log_menu.php";
	
	include "foot.php";
}
else{
	echo "category: ".$_POST['category']." merge: ".$_POST['merge']."<br>\n";
	$que="update ".$homename."_log set category='".$_POST['merge']."' where category='".$_POST['category']."'";
	mysqli_query($connect,$que);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=log.php\">\n";
}
?>
