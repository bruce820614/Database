  
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


                    $sql = "select * from music m  natural join singer s  natural join company c 
                              where m.mNo=c.mNo and m.mNo=s.mNo  and REGEXP_LIKE (mName, ".$searchmName."+)";

                                           /*echo $sql;*/

                    $stid = oci_parse($conn, $sql);
                    oci_execute($stid);
                    $row = oci_fetch_array($stid);

                    $i = 0;
                    while ($rs = $row->fetch(PDO::FETCH_OBJ)) {

                      $search_list[$i]["mName"]   = $rs->mName;
                      $search_list[$i]["mDate"]   = $rs->mDate;
                      $search_list[$i]["singer"]  = $rs->singer;
                      $search_list[$i]["cName"]   = $rs->cName;
                      $search_list[$i]["mDetail"] = $rs->mDetail;
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
    <style type="text/css">.tableA{margin-bottom: 0px;}</style>
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
                <li><a href="musicAf.php" accesskey="2" >Music</a></li>
                <li><a href="leaderboardAf.html" accesskey="3">Leaderboard</a></li>
                <li class="current_page_item"><a href="searchAf.php" accesskey="4">Search</a></li>
                <li><a href="alter.html" accesskey="5" >Member</a></li>
      </ul>
		</div>
	</div>
</div>


<div id="banner"></div>
<div id="wrapper2" class="searchbg">
<form class="form-signin" method="post" action="<?php $_SERVER["PHP_SELF"];?>" >
        <h3 class="form-signin-heading">音樂查詢</h3>
        <label name="mName" for="inputNumber" class="sr-only"></label>
        <input type="text"  id="inputNumber" class="form-control" name="searchmName" placeholder="請輸入音樂名稱" required autofocus>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">搜尋</button>
</form>
</div>
<div class="table-responsive divbg ">
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
                            <th></th>
                          </tr>';

                  }
                  else
                  {

                     echo'<tr> 
                            <th></th>
                            <th>'.$search_list[$j]["mName"].'</th>
                            <th>'.$search_list[$j]["mDate"].'</th>
                            <th>'.$search_list[$j]["singer"].'</th>
                            <th>'.$search_list[$j]["cName"].'</th>
                            <th><a href='.$search_list[$j]["mDetail"].' Target="_blank">Detail</a></th>
                          </tr>';


                  }
                    $j++;

                }
                
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