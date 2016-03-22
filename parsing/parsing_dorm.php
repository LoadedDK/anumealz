<!-- 생활관 파트2 -->
<?include "/var/www/html/anumealz/lib.php";?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>오늘 밥 뭐야?</title>
</head>
<body>
<?
$now = date("Ymd");
$now_year = substr($now,0,4);
$now_month = substr($now,4,2);
$now_day = substr($now,6,2);

$url = 'http://dorm.andong.ac.kr/2014/food_menu/food_menu.htm?year='.$now_year.'&month='.$now_month.'&day='.$now_day;
$content = file_get_contents($url);
$content = iconv("CP949","UTF-8",$content);

echo "내용 : ".$content;

$yo = date('w');

switch($yo) {
	case 0 :
	$yo = 7;
	break;
}

for($i=$yo;$i<=7;$i++) { 
//요일

//$regi_date = date("Ymd",strtotime ($i-date('w').'days'));
$regi_date = date("Ymd",strtotime ($i-$yo.'days'));
$regi_date_year = substr($regi_date,0,4);
$regi_date_month = substr($regi_date,4,2);
$regi_date_day = substr($regi_date,6,2);
$query_first = "select * from menu_daily where year='$regi_date_year' and month='$regi_date_month'";//중복검사용
		switch($i)
		{
			case 1 :
					$dow = "월요일";
				break;
			case 2 :
					$dow = "화요일";		
				break;
			case 3 :
					$dow = "수요일";
				break;
			case 4 :
					$dow = "목요일";
				break;
			case 5 :
					$dow = "금요일";
				break;
			case 6 :
					$dow = "토요일</span>";
				break;
			case 7 :
					$dow = "일요일</span>";
				break;
		}
					
		$temp = @explode($dow.'</td>', $content); 
		$temp = @explode('</tr>', $temp[1]); 
		$menu = $temp[0]; 
		
		$menu_b_temp = @explode("<td  >", $menu); 
		$menu_b = $menu_b_temp[1];
		
		$menu_b = change_str($menu_b);
		if($menu_b) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='1'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_b) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
				mysql_query("insert into menu_daily(year,month,day,loca,type,content)
				values('$regi_date_year','$regi_date_month','$regi_date_day','s','1','$menu_b')");
				echo $regi_date_month."월 ".$regi_date_day."일 아침 등록완료<br/>";
				echo $regi_date_month."월 ".$regi_date_day."일 아침 : ".$menu_b."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 아침없음<br/>";
		}
		$menu_l_temp = @explode("</td>", $menu_b_temp[2]); 
		$menu_l = $menu_l_temp[0];
		$menu_l = change_str($menu_l);
		if($menu_l) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='2'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_l) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
			mysql_query("insert into menu_daily(year,month,day,loca,type,content)
			values('$regi_date_year','$regi_date_month','$regi_date_day','s','2','$menu_l')");
			echo $regi_date_month."월 ".$regi_date_day."일 점심 등록완료<br/>";
			echo $regi_date_month."월 ".$regi_date_day."일 점심 : ".$menu_l."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 점심없음<br/>";
		}
		$menu_d = array();
		$menu_d_temp = @explode("<td  class='last'>", $menu_b_temp[2]); 
		$menu_d = $menu_d_temp[1];
		$menu_d = change_str($menu_d);
		if($menu_d) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='3'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_d) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
			mysql_query("insert into menu_daily(year,month,day,loca,type,content)
			values('$regi_date_year','$regi_date_month','$regi_date_day','s','3','$menu_d')");
			echo $regi_date_month."월 ".$regi_date_day."일 저녁 등록완료<br/>";
			echo $regi_date_month."월 ".$regi_date_day."일 저녁 : ".$menu_d."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 저녁없음<br/>";
		}
}

$next = date("Ymd",strtotime ('+7 days'));
$next_year = substr($next,0,4);
$next_month = substr($next,4,2);
$next_day = substr($next,6,2);

$url = 'http://dorm.andong.ac.kr/2014/food_menu/food_menu.htm?year='.$next_year.'&month='.$next_month.'&day='.$next_day;
$content = file_get_contents($url);
$content = iconv("CP949","UTF-8",$content);

for($i=1;$i<=7;$i++) { 
$regi_date = date("Ymd",strtotime (7-$yo+$i.' days'));
$regi_date_year = substr($regi_date,0,4);
$regi_date_month = substr($regi_date,4,2);
$regi_date_day = substr($regi_date,6,2);
$query_first = "select * from menu_daily where year='$regi_date_year' and month='$regi_date_month'";//중복검사용
		switch($i)
		{
			case 1 :
					$dow = "월요일";
				break;
			case 2 :
					$dow = "화요일";		
				break;
			case 3 :
					$dow = "수요일";
				break;
			case 4 :
					$dow = "목요일";
				break;
			case 5 :
					$dow = "금요일";
				break;
			case 6 :
					$dow = "토요일</span>";
				break;
			case 7 :
					$dow = "일요일</span>";
				break;
		}
					
		$temp = @explode($dow.'</td>', $content); 
		$temp = @explode('</tr>', $temp[1]); 
		$menu = $temp[0]; 

		$menu_b_temp = @explode("<td  >", $menu); 
		$menu_b = $menu_b_temp[1];
		
		$menu_b = change_str($menu_b);
		if($menu_b) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='1'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_b) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
			mysql_query("insert into menu_daily(year,month,day,loca,type,content)
			values('$regi_date_year','$regi_date_month','$regi_date_day','s','1','$menu_b')");
			echo $regi_date_month."월 ".$regi_date_day."일 아침 등록완료<br/>";
			echo $regi_date_month."월 ".$regi_date_day."일 아침 : ".$menu_b."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 아침없음<br/>";
		}
		$menu_l_temp = @explode("</td>", $menu_b_temp[2]); 
		$menu_l = $menu_l_temp[0];
		$menu_l = change_str($menu_l);
		if($menu_l) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='2'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_l) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
			mysql_query("insert into menu_daily(year,month,day,loca,type,content)
			values('$regi_date_year','$regi_date_month','$regi_date_day','s','2','$menu_l')");
			echo $regi_date_month."월 ".$regi_date_day."일 점심 등록완료<br/>";
			echo $regi_date_month."월 ".$regi_date_day."일 점심 : ".$menu_l."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 점심없음<br/>";
		}
		$menu_d = array();
		$menu_d_temp = @explode("<td  class='last'>", $menu_b_temp[2]); 
		$menu_d = $menu_d_temp[1];
		$menu_d = change_str($menu_d);
		if($menu_d) {			
			//중복검사
			$result = mysql_query($query_first." and day='$regi_date_day' and loca='s' and type='3'");
			$data = mysql_fetch_array($result);
			if($data) {
				echo "중복걸러내기";
			} elseif(strlen($menu_d) < 20) {
				echo "빈 값이므로 DB 저장 안 함.";
			} else {
			mysql_query("insert into menu_daily(year,month,day,loca,type,content)
			values('$regi_date_year','$regi_date_month','$regi_date_day','s','3','$menu_d')");
			echo $regi_date_month."월 ".$regi_date_day."일 저녁 등록완료<br/>";
			echo $regi_date_month."월 ".$regi_date_day."일 저녁 : ".$menu_d."<br/>";
			}
		} else {
		echo $regi_date_month."월 ".$regi_date_day."일".$dow." 저녁없음<br/>";
		}
}
?>

</body>
</html>
