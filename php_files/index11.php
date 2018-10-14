<?php

	include_once('connection.php');  	
	$response=array();
	$result=mysql_query("SELECT * FROM `temphumi` ORDER BY `Date` DESC",$conn);
					$response["temphumi"]= array();
					while($row = mysql_fetch_array($result)){
						$temp_humi = array();
						$temp_humi["Date"] = $row["Date"];
						$temp_humi["Temp"] = $row["Temp"];
						$temp_humi["TempF"] = $row["TempF"];
						$temp_humi["Humi"] = $row["Humi"];
						//pushing details into final array
						array_push($response["temphumi"],$temp_humi);
					}
					echo json_encode($response);

			?>
