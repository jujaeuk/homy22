<?
include "lib.php";
include "barrier.php";
if($_POST['category']=="직접 입력"){
	include "head.php";
	include "login.php";
	
	echo "<h4>로그 수정</h4>";
	echo "<form method=post action=$PHP_SELF>\n";
	echo "category <input type=text name=category>\n";
	echo "<input type=hidden name=content value='".$_POST['content']."'>\n";
	echo "<input type=hidden name=start_hour value=".$_POST['start_hour'].">\n";
	echo "<input type=hidden name=start_min value=".$_POST['start_min'].">\n";
	echo "<input type=hidden name=start_month value=".$_POST['start_month'].">\n";
	echo "<input type=hidden name=start_day value=".$_POST['start_day'].">\n";
	echo "<input type=hidden name=start_year value=".$_POST['start_year'].">\n";
	echo "<input type=hidden name=loss value=".$_POST['loss'].">\n";
	if($_POST['end_year']&&$_POST['end_month']&&$_POST['end_day']){
		echo "<input type=hidden name=end_hour value=".$_POST['end_hour'].">\n";
		echo "<input type=hidden name=end_min value=".$_POST['end_min'].">\n";
		echo "<input type=hidden name=end_month value=".$_POST['end_month'].">\n";
		echo "<input type=hidden name=end_day value=".$_POST['end_day'].">\n";
		echo "<input type=hidden name=end_year value=".$_POST['end_year'].">\n";
	}
	echo "<input type=hidden name=no value=".$_POST['no'].">\n"; 
	echo "<input type=submit value=start></form>\n";
	
	include "log_menu.php";
	
	include "foot.php";

}
else{
	include "data/db_access.php";
	$start=mktime($_POST['start_hour'],$_POST['start_min'],0,$_POST['start_month'],$_POST['start_day'],$_POST['start_year']);
	$que="update ".$homename."_log set start=$start, loss=".$_POST['loss'].", category='".$_POST['category']."',content='".htmlentities($_POST['content'],ENT_QUOTES)."'";
	if($_POST['category']=="기록"){
		$end=$start;
		$que=$que.", end=$end";
	}
	elseif($_POST['end_year']&&$_POST['end_month']&&$_POST['end_day']){
		$end=mktime($_POST['end_hour'],$_POST['end_min'],0,$_POST['end_month'],$_POST['end_day'],$_POST['end_year']);
		$que=$que.", end=$end";
	}
	$que=$que." where no=".$_POST['no'];
	mysqli_query($connect,$que);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=log.php\">\n";
}
?>
