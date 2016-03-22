
<div id="head">
	<div class="logo">
	오늘 <span class="logo_o">밥</span> 뭐야?
	</div>
</div>
<div id="body">
	<div class="snack">
		<div class="snack_title">
		학생식당 <span class="content_location_font_snack">간식</span>
		</div>
		<div class="content_date">
		10:00 ~ 11:40<br/>
		13:30 ~ 18:30
		</div>
		<div class="snack_content">
		<?
		$result = mysql_query("select * from menu_fix where loca='h' order by num asc");
		while($data = mysql_fetch_array($result)) {
			echo $data['item']." / <b>".$data['price']."</b><br/>";
		}
		?>
		</div>
	</div>
</div>
