<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

function subcontents_backup($connect,$homename,$upper,$fp){
	$que="select * from ".$homename."_board where no=$upper";
	$check_upper=mysqli_fetch_object(mysqli_query($connect,$que));
	if(!$check_upper->order_lower) $order_lower="subno";
	else $order_lower=$check_upper->order_lower;
	$que="select * from ".$homename."_board where upper=$upper order by $order_lower";
	$result=mysqli_query($connect,$que);
	while(@$check=mysqli_fetch_object($result)){
		fwrite($fp, "no. ".$check->no." ".$check->title." (".date("Y-m-d H:i",$check->time).")\n".html_entity_decode($check->content,ENT_QUOTES)."\n\n");
		subcontents_backup($connect,$homename,$check->no,$fp);
	}
}

echo "<h4>게시판 백업</h4>\n";
$filename="data/board_backup_".$homename.date("ymd").".txt";
$fp=fopen($filename,"w");
subcontents_backup($connect,$homename,0,$fp);
fclose($fp);
echo "<a href=".$filename.">다운로드</a>\n";

include "foot.php";
?>