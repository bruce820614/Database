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
	global $dbh;
	$dsn = "mysql:host=$dbhost;dbname=$dbname";
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
	$dbh = new PDO($dsn, $dbuser, $dbpassword, $options);
	

	//$sql = "set name utf8;";
  //$stmt = $dbh->prepare("$sql");
  //$stmt->execute();
	//$result = $stmt->fetch(PDO::FETCH_OBJ);	
	//print_r($result);
} catch (PDOException $e) {
        print "DB connect Error!: " . $e->getMessage() . "<br/>";
        die();
}


// ------------------------------------------------------------------------------------------------
// 結束
// ------------------------------------------------------------------------------------------------


$email = $_POST['email'];
$password = $_POST['password'];
$refer = $_POST['refer'];

if ($email == '' || $password == '')
{
    // No login information
    header('Location: login.php?refer='. urlencode($_POST['refer']));
}
else
{
    // Authenticate user
    $con = mysql_connect($db_host, $db_user, $db_pass);
    mysql_select_db($db_name, $con);
    
    $query = "SELECT userid, MD5(UNIX_TIMESTAMP() + userid + RAND(UNIX_TIMESTAMP()))
        guid FROM susers WHERE email = '$email' AND password = password('$password')";
        
    $result = mysql_query($query, $con)
    	or die ('Error in query');
    
    if (mysql_num_rows($result))
    {
        $row = mysql_fetch_row($result);
        // Update the user record
        $query = "UPDATE susers SET guid = '$row[1]' WHERE userid = $row[0]";
            
        mysql_query($query, $con)
        	or die('Error in query');
        
        // Set the cookie and redirect
        // setcookie( string name [, string value [, int expire [, string path
        // [, string domain [, bool secure]]]]])
        // Setting cookie expire date, 6 hours from now
        $cookieexpiry = (time() + 21600);
        setcookie("session_id", $row[1], $cookieexpiry);

        if (empty($refer) || !$refer)
        {
            $refer = 'index.php';
        }

        header('Location: '. $refer);
    }
    else
    {
        // Not authenticated
        header('Location: login.php?refer='. urlencode($refer));
    }
}
?>



?>