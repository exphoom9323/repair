<?php
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    
    $salt = "1234567890";
    $hash_password = hash_hmac('sha256', $password, $salt);
    
    require 'connectdb.php';
    
    $strSQL = "select * from user where user_name='" . $username . "' and user_password='" . $hash_password . "';";
    $result = mysqli_query($link, $strSQL);
    
    if (mysqli_num_rows($result) == 0) {
        echo "NotFound";
    } else {
        session_start();
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION['UserID'] = $row['user_id'];
        $_SESSION['Username'] = $row['user_name'];
        $_SESSION['UserType'] = $row['user_type'];
        
        echo "Found";
        
    }
    
    mysqli_free_result($result);
    mysqli_close($link);

    