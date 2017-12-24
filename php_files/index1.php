<?php

	include("connect.php"); 	
	
	$link=Connection();
	$response=array();
	$result=mysql_query("SELECT * FROM `temphumi` ORDER BY `date` DESC",$link);

				if(mysql_num_rows($result)>0){
					$response["temphumi"]= array();
					while($row = mysql_fetch_array($result)){
						$temp_humi = array();
						$temp_humi["date"] = $row["date"];
						$temp_humi["Temp"] = $row["Temp"];
						$temp_humi["TempF"] = $row["TempF"];
						$temp_humi["Humi"] = $row["Humi"];
						//pushing details into final array
						array_push($response["temphumi"],$temp_humi);
					}
					
					//success
					$response["success"]=1;
					//echoing json response
					echo json_encode($response);
				} else{
					$response["success"] =  0;
					$response["message"] = "details not available";
					
	echo json_encode($response);
			}

			?>
