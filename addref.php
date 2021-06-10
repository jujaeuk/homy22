<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>참조 추가</h4>\n";
echo "<form method=post action=addref_ok.php>\n";
echo "본글 : <input class=addref type=text name=origin value=".$_GET['no']."> / 참조 목록에 추가 : <input class=addref type=text name=ref>\n";
echo "<input type=submit value=add></form>\n";
include "foot.php";
?>