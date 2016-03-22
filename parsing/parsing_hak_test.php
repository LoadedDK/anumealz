<!-- 학생식당 파싱 -->
<?include "/var/www/html/anumealz/lib_test.php";?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>오늘 밥 뭐야?</title>
</head>
<body>
<?
for($i=0;$i<14;$i++) {

$regi_date = date("Ymd",strtotime ('+'.$i.'days'));
$regi_date_year = substr($regi_date,0,4);
$regi_date_month = substr($regi_date,4,2);
$regi_date_day = substr($regi_date,6,2);	

$query_first = "select * from menu_daily where year='$regi_date_year' and month='$regi_date_month'";//중복검사용

//if($regi_date_day < 10) $regi_date_day = "0".$regi_date_day;
$url = 'http://www.andong.ac.kr/index.sko?menuCd=AA06003005000&strDate='.$regi_date_year.'-'.$regi_date_month.'-'.$regi_date_day;
$content = file_get_contents($url);

$temp = @explode('<!-- bbs_view S -->', $content); 
$temp = @explode('<!-- bbs_view E -->', $temp[1]); 

$temp_l = @explode('<span>중식</span>', $temp[0]); 
$temp_l = @explode('</tr>', $temp_l[1]); 
$lunch = strip_tags($temp_l[0],"<br>");
$lunch = str_replace("\r\n","",$lunch);
$lunch = str_replace("\n","",$lunch);
$lunch = str_replace("\r","",$lunch);
$lunch = str_replace(" ","",$lunch);
$lunch = str_replace("<br/><br/>","<br/>",$lunch);
if($lunch) {
	$result = mysql_query($query_first." and day='$regi_date_day' and loca='h' and type='2'");
	$data = mysql_fetch_array($result);
	if($data) {
		echo "중복걸러내기";
	} else {
	mysql_query("insert into menu_daily(year,month,day,loca,type,content)
		values('$regi_date_year','$regi_date_month','$regi_date_day','h','2','$lunch')");
		echo $regi_date_month."월 ".$regi_date_day."일 점심 등록완료<br/>";
	}
} else {
		echo $regi_date_month."월 ".$regi_date_day."일 점심 없음<br/>";
}
$temp_d = @explode('<span>석식</span>', $temp[0]); 
$temp_d = @explode('</tr>', $temp_d[1]); 
$dinner = strip_tags($temp_d[0],"<br>");
$dinner = str_replace("\r\n","",$dinner);
$dinner = str_replace("\n","",$dinner);
$dinner = str_replace("\r","",$dinner);
$dinner = str_replace(" ","",$dinner);
$dinner = str_replace("<br/><br/>","<br/>",$dinner);
if($dinner) {
	$result = mysql_query($query_first." and day='$regi_date_day' and loca='h' and type='3'");
	$data = mysql_fetch_array($result);
	if($data) {
		echo "중복걸러내기";
	} else {
	mysql_query("insert into menu_daily(year,month,day,loca,type,content)
		values('$regi_date_year','$regi_date_month','$regi_date_day','h','3','$dinner')");
		echo $regi_date_month."월 ".$regi_date_day."일 저녁 등록완료<br/>";
	}
} else {
		echo $regi_date_month."월 ".$regi_date_day."일 저녁 없음<br/>";
}
}
?>
</body>
</html>
