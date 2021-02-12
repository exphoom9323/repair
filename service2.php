<?php
    require 'connectdb.php';
    
	$detail = mysql_real_escape_string($_POST['detail']);
    $repair_id = $_POST['repair_id'];
		
		$strSQL = "update repair set service_detail='" . $detail . "', service_date='" . date("Y-m-d") . "' where repair_id=" . $repair_id . " ;";
		$result = mysqli_query($link, $strSQL);
    
    if ($result) {
        echo "COMPLETE";
    } else {
        echo "ERROR";
    }
    
    mysqli_free_result($result);
    mysqli_close($link);