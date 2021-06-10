<?
include "lib.php";
include "head.php";
?>
<h4>install</h4>
<form method=post action=install_ok.php>
<table>
<tr><td>home name</td><td><input type=text name=homename></td></tr>
<tr><td>host</td><td><input type=text name=host></td></tr>
<tr><td>db user</td><td><input type=text name=user></td></tr>
<tr><td>db password</td><td><input type=password name=password></td></tr>
<tr><td>db name</td><td><input type=text name=db></td></tr>
<tr><td>admin name</td><td><input type=text name=admin></td></tr>
<tr><td>admin password</td><td><input type=password name=admpw></td></tr>
<tr><td>ip address</td><td><input type=text name=ip value='<? echo $_SERVER['REMOTE_ADDR']; ?>'></td></tr>
<tr><td colspan=2 align=center><input type=submit value=install></td><tr>
</table>
</form>
<?
include "foot.php";
?>
