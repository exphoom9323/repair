<?php
	require 'session.php';
    require 'header.php';
    require 'connectdb.php';
	
	echo "<h2>รายการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์</h2>";
	
	$strSQL = "select repair.*, user.user_name, department.dep_name from repair ";
	$strSQL = $strSQL . "left join user on repair.user_id=user.user_id ";
	$strSQL = $strSQL . "left join department on repair.dep_id=department.dep_id ";
	$strSQL = $strSQL . "order by date1 desc;" ;
	$result = mysqli_query($link, $strSQL);
	
	if (!$result) {
        echo mysqli_error($link);
    } else if (mysqli_num_rows($result) != 0 ) {
?>
<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <th>รหัส</th>
			<th>ผู้แจ้ง</th>
			<th>แผนก</th>
			<th>วันที่แจ้งซ่อม</th>
            <th>วันที่ดำเนินการซ่อม</th>
			<th>&nbsp;<th>
        </tr>
    </thead>
	<tbody>
<?php
    while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		echo "<tr>";
		echo "<td>" . $data['repair_id'] . "</td>";
		echo "<td>" . $data['user_name'] . "(" . $data['user_id'] . ")" . "</td>";
		echo "<td>" . $data['dep_name'] . "(" . $data['dep_id'] . ")" . "</td>";
		echo "<td>" . $data['date1'] . "</td>";
		echo "<td>" . $data['service_date'] . "</td>";
		echo "<td>";
		echo "<a class='btn btn-outline-primary btn-sm' href='show_detail_repair.php?id=" . $data['repair_id'] . "'>แสดงรายละเอียด</a>&nbsp;";
		echo "<a class='btn btn-outline-success btn-sm' href='service.php?id=" . $data['repair_id'] . "'>บันทึกดำเนินการซ่อม</a>";
		echo "</td>";
		echo "</tr>";
	}
?>
    </tbody>
    </table>
<?php   
	}
		mysqli_free_result($result);
		mysqli_close($link);
		require 'footer.php';