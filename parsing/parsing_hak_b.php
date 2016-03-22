<?include "/var/www/html/anumealz/lib.php";?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>오늘 밥 뭐야?</title>
</head>
<body>
<?
$k = 0;//플래그
for($i=0;$i<14;$i++) {

$regi_date = date("Ymd",strtotime ('+'.$i.'days'));
$regi_date_year = substr($regi_date,0,4);
$regi_date_month = substr($regi_date,4,2);
$regi_date_day = substr($regi_date,6,2);	


//if($regi_date_day < 10) $regi_date_day = "0".$regi_date_day;
$url = 'http://www.andong.ac.kr/index.sko?menuCd=AA06003005001&strDate='.$regi_date_year.'-'.$regi_date_month.'-'.$regi_date_day;
$content = file_get_contents($url);

$temp = @explode('<!-- bbs_view S -->', $content); 
$temp = @explode('<!-- bbs_view E -->', $temp[1]); 

$temp_l = @explode('<span>중식</span>', $temp[0]); 
$temp_l = @explode('</tr>', $temp_l[1]); 
$lunch = strip_tags($temp_l[0],"<br>");
$lunch = str_replace("\n","",$lunch);
$lunch = str_replace("\r","",$lunch);
$lunch = str_replace(" ","",$lunch);

$result = mysql_query("select * from menu_daily where year='$regi_date_year' and month='$regi_date_month' and day='$regi_date_day' and loca='h' and type='2'");
$data = mysql_fetch_array($result);



	$str_A = $data['content'];
	$str_B = $lunch;
	$str_A = str_replace("(채움)","",$str_A);
	$str_B = str_replace("(이룸)","",$str_B);



        $A = explode("<br/>", $str_A);
        $B = explode("<br/>", $str_B);
        $mcount = count($A);
		echo $str_A."<br/>";
		echo $str_B."<br/>";

        if($mcount != count($B)) {
            echo '메뉴 갯수 불일치<br>';
        } else {
            echo '메뉴 갯수 '.$mcount.'개로 일치<br>';
				
			for($j=0;$j<$mcount;$j++) {
					if(strcmp($A[$j], $B[$j]) != 0) {
							$A[$j]=$A[$j].'(채움)<br/>'.$B[$j].'(이룸)';
							$k = 1;
							echo "hello";
					}
			}
			if($k == 1) {
			$str = implode('<br/>', $A);
			echo $data['year'].$data['month'].$data['day']."<br/>";
			echo $str.'<br>';
			mysql_query("update menu_daily set content='$str' where num='$data[num]'");
			$str = NULL;
			$k = 0;
			}
		}
}
?>
</body>
</html>
