<?php
    require "connectdb.php";

    $dept_id = $_POST['dept_id'];
    $dept_name = mysql_real_escape_string($_POST['dept_name']);
    
    $strSQL = "update department set dep_name='" . $dept_name . "' where dep_id=" . $dept_id . ";";
    $result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETE";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
    