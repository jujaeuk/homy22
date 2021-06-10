<?
include "lib.php";
include "data/db_access.php";

if(isset($_POST['fdel'])){
	foreach($_POST['fdel'] as $fdel){
		$que="select * from ".$homename."_files where no=$fdel";
		$check=mysqli_fetch_object(mysqli_query($connect,$que));
		unlink("files/".$check->filename);
		$que="delete from ".$homename."_files where no=$fdel";
		mysqli_query($connect,$que);
	}
}
if($_FILES['file']['error']==0){
	while(file_exists("files/".$_FILES['file']['name'])){
		$temp=explode(".",$_FILES['file']['name']);
		$ext=end($temp);
		$name=basename($_FILES['file']['name'],".".$ext);
		$_FILES['file']['name']=$name."_.".$ext;
	}
	move_uploaded_file($_FILES['file']['tmp_name'],"files/".$_FILES['file']['name']);
	$que="insert into ".$homename."_files (boardno,filename) values(".$_POST['no'].",'".
		$_FILES['file']['name']."')";
	mysqli_query($connect,$que);
}
 
if(!$_POST['title']) $_POST['title']="무제";
$que="update ".$homename."_board set title='".htmlentities($_POST['title'],ENT_QUOTES).
	"', content='".htmlentities($_POST['content'],ENT_QUOTES)."', upper=".$_POST['upper'].
	", order_lower='".$_POST['order_lower']."'  where no=".$_POST['no'];

mysqli_query($connect,$que);
echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_POST['no']."\">\n";
?>
