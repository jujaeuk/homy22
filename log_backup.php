<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

$now=time();
$fpc=fopen("data/log.csv","w");
$fpt=fopen("data/log.txt","w");
fwrite($fpc,"start,end,loss,category,content\n");
$que="select * from ".$homename."_log where due is null order by start";
$result=mysqli_query($connect,$que);
$i=0;
while(@$check=mysqli_fetch_object($result)){
  fwrite($fpc, date("Y-m-d H:i:s",$check->start).",");
  fwrite($fpc, date("Y-m-d H:i:s",$check->end).",");
  fwrite($fpc,$check->loss.",\"".$check->category."\",\"".html_entity_decode($check->content,ENT_QUOTES)."\"\n");
  if($date!=date("Ymd",$check->start)){
    if($i!=0) fwrite($fpt,"\n");
    fwrite($fpt,date("Ymd.D",$check->start)."\n");
  }
  fwrite($fpt,date("Hi",$check->start));
  if($check->end>0){
    fwrite($fpt,"-".date("Hi",$check->end));
    if($check->loss>0) fwrite($fpt, " (-:$check->loss)");
  }
  fwrite($fpt," (".$check->category.") ".html_entity_decode($check->content,ENT_QUOTES)."\n");
  $i++;
  $date=date("Ymd",$check->start);
}
fclose($fpc);
fclose($fpt);

echo "<h4>로그 백업</h4>\n";
echo "<a href=data/log.csv>log.csv</a> <a href=data/log.txt>log.txt</a>\n";

include "log_menu.php";

include "foot.php";
?>
