<?php
	include '../logic/start.php';

	if(isset($_SESSION['gluster_list'])){
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

?>
