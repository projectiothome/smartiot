<?php 
	include_once('connection.php');
	$Uid = $_POST['Uid']; 
	$getdata = mysqli_query($conn,"SELECT * FROM rfid WHERE Uid ='$Uid'");
	$DTag = mysqli_query($conn, "SELECT Tag FROM rfid WHERE Uid ='$Uid'");
	$DTvalue = ' ';
	while($row = mysqli_fetch_array($DTag)){
		$DTvalue = $row['Tag'];
		}
	$cmd = "Remove" ;
	$data = ['cmd'=>$cmd, 'data'=>$DTvalue];
	$json_data=json_encode($data);
	$ret = file_put_contents('mydata.txt', $json_data, FILE_APPEND | LOCK_EX );
	$rows = mysqli_num_rows($getdata);
	$delete = "DELETE FROM rfid WHERE Uid ='$Uid'";
	
	$exedelete = mysqli_query($conn,$delete);
	$respose = array();
	if($rows > 0)
	{
		if($exedelete)
		{
			$respose['code'] =1;
			$respose['message'] = "Delete Success";
		}
		else
		{
		$respose['code'] =0;
		$respose['message'] = "Failed Delete";
		}
	}
	else
	{
		$respose['code'] =0;
		$respose['message'] = "Failed Delete, data not found";
	}
	
	echo json_encode($respose);
 ?>