<?
if(!$_POST['homename']){
	echo "ERROR: no home name\n";
	exit;
}
mkdir("files");
mkdir("data");
$fp=fopen("data/db_access.php","w");
fwrite($fp, "<?\n\$homename=\"".$_POST['homename']."\";\n\$host=\"".$_POST['host']."\";\n\$user=\"".$_POST['user']."\";\n\$password=\"".$_POST['password'].
	"\";\n\$db=\"".$_POST['db']."\";\n");
fwrite($fp, "\$connect=mysqli_connect(\$host,\$user,\$password,\$db) or die(\"DB connection error\");\n?>\n");
fclose($fp);

$fp=fopen("data/authorized_ip.txt","wt");
fwrite($fp,$_POST['ip']."\n");
fclose($fp);

include "data/db_access.php";
$que="create table ".$_POST['homename']."_users(
	no int not null auto_increment,
	unique(no),
	primary key(no),
	name char(32),
	password char(32))";
mysqli_query($connect,$que);

$que="create table ".$_POST['homename']."_board(
	no int not null auto_increment,
	unique(no),
	primary key(no),
	title char(128),
	time int,
	writer char(32),
	content text,
	upper int,
	order_lower char(16) default 'time',
	subno int default 1)";
mysqli_query($connect,$que);

$que="create table ".$_POST['homename']."_files(
	no int not null auto_increment,
	unique(no),
	primary key(no),
	boardno int,
	filename char(128))";
mysqli_query($connect,$que);

$que="create table ".$_POST['homename']."_ref(
	no int not null auto_increment,
	primary key(no),
	origin int,
	ref int)";
mysqli_query($connect,$que);

$que="create table ".$_POST['homename']."_log(
	no int not null auto_increment,
	unique(no),
	primary key(no),
	start int,
	end int,
	loss int default 0,
	category char(32),
	content char(128),
	due int,
	up int)";
mysqli_query($connect,$que);

$crypt_pass=crypt($_POST['admpw'],'onlyone');
$que="insert into ".$_POST['homename']."_users (name, password) values('".$_POST['admin']."', '".$crypt_pass."')";
mysqli_query($connect,$que);

echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">\n";
?>