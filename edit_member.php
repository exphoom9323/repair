<?php
    require 'connectdb.php';
    
    $user_id = $_POST['user_id'];
	$user_name = mysql_real_escape_string($_POST['user_name']);
	$user_type = $_POST['user_type'];
	
	$strSQL = "update user set user_name='" . $user_name . "', user_type='" . $user_type . "' where user_id=" . $user_id . " ;";
	
    $result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETED";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);