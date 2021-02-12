<?php

    $user_id = $_POST['user_id'];
    $dep_id = $_POST['dep_id'];
    $detail = mysql_real_escape_string($_POST['detail']);

    
    require "connectdb.php";
    
    $strSQL = "insert into repair (dep_id, user_id, detail, date1) values";
    $strSQL = $strSQL . "(" . $dep_id . "," . $user_id . ",'" . $detail . "','" . date("Y-m-d") . "');";

    $result = mysqli_query($link, $strSQL);
    if ($result) {
        echo "COMPLETED";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
