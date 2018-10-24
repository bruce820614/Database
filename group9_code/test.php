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
	oci_execute($stid);
	$row = oci_fetch_array($stid);
	
	$sql2 = 'SELECT * FROM MUSIC';
	 $oci_rs = oci_parse($conn,$sql2);
    oci_execute($oci_rs,OCI_DEFAULT);
    $rows= OCIFetchstatement($oci_rs,$results);
    $keys=array_keys($results);
    $table = '<table border="1">';
    foreach($keys as $key){
		$table .= " <TH>$key</TH>\n";
	}
    $table .= " </TR>\n";
    for($i=0;$i<$rows;$i++) 
   {
       $table .= "<TR>";
       foreach($results as $spalte)
       {
           $data = $spalte[$i];
           $table .= " <TD>$data</TD>"; 
       }
       $table .=" </TR>";
   }
   echo $table;
	
	

?>