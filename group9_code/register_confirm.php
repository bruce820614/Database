<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include_once("connect.php");

//$type=$_GET['type'];


// add member


//$uNo=$_POST['uNo'];
//$uDate=$_POST['uDate'];
$uName=$_POST['uName'];
$email=$_POST['email'];
$uaNo=$_POST['uaNo'];
$upassword=$_POST['upassword'];
$password_confirm=$_POST['password_confirm'];
date_default_timezone_set("Asia/Taipei");
$date=date('Y-m-d',time()) ; 
$uNo="3";														//---------------須設定uNo為自動產生
if ($upassword != $password_confirm) {
	echo "
			<html>
			<head> 
	    		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
			</head>
			<body>
			<script language='javascript'>
			alert('密碼不相符！請再次確認');
			  location.href=\"login.html\";	  
			</script>
			</body>
			</html>
			";
} else {
	//check if mID exist
	
	

	$sql="SELECT * FROM user_ WHERE uaNo ='$uaNo'";
	$result =  oci_parse($conn, $sql);		//$result = $conn->query($sql);
	oci_execute($result);
	//$num=$result->fetch();
	$num = oci_fetch($result);
	//$num=mysql_num_rows($row);
		
	//if mId not exist
	if($num==0)
	{
		$sql = "INSERT INTO user_(uno,uDate, email, uName, uaNo, upassword)
        VALUES ('$uNo', TO_DATE('$date','YYYY-MM-DD'), '$email', '$uName', '$uaNo', '$upassword')";
    	//echo $sql;
		$sth=oci_parse($conn, $sql);
		if(oci_execute($sth))
		{
			echo "
			<html>
			<head> 
	    		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>   
			</head>
			<body>
			<script language='javascript'>
			alert('恭喜您加入會員！您可以前往登入了!');
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
			  alert('加入失敗！請再試一次');
			  location.href=\"DB.html\";
			</script>
			</body>
			</html>
			";
		}
	}
	
	
	
	//if hNO exist
	
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
		  location.href=\"login.html\";		  
		</script>
		</body>
		</html>
		";
	}
	
	
}

oci_close($conn);
?>