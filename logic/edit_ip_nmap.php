<!-- 用于连接有nmap工具的linux系统，在集群配置setting_pools中 手动 按钮使用 -->
<?php include '../logic/start.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>edit_ip_nmap</title>
</head>

<body>

<?php

if(isset($_GET['edit_ip'])){	
	//从请求URL地址中获取 q 参数
	$edit_ip=$_GET["edit_ip"];
//if(isset($_SESSION['edit_ip_new'])&&$_SESSION['edit_ip_new']=="true"){
	/*$_SESSION['edit_ip_new']="false";
	$edit_ip = $_SESSION['edit_ip'];		
	$_SESSION['edit_ip']="";*/
	
	
	//这个用于连接有nmap工具的linux系统
	if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
	// log in at server1.example.com on port 22
	//获得nmap的地址
	if(isset($_SESSION['nmap_ip']))
		$nmap_ip=$_SESSION['nmap_ip'];
	else 
		$nmap_ip="192.168.150.85";	
		
	if(!($con = ssh2_connect($nmap_ip, 22))){
		echo "fail: unable to establish connection\n";
	} else {
		// try to authenticate with username root, password secretpassword
		if(!ssh2_auth_password($con, "root", "123456")) {
			echo "fail: unable to authenticate\n";
		} else {
			// allright, we're in!
			//echo "okay: logged in...\n";        
			
			//set command，使命令变成需要的nmap命令
			$str="nmap -sP ".$edit_ip." -oX edit_ip.xml";
			// execute a command
			if (!($stream = ssh2_exec($con, $str ))) {
				echo "fail: unable to execute command\n";
			} else {
				// collect returning data from command
				stream_set_blocking($stream, true);
				$data = "";
				while ($buf = fread($stream,4096)) {
					$data .= $buf;
				}
				//echo $data;
				fclose($stream);
			}
			if (!($stream = ssh2_exec($con, "cat edit_ip.xml" ))) {
				echo "fail: unable to execute command\n";
			} else {
				// collect returning data from command
				stream_set_blocking($stream, true);
				$data = "";
				while ($buf = fread($stream,4096)) {
					$data .= $buf;
				}
				//echo $data;
				//将输出的myscan.xml文件内容，重新在本地创建一个内容相同的myscan.xml文件
				$myfile = fopen("xml/edit_ip.xml", "w") or die("Unable to open file!");
				fwrite($myfile, $data);
				fclose($myfile);
							
				fclose($stream);
				
				update_ip_list($edit_ip,"unknown");	
				
				//从edit_ip.xml文件中，读取ip和状态，并放入ip_list列表中	
				$xml = simplexml_load_file("xml/edit_ip.xml");
				$host = $xml->host;
				for ($i=0; $i<count($host); $i++){
					$addr = (string)$host[$i]->address->attributes()->addr;
					$state = (string)$host[$i]->status->attributes()->state;
					update_ip_list($addr,$state);
				}
			}
			if (!($stream = ssh2_exec($con, "rm -f edit_ip.xml" ))) {
				echo "fail: unable to execute command\n";
			} else {
				// collect returning data from command
				stream_set_blocking($stream, true);
				$data = "";
				while ($buf = fread($stream,4096)) {
					$data .= $buf;
				}
				//echo $data;
				fclose($stream);
			}
	
		}
	}

}
include '../logic/db/db_reflash_ip_list.php'; 	
//}
?>


</body>
</html>