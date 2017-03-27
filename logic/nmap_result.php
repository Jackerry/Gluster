<!-- 用于连接有nmap工具的linux系统，在集群配置setting_pools中自动探测使用  -->
<?php include '../logic/start.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>nmap_result自动探测结果</title>
</head>

<body>

<?php
//将ip_list列表内容清空，默认每次点击 自动探测 就清空先，再探测ip
$_SESSION['ip_list']=array();
$_SESSION['gluster_list']=array();
$_SESSION['current_list']=array();

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
		if(isset($_SESSION['start_ip'])){$st=$_SESSION['start_ip'];}else $st=$_SESSION['default_start_ip'];
		if(isset($_SESSION['end_ip'])){$et=$_SESSION['end_ip'];}else $et=$_SESSION['default_end_ip'];
		$et_t=explode('.',$et,4);
		$str="nmap -sP ".$st."-".$et_t[3]." -oX myscan.xml";
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
        if (!($stream = ssh2_exec($con, "cat myscan.xml" ))) {
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
			$myfile = fopen("xml/myscan.xml", "w") or die("Unable to open file!");
			fwrite($myfile, $data);
			fclose($myfile);
						
            fclose($stream);
			
			
			//从myscan.xml文件中，读取ip和状态，并放入ip_list列表中		
			$xml = simplexml_load_file("xml/myscan.xml");
			$host = $xml->host;
			for ($i=0; $i<count($host); $i++){
				$addr = (string)$host[$i]->address->attributes()->addr;
				$state = (string)$host[$i]->status->attributes()->state;
				update_ip_list($addr,$state);
			}
        }
		if (!($stream = ssh2_exec($con, "rm -f myscan.xml" ))) {
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


?>


</body>
</html>