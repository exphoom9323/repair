<?php
    require "session.php";
    require "header.php";
	require 'connectdb.php';
	$id = $_GET['id'];
    $strSQL = "select * from department where dep_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$dep_id = $data['dep_id'];
    $dep_name = $data['dep_name'];
?>
    <script>
		function dept_edit(dep_id) {
			var dept_name = $("#inputDepartment").val();
			
            msgConfirm = "ต้องการแก้ไขแผนก ใช่หรือไม่ ??";
            if (confirm(msgConfirm)==true) {
                $.ajax({
                   method: "post",
                   url: "edit_department.php",
                   data: { dep_id: dep_id, dept_name: dept_name }
               }).done(function(msg) {
                   if (msg == "ERROR") {
                       alert("แก้ไขข้อมูลแผนกไม่สำเร็จ");
                   } else {
                       alert("แก้ไขข้อมูลแผนกเรียบร้อยแล้ว");
                       location.replace("department.php");
                   }
                });
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">

    <form class="form-signin">
        <center><h4>แก้ไขข้อมูลแผนก</h4></center>
        <div class="form-group">
            <label for="inputDepartment">แผนก</label>
            <input type="text" name="department_name" class="form-control" id="inputDepartment" value="<?php echo $dep_name; ?>" >
        </div>
        
        <button type="button" class="btn btn-primary" onclick="dept_edit(<?php echo $dep_id; ?>)">บันทึกการแก้ไข</button>
    </form>
    
<?php    
    require "footer.php";
