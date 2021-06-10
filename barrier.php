<?
$ip_ok=0;
$fp=@fopen("data/authorized_ip.txt","r");
if($fp){
	while(($buffer=fgets($fp,4096))!==false){
		if($_SERVER['REMOTE_ADDR']==trim($buffer)) $ip_ok++;
	}
}
if(($ip_ok==0)&&(!is_mobile())){
	echo "unauthoized address(".$_SERVER['REMOTE_ADDR'].")\n";
	exit;
}
?>
