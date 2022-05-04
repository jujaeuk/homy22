<?
$now=time();
function weekdate($datein){
}

function weekstart($now){
	$weekday=date("w",$now);
	$start=$now+(-$weekday+1)*24*60*60;
	$year=date("Y",$start);
	$month=date("m",$start);
	$day=date("d",$start);
	$dateout=mktime(0,0,0,$month,$day,$year);
	return $dateout;
}

$thisweekstart=weekstart($now);

function stat_print($thisweekstart, $homename, $connect){
	$bigcategory=array("독서","연구업무","기타업무","공부1","공부2","취미","여가","기타");
	$category=array("국내서","외국서","논문읽기",
		"폐업","AI","금융","창업",
		"회의","기타업무",
		"딥러닝",
		"R","계량","공수","파이썬",
		"미디",
		"b게임","TV","만화","문화","블로그","산책","애니","영화","운동","음악","호미",
		"수면","식사","친구","가족","소셜","개인","휴식");
	$sum_bigcate=array_fill(0,count($bigcategory),0);
	$sum_cate=array_fill(0,count($category),0);
	$num_cate=array(3, 7, 9, 10, 14, 15, 26);
	
	$nextweekstart=$thisweekstart+7*24*60*60;
	
	echo "<td style=\"vertical-align: top;border-right: 1px grey dotted;\">";
	echo "<table>";
	echo date("m/d",$thisweekstart)."-".date("m/d",$thisweekstart+6*24*60*60)."<br>";
	$que="select * from ".$homename."_log where end is not null and start >= $thisweekstart and start < $nextweekstart order by start";
	$result=mysqli_query($connect,$que);
	while($check=mysqli_fetch_object($result)){
		for($i=0;$i<sizeof($category);$i++){
			$intime=round(($check->end-$check->start)/60)-$check->loss;
			if($check->category==$category[$i]){
				$sum_cate[$i]+=$intime;
				if($i<3) $sum_bigcate[0]+=$intime;
				elseif($i<7) $sum_bigcate[1]+=$intime;
				elseif($i<9) $sum_bigcate[2]+=$intime;
				elseif($i<10) $sum_bigcate[3]+=$intime;
				elseif($i<14) $sum_bigcate[4]+=$intime;
				elseif($i<15) $sum_bigcate[5]+=$intime;
				elseif($i<26) $sum_bigcate[6]+=$intime;
				else $sum_bigcate[7]+=$intime;
			}
		}
	}
	$sum_total=0;
	for($i=0;$i<sizeof($category);$i++){
		echo "<tr>";
		if(in_array($i, $num_cate)) echo "<td style=\"border-top: 1px grey dotted;\">";
		else echo "<td>";
		echo $category[$i]."</td>";
		if(in_array($i, $num_cate)) echo "<td style=\"text-align: right; border-top: 1px grey dotted;\">";
		else echo "<td align=right>";
		echo $sum_cate[$i]."</td></tr>";
		$sum_total+=$sum_cate[$i];
	}
	for($j=0;$j<sizeof($bigcategory);$j++){
		echo "<tr>";
		if($j==0) echo "<td style=\"border-top: 1px grey dotted;\">";
		else echo "<td>";
		printf("%s</td>",$bigcategory[$j]);
		if($j==0) echo "<td style=\"text-align: right; border-top: 1px grey dotted;\">";
		else echo "<td align=right>";
		printf("%d</td></tr>", $sum_bigcate[$j]);
	}
	echo "</table></td>";
	
}

include "lib.php";
include "barrier.php";
include "data/db_access.php";
include "head.php";
include "login.php";

echo "<h4>로그 주간 통계</h4>\n";

echo "<table><tr>";
if(is_mobile()) $limit=4;
else $limit=5;
for($i=0;$i<$limit;$i++){
	stat_print($thisweekstart-$i*7*24*60*60, $homename, $connect);
}
echo "</tr></table>";

include "log_menu.php";

include "foot.php";
?>