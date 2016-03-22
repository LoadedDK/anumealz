<? include "../lib.php"; ?>
<html>
<head>
<meta charset="utf-8" />
<title>오늘 밥 뭐야?</title>
<script>
setTimeout("location.reload(true)",6000);
</script>
</head>
<body>
<h2><?echo "기준 : ".date("Y-m-d H:i:s");?></h2>
<table border="1"cellspacing="0" width="400" cellpadding="5">
	<tr  align="center">
		<th width="100"></th>
		<th width="100" bgcolor="#BCE55C">안드로이드</th>
		<th width="100" bgcolor="#B2EBF4">아이폰</th>
		<th width="100" bgcolor="#FFBB00">전 체</th>
	</tr>
	<tr  align="center">
		<th width="100">전체 기간</th>
		<td>
				<?$result = mysql_query("SELECT COUNT(pk) as count, user_agent FROM statistics GROUP BY user_agent ORDER BY user_agent ASC");
				$data = mysql_fetch_array($result);
				$And_count = 0 + $data['count'];
				echo $And_count; ?>	
		</td>
		<td>
				<?$data = mysql_fetch_array($result);
				$iPhone_count = 0 + $data['count'];
				echo $iPhone_count;?>
		</td>
		<td>
				<?$Total_count = 0 + $And_count + $iPhone_count;
				echo $Total_count;?>
	</tr>
	<tr  align="center">
		<th width="100">오늘</th>
		<td>
                                <?$result = mysql_query("SELECT COUNT(pk) as count, user_agent FROM statistics WHERE DATE(req_datetime)=DATE_ADD(DATE(now()), interval 0 day) GROUP BY user_agent");
                                $data = mysql_fetch_array($result);
                                $And_count = 0 + $data['count'];
                                echo $And_count; ?>
                </td>
                <td>
                                <?$data = mysql_fetch_array($result);
                                $iPhone_count = 0 + $data['count'];
                                echo $iPhone_count;?>
                </td>
                <td>
                                <?$Total_count = 0 + $And_count + $iPhone_count;
                                echo $Total_count;?>
		</td>
	</tr>
        <tr  align="center">
                <th width="100">어제</th>
                <td>
                                <?$result = mysql_query("SELECT COUNT(pk) as count, user_agent FROM statistics WHERE DATE(req_datetime)=DATE_ADD(DATE(now()), interval -1 day) GROUP BY user_agent");
                                $data = mysql_fetch_array($result);
                                $And_count = 0 + $data['count'];
                                echo $And_count; ?>
                </td>
                <td>
                                <?$data = mysql_fetch_array($result);
                                $iPhone_count = 0 + $data['count'];
                                echo $iPhone_count;?>
                </td>
                <td>
                                <?$Total_count = 0 + $And_count + $iPhone_count;
                                echo $Total_count;?>
                </td>
        </tr>
        <tr  align="center">
                <th width="100">이번 달</th>
                <td>
                                <?$result = mysql_query("SELECT COUNT(pk) as count, user_agent FROM statistics WHERE DATE_FORMAT(req_datetime, '%Y-%m')=DATE_FORMAT(now(), '%Y-%m') GROUP BY user_agent");
                                $data = mysql_fetch_array($result);
                                $And_count = 0 + $data['count'];
                                echo $And_count; ?>
                </td>
                <td>
                                <?$data = mysql_fetch_array($result);
                                $iPhone_count = 0 + $data['count'];
                                echo $iPhone_count;?>
                </td>
                <td>
                                <?$Total_count = 0 + $And_count + $iPhone_count;
                                echo $Total_count;?>
                </td>
        </tr>
        <tr  align="center">
                <th width="100">지난 달</th>
                <td>
                                <?$result = mysql_query("SELECT COUNT(pk) as count, user_agent FROM statistics WHERE DATE_FORMAT(req_datetime, '%Y-%m')=DATE_FORMAT(DATE_ADD(DATE(now()), interval -1 month), '%Y-%m') GROUP BY user_agent");
                                $data = mysql_fetch_array($result);
                                $And_count = 0 + $data['count'];
                                echo $And_count; ?>
                </td>
                <td>
                                <?$data = mysql_fetch_array($result);
                                $iPhone_count = 0 + $data['count'];
                                echo $iPhone_count;?>
                </td>
                <td>
                                <?$Total_count = 0 + $And_count + $iPhone_count;
                                echo $Total_count;?>
                </td>
        </tr>



</table>
<br/><br/>
<?
//월
if($_GET['mon']) $calMon = $_GET['mon']; //초기화
else $calMon = date('m');

