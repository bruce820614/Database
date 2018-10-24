
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


//記得要補 group幾 跟資料庫密碼 
$system_mode = 'release';
if($system_mode == 'release') {
	// sql DB infomation 
	$dbhost='140.117.68.47';
	$dbname='group11';
	$dbuser='group11';
	$dbpassword='5AMAfA';
	//$host_url = "http://140.117.68.47/group";
}else{
	// 沒有設定 STOP
	die('沒有設定執行模式, STOP IT。');
}
	
//
// 連接資料庫的的設定,預設將 set name utf8 開啟 (第 1 組 SQL)
//
try {
	// 在 PDO 宣告的時候就要將編碼一併宣告。 ref.pdo-mysql.connection
	global $conn;
	$dsn = "mysql:host=$dbhost;dbname=$dbname";
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
	$conn = new PDO($dsn, $dbuser, $dbpassword, $options);
	

	//$sql = "set name utf8;";
  //$stmt = $dbh->prepare("$sql");
  //$stmt->execute();
	//$result = $stmt->fetch(PDO::FETCH_OBJ);	
	//print_r($result);
} catch (PDOException $e) {
        print "DB connect Error!: " . $e->getMessage() . "<br/>";
        die();
}

	$sql="select * from music as m natural join produce as p natural join author as a natural join company as c
          where m.mNo=p.mNo and m.mNo=c.mNo and p.aNo=a.aNo";
	$result=$conn->query($sql);
	$row=$result->fetchAll(PDO::FETCH_ASSOC);


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
</head>
<body>
<div id="header-wrapper" >
	<div id="header" class="container" >
		<div id="logo" >
			<h1><a href="#" >Music Info Stop</a></h1>
		</div>
	</div>
	<div id="menu-wrapper" class="color">
		<div id="menu" class="container" >
			<ul>
				<li class="current_page_item"><a href="DB.html" accesskey="1" title="">Homepage</a></li>
				<li><a href="register.html" accesskey="2" title="">Member</a></li>
				<li><a href="music.html" accesskey="3" title="">Music</a></li>
				<li><a href="author.html" accesskey="4" title="">Author</a></li>
				<li><a href="style.html" accesskey="5" title="">Style</a></li>
				<li><a href="company.html" accesskey="6" title="">Company</a></li>
				<li><a href="leaderboard.html" accesskey="7" title="">Leaderboard</a></li>
			</ul>
		</div>
	</div>
</div>



<div class="table-responsive divbg">
	<p class="sub-header"><b>&nbsp;♫音樂資訊</b></p>
         
            <table class="table table-striped tableA">
              <thead>
                <tr>
                  <th></th>
                  <th>音樂名稱</th>
                  <th>音樂日期</th>
                  <th>創作者名稱</th>
                  <th>唱片公司</th>
                  <th>詳細資訊</th>
                </tr>
              </thead>
              <tbody>';
              $nnnnnn ='';
              foreach($row as $value)
             
              {
              	if($nnnnnn == $value['mNo']){
				echo' <tr>
				<th></th> 
                         <th></th>
                         <th></th>
                         <th>'.$value['aName'].'</th>
                         <th></th>
                         <th></th>
              		   </tr>';
              	}
              	else{
                 echo' <tr> 
                 <th></th>
                         <th>'.$value['mName'].'</th>
                         <th>'.$value['mDate'].'</th>
                         <th>'.$value['aName'].'</th>
                         <th>'.$value['cName'].'</th>
                         <th><a href="'.$value['mDetail'].'" >Detail</a></th>
              		   </tr>';
              	}
              	$nnnnnn = $value['mNo'];
              }
             echo' </tbody>
            </table>
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