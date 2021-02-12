<?php
    require 'connectdb.php';
    
    $user_id = $_POST['user_id'];
    $strSQL = "delete from user where user_id=" . $user_id . ";";
    $result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETED";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);