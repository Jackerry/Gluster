<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php

$s='peer status';
$str="gluster ".$s.' --xml';
$file_name='cli file/'.$str.'.xml';
$ip="192.168.150.76";

//这个用于连接有nmap工具的linux系统
if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
// log in at server1.example.com on port 22

if(!($con = ssh2_connect($ip, 22))){
    echo "fail: unable to establish connection\n";
} else {
    // try to authenticate with username root, password secretpassword
    if(!ssh2_auth_password($con, "root", "123456")) {
        echo "fail: unable to authenticate\n";
    } else {
        // allright, we're in!
        //echo "okay: logged in...\n";        
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
				$myfile = fopen($file_name, "w") or die("Unable to open file!");
				fwrite($myfile, $data);					
				fclose($stream);
				echo 'ok';			
			
		}		
    }
}




?>

</body>
</html>