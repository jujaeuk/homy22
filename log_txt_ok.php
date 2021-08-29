<?
include "lib.php";
include "data/db_access.php";
$fp=fopen($_FILES['file']['tmp_name'],'r');

$year=date("Y");
$month=date("m");
$day=date("d");

$string=fgets($fp);
while(!feof($fp)){
	if(preg_match("/^[0-9]{6,8}/",$string)){
		if(preg_match("/^[0-9]{6}[^0-9]/",$string)) $string="20".$string;
		$year=intval(substr($string, 0, 4));
		$month=intval(substr($string, 4, 2));
		$day=intval(substr($string, 6, 2));
	}
	elseif(preg_match("/^[0-9]{4}/",$string)){
		if(preg_match("/^[0-9]{4} /",$string)){
			$hour_s=intval(substr($string, 0, 2));
			$min_s=intval(substr($string, 2, 2));
			$hour_e=$hour_s;
			$min_e=$min_s;
			$string=trim(substr($string, 4));
		}
		elseif(preg_match("/^[0-9]{4}-[0-9]{4}/",$string)){
			$hour_s=intval(substr($string, 0, 2));
			$min_s=intval(substr($string, 2, 2));
			$hour_e=intval(substr($string, 5, 2));
			$min_e=intval(substr($string, 7, 2));
			$string=trim(substr($string, 9));
		}
		$start=mktime($hour_s, $min_s, 0, $month, $day, $year);
		$end=mktime($hour_e, $min_e, 0, $month, $day, $year);
		$loss=0;
		if(preg_match("/[(][-][:]\d*[)]/", $string, $match)){
			$loss=intval(substr($match[0], 3, -1));
			$string=trim(str_replace($match[0],"",$string));
		}
		if(preg_match("/[(][a-zA-Z0-9가-힣]*[)]/",$string, $match)){
			$category=substr($match[0], 1, -1);
			$content=trim(str_replace($match[0], "", $string));
		}
		$que="insert into ".$homename."_log (start, end, loss, category, content) values($start, $end, $loss, '$category', '$content')";
		mysqli_query($connect, $que);
	}
}
fclose($fp);
?>
<meta http-equiv="refresh" content="0;url=log.php">