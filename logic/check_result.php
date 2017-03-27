<?php include '../logic/start.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>check_result验证节点结果</title>
</head>

<body>
<?php
//更改gluster_list内的ip的状态

//用于判断是否ip上有gluster
if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
//判断当前可用gluster服务器节点列表 是否为空
if(isset($_SESSION['gluster_list'])){
	$gluster_list=$_SESSION['gluster_list'];
	
	//查看是否设置 gluster_list_auth 内容
	if(isset($_SESSION['gluster_list_auth']))
		$auth=$_SESSION['gluster_list_auth'];
	else{
		echo "没有设置gluster_list_auth";
		return;
	}	
	
	//遍历gluster_list所有ip
	for($i=0; $i<count($gluster_list); $i++){
		//echo $gluster_list[$i][0].",".$gluster_list[$i][1]."<br />";
		//获得当前ip
		$ip=$gluster_list[$i][0];
		//查找当前ip对应的用户和密码	
		$index=-1;
		for($j=0; $j<count($auth); $j++){
			if($ip==$auth[$j][0]){
				$index=$j;
				break;
			}
		}
		if($index==-1){
			echo "未找到对应的ip".$ip."的用户和密码";
			continue;
		}
		$username=$auth[$index][1];
		$password=$auth[$index][2];		
		if($username=="unknown"&&$password=="unknown")
			continue;
		//echo $username.",".$password."<br />";
		
		
		//连接对应ip
		if(!($con = ssh2_connect($ip, 22))){
			echo "fail: unable to establish connection\n";
			continue;
		} else {
						
			// try to authenticate with username root, password secretpassword
			if(!ssh2_auth_password($con, $username, $password)) {
				echo "fail: unable to authenticate\n";
				continue;
			} else {
				// allright, we're in!
				//echo "okay: logged in...\n";   
				
				//set command
				$str="gluster --version --xml";
				// execute a command
				if (!($stream = ssh2_exec($con, $str ))) {
					echo "fail: unable to execute command\n";
					continue;
				} else {
					// collect returning data from command
					stream_set_blocking($stream, true);
					$data = "";
					while ($buf = fread($stream,4096)) {
						$data .= $buf;
					}
					//echo $data;
					$file_name="xml/"."gluster --version".".xml";
					$myfile = fopen($file_name, "w") or die("Unable to open file!");
					fwrite($myfile, $data);
					fclose($myfile);
					
					fclose($stream);
				}//end ssh2_exec else
			}//end ssh2_auth_password else
		}//end ssh2_connect else
		
		//读本地存的文件，里面内容是刚才缓存的内容data		
		$file = fopen($file_name, "r") or exit("无法打开文件!");
		// 读取文件第一行，获取版本信息，将信息分成8个，第2个([1])为版本信息。	
		$str=trim(fgets($file));
		//echo $str.'<br />';		
		$s=explode(' ',$str,8);
		fclose($file);
		//判断返回的内容，是不是符合正常返回glusterfs版本的格式，正常则将版本号更新到gluster_list表中
		if($s[0]=="glusterfs"){
			update_gluster_list($ip,$s[1]);
		}else{
			update_gluster_list($ip,"no");
		}
		
		
		
				
	
		
		
	}//end for
	
	
}//end if isset $_SESSION['gluster_list']

?>
</body>
</html>