<?
include "lib.php";
include "barrier.php";
include "data/db_access.php";

include "head.php";
include "login.php";

echo "<h4>비밀번호 변경</h4>\n";
echo "<form method=post action=user_pass_ok.php>\n";
echo "<table>\n";
echo "<tr><td>현재 비밀번호</td><td><input type=password name=old_pass></td></tr>\n";
echo "<tr><td>새 비밀번호</td><td><input type=password name=new_pass1></td></tr>\n";
echo "<tr><td>새 비밀번호 확인</td><td><input type=password name=new_pass2></td></tr>\n";
echo "<tr><td colspan=2 align=center><input type=submit value=변경></td></tr>\n";
echo "</form>\n";

include "foot.php";
?>