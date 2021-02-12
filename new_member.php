<?php
    require "connectdb.php";

    $user_name = mysql_real_escape_string($_POST['user_name']);
	$password = mysql_real_escape_string($_POST['password']);
	$user_type = $_POST['user_type'];
    
    $strSQL = "select * from user where user_name='" . $user_name . "';";
    $result = mysqli_query($link, $strSQL);
	
	if (mysqli_num_rows($result) == 0) {
        $salt = "1234567890";
        $hash_password = hash_hmac('sha256', $password, $salt);
		
		$strSQL = "insert into user (user_name, user_password, user_type) values ('" . $user_name . "','" . $hash_password . "','" . $user_type . "');";
		$result = mysqli_query($link, $strSQL);
    
		if ($result) {
			echo "COMPLETE";
		} else {
			echo "ERROR";
		}
		
	} else {
        echo "DUPLICATED";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
    