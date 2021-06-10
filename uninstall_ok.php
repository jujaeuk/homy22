<?
include "lib.php";
include "data/db_access.php";
$files=glob("data/*");
foreach($files as $file)
  if(is_file($file)) unlink($file);
rmdir("data");
$files=glob("files/*");
foreach($files as $file)
  if(is_file($file)) unlink($file);
rmdir("files");

$que="drop table ".$homename."_users, ".$homename."_board, ".$homename."_files, ".$homename."_ref, ".$homename."_log";
mysqli_query($connect,$que);

setcookie("user", $_COOKIE['user'],time()-3600,".");

echo "<meta http-equiv=\"refresh\" content=\"0;url=install.php\">\n";
?>
