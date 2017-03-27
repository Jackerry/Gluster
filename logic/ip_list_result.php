<?php
	include '../logic/start.php';
	
	//从myscan.xml文件中，读取ip和状态，并使输出为json格式，可以被logic/setting_pools.php中，自动探测 的onclick函数所接收，然后在 网内主机列表 输出相应的信息
	/*echo '[';
	if(0<count($host)){
		$addr = $host[0]->address->attributes()->addr;
		$state = $host[0]->status->attributes()->state;
		echo '{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	for ($i=1; $i<count($host); $i++){
		$addr = $host[$i]->address->attributes()->addr;
		$state = $host[$i]->status->attributes()->state;
		echo ',{"ip":"'.$addr.'","state":"'.$state.'"}';
	}
	echo ']';*/
	if(isset($_SESSION['ip_list'])){
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

?>
