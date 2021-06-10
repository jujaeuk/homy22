<?
include "lib.php";
include "barrier.php";
if($_POST['category']=="직접 입력"){
	include "head.php";
	include "login.php";

	echo "<h4>new category</h4>\n";
	echo "<form method=post action=$PHP_SELF>\n";
	echo "category <input type=text name=category>\n";
	echo "<input type=hidden name=content value='".$_POST['content']."'>\n";
	echo "<input type=submit value=start></form>\n";

	include "foot.php";
}
else{
	include "data/db_access.php";
	$start=time();
	if($_POST['cont']=="yes"){
		$que="select * from ".$homename."_log order by start desc limit 1";
		$check=mysqli_fetch_object(mysqli_query($connect,$que));
		if($check->end) $start=$check->end;
		else{
			$que="update ".$homename."_log set end=".time()." where no=".$check->no;
			mysqli_query($connect,$que);
		}
	} 
	$que="insert into ".$homename."_log (start,category,content) values ($start,'".$_POST['category']."','".htmlentities($_POST['content'],ENT_QUOTES)."')";
	if($_POST['category']) mysqli_query($connect,$que);
	echo "<meta http-equiv=\"refresh\" content=\"0;url=log.php\">\n";
} 
