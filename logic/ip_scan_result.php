

<?php

	$xml = simplexml_load_file("myscan.xml");
	$host = $xml->host;
	echo '[';
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
	echo ']';

?>
