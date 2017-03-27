<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ip_list_out</title>
</head>

<body>

<?php
//初始start，用于设置初始的session等
session_start();

//用于test和查看ip_list的内容
if(isset($_SESSION['ip_list']))
{
	print_r($_SESSION['ip_list']);
			
	echo "<br /><br />";		
	$array=$_SESSION['ip_list'];
	echo '[';
	if(0<count($array)){
		$addr = $array[0][0];
		$state = $array[0][1];
		echo '{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	for ($i=1; $i<count($array); $i++){
		$addr = $array[$i][0];
		$state = $array[$i][1];
		echo ',{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	echo ']';
}
else
	echo "no";



		


echo "<br /><br />";
//初始ip
echo '初始ip';
if(isset($_SESSION['start_ip']))
	print_r($_SESSION['start_ip']);
else
	echo "no";


echo "<br /><br />";
//结束ip
echo '结束ip';
if(isset($_SESSION['end_ip']))
	print_r($_SESSION['end_ip']);
else
	echo "no";




echo "<br /><br />";
//用于test和查看gluster_list的内容
if(isset($_SESSION['gluster_list']))
{
	print_r($_SESSION['gluster_list']);
			
	echo "<br /><br />";		
	$array=$_SESSION['gluster_list'];
	echo '[';
	if(0<count($array)){
		$addr = $array[0][0];
		$state = $array[0][1];
		echo '{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	for ($i=1; $i<count($array); $i++){
		$addr = $array[$i][0];
		$state = $array[$i][1];
		echo ',{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	echo ']';
}
else
	echo "no";



?>
</body>
</html>