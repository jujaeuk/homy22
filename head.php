<!doctype html>
<? session_start();?>
<html>
<head>
<title>homy 22 dev</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?
if(!is_mobile()) echo "<div class=desktop>\n";
if(isset($homename)) echo "<h3>$homename</h3>\n";
?>
