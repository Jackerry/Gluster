<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
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
		
		echo $_SESSION['name'];
		$file = fopen($_SESSION['name'], "r") or exit("无法打开文件!");
		// 读取文件每一行，直到文件结尾		
		while(!feof($file))
		{
			//去除每行换行符，否则会有异常，更新到ip_list
			$ip=trim(fgets($file));
			update_ip_list($ip,"unknown");
						
			//set command，使命令变成需要的nmap命令
			$str="nmap -sP ".$ip." -oX file_ip.xml";
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
			if (!($stream = ssh2_exec($con, "cat file_ip.xml" ))) {
				echo "fail: unable to execute command\n";
			} else {
				// collect returning data from command
				stream_set_blocking($stream, true);
				$data = "";
				while ($buf = fread($stream,4096)) {
					$data .= $buf;
				}
				//echo $data;
				$myfile = fopen("xml/file_ip.xml", "w") or die("Unable to open file!");
				fwrite($myfile, $data);					
				fclose($stream);
			}
			
			//从file_ip.xml文件中，读取ip和状态，并放入ip_list列表中		
			$xml = simplexml_load_file("xml/file_ip.xml");
			$host = $xml->host;
			for ($i=0; $i<count($host); $i++){
				$addr = (string)$host[$i]->address->attributes()->addr;
				$state = (string)$host[$i]->status->attributes()->state;
				update_ip_list($addr,$state);
			}
			
		}		
		fclose($myfile);
		fclose($file);	

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