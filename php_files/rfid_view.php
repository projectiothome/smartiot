<?php 
	include_once('connection.php'); 
	$query = "SELECT * FROM accesslog";
	$result = mysqli_query($conn,$query);
	$arraydata = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$arraydata[] = $row ;
	}
	echo json_encode($arraydata);
 ?>