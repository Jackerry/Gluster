<?php
include '../logic/start.php'; 
echo "<br><a href='../views/setting_pools.php'>返回</a><br />";
if(isset($_FILES['file'])){
	// 允许上传的文件后缀
	$allowedExts = array("txt", "xls","xlsx");
	$temp = explode(".", $_FILES["file"]["name"]);
	echo $_FILES["file"]["size"];
	$extension = end($temp);     // 获取文件后缀名
	if ((($_FILES["file"]["type"] == "text/plain")
	|| ($_FILES["file"]["type"] == "application/vnd.ms-excel")
	|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
	&& ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "错误：: " . $_FILES["file"]["error"] . "<br>";
		}
		else
		{
			echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
			echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
			echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
			
			// 判断当期目录下的 upload 目录是否存在该文件
			// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
			if (file_exists("../logic/upload/" . $_FILES["file"]["name"]))
			{
				echo $_FILES["file"]["name"] . " 文件已经存在。 ";
			}
			else
			{
				// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
				move_uploaded_file($_FILES["file"]["tmp_name"], "../logic/upload/" . $_FILES["file"]["name"]);
				echo "文件存储在: " . "../logic/upload/" . $_FILES["file"]["name"];
			}
			echo '<br />正在添加中...';
			
			$_SESSION['name']='upload/'.$_FILES["file"]["name"];
				
			include '../logic/file_nmap.php'; 	
			include '../logic/db/db_reflash_ip_list.php'; 				
		}
	}
	else
	{
		echo "非法的文件格式";
	}
}
?>