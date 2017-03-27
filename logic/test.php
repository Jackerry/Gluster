<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	$dbhost = 'localhost:3306';  //mysql服务器主机地址
	$dbuser = 'zcp';      //mysql用户名
	$dbpass = '123456';//mysql用户名密码
	//连接数据库
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
		die('Could not connect: ' . mysqli_connect_errno($conn));
	}
	//echo 'Connected successfully';
	//进入gluster数据库
	$sql = 'USE gluster;';
	$retval = mysqli_query( $conn,$sql  );
	if(! $retval )
	{
	  die('failure: ' . mysqli_error($conn));
	}
	//从ip_list列表中读数据
	$sql = 'SELECT * FROM `gluster_list`;';
	$retval = mysqli_query( $conn,$sql  );
	if(! $retval )
	{
	  die('failure: ' . mysqli_error($conn));
	}
	// 关联数组
	$row=mysqli_fetch_all($retval,MYSQLI_ASSOC);
	echo count($row);
	for($i=0; $i<count($row); $i++)
		echo $row[$i]['ip'].','.$row[$i]['status'].'<br />';	
	
	mysqli_close($conn);

?>



</body>
</html>