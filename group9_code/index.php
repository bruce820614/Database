<html>
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


// ------------------------------------------------------------------------------------------------
// 結束
// ------------------------------------------------------------------------------------------------




?>
<body><h1>It works!</h1></body>
</html>
