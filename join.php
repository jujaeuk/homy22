<?
include "lib.php";
include "head.php";
?>
<h4>아이디 생성</h4>
<form method=post action=join_ok.php>
<table>
<tr><td>username</td><td><input type=text name=username></td></tr>
<tr><td>password</td><td><input type=password name=password1></td></tr>
<tr><td>retype password</td><td><input type=password name=password2></td></tr>
<tr><td colspan=2 align=center><input type=submit value=만들기></td></tr>
</table>
</form>
<?
include "foot.php";
?>