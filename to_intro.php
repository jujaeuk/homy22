<?
include "data/db_access.php";
$fp=fopen("data/intro.php","w");
fwrite($fp,"<?\n\$intro=".$_GET['no'].";\n?>");
fclose($fp);
echo "<meta http-equiv=\"refresh\" content=\"0;url=read.php?no=".$_GET['no']."\">\n";
?>

