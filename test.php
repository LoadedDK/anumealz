<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>loader demo</title>
  <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
<script>
$(function(){ 
$.mobile.loading( 'show');
})

</script>
<div data-role="page" id="page1">
  <div role="main" class="ui-content">
    <div data-role="controlgroup">
      <button class="show-page-loading-msg" data-theme="b" data-textonly="false" data-textvisible="false" data-msgtext="" data-icon="arrow-r" data-iconpos="right">Default loader</button>
    </div>
  </div>
</div>
 

 
</body>
</html>