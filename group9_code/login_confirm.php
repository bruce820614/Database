
<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
 
 include("connect.php");
 $uaNo=$_POST['uaNo'];
 $upassword=$_POST['upassword'];
 
 $sql = "SELECT * FROM user_ WHERE uaNo='$uaNo'";
 $res = oci_parse($conn, $sql);
 oci_execute($res);
 //$row=oci_fetch_array($res);
 //$result=oci_fetch($res);
 //x
 if ($result=oci_fetch_array($res)) {
     if($result[2] == $uaNo && $result[3] == $upassword)
     {
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['sessionC'] = $uaNo;
        echo '登入成功!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=hompageAf.php>';
     }
else
{
    if ($result[2]!=$uaNo) {
        echo "無此使用者，請確認後再次輸入";
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
    } else {
        echo '密碼有誤，請重新輸入';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
    }
        
        
}

 }



oci_close($conn);
?>