 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Picturesque 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20131223

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Music Info Stop</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.slidertron-1.3.js"></script>
<style>
body{font-family:Microsoft JhengHei,arial}
</style>
</head>


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->





</head>
<body>
<div id="header-wrapper" >
<div class="login">Welcome, you had LOG IN. | <a href="logout.html" class="log">log out </a>&nbsp;&nbsp;&nbsp;</div>
	<div id="header" class="container" >
		<div id="logo" >
			<h1><a href="hompageAf.php" >Music Info Stop</a></h1>
		</div>
	</div>
	<div id="menu-wrapper" class="color">
		<div id="menu" class="container" >
			<ul>
				<li class="current_page_item"><a href="hompageAf.php"  accesskey="1" >Homepage</a></li>				
				<li><a href="musicAf.php" accesskey="2" >Music</a></li>
				<li><a href="leaderboardAf.html" accesskey="3">Leaderboard</a></li>
				<li><a href="searchAf.php" accesskey="4">Search</a></li>
				<li><a href="alter.html" accesskey="5" >Member</a></li>
			</ul>
		</div>
	</div>
</div>


<div id="slider">
				<a href="#" class="button previous-button"><span class="icon icon-double-angle-left"></span></a>
				<a href="#" class="button next-button"><span class="icon icon-double-angle-right"></span></a>
				<div class="viewer">
					<div class="reel">
						<div class="slide link">
							
							<img src="images/taylor.jpg" alt="" />
						</div>
						<div class="slide link">

							<img src="images/staywithme.jpg" alt="" />
						</div>
						<div class="slide link">

							<img src="images/taylor.jpg" alt="" />
						</div>
						<div class="slide link">

							<img src="images/exid.jpg" alt="" />
						</div>
					</div>
				</div>
			</div>
			
			<script type="text/javascript">
				$('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',
					slidesSelector: '.viewer .reel .slide',
					advanceDelay: 3000,
					speed: 'slow',
					navPreviousSelector: '.previous-button',
					navNextSelector: '.next-button',
					slideLinkSelector: '.link'
				});
			</script>







<div id="wrapper2">
	<div id="portfolio" class="container">
		<div class="title">
			<h2>熱門歌手</h2>
			<span class="byline">近期熱門的歌手資訊</span>
		</div>
		<div class="column1">
			<div class="box"><img src="images/123.jpg" alt="" class="image image-full" style="width:200px ; height:200px" />
				<h3>蕭如毛</h3>
				<p>體重有點重</p>
				<a href="notlog.html" class="button button-small">點此看更多</a> </div>
		</div>
		<div class="column2">
			<div class="box"><img src="images/img05-1.jpg" alt="" class="image image-full" style="width:200px ; height:200px"/>
				<h3>Taylor Swift</h3>
				<p>Style</p>
				<a href="detail/Style.html" class="button button-small" Target="_blank">點此看更多</a> </div>
		</div>
		<div class="column3">
			<div class="box"><img src="images/img06.jpg" alt="" class="image image-full" style="width:200px ; height:200px" />
				<h3>EXID</h3>
				<p>UP & DOWN</p>
				<a href="detail/UpAndDown.html" class="button button-small" Target="_blank">點此看更多</a> </div>
		</div>
		<div class="column4">
			<div class="box"><img src="images/img07.jpg" alt="" class="image image-full" style="width:200px ; height:200px"/>
				<h3>Sam Smith</h3>
				<p>Stay With Me</p>
				<a href="detail/StayWithMe.html" class="button button-small" Target="_blank">點此看更多</a> </div>
		</div>
	</div>
</div>

<div id="page-wrapper">
	<div id="page" class="container">
		<div class="title">
			<h2>謝謝光臨 Music Info Stop</h2>
		</div>
		<p>希望你能在這裡得到你想要的資訊 我們的宗旨在於提供一個方便的音樂平台</p>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Music Info Stop. All rights reserved.</p>
		<ul class="contact">
			<li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>
			<li><a href="#" class="icon icon-facebook"><span></span></a></li>
			<li><a href="#" class="icon icon-dribbble"><span>Pinterest</span></a></li>
			<li><a href="#" class="icon icon-tumblr"><span>Google+</span></a></li>
			<li><a href="#" class="icon icon-rss"><span>Pinterest</span></a></li>
		</ul>
</div>
</body>
</html>