if($calMon == 12) $next_mon = sprintf("%02d", 1); //다음월 구하기
else $next_mon = sprintf("%02d", $calMon + 1);

if($calMon == 1) $prev_mon = 12; //이전월 구하기
else $prev_mon = sprintf("%02d", $calMon - 1);

//년
if($_GET['year']) $calYear = $_GET['year']; //초기화
else $calYear = date('Y');

if($calMon == 12) $next_year = $calYear + 1; //다음년 구하기
else $next_year = $calYear;
if($calMon == 1) $prev_year = $calYear - 1; //이전년 구하기
else $prev_year = $calYear;
?>
<input type="button" value="<<이전" onclick="document.location='./statistics.php?year=<?echo $prev_year; ?>&mon=<?echo $prev_mon; ?>'" />
<? 
	echo "<b>".$calYear."년 ".$calMon."월 </b>";
?>
<input type="button" value="다음>>" onclick="document.location='./statistics.php?year=<?echo $next_year; ?>&mon=<?echo $next_mon; ?>'" />
<br/><br/>
<?
        $i = 0;
        $col = 0;
        $row = 1;
        $damon;
        $dadata = array();
        $result = mysql_query("SELECT date, count, WEEKDAY(date) as week FROM (SELECT DATE_FORMAT(req_datetime, '%Y-%m-%d') as date, COUNT(pk) as count FROM statistics WHERE DATE_FORMAT(req_datetime, '%Y-%m')=DATE_FORMAT(DATE_ADD(DATE(now()), interval 0 month), '$calYear-$calMon') GROUP BY DATE_FORMAT(req_datetime, '%Y-%m-%d')) as q1");
        while($data = mysql_fetch_array($result)) {
                $dadata[$i]['date'] = $data['date'];
                $dadata[$i]['count'] = $data['count'];
                $dadata[$i]['week'] = $data['week'];
                $damon = substr($data['date'],5,2);
                $i++;
        }
?>
        <table border="1"cellspacing="0" width="700" cellpadding="5">
                <tr  align="center">
                        <th width="100" bgcolor="#BCE55C">월</th>
                        <th width="100" bgcolor="#B2EBF4">화</th>
                        <th width="100" bgcolor="#FFBB00">수</th>
                        <th width="100" bgcolor="#BCE55C">목</th>
                        <th width="100" bgcolor="#B2EBF4">금</th>
                        <th width="100" bgcolor="#FFBB00">토</th>
                        <th width="100" bgcolor="#BCE55C">일</th>
                </tr>
<?
        //한 달의 첫 요일 전까지의 row를 그린다.
        $i = 0;
        echo "<tr  align='center'>";
        while($i < $dadata[0]['week']) {
                echo "<td width='100'></td>";
                $i++;
        }

        //날짜가 있는 날을 그린다.
        $i = 0;
        while($i<count($dadata)) {
                if($dadata[$i]['week'] == 0) {//월요일
                        echo "<tr  align='center'>
                                <td width='100'><span style='float:left;font-size:12px;'>".substr($dadata[$i]['date'],8,2)."</span><br/>".$dadata[$i]['count']."</td>";
                }
                else if($dadata[$i]['week'] == 5) {//토요일
                        echo "<td width='100'><span style='float:left;font-size:12px;color:blue;'>".substr($dadata[$i]['date'],8,2)."</span><br/>".$dadata[$i]['count']."</td>";
                }

                else if($dadata[$i]['week'] == 6) {//일요일
                        echo "<td width='100'><span style='float:left;font-size:12px;color:red;'>".substr($dadata[$i]['date'],8,2)."</span><br/>".$dadata[$i]['count']."</td>
                                </tr>";
                        $row++;
                }
                else {//나머지
                        echo "<td width='100'><span style='float:left;font-size:12px;'>".substr($dadata[$i]['date'],8,2)."</span><br/>".$dadata[$i]['count']."</td>";
                }
                $i++;
        }
        for($i = $dadata[$i-1]['week'];$i<6;$i++) {
                echo "<td width='100'> </td>";
        }
        echo "</tr>";
?>

        </table>

<h3>Log</h3>
<p style="font-size:11pt;">
<?
;$result = mysql_query("SELECT * FROM statistics WHERE DATE(req_datetime)=DATE(now()) ORDER BY pk DESC");
while($data = mysql_fetch_array($result)) {
	echo '접속기기 : '.$data['user_agent'].' / ';
	echo '접속시간 : '.$data['req_datetime'].' / ';
	echo '아이피 : <b>'.$data['ip'].'</b><br/>';
}

?>
</p>
</body>
</html>
