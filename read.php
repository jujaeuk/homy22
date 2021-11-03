<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

if(isset($_GET['no'])) $que="select * from ".$homename."_board where no=".$_GET['no'];
else $que="select * from ".$homename."_board order by time desc limit 1";
@$check=mysqli_fetch_object(mysqli_query($connect,$que));

echo "<h4>".$check->title."</h4>\n";
echo "<p>by ".$check->writer." ".date("Y-m-d H:i",$check->time)."\n";
if($check->time_modify) echo "(".date("Y-m-d H:i",$check->time_modify).")\n";
echo "<br><a href=write.php?upper=$check->no>아랫글쓰기</a>";
if($_COOKIE['user']==$check->writer) echo " <a href=modify.php?no=$check->no>수정</a> <a href=addref.php?no=$check->no>참조</a> <a href=delete.php?no=$check->no&upper=$check->upper>삭제</a>\n";
$que="select * from ".$homename."_users where name='".$_COOKIE['user']."'";
@$check_user=mysqli_fetch_object(mysqli_query($connect,$que));
if($check_user->no==1){
	echo "<a href=to_intro.php?no=$check->no>소개글로</a>";
}
echo "</p>\n";
echo "<p>".nl2br($check->content)."</p>\n";

$i=0;
$que="select * from ".$homename."_files where boardno=".$check->no;
$result_file=mysqli_query($connect,$que);
while(@$check_file=mysqli_fetch_object($result_file)){
	if($i==0) echo "<p>file:<br>\n";
	$temp=explode(".",$check_file->filename);
	$ext=end($temp);
	if($ext=="py"||$ext=="txt"){
		$fp=fopen("files/".$check_file->filename,"r");
		echo "<pre class=code>\n";
		while(!feof($fp)) echo fgets($fp);
		echo "</pre>\n";
		fclose($fp);
	}
	$pic_ext=["JPG","jpg","PNG","png","JPEG","jpeg"];
	if(in_array($ext,$pic_ext)) echo "<img src=files/".$check_file->filename." width=100%>\n";
	echo "<a href=\"files/".$check_file->filename."\">".$check_file->filename."</a><br>\n";
	$i++;
}
if($i>0) echo "</p>\n";

$que="select * from ".$homename."_ref where origin=$check->no";
$result_ref=mysqli_query($connect,$que);
$i=0;
while(@$check_ref=mysqli_fetch_object($result_ref)){
	if($i==0){
		echo "<h4>참조</h4>\n";
		echo "<ul>\n";
	}
	$que="select * from ".$homename."_board where no=".$check_ref->ref;
	$check_ref1=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "<li><a href=read.php?no=$check_ref1->no>$check_ref1->title </a> <a href=delref.php?no=$check->no&refno=$check_ref->no>x</a></li>\n";
	$i++;
}
if($i>0) echo "</ul>\n";
$que="select * from ".$homename."_ref where ref=$check->no";
$result_origin=mysqli_query($connect,$que);
$i=0;
while(@$check_origin=mysqli_fetch_object($result_origin)){
	if($i==0){
		echo "<h4>참조됨</h4>\n";
		echo "<ul>\n";
	}
	$que="select * from ".$homename."_board where no=".$check_origin->origin;
	$check_origin1=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "<li><a href=read.php?no=$check_origin1->no>$check_origin1->title </a> <a href=delref.php?no=$check->no&refno=$check_origin->no>x</a></li>\n";
	$i++;
}
if($i>0) echo "</ul>\n";

$que="select * from ".$homename."_board where upper=".$check->no." order by $check->order_lower";
$result=mysqli_query($connect,$que);
$i=0;
while(@$check_sub=mysqli_fetch_object($result)){
	if($i==0){
		echo "<h4>목차</h4>\n";
		echo "<ul>\n";
	}
	echo "<li><a href=read.php?no=$check_sub->no>$check_sub->title </a>\n";
	if($check_sub->subno>1) echo "<a href=subup.php?no=$check->no&sub=$check_sub->no&subno=$check_sub->subno>^</a>\n";
	echo "</li>\n";
	$i++;
}
if($i>0) echo "</ul>\n";

if($check->upper!=0){ 
	echo "<h4>윗글</h4>\n";
	$que="select * from ".$homename."_board where no=$check->upper";
	@$check_upper=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "<ul><li><a href=read.php?no=$check->upper>$check_upper->title </a></li></ul>\n";
}
echo "<h4>옆글</h4>\n";
$que="select * from ".$homename."_board where no=$check->upper";
$check_upper=mysqli_fetch_object(mysqli_query($connect,$que));
if(!$check_upper->order_lower) $order_lower="subno";
else $order_lower=$check_upper->order_lower;
$que="select * from ".$homename."_board where upper=$check->upper order by $order_lower";
$result_peer=mysqli_query($connect,$que);
$i=0;
while(@$check_peer=mysqli_fetch_object($result_peer)){
	if($i==0) echo "<ul>\n";
	if($check_peer->no==$check->no) echo "<li>$check_peer->title </li>\n";
	else echo "<li><a href=read.php?no=$check_peer->no>$check_peer->title </a></li>\n";
	$i++;
}
if($i>0) echo "</ul>\n";

include "foot.php";
?>

