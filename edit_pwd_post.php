<?php
    require 'connectdb.php';
    
	$password = mysql_real_escape_string($_POST['password']);
	$password1 = mysql_real_escape_string($_POST['password1']);
    $user_id = $_POST['user_id'];
	
	$salt = "1234567890";
    $hash_password = hash_hmac('sha256', $password, $salt);
	
	$strSQL = "select * from user where user_id='" . $user_id . "';";
    $result = mysqli_query($link, $strSQL);
	
	$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$checkpwd = $data['user_password'];
	
	if($checkpwd != $hash_password) {
		echo "NOCOMPLETED";
	} else {
		$hash_password1 = hash_hmac('sha256', $password1, $salt);
		$strSQL = "update user set user_password='" . $hash_password1 . "' where user_id=" . $user_id . " ;";
		$result = mysqli_query($link, $strSQL);
		echo "COMPLETED";
	}
	 
    mysqli_free_result($result);
    mysqli_close($link);