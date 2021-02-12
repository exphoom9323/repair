<?php
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    require 'connectdb.php';
    
    $strSQL = "select * from user where user_name='" . $username . "';";
    $result = mysqli_query($link, $strSQL);

    if (mysqli_num_rows($result) == 0) {
        $salt = "1234567890";
        $hash_password = hash_hmac('sha256', $password, $salt);
    
        $strSQL = "insert into user (user_name, user_password, user_type) values ('" . $username . "','" . $hash_password . "', 3);";
        $result = mysqli_query($link, $strSQL);
    
        if ($result) {
            echo "COMPLETED";
        } else {
            echo "ERROR";
        }
    } else {
        echo "DUPLICATED";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
    
    