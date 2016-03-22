<? include "lib.php";?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<title>오늘 밥 뭐야?</title>
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1" />
	<link rel="apple-touch-icon" href="img/icon.jpg">
	<meta name="apple-mobile-web-app-capable" content="yes" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
<link rel="stylesheet" href="css/style.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<?
//안드로이드 검사해서 구글플레이로 이동
$And_url = "market://details?id=com.comeng.vision.anumealz";
$else_url = "https://play.google.com/store/apps/details?id=com.comeng.vision.anumealz";

// 안드로이드 접속
if(stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
	movepage($And_url);

//아이폰 카카오톡 접속
} elseif(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone") && stripos($_SERVER['HTTP_USER_AGENT'], "kakao")) {
?>
	<div id="intro">
		<div id="intro-content">
			<div id="webapp_logo">
				<span class="intro_title_a">안동대</span> 오늘 <span class="intro_title_b">밥</span> 뭐야?
			</div>
			<div id="intro_box_b">
				<div class="homebutton_box">
					사파리 브라우저로 접속하셔서 <img src="img/icon_1.gif" width="15" height="15" alt="icon">을 터치한 후에 "홈화면에 추가"를 선택하세요.
				</div>
			</div>
		</div>
	</div>
<?
//아이폰 사파리 접속
} elseif(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone") && stripos($_SERVER['HTTP_USER_AGENT'], "Safari")) {
?>
	<div id="intro">
		<div id="intro-content">
			<div id="webapp_logo">
				<span class="intro_title_a">안동대</span> 오늘 <span class="intro_title_b">밥</span> 뭐야?
			</div>
			<div id="intro_box_b">
				<div class="homebutton_box">
					<img src="img/icon_1.gif" width="15" height="15" alt="icon">을 터치한 후에 "홈화면에 추가"를 선택하세요.
				</div>
			</div>
		</div>
	</div>
<?
//아이폰 네이버 접속
} elseif(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone") && stripos($_SERVER['HTTP_USER_AGENT'], "NAVER")) {
?>
	<div id="intro">
		<div id="intro-content">
			<div id="webapp_logo">
				<span class="intro_title_a">안동대</span> 오늘 <span class="intro_title_b">밥</span> 뭐야?
			</div>
			<div id="intro_box_b">
				<div class="homebutton_box">
					사파리 브라우저로 접속하셔서 <img src="img/icon_1.gif" width="15" height="15" alt="icon">을 터치한 후에 "홈화면에 추가"를 선택하세요.
				</div>
			</div>
		</div>
	</div>
<?
//아이폰 페이스북 접속
} elseif(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone") && stripos($_SERVER['HTTP_USER_AGENT'], "FBIOS")) {
?>	
	<div id="intro">
		<div id="intro-content">
			<div id="webapp_logo">
				<span class="intro_title_a">안동대</span> 오늘 <span class="intro_title_b">밥</span> 뭐야?
			</div>
			<div id="intro_box_b">
				<div class="homebutton_box">
					사파리 브라우저로 접속하셔서 <img src="img/icon_1.gif" width="15" height="15" alt="icon">을 터치한 후에 "홈화면에 추가"를 선택하세요.
				</div>
			</div>
		</div>  	
	</div>
<?
//기타 접속
//} elseif(stripos($_SERVER['HTTP_USER_AGENT'], "iPhone") || $_SERVER['HTTP_USER_AGENT'] == "webview") {
} else {
?>
<!-- 메인 페이지 -->
<div data-role="page" id="index" data-theme="a" >
    <div data-role="content" id="content"  data-theme="a">
	<? include "page/main.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#flour">분식</a></li>
				<li><a href="#snack">간식</a></li>
				<li><a href="#guide">이용안내</a></li>
        	</ul>
        </div>
    </div>
</div>
<!-- 분식당 페이지 -->
<div data-role="page" id="flour" data-theme="a">
    <div data-role="content" id="content"  data-theme="a">
	<? include "page/flour.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#index">홈</a></li>
				<li><a href="#snack">간식</a></li>
				<li><a href="#guide">이용안내</a></li>
        	</ul>
        </div>
    </div>
</div>
<!-- 간식 페이지 -->
<div data-role="page" id="snack" data-theme="a" >
    <div id="content" data-role="content" data-theme="a">
	<? include "page/snack.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#index">홈</a></li>
            	<li><a href="#flour">분식</a></li>
				<li><a href="#guide">이용안내</a></li>
        	</ul>
        </div>
    </div>
</div>
<!-- 이용안내 페이지 -->
<div data-role="page" id="guide" data-theme="a" >
    <div id="content" data-role="content" data-theme="a">
	<? include "page/guide.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#index">홈</a></li>
            	<li><a href="#flour">분식</a></li>
				<li><a href="#snack">간식</a></li>
        	</ul>
        </div>
    </div>
</div>
<!-- 학생식당 페이지 -->
<div data-role="page" id="student" data-theme="a">
    <div data-role="content" id="content"  data-theme="a">
	<? include "page/student.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#index">홈</a></li>
            	<li><a href="#flour">분식</a></li>
				<li><a href="#snack">간식</a></li>
				<li><a href="#guide">이용안내</a></li>
        	</ul>
        </div>
    </div>
</div>
<!-- 생활관식당 페이지 -->
<div data-role="page" id="dorm" data-theme="a">
    <div id="content" data-role="content" data-theme="a">
	<? include "page/dorm.php"; ?>
    </div>
    <div data-role="footer" data-theme="a" data-position="fixed">
    	<div data-role="navbar">
        	<ul>
            	<li><a href="#index">홈</a></li>
            	<li><a href="#flour">분식</a></li>
				<li><a href="#snack">간식</a></li>
				<li><a href="#guide">이용안내</a></li>
        	</ul>
        </div>
    </div>
</div>
<?
//} else {
//movepage($else_url);
}
?>
</body>
</html>
