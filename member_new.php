<?php
    require "session.php";
    require "header.php";

?>
    <script>
        function dept_new() {
            var user_name = $("#inputDepartment").val(); 
			var user_type = $("#user_type").val();
			var pwd1 = $("#inputPassword").val();
            var pwd2 = $("#inputPassword2").val();
            $("#msgErrorDepartment").text("");
			$("#msgErrorPassword1").text("");
            $("#msgErrorPassword2").text("");
            $("#inputPassword3").text("");
			
            if (user_name == "") {
                $("#msgErrorDepartment").text("กรุณาพิมพ์ชื่อผู้ใช้ไหมใหม่");
                $("#inputDepartment").focus();
            }else if(pwd1 == "") {
                $("#msgErrorPassword1").text("กรุณาพิมพ์รหัสผ่าน");
                $("#inputPassword").focus();
            } else if (pwd2 == "") {
                $("#msgErrorPassword2").text("กรุณายืนยันรหัสผ่าน");
                $("#inputPassword2").focus();
            } else if (pwd1 != pwd2) {
                $("#inputPassword3").text("พิมพ์รหัสผ่านไม่เหมือนกัน");
            } else {
                $.ajax({
                    method: "post",
                    url: "new_member.php",
                    data: {user_name: user_name, user_type: user_type, password: pwd1 }
                }).done(function(msg) {
                    if (msg == "ERROR") {
                        $("#msgErrorDepartment").text("บันทึกข้อมูลไม่สำเร็จ");
                    } else if (msg == "COMPLETE") {
                        alert("บันทึกข้อมูลผู้ใช้ใหม่ เรียบร้อยแล้ว");
                        location.replace("member.php");
                    } else if (msg == "DUPLICATED") {
                        $("#msgErrorDepartment").text("ชื่อผู้ใช้ซ้ำ");
                    }
                });
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">

    <form class="form-signin">
        <center><h4>เพิ่มข้อมูลผู้ใช้งาน</h4></center>
        <div class="form-group">
            <label for="inputDepartment">ผู้ใช้งาน</label>
            <input type="text" name="department_name" class="form-control" id="inputDepartment" placeholder="ชื่อผู้ใช้งาน" required autofocus>
            <div id="msgErrorDepartment" style="color: red;"></div>
        </div>
        <div class="form-group">
    <label>ระดับ</label>
    <select class="form-control" name="user_type" id="user_type" >
	<option value='1'>Admin</option>
      <option value='2'>Staff</option>
      <option value='3'>Employee</option>
    </select>
  </div>
  <div  class="from-group">
            <label for="inputPassword">รหัสผ่าน</label>
            <input type="password" name="Password1" id="inputPassword" class="form-control" placeholder="Password" required>
            <div id="msgErrorPassword1" style="color: red;"></div>
        </div>
        <div class="from-group">
            <label for="inputPassword2">ยืนยันรหัสผ่าน</label>
            <input type="password" name="Password2" id="inputPassword2" class="form-control" placeholder="Password" required>
            <div id="msgErrorPassword2" style="color: red;"></div>
        </div>
		<div id="inputPassword3" style="color: red;"></div>
        <button type="button" class="btn btn-primary" onclick="dept_new()">บันทึก</button>
    </form>
    
<?php    
    require "footer.php";
