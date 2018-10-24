
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


 /* error_reporting( error_reporting() & ~E_NOTICE ).//關閉錯誤*/
         if(isset($_POST["searchmName"])){
                    if (empty($_POST["searchmName"])) 
                        {
                            $mNameErr = "請輸入音樂名稱";
                            
                        } 
                        else 
                        {
                            $searchmName = ($_POST["searchmName"]);
                        }


                    $sql = "select * from music as m  natural join singer as s  natural join company as c 
                              where m.mNo=c.mNo and m.mNo=s.mNo  and mName LIKE '%". $searchmName."%'" ;

                                           /*echo $sql;*/

                    $stmt = $conn->prepare("$sql");
                    $stmt ->execute();

                    $i = 0;
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

                      $search_list[$i]["mName"]   = $rs->mName;
                      $search_list[$i]["mDate"]   = $rs->mDate;
                      $search_list[$i]["singer"]  = $rs->singer;
                      $search_list[$i]["cName"]   = $rs->cName;
                      $i++;
                    }

                #    $sql=$conn->quote($searchmName);

                 #   $catchmName = sprintf("select * from music as m natural join produce as p natural join author as a natural join company as c
                    #                       where m.mNo=p.mNo and m.mNo=c.mNo and p.aNo=a.aNo and mName LIKE "."'%". $searchmName."%'" , $sql);
                   
                    #foreach($conn->query($catchmName) as $row){};
           }
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search</title>
	<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
    <link href="bootstrap-3.3.4-dist\css\bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.3.4-dist\css\body.css" rel="stylesheet">
    <link href="bootstrap-3.3.4-dist\css\dashboard.css" rel="stylesheet">
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



<div id="banner"></div>
<div id="wrapper2">
<form class="form-signin" method="post" action="<?php $_SERVER["PHP_SELF"];?>" >
        <h3 class="form-signin-heading">音樂查詢</h3>
        <label name="mName" for="inputNumber" class="sr-only"></label>
        <input type="text"  id="inputNumber" class="form-control" name="searchmName" placeholder="請輸入音樂名稱" required autofocus>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">搜尋</button>
</form>
</div>
<h2 class="sub-header"><b>音樂資訊</b></h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>音樂名稱</th>
                  <th>音樂日期</th>
                  <th>演唱者名稱</th>
                  <th>唱片公司</th>
                </tr>
              </thead>
              <tbody>
              <?php
              if(isset($_POST["searchmName"])){

                $j=0;
                while($j<$i)
                {


                  if($j!=0 && $search_list[$j]["mName"]==$search_list[$j-1]["mName"])
                  {

                     echo'<tr> 
                            <th></th>
                            <th></th>
                            <th>'.$search_list[$j]["singer"].'</th>
                            <th></th>
                          </tr>';

                  }
                  else
                  {

                     echo'<tr> 
                            <th>'.$search_list[$j]["mName"].'</th>
                            <th>'.$search_list[$j]["mDate"].'</th>
                            <th>'.$search_list[$j]["singer"].'</th>
                            <th>'.$search_list[$j]["cName"].'</th>
                          </tr>';

                  }
                    $j++;

                }
                #        	$nnnnnn ='';
                 #       foreach($conn->query($catchmName) as $row)
                       
                  #      {
                  #      	if($nnnnnn == $row['mName']){
          				#echo' <tr> 
                   #                <th></th>
                    #               <th></th>
                     #              <th>'.$row['aName'].'</th>
                      #             <th></th>
                      #  		   </tr>';
                       # 	}
                        #	else{
                         #  echo' <tr> 
                          #         <th>'.$row['mName'].'</th>
                           #        <th>'.$row['mDate'].'</th>
                            #       <th>'.$row['aName'].'</th>
                             #      <th>'.$row['cName'].'</th>
                        		 #  </tr>';
                        #	}
                        #	$nnnnnn = $row['mName'];
           #   }
   
                 /* <tr>   
                         <th><?php foreach($conn->query($catchmName) as $row) {echo $row['mName'] ;}?></th>
                         <th><?php foreach($conn->query($catchmName) as $row) {echo $row['mDate'] ;}?></th>
                         <th><?php foreach($conn->query($catchmName) as $row) {echo $row['aName'] ;}?></th>
                         <th><?php foreach($conn->query($catchmName) as $row) {echo $row['cName'] ;}?></th>
              			</tr>*/
              }
              ?>
              </tbody>
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
</html>