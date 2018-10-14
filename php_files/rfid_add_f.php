<?php 
	include_once('connection.php'); 
	
	$Name = $_POST['Name'];
	$Tag=$_POST['Tag'];
	$Uid=$_POST['Uid'];
	$insert  =  " INSERT INTO rfid(Name, Tag, Uid) VALUES ('$Name','$Tag', '$Uid')";
	$exeinsert = mysqli_query($conn,$insert);
	file_put_contents('mydata.txt',"");
	$cmd = "Add" ;
	$data = ['cmd'=> $cmd, 'data'=>$_POST['Tag']];
	$json_data=json_encode($data);
	$ret = file_put_contents('mydata.txt', $json_data, FILE_APPEND | LOCK_EX );
	$response = array();
	if($exeinsert)
	{
		$response['code'] =1;
		$response['message'] = "Success ! Data added successfully";
		
	}
	else
	{
		$response['code'] =0;
		$response['message'] =  " Failed! Data failed to be added " ;
	}
		echo json_encode($response);
 ?>