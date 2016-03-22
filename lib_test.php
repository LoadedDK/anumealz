<?
$conn = mysql_connect("localhost","root","9801");
mysql_select_db("anumealzTest");
mysql_query("set names utf8",$conn); 


function writeConnLog() {

	
        //user_agent : 안드로이드앱/Android, 아이폰웹앱/iPhone
        $ip =  $_SERVER['REMOTE_ADDR'];
        $j = 0;
	$dot = 0;
        $val = ' ';
        for($i=strlen($ip);$dot != 2;$i--) {
		if($ip[$i] == '.')
			$dot++;
		if($dot == 2)
			break;	
	        $val[$j++] = $ip[$i];
        }
        $ip = ' ';
        for($i=0;$i < strlen($val);$i++) {
                $ip[strlen($val)-1-$i] = $val[$i];
        }
        if(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone"))
                $user_agent = 'iPhone';
        elseif($_SERVER['HTTP_USER_AGENT'] == "webview")
                $user_agent = 'Android';
	else
                $user_agent = 'Nothing';
	//이전 기록 확인 쿼리
	$query = "SELECT * FROM statistics WHERE ip='$ip' AND user_agent='$user_agent' AND TIMESTAMPDIFF(minute, req_datetime, NOW())<'5' ORDER BY pk DESC LIMIT 1";
	$result = mysql_query($query);
	$data = mysql_fetch_array($result);
	//5분 이내에 접속된 동일 사용자 기록이 없을 경우에만. DB 입력
	if($data == NULL)
		mysql_query("INSERT INTO statistics(req_datetime, user_agent, ip) VALUES(NOW(), '$user_agent', '$ip')");
}


//DB에 저장된 요일 숫자를 문자열로 변환
function getYoStr($yo) {
	switch($yo)
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
			$dow = "토요일";
			break;
		case 0 :
			$dow = "일요일";
			break;
	}
	return $dow;
}

//DB에 저장된 type 값 1,2,3을 각각 아침,점심,저녁으로 변환
function getTypeStr($strtype) {
	switch($strtype)
	{
		case "1" :
			$strtype = "아침";
			break;
		case "2" :
			$strtype = "점심";
			break;
		case "3" :
			$strtype = "저녁";
	}
	return $strtype;
}



function change_str($day) {
	
	$day = str_replace("\r\n"," ",$day);
	$day = str_replace("\n"," ",$day);
	$day = str_replace("\r"," ",$day);

	$day = strip_tags($day,"<br>");
	while(1) {
		if(stripos($day,"      "))
			$day = str_replace("      ","<br/>",$day);
		elseif(stripos($day,"     "))
			$day = str_replace("     ","<br/>",$day);
		elseif(stripos($day,"    "))
			$day = str_replace("    ","<br/>",$day);
		elseif(stripos($day,"   "))
			$day = str_replace("   ","<br/>",$day);
		elseif(stripos($day,"  "))
			$day = str_replace("  ","<br/>",$day);
		elseif(stripos($day," "))
			$day = str_replace(" ","<br/>",$day);
		else 
			break;
	}
	return $day;
}

function movepage($url) {
echo "
	<script>
	self.location='$url';
	</script>
";
}

function alert($msg) {
echo "
	<script>
	alert('$msg');
	</script>
";
}

function alertback($msg) {
echo "
	<script>
	alert('$msg');
	history.back();
	</script>
";
}


?>
