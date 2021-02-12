<?php
    require 'header.php';
	require 'connectdb.php';
	$id = $_GET['id'];
    $strSQL = "select * from user where user_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$user_id = $data['user_id'];
?>

	<script>
		function edit_pwd(user_id) {
			var pwd = $("#inputPassword").val();
            var pwd1 = $("#inputPassword1").val();
            var pwd2 = $("#inputPassword2").val();
			$("#inputPassword").text("");
            $("#msgErrorPassword1").text("");
            $("#msgErrorPassword2").text("");
			
            msgConfirm = "ต้องการเปลี่ยนรหัสผ่าน ใช่หรือไม่ ??";
			
			if (pwd == "") {
                $("#msgErrorPassword").text("กรุณาพิมพ์รหัสผ่านเดิม");
                $("#inputPassword").focus();
            } else if(pwd1 == "") {
                $("#msgErrorPassword1").text("กรุณาพิมพ์รหัสผ่านใหม่");
                $("#inputPassword1").focus();
            } else if (pwd2 == "") {
                $("#msgErrorPassword2").text("กรุณายืนยันรหัสผ่านใหม่");
                $("#inputPassword2").focus();
            } else if (pwd1 != pwd2) {
                $("#msgError").text("พิมพ์รหัสผ่านไม่ตรงกัน");
            } else if (confirm(msgConfirm)==true) {
                $.ajax({
                   method: "post",
                   url: "edit_pwd_post.php",
                   data: { user_id: user_id, password: pwd, password1: pwd1 }
               }).done(function(msg) {
                   if (msg == "NOCOMPLETED") {
                       alert("รหัสผ่านเดิมไม่ถูกต้อง");
                   } else {
                       alert("เปลี่ยนรหัสผ่านเสร็จสิ้น กรุณา Login ใหม่เพื่อเข้าสู่ระบบอีกครั้ง");
					   location.replace("signout.php");
                   }
                });
            }
        }
    </script>
	
    <link href="css/signin.css" rel="stylesheet">
    <form class="form-signin">
        <div>
            <h1 class="h3 mb-3 font-weight-normal"><center>ลงทะเบียน</center></h1> 
        </div>
        <div class="from-group">
            <label for="inputPassword">รหัสผ่านเดิม</label>
            <input type="password" name="Username" id="inputPassword" class="form-control" >
            <div id="msgErrorPassword" style="color: red;"></div>
        </div>
        <div  class="from-group">
            <label for="inputPassword1">รหัสผ่านเดิมใหม่</label>
            <input type="password" name="Password1" id="inputPassword1" class="form-control"  >
            <div id="msgErrorPassword1" style="color: red;"></div>
        </div>
        <div class="from-group">
            <label for="inputPassword2">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" name="Password2" id="inputPassword2" class="form-control"  >
            <div id="msgErrorPassword2" style="color: red;"></div>
			<div id="msgError" style="color: red;"></div>
        </div>
        <button type="button" class="btn btn-primary" onclick="edit_pwd(<?php echo $user_id; ?>)">ลงทะเบียน</button>  
    </form>
<?php
    require 'footer.php';
?>