<?php  
	include_once('connection.php'); 
	$Name = $_POST['Name'];
	$Tag  =  $_POST['Tag'];
	$Uid = $_POST['Uid'];
	
	$getdata = mysqli_query($conn,"SELECT * FROM rfid WHERE Uid ='$Uid'"); 
	$rows = mysqli_num_rows($getdata);
	
	$respose = array();
	if($rows > 0 )
	{
		$query  =  " UPDATE rfid SET  Name= '$Name'   WHERE Uid = '$Uid'" ;
		$exequery  =  mysqli_query($conn,$query);
		if($exequery)
		{
				$respose['code'] =1;
				$respose['message'] = "Update Success";
		}
		else
		{
				$respose['code'] =0;
				$respose['message'] = "Failed Update";
		}
	}
	else
	{
				$respose['code'] =0;
				$respose['message'] =  " Failed Update: data not found " ;
	}
	
	echo json_encode($respose);
?>