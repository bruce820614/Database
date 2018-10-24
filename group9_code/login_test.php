
<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
 
 //DB configuration Constants
 define('_HOST_NAME_', '140.117.68.47');
 define('_USER_NAME_', 'group11');
 define('_DB_PASSWORD', '5AMAfA');
 define('_DATABASE_NAME_', 'group11');
 
 //PDO Database Connection
 try {
 $databaseConnection = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
 $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch(PDOException $e) {
 echo 'ERROR: ' . $e->getMessage();
 }
 
 if(isset($_POST['submit'])){
 $errMsg = '';
 //username and password sent from Form
 $account = trim($_POST['account']);
 $password = trim($_POST['password']);
 
 if($account == '')
 $errMsg .= 'You must enter your Username<br>';
 
 if($password == '')
 $errMsg .= 'You must enter your Password<br>';
 
 
 if($errMsg == ''){
 $records = $databaseConnection->prepare('SELECT uNo,uaNo,upassword FROM  tbl_users WHERE account = :uaNo');
 $records->bindParam(':uaNo', $account);
 $records->execute();
 $results = $records->fetch(PDO::FETCH_ASSOC);
 if(count($results) > 0 && password_verify($password, $results['password'])){
 $_SESSION['account'] = $results['account'];
 header('location:dashboard.php');
 exit;
 }else{
 $errMsg .= 'Username and Password are not found<br>';
 }
 }
 }
 












/*
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("connect.php");
$account = $_POST['account'];
$password = $_POST['password'];

//搜尋資料庫資料
$sql = $dbh->query("SELECT * FROM user where uaNo = '$account'");
$row = $sql->fetch(PDO::FETCH_ASSOC);

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($account != null && $password != null && $row[0] == $account && $row[1] == $password)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['uaNo'] = $account;
        echo '登入成功!';
        //echo '<meta http-equiv=REFRESH CONTENT=1;url=member.php>';
}
else
{
        echo '登入失敗!';
        //echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
*/
?>