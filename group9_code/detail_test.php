

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	body
	{
		margin:0;
		padding:0;
		font-size: 12px;
	}
	.content
	{
		color: #990000;
	}

	a:link{color:#990000; text-decoration:underline}
	a:visited{color:#990000; text-decoration:underline}
	a:hover{color:#336699; text-decoration:underline}
</style>
<script language="JavaScript">
<!--
self.moveTo(40,120)  //指定預開啟位置的寬度與高度
self.resizeTo(screen.availWidth-100,screen.availHeight-300)  //指定預開啟視窗的寬度與高度
//-->
</script>
<title>多媒體資訊瀏覽</title>
</head>
<body>
<?php
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
	
	$post_mNo = "";
	$mNo = $_GET['mNo'];
	$post_mNo = $mNo;
	
	$conn = oci_connect($db_id, $db_pwd, $oracle_db);
	$sql = 'SELECT MUSIC.MNO, MUSIC.MNAME, COMPANY.CNAME, AUTHOR.ANAME, SINGER.SINGER, CLASSIFICATION.STYLE, CLASSIFICATION.REGION FROM MUSIC, PRODUCE, AUTHOR, COMPANY, SINGER, CLASSIFICATION WHERE MUSIC.MNO = :didbv AND PRODUCE.MNO = MUSIC.MNO AND PRODUCE.ANO = AUTHOR.ANO AND MUSIC.CNO = COMPANY.CNO AND SINGER.MNO = MUSIC.MNO AND CLASSIFICATION.CID = MUSIC.CID';
	$stid = oci_parse($conn, $sql);
	$didbv = $post_mNo;
	oci_bind_by_name($stid, ':didbv', $didbv);
	oci_execute($stid);
	/* // Execute the statement using OCI_DEFAULT (begin a transaction)
	oci_execute($stid, OCI_DEFAULT) 
	or die ("Unable to execute query\n"); */
	
	while (($row = oci_fetch_array($stid))) {
	$mNo = $row['MNO'];
	/* echo $mNo;
	echo '////'; */
	$mName = $row['MNAME'];
	/* echo $mName;
	echo '////'; */
	$cName = $row['CNAME'];
	/* echo $cName;
	echo '////'; */
	$aName = $row['ANAME'];
	/* echo $aName;
	echo '////'; */
	$singer = $row['SINGER'];
	/* echo $singer;
	echo '////'; */
	$style = $row['STYLE'];
	/* echo $style;
	echo '////'; */
	$region = $row['REGION'];
	/* echo $region; */
	}

?>


				
<div >
		<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#D6D5A5" style="margin-top:10px;margin-bottom:10px;">
			
		  <tr>
			<td width=320  valign="top" ><div align="center">
			  <table cellpadding="2"  bgcolor="#595847"  style="margin-left:2%;margin-right:2%;">
							<tr>
			  <td><div align="center">
				<div width=320 height=280></div>
			  </div></td>
			</tr>
						<tr>
				  <td><div align="center">
				  <!--
				  				  <img src="images/exid.jpg" border="0" style="width:320px;">
				  -->
				  </div></td>
				</tr>
							  </table>
			</div></td>
			<td valign="top"><div align="left">
			  <table width="100%"  border="0" cellpadding="2" cellspacing="2"  style="margin-left:5px">
				<tr >
				  <td width="20%" colspan="2" >音樂名稱： <span class="content">
				  <?php
					echo $mName;
				  ?>
				  </span></td>
				</tr>
				<tr >
				  <td width="20%" colspan="2" >演唱者： <span class="content">
				  <?php
					echo $singer;
				  ?>
				  </span></td>
				</tr>
				<tr >
				  <td width="20%" colspan="2" >創作者 ： <span class="content">
				  <?php
					echo $aName;
				  ?>
				  </span></td>
				</tr>
				<tr >
				  <td width="20%" colspan="2" >曲風： <span class="content">
				  <?php
					echo $style;
				  ?>
				  </span></td>
				</tr>
				<tr >
				  <td width="20%" colspan="2" >地區： <span class="content">
				  <?php
					echo $region;
				  ?>
				  </span></td>
				</tr>
				<tr >
				  <td width="20%" colspan="2" >唱片公司：<span class="content">
				  <?php
					echo $cName;
				  ?>
				  </span></td>
				</tr>
				
			  </table>
			</div></td>
		  </tr>
		</table>
</div>
<?php
	oci_close($conn);
?>
</body>
</html>
