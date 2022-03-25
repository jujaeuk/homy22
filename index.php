<?
function subcontents($connect,$homename,$upper,$level){
	$que="select * from ".$homename."_board where no=$upper";
	$check_upper=mysqli_fetch_object(mysqli_query($connect,$que));
	if(!$check_upper->order_lower) $order_lower="subno";
	else $order_lower=$check_upper->order_lower;
	$que="select * from ".$homename."_board where upper=$upper order by $order_lower";
	$result=mysqli_query($connect,$que);
	if(mysqli_num_rows($result)){
		echo "<ul>\n";
		while(@$check=mysqli_fetch_object($result)){
			echo "<li><a href=read.php?no=$check->no>$check->title</a>\n";
			if(($check->upper==0)&&($check->subno>1)) echo "<a href=subup.php?no=0&sub=$check->no&subno=$check->subno>^</a>\n";
			$que="select * from ".$homename."_board where upper=$check->no";
			$check_sub=mysqli_fetch_object(mysqli_query($connect,$que));
			$que="select * from ".$homename."_users where name='".$_COOKIE['user']."'";
			@$check_user=mysqli_fetch_object(mysqli_query($connect,$que));
			if($check_user->no==1) echo "<a href=write.php?upper=$check->no>+</a>\n";
			if($level<1) subcontents($connect,$homename,$check->no,$level+1);
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
}

include "lib.php";
include "barrier.php";
if(file_exists("data/db_access.php")) include "data/db_access.php";
else exit;

include "head.php";
include "login.php";

if(file_exists("data/intro.php")){
	include "data/intro.php";
	$que="select * from ".$homename."_board where no=$intro";
	@$check_intro=mysqli_fetch_object(mysqli_query($connect,$que));
	echo "<h4>".$check_intro->title."</h4>\n";
	echo nl2br($check_intro->content);
}

$que="select * from ".$homename."_board order by time desc limit 1";
$result=mysqli_query($connect,$que);
if(@$check=mysqli_fetch_object($result)){
	echo "<h4>최근글: ".$check->title."\n";
	echo "(".date("Y-m-d H:i",$check->time).")</h4>\n";
	echo "<p>\n";
	$que_file="select * from ".$homename."_files where boardno=".$check->no." limit 1";
	$result_file=mysqli_query($connect,$que_file);
	while(@$check_file=mysqli_fetch_object($result_file)){
		$fileinfo=pathinfo($check_file->filename);
		$ext=$fileinfo['extension'];
		$pic_ext=["JPG","jpg","PNG","png","JPEG","jpeg"];
		if(in_array($ext,$pic_ext)) echo "<img src=files/".$check_file->filename." width=100%>\n";
	}
	echo nl2br(iconv_substr($check->content,0,140,"utf-8"))."...<a href=read.php?no=$check->no>읽기로 이동</a></p>\n";
	$que_file="select * from ".$homename."_files where boardno=".$check->no;
	$result_file=mysqli_query($connect,$que_file);
}
echo "<h4>목차</h4>\n";
subcontents($connect,$homename,0,0);
$que="select * from ".$homename."_users where name='".$_SESSION['user']."'";
@$check=mysqli_fetch_object(mysqli_query($connect,$que));
if($check->no==1){
	echo "<h4>관리 메뉴</h4>\n";
	echo "<ul>\n";
	$que="show tables like '".$homename."_board'";
	$result=mysqli_query($connect,$que);
	if(mysqli_num_rows($result)>0){
		echo "<li><a href=write.php?upper=0>글쓰기</a></li>\n";
		$samesub=0;
		$que="select * from ".$homename."_board where upper=0";
		$result_sub=mysqli_query($connect,$que);
		while(@$check_sub=mysqli_fetch_object($result_sub)){
			$que="select * from ".$homename."_board where upper=0 and subno=".$check_sub->subno;
			$result_samesub=mysqli_query($connect,$que);
			$samesub1=0;
			while(@$check_samesub=mysqli_fetch_object($result_samesub)) $samesub1++;
			if($samesub1>1) $samesub++;
		}
		if($samesub>0) echo "<li><a href=subno_rearrange.php?no=0>목차 재정렬</a></li>\n";
		echo "<li><a href=board_backup.php>게시판 백업</a></li>\n";
	}
	echo "<li><a href=users.php>사용자 목록</a></li>\n";
	echo "<li><a href=uninstall.php>홈페이지 삭제</a></li>\n";
	echo "</ul>\n";
}
echo "<h4>사용자 메뉴</h4>\n";
echo "<ul>\n";
echo "<li><a href=user_pass.php>비밀번호 변경</a></li>\n";
echo "<li><a href=user_del.php>계정 삭제</a></li>\n";
echo "</ul>\n";


include "foot.php";
?>
