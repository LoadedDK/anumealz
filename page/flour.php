<div id="head">
	<div class="logo">
	오늘 <span class="logo_o">밥</span> 뭐야?
	</div>
</div>
<div id="body">
	<div class="flour">
		<div class="flour_title">
		<span class="content_location_font_flour">분식당(나눔관)</span> 메뉴
		</div>
		<div class="content_date">
		10:00 ~ 19:00
		</div>
		<div class="flour_content">
		<?
		$result = mysql_query("select * from menu_fix where loca='b' order by num asc");
		while($data = mysql_fetch_array($result)) {
			echo $data['item']." / <b>".$data['price']."</b><br/>";
		}
		?>

		</div>
	</div>
</div>
