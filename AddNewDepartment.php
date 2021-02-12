<?php
    require "connectdb.php";

    $dept_name = mysql_real_escape_string($_POST['dept_name']);
    
    $strSQL = "insert into department (dep_name) values ('" . $dept_name . "');";
    $result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETE";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);
    