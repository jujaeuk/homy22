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
	$bigcategory=array("루틴","일","공부","취미");
	$category=array("국내서","외국서","논문읽기","폐업","AI","금융허브","창업","RDS","파이썬","딥러닝","미디");
	$sum_bigcate=array_fill(0,4,0);
	$sum_cate=array_fill(0,11,0);
	
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
				elseif($i<10) $sum_bigcate[2]+=$intime;
				else $sum_bigcate[3]+=$intime;
			}
		}
	}
	$sum_total=0;
	for($i=0;$i<sizeof($category);$i++){
		echo "<tr><td>".$category[$i]."</td><td align=right>".$sum_cate[$i]."</td></tr>";
		$sum_total+=$sum_cate[$i];
	}
	for($j=0;$j<sizeof($bigcategory);$j++){
		echo "<tr>";
		if($j==0) echo "<td style=\"border-top: 1px grey dotted;\">";
		else echo "<td>";
		printf("%s</td>",$bigcategory[$j]);
		if($j==0) echo "<td style=\"text-align: right; border-top: 1px grey dotted;\">";
		else echo "<td align=right>";
		printf("%d(%4.1f)</td></tr>", $sum_bigcate[$j], $sum_bigcate[$j]/$sum_total*100);
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
stat_print($thisweekstart, $homename, $connect);
stat_print($thisweekstart-7*24*60*60, $homename, $connect);
stat_print($thisweekstart-14*24*60*60, $homename, $connect);
echo "</tr></table>";

include "log_menu.php";

include "foot.php";
?>