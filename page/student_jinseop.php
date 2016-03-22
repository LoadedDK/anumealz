<div id="wrapper">
<div id="head">
	<div class="logo">
	오늘 <span class="logo_o">밥</span> 뭐야?
	</div>
</div>
<div id="body">
	<div class="student">
		<div class="student_title">
		<span class="content_location_font_a">학생</span>식당 자세히보기<br />
		</div>
		<?
		include "../lib.php";

		$diff = time() - strtotime(date('Y-m-d 00:00:00'));     //00:00:00로부터 지난 시간.seconds.
		$diff = floor($diff / 60);      //seconds to minute

		//현재 시간 구하기
		$now = date("Ymd");
                $now_year = date('Y');
                $now_month = date('m');
                $now_day = date('d');

		//내일 시간 구하기
		$next_date = date("Ymd",strtotime ("+1 days"));
		$next_year = substr($next_date,0,4);
		$next_month = substr($next_date,4,2);
		$next_day = substr($next_date,6,2);


		$query_first = "select * from menu_daily where loca='h'";
                $query_second_now = "and year = '$now_year' and month = '$now_month' and day = '$now_day'";
                $query_second_next = "and year >= '$next_year' and month >= '$next_month' and day >= '$next_day'";


		//오늘의 시간 경과에 따른 식단
		if($diff <= 810 && $diff >= 0) { // 00:00 ~ 13:30
                        $flagtype = 2;
			$result = mysql_query($query_first.$query_second_now." and type>=$flagtype order by year,month,day,type asc");
		}
                else if($diff <= 1110 && $diff >= 811) { // 13:31 ~ 18:30
                        $flagtype = 3;
			$result = mysql_query($query_first.$query_second_now." and type>=$flagtype order by year,month,day,type asc");
		}

		while($data = mysql_fetch_array($result)) {
                $yo = date('w', strtotime(date($data['year'].'-'.$data['month'].'-'.$data['day'])));
                $dow = getYoStr($yo);
                $type = getTypeStr($data['type']);
                ?>
                <div class="content_date">

                <?
                echo $data['month']."월 ".$data['day']."일 ".$dow." ".$type;?>
                </div>
                <?echo $data['content'];?>
                <br /><br />
                <?
		}

		//내일부터의 식단
                $flagtype = 2;
		$result = mysql_query($query_first.$query_second_next." and type>=$flagtype order by year,month,day,type asc");

		while($data = mysql_fetch_array($result)) {
			
		$yo = date('w', strtotime(date($data['year'].'-'.$data['month'].'-'.$data['day'])));
                $dow = getYoStr($yo);
                $type = getTypeStr($data['type']);
		?>
		<div class="content_date">
		<?echo $data['month']."월 ".$data['day']."일 ".$dow." ".$type;?>
		</div>
		<?echo $data['content'];?>
		<br /><br />
		<?
		}
		?>
		<div class="content_button">
		<input type="button" value="돌아가기" onclick="document.location='#index'" data-inline="true" data-theme="a" data-corners="false" />
		</div>
</div>
<div id="footer">
</div>
</div>
</div>
