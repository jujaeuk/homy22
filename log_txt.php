<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>로그</h4>\n";
echo "<form method=post enctype=\"multipart/form-data\" action=log_txt_ok.php>\n";
echo "<input type=file name=file><input type=submit value=upload>\n";
echo "</form>\n";

include "foot.php";
?>