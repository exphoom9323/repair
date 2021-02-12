<?php
	require 'session.php';
    require 'header.php';
    require 'connectdb.php';
	
	$repair_id = $_GET['id'];
	$strSQL = "select repair.*, user.user_name, department.dep_name from repair ";
	$strSQL = $strSQL . "left join user on repair.user_id=user.user_id ";
	$strSQL = $strSQL . "left join department on repair.dep_id=department.dep_id ";
	$strSQL = $strSQL . "where repair_id=" . $repair_id . " order by date1 desc;";
	$result = mysqli_query($link, $strSQL);
	
	$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$repair_id = $data['repair_id'];
	$dep_id = $data['dep_id'];
	$dep_name = $data['dep_name'];
	$user_id = $data['user_id'];
	$user_name = $data['user_name'];
	$detail = $data['detail'];
	$date1 = $data['date1'];
	
	if(!$result) {
		echo mysqli_error($dbcon);
	} else if(mysqli_num_rows($result) != 0) {
		echo "<h4>บันทึกผลการดำเนินการซ่อมอุปกรณ์คอมพิวเตอร์</h4>"
?>
	<table class="table table-striped table-bordered table-sm">
		<tr>
			<td width='20%'>รหัสการแจ้งซ่อม:</td>
			<td><?php echo $repair_id; ?></td>
		</tr>
		<tr>
			<td>ผู้แจ้งซ่อม:</td>
			<td><?php echo $user_name . "(" . $user_id . ")"; ?></td>
		</tr>
		<tr>
			<td>แผนก:</td>
			<td><?php echo $dep_name . "(" . $dep_id . ")"; ?></td>
		</tr>
		<tr>
			<td >วันที่แจ้งซ่อม:</td>
			<td><?php echo $date1; ?></td>
		</tr>
		<tr>
			<td >รายละเอียด:</td>
			<td><?php echo $detail; ?></td>
		</tr>
		<tr>
			<td>บันทึกผลการซ่อม</td>
			<td>
				<input type="text" name="detail" class="form-control" id="detail" required autofocus>
				<div id="msgError" style="color: red;"></div>
				<input type="hidden" id="repair_id" value="<?php echo $repair_id; ?>"><br />
				<button type="button" class="btn btn-primary" onclick="service()">บันทึก</button>
			</td>
		</tr>
	</table>
<?php

	}
	mysqli_free_result($result);
	mysqli_close($link);
	require 'footer.php';
?>
<script>
        function service() {
            var detail = $("#detail").val();
			var repair_id = $("#repair_id").val();
            
            if (detail == "") {
                $("#msgError").text("กรุณาป้อนผลการดำเนินการซ่อม");
                $("#detail").focus();
            } else {
                $.ajax({
                    method: "post",
                    url: "service2.php",
                    data: {detail: detail, repair_id: repair_id}
                }).done(function(msg) {
                    if (msg == "ERROR") {
                        $("#msgError").text("เกิดข้อผิดพลาด บันทึกข้อมูลไม่สำเร็จ");
                    } else if (msg == "COMPLETE") {
                        alert("บันทึกข้อมูลการดำเนินการซ่อม เรียบร้อยแล้ว");
                        location.replace("show_repair.php");
                    } else {
						alert(msg);
					}
                });
            }
        }
    </script>
