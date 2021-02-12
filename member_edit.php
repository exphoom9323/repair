<?php
    require "session.php";
    require "header.php";
	require 'connectdb.php';
	$id = $_GET['id'];
    $strSQL = "select * from user where user_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$user_id = $data['user_id'];
    $user_name = $data['user_name'];
	$user_type = $data['user_type'];
?>
    <script>
		function member_edit(user_id) {
			var user_name = $("#inputDepartment").val();
			var user_type = $("#user_type").val();
			
            msgConfirm = "ต้องการแก้ไขแผนก ใช่หรือไม่ ??";
            if (confirm(msgConfirm)==true) {
                $.ajax({
                   method: "post",
                   url: "edit_member.php",
                   data: { user_id: user_id, user_name: user_name, user_type: user_type }
               }).done(function(msg) {
                   if (msg == "ERROR") {
                       alert("แก้ไขข้อมูลผุ้ใช้ไม่สำเร็จ");
                   } else {
                       alert("แก้ไขข้อมูลผู้ใช้เรียบร้อยแล้ว");
                       location.replace("member.php");
                   }
                });
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">

    <form class="form-signin">
        <center><h4>แก้ไขข้อมูลผู้ใช้งาน</h4></center>
        <div class="form-group">
            <label for="inputDepartment">ชื่อผู้ใช้</label>
            <input type="text" name="department_name" class="form-control" id="inputDepartment" value="<?php echo $user_name; ?>" >
        </div>
		<div class="form-group">
    <label>ระดับ</label>
    <select class="form-control" name="user_type" id="user_type" >
<?php
	if($user_type == "Admin") {
		echo "<option value='1'>Admin</option>";
		echo "<option value='2'>Staff</option>";
		echo "<option value='3'>Employee</option>";
	}else if($user_type == "Staff") {
		echo "<option value='2'>Staff</option>";
		echo "<option value='1'>Admin</option>";
		echo "<option value='3'>Employee</option>";
	}else if($user_type == "Employee") {
		echo "<option value='3'>Employee</option>";
		echo "<option value='1'>Admin</option>";
		echo "<option value='2'>Staff</option>";
	} 
?>
	
    </select>
  </div>
        
        <button type="button" class="btn btn-primary" onclick="member_edit(<?php echo $user_id; ?>)">บันทึกการแก้ไข</button>
    </form>
    
<?php    
    require "footer.php";
