<?php
include_once('connection.php');
$result= mysql_query("SELECT * FROM keypadd", $conn);
$json = array();
if(mysql_num_rows($result) > 0){
	while($row[] = mysql_fetch_assoc($result)){
	$temp = $row;
	$json = json_encode($row);	
	}
 } else {
	echo "no results found";
}
	echo $json;
?>
