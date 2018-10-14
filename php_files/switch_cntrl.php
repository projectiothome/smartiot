<?php 
	$data = ['App'=> $_POST['light'], 'State'=>$_POST['state']];
	file_put_contents('appliance.txt',"");
	$json_data=json_encode($data);
	$ret = file_put_contents('appliance.txt', $json_data, FILE_APPEND | LOCK_EX );
	echo $content;
	
 ?>