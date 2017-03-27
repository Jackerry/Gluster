<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清空数据库中三个表的内容</title>
</head>

<body>


<?php
if(!isset($_SESSION))
	session_start();
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
//清空gluster数据库中ip_list表
$sql = 'DELETE FROM `ip_list`;';
$retval = mysqli_query( $conn,$sql  );
if(! $retval )
{
  die('failure: ' . mysqli_error($conn));
}
//清空gluster数据库中gluster_list表
$sql = 'DELETE FROM `gluster_list`;';
$retval = mysqli_query( $conn,$sql  );
if(! $retval )
{
  die('failure: ' . mysqli_error($conn));
}
//清空gluster数据库中current_list表
$sql = 'DELETE FROM `current_list`;';
$retval = mysqli_query( $conn,$sql  );
if(! $retval )
{
  die('failure: ' . mysqli_error($conn));
}
//关闭数据库
mysqli_close($conn);

?>



</body>
</html>