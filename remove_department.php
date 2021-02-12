<?php
    require 'connectdb.php';
    
    $dep_id = $_POST['dep_id'];
    $strSQL = "delete from department where dep_id=" . $dep_id . ";";
    $result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETED";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);