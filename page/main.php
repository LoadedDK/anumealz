<?php
include "../lib.php";
//mysql_query("INSERT INTO statistics(req_time) VALUES(NOW())");
writeConnLog();
$diff = time() - strtotime(date('Y-m-d 00:00:00'));     //00:00:00로부터 지난 시간.seconds.
$diff = floor($diff / 60);      //seconds to minutes
//시간 경과에 따라 다른 식사정보를 제공

$now_year = date("Y");
$now_month = date("m");
$now_day = date("d");

$query_first = "select * from menu_daily where year='$now_year' and month='$now_month' and day='$now_day'";
?>
<div id="wrapper">
<div id="head">
	<div class="logo">
	오늘 <span class="logo_o">밥</span> 뭐야?
	</div>
	
		
	<div class="notice" style="width:100%; text-align:center; color:red; font-size:9pt; padding:4px 0 0 0;">
	3.17 즈음 이룸관 간식메뉴가 추가될 예정입니다.
	</div>

	
	
</div>
<div id="body">
	<div id="content_a">
		<div class="content_location_a">
	        <span class="content_location_font_a">학생</span>식당(이룸관/채움관)
		</div>
        <?
		//학생식당
		if($diff <= 810 && $diff >= 0)
	        $flagday = 2;
	    else if($diff <= 1110 && $diff >= 811)
	        $flagday = 3;
	    else if($diff <= 1439 && $diff >= 1111)
	        $flagday = 4;
	    switch($flagday) {
	        case 2:
				$result = mysql_query($query_first." and loca='h' and type='2'");
				$data = mysql_fetch_array($result);
				if(isset($data['content'])) {?>
					<div class="content_date">
					오늘 점심<span class="content_date_small">(11:50~13:30)</span>
					</div>
					<div class="content_menu"><?echo $data['content'];?></div>
            <?
			break;
	        }
	        case 3:
				$result = mysql_query($query_first." and loca='h' and type='3'");
				$data = mysql_fetch_array($result);
				if(isset($data['content'])) {?>
				<div class="content_date">
				오늘 저녁<span class="content_date_small">(16:50~18:30)</span>
				</div>
				<div class="content_menu"><?echo $data['content'];?></div>
        	<?
			break;
	        }
	        case 4:
				$next_date = date("Ymd",strtotime ("+1 days"));
				$next_year = substr($next_date,0,4);
				$next_month = substr($next_date,4,2);
				$next_day = substr($next_date,6,2);
	
	            $result = mysql_query("select * from menu_daily where year='$next_year' and month='$next_month' and day='$next_day' and loca='h' AND type BETWEEN 1 AND 3 ORDER BY type ASC LIMIT 1");
	            $data = mysql_fetch_array($result);
	            if(isset($data['content'])) {
				switch($data['type']) {
				case 2:
					?>
					<div class="content_date">
						내일 점심<span class="content_date_small">(11:50~13:30)</span>
					</div>
					<div class="content_menu"><?echo $data['content'];?></div>
					<?
					break;
				case 3:
				?>
					<div class="content_date">
						내일 저녁<span class="content_date_small">(16:50~18:30)</span>
					</div>
					<div class="content_menu"><?echo $data['content'];?></div>
				<?
				}
				break;
			}	
	        default:
	        ?>
				<div class="content_menu">메뉴가 없습니다.</div>
				<?
	        }
			?>
		<div class="content_button">
			<input type="button" value="더 보기" onclick="document.location='#student'" data-inline="true" data-theme="a" data-corners="false" />
		</div>
	</div>

	<!--생활관 영역-->
	<div id="content_b">
		<div class="content_location_b">
	                <span class="content_location_font_b">생활관</span>식당(청기정/은기정)
                </div>
	                <?
	                if($diff <= 570 && $diff >= 0)
	                        $flagday = 1;
	                else if($diff <= 810 && $diff >= 571)
	                        $flagday = 2;
	                else if($diff <= 1170 && $diff >= 811)
	                        $flagday = 3;
	                else if($diff <= 1439 && $diff >= 1171)
	                        $flagday = 4;
	
	                switch($flagday) {
	                        case 1:
	                                $result = mysql_query($query_first." and loca='s' and type='1'");
	                                $data = mysql_fetch_array($result);
	                                if(isset($data['content'])) {?>
	                                        <div class="content_date">
						오늘 아침<span class="content_date_small">(07:30~09:00)</span>
	                                        </div>
	                                        <div class="content_menu"><?echo $data['content'];?></div>
	                                        <?break;
	                                }
	                        case 2:
	                                $result = mysql_query($query_first." and loca='s' and type='2'");
	                                $data = mysql_fetch_array($result);
	                                if(isset($data['content'])) {?>
											<div class="content_date">
	                                        오늘 점심<span class="content_date_small">(12:00~13:00)</span>
	                                        </div>
	                                        <div class="content_menu"><?echo $data['content'];?></div>
	                                        <?break;
	                                }
	                        case 3:
	                                $result = mysql_query($query_first." and loca='s' and type='3'");
	                                $data = mysql_fetch_array($result);
	                                if(isset($data['content'])) {?>
											<div class="content_date">
	                                        오늘 저녁<span class="content_date_small">(18:00~19:30)</span>
	                                        </div>
	                                        <div class="content_menu"><?echo $data['content'];?></div>
	                                        <?break;
	                                }
	                        case 4:
	                                $next_date = date("Ymd",strtotime ("+1 days"));
	                                $next_year = substr($next_date,0,4);
	                                $next_month = substr($next_date,4,2);
	                                $next_day = substr($next_date,6,2);
	
	                                $result = mysql_query("select * from menu_daily where year='$next_year' and month='$next_month' and day='$next_day' and loca='s' AND type BETWEEN 1 AND 3 ORDER BY type ASC LIMIT 1");
	                                $data = mysql_fetch_array($result);
	                                if(isset($data['content'])) {
										switch($data['type']) {
										case 1:
										?>
										<div class="content_date">
											내일 아침<span class="content_date_small">(07:30~09:00)</span>
										</div>
										<div class="content_menu"><?echo $data['content'];?></div>
										<?
										break;
										case 2:
										?>
										<div class="content_date">
											내일 점심<span class="content_date_small">(12:00~13:30)</span>
										</div>
										<div class="content_menu"><?echo $data['content'];?></div>
										<?
										break;
										case 3:
									   ?>
										<div class="content_date">
											내일 저녁<span class="content_date_small">(18:00~19:30)</span>
										</div>
										<div class="content_menu"><?echo $data['content'];?></div>
									   <?
										
										}
										break;
									}						
						default:
						?>
						<div class="content_menu">메뉴가 없습니다.</div>
						<?
						break;
					}
			?>
		<div class="content_button">
			<input type="button" value="더 보기" onclick="document.location='#dorm'" data-inline="true" data-theme="a" data-corners="false" />
		</div>
	</div>
</div>
<div id="footer">
</div>

</div>
