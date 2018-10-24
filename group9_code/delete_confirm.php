<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include_once("connect.php");

//$type=$_GET['type'];


// add member


//$uNo=$_POST['uNo'];
//$uDate=$_POST['uDate'];
$email=$_POST['email'];
$uaNo=$_POST['uaNo'];
$upassword=$_POST['upassword'];
//date_default_timezone_set("Asia/Taipei");
//$time=date('Y-m-d H:i:s',time()) ; 

$sql = "SELECT * FROM user WHERE uaNo='$uaNo'";
 $res = $conn->query($sql);
 $result=$res->fetch();

if($result['uaNo'] == $uaNo && $result['upassword'] == $upassword)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['sessionC'] = $uaNo;
        if ($result['email']==$email) {
        
        $sql = "DELETE FROM user WHERE uaNo='$uaNo'";
        $sth=$conn->prepare($sql);
        if($sth->execute())
        {
            echo "
            <html>
            <head> 
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
            </head>
            <body>
            <script language='javascript'>
            alert('會員已清除!');
              location.href=\"homepage.html\";      
            </script>
            </body>
            </html>
            ";}}
        else{
            echo "
            <html>
            <head> 
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
            </head>
            <body>
            <script language='javascript'>
              alert('信箱驗證錯誤，請重新輸入');
              location.href=\"delete.html\";
            </script>
            </body>
            </html>
            ";
            }
}
    else
    {
        echo "
        <html>
        <head> 
            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
        </head>
        <body>
        <script language='javascript'>
          alert('帳號密碼輸入有誤，請重新輸入');
          location.href=\"delete.html\";       
        </script>
        </body>
        </html>
        ";
        
    }

?>