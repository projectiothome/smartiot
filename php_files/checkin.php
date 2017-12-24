<?php
        include("connect.php");

        $link=Connection();


        $ID=$_GET["ID"]; \\ get values from arduino rfid
        $query = "INSERT INTO `check_in` (`UID`)
                VALUES ('".$ID."')";

        mysql_query($query,$link);
        mysql_close($link);
        header("Location: indexrf.php");
        echo "\nDatabase updated";

?>

