<?
include "lib.php";
include "data/db_access.php";

$now=time();
$que="select * from ".$homename."_board where upper=".$_POST['upper']." order by subno desc limit 1";
$check_maxsubno=mysqli_fetch_object(mysqli_query($connect,$que));
$maxsubno=$check_maxsubno->subno+1;
$que="insert into ".$homename."_board (title,time,writer,content,upper,order_lower,subno)".
	" values('".htmlentities($_POST['title'],ENT_QUOTES)."',".$now.",'".
	$_POST['writer']."','".htmlentities($_POST['content'],ENT_QUOTES)."',".
	$_POST['upper'].",'".$_POST['order_lower']."',".$maxsubno.")";
mysqli_query($connect,$que);

$que="select * from ".$homename."_board where title='".htmlentities($_POST['title'],ENT_QUOTES).
	"' and time=".$now." order by no desc limit 1";
$check=mysqli_fetch_object(mysqli_query($connect,$que));
$no=$check->no;

if($_FILES['file']['error']==0){
	while(file_exists("files/".$_FILES['file']['name'])){
		$temp=explode(".",$_FILES['file']['name']);
		$ext=end($temp);
		$name=basename($_FILES['file']['name'],".".$ext);
		$_FILES['file']['name']=$name."_.".$ext;
	}
	move_uploaded_file($_FILES['file']['tmp_name'],"files/".$_FILES['file']['name']);
	$que="insert into ".$homename."_files (boardno,filename) values($no,'".
		$_FILES['file']['name']."')";
	mysqli_query($connect,$que);
}
if($_POST['upper']!=0) echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_POST['upper']."\">\n";
else echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">\n";
?>
