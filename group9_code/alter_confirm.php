<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include_once("connect.php");

//$type=$_GET['type'];


// add member


//$uNo=$_POST['uNo'];
//$uDate=$_POST['uDate'];
$ori_uaNo=$_POST['ori_uaNo'];
$ori_upassword=$_POST['ori_upassword'];
$uName=$_POST['uName'];
$email=$_POST['email'];
$uaNo=$_POST['uaNo'];
$upassword=$_POST['upassword'];
$password_confirm=$_POST['password_confirm'];
//date_default_timezone_set("Asia/Taipei");
//$time=date('Y-m-d H:i:s',time()) ; 

$sql = "SELECT * FROM user WHERE uaNo='$ori_uaNo'";
 $res = $conn->query($sql);
 $result=$res->fetch();

if($result['uaNo'] == $ori_uaNo && $result['upassword'] == $ori_upassword)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['sessionC'] = $ori_uaNo;
        if ($upassword != $password_confirm) 
        {
            echo "
            <html>
            <head> 
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
            </head>
            <body>
            <script language='javascript'>
            alert('新密碼不一樣！請再次確認');
              location.href=\"alter.html\";   
            </script>
            </body>
            </html>
            ";
        }
        else 
        {
            $sql="SELECT * FROM user WHERE uaNo ='$uaNo'";
            $result = $conn->query($sql);
            $num=$result->fetch();

            if ($ori_uaNo==$uaNo) 
            {
                $sql = "UPDATE user SET uaNo='$uaNo', uName='$uName', email='$email',upassword='$upassword'
                WHERE uaNo='$ori_uaNo'";
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
            alert('恭喜修改成功!請重新登入~');
              location.href=\"login.html\";   
            </script>
            </body>
            </html>
            ";
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
            alert('修改失敗!請重新修改~');
              location.href=\"login.html\";   
            </script>
            </body>
            </html>
            ";
                }
            } 
            else 
            {
                if($num==0)
                {
                    $sql = "UPDATE user SET uaNo='$uaNo', uName='$uName', email='$email',upassword='$upassword'
                    WHERE uaNo='$ori_uaNo'";
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
            alert('恭喜修改成功!請重新登入~');
              location.href=\"login.html\";   
            </script>
            </body>
            </html>
            ";
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
            alert('修改失敗!請重新修改~');
              location.href=\"login.html\";   
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
                    alert('此會員帳號已存在，請重試');
                    location.href=\"alter.html\";       
                    </script>
                    </body>
                    </html>
                    ";
                }
            }          
        }
        //echo '<meta http-equiv=REFRESH CONTENT=1;url=indexAf.php>';
}
else
{
        if ($result['uaNo']!=$uaNo) 
        {
            echo "
            <html>
            <head> 
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
            </head>
            <body>
            <script language='javascript'>
            alert('無此使用者');
              location.href=\"alter.html\";   
            </script>
            </body>
            </html>
            ";
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
            alert('原始密碼有誤！請再次確認喔');
              location.href=\"alter.html\";   
            </script>
            </body>
            </html>
            ";
        }       
}
?>