<?php
/* This code takes Tag value sent from RFID reader.
Then tries to check if the Tag value matches with existing Registered users in "rfid" table.
if not found takes the tag value and notes the Name field with anonymous access*/
include_once('connection.php');
  	//connect to the database

$Tag= $_GET['Tag']; // variable to recieve Tag value from RFID

$DTag = mysqli_query($conn, "SELECT Name, Uid FROM rfid WHERE Tag ='$Tag'");
 //rfid table contains Name, Tag, Uid fields, consider it as userbase
$TName = '';
$TUid = '';
	while($row = mysqli_fetch_array($DTag)){
		$TName = $row['Name']; // fetch the name of the user with the Tag value
		$TUid = $row['Uid'];
		}
if(!empty($TName)){
	$query = "INSERT INTO accesslog (Name, Tag, Uid) VALUES ('$TName','$Tag', '$TUid')";}
   // accesslog table contains when each user has accessed using his Tag
else{
	$query = "INSERT INTO accesslog (Name, Tag, Uid) VALUES ('Anonymous', '$Tag', '0')";
}
$exeinsert = mysqli_query($conn,$query);
if($exeinsert){
	echo "Access logged";
}
?>
