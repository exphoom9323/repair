<?php
	require 'session.php';
    require 'header.php';
    require 'connectdb.php';
	
	$strSQL = "select repair.*, user.user_name, department.dep_name from repair ";
	$strSQL = $strSQL . "left join user on repair.user_id=user.user_id ";
	$strSQL = $strSQL . "left join department on repair.dep_id=department.dep_id ";
	$strSQL = $strSQL . "where repair_id='" . $_GET['id'] . "';";
	$result = mysqli_query($link, $strSQL);
	
	$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$repair_id = $data['repair_id'];
	$dep_name = $data['dep_name'];
	$user_id = $data['user_id'];
	$user_name = $data['user_name'];
	$detail = $data['detail'];
	$date1 = $data['date1'];
	
	mysqli_free_result($result);
	mysqli_close($link);
	
	echo "<h4>รายละเอียดการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์</h4>";
	
	echo "<table class='table table-striped table-bordered table-sm'>";
	echo "<tr>";
	echo		"<td width='20%'>รหัสการแจ้งซ่อม</td>";
	echo		"<td>" . $repair_id . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo		"<td>ผู้แจ้งซ่อม</td>";
	echo		"<td>" . $user_name . "(" . $user_id . ")" . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo		"<td>แผนก</td>";
	echo		"<td>" . $dep_name . "(" . $dep_id . ")" . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo		"<td>วันที่แจ้ง</td>";
	echo		"<td>" . $date1  . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo		"<td>รายระเอียด</td>";
	echo		"<td>" . $detail  . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo		"<td>&nbsp;</td>";
	echo 		"<td><a class='btn btn-outline-success btn-sm' href='service.php?id=" . $repair_id . "'>บันทึกดำเนินการซ่อม</a></td>";
	echo "</tr>";
	echo "</table>";
	
	require 'footer.php';
