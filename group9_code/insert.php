<?php
include("connect.php");
/////////////////////////////////////////////////////////////////////////

$uNo=$_POST['uNo'];
//$uDate=$_POST['uDate'];
$uName=$_POST['uName'];
$email1=$_POST['email1'];
$account=$_POST['account'];
$password1=$_POST['password1'];
$password2=$_POST['password2'];
date_default_timezone_set("Asia/Taipei");
$time=date('Y-m-d H:i:s',time()) ; 


if ($password1!=$password2) {
    echo "密碼不相符，請重新輸入";
} else {
    try {

    $confirm = $dbh->prepare("SELECT * FROM user where uaNo='$account'");
    $result = $dbh->query($confirm);
    $num=$result->fetch();
    if ($num != 0) {
        echo "此帳號已申請";
        exit;
        } 
        else {
        $sql = "INSERT INTO user (uNo, uDate, email, uName, uaNo, upassword)
        VALUES ('$uNo', '$time', '$email1', '$uName', '$account', '$password1')";
     // use exec() because no results are returned
        $dbh->exec($sql);
        echo "New record created successfully";
         }}
        catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
           }
         $conn = null;
    
    }




    


    

/////////////////////////////////////////////////////////////////////////

/*select data
//
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["uNo"]. " - Name: " . $row["uName"]. "<br>";
    }
} else {
    echo "0 results";
}
*/

//$conn->close();
?>