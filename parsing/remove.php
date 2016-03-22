<!-- DB삭제 -->
<?include "/var/www/html/anumealz/lib.php";?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<?
$now = date("Ymd");
$now_year = substr($now,0,4);
$now_month = substr($now,4,2);
$now_day = substr($now,6,2);

mysql_query("delete from menu_daily where year<='$now_year' and month<='$now_month' and day<'$now_day'");
echo $now_year.$now_month.$now_day;
?>
</body>
</html>
