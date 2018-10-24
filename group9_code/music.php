 
<!doctype html>
<?php
// ----------------------------------------
// 程式功能：DB連結設定檔
// 檔案名稱：DBconfig.php
//------------------------------------------

  
$title_name = "";
//放在html title那邊的 網頁名稱 可有可無

//
// 資料庫設定
//

	$db_id = "group9";
	$db_pwd = "groupnine09";
	$oracle_db = "(DESCRIPTION = (ADDRESS_LIST =
	(ADDRESS = (PROTOCOL = TCP)(HOST=140.117.68.117)(PORT=1521) ) )
	(CONNECT_DATA = (SERVICE_NAME='orcl.example.com') ) )";

	$conn = oci_connect($db_id, $db_pwd, $oracle_db);
	if( !$conn )
	{
		echo "連接失敗!";
	}
	else
	{
		echo "連接成功!";
		oci_close($conn);
	}
	
	$conn = oci_connect($db_id, $db_pwd, $oracle_db);
	$sql='SELECT MUSIC.MNAME, MUSIC.MDATE, SINGER.SINGER, COMPANY.CNAME, MUSIC.MNO FROM MUSIC, COMPANY, SINGER 
			WHERE MUSIC.CNO = COMPANY.CNO AND SINGER.MNO = MUSIC.MNO';
	$stid = oci_parse($conn, $sql);
	oci_execute($stid, OCI_DEFAULT);
	//$row = oci_fetch_array($stid);
	$row = OCIFetchstatement($stid,$results);
	$keys=array_keys($results);
	
	
	$sql_music = 'SELECT COUNT(*) FROM MUSIC';
	$stmt = oci_parse($conn, $sql_music);
	oci_execute($stmt);
	while (($rowCount = oci_fetch_array($stmt))) {
	$count_music = $rowCount[0];
	}
	echo '///countmusic:';
	echo $count_music;
	
	/* $result=$conn->query($sql);
	$row=$result->fetchAll(PDO::FETCH_ASSOC);

	$sql1 = "select * from MUSIC ;";
	$stmt = $conn->prepare("$sql1");
	$stmt->execute();

	$count_music = $stmt->rowCount(); */

echo '<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Music</title>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="bootstrap-3.3.4-dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.3.4-dist\css\body.css" rel="stylesheet">
    <link href="bootstrap-3.3.4-dist\css\dashboard.css" rel="stylesheet">
    <style>
    .tableA{
		margin-bottom: 0px;
	}
    </style>
    <script type="text/javascript" src="jquery.slidertron-1.3.js"></script>
</head>
<body>
<div id="header-wrapper" >
<div class="login"><a href="logout.html" class="log">log out </a>&nbsp;&nbsp;&nbsp;</div>
	<div id="header" class="container" >
		<div id="logo" >
			<h1><a href="#" >Music Info Stop</a></h1>
		</div>
	</div>
	<div id="menu-wrapper" class="color">
		<div id="menu" class="container" >
			<ul>
				<li><a href="hompageAf.php"  accesskey="1" >Homepage</a></li>       
                <li class="current_page_item"><a href="musicAf.php" accesskey="2" >Music</a></li>
                <li><a href="leaderboardAf.html" accesskey="3">Leaderboard</a></li>
                <li><a href="searchAf.php" accesskey="4">Search</a></li>
                <li><a href="alter.html" accesskey="5" >Member</a></li>
			</ul>
		</div>
	</div>
</div>


<div id="banner"></div>
<div class="table-responsive divbg">
	<p class="sub-header"><b>&nbsp;♫音樂資訊</b></p>
         
            <table class="table table-striped tableA">
              <thead>
                <tr>
                  <th></th>
                  <th>音樂名稱</th>
                  <th>音樂日期</th>
                  <th>演唱者名稱</th>
                  <th>唱片公司</th>
                  <th>音樂編號</th>
				  <th>詳細</th>
                </tr>
              </thead>
              <tbody>';
			  $table = "<TR></TR>";
              for($i=0;$i<$row;$i++){
				  $table .= "<TR><TH></TH>";
				  $mNo;
				  foreach($results as $spalte){
					  $data = $spalte[$i];
					  $table .= " <TH>$data</TH>";
					  $mNo = $data;
				  }
				  $table .="<TH>
				  <a href='detail_test.php?mNo=$mNo'>詳細</a>
				  </TH>";
				  $table .=" </TR>";
			  }
			  echo $table;
             echo' </tbody>
            </table>
         </div>
	
<div class="row" >
	<div class="col-md-10"></div>
	<div class="col-md-2"><h2 style="color:white;"><b>總計:'.$count_music.'首歌</b></h2></div>
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
</html>';

?>