<?php
    require 'header.php';
?>
    <script>
        function passwordup() {
            var usr = $("#inputUsername").val();
            var pwd1 = $("#inputPassword").val();
            var pwd2 = $("#inputPassword2").val();
            $("#msgErrorUsername").text("");
            $("#msgErrorPassword1").text("");
            $("#msgErrorPassword2").text("");
            
            if (usr == "") {
                $("#msgErrorUsername").text("กรุณาพิมพ์ชื่อผู้ใช้ระบบ");
                $("#inputUsername").focus();
            } else if(pwd1 == "") {
                $("#msgErrorPassword1").text("กรุณาพิมพ์รหัสผ่าน");
                $("#inputPassword").focus();
            } else if (pwd2 == "") {
                $("#msgErrorPassword2").text("กรุณายืนยันรหัสผ่าน");
                $("#inputPassword2").focus();
            } else if (pwd1 != pwd2) {
                $("#msgError").text("พิมพ์รหัสผ่านไม่เหมือนกัน");
            } else {
                $.ajax({
                    method: "post",
                    url: "register.php",
                    data: { username: usr, password: pwd1 }
                }).done(function(msg) {
                    if (msg == "ERROR") {
                        $("#msgErrorUsername").text("เกิดข้อผิดพลาด");
                    } else if (msg == "COMPLETED") {
                        location.replace("signin.php");
                    } else if (msg == "DUPLICATED") {
                        $("#msgErrorUsername").text("ชื่อผู้ใช้ซ้ำ");
                    }
                });
            }
        }
    </script>

    <link href="css/signin.css" rel="stylesheet">
    <form class="form-signin">
        <div>
            <h1 class="h3 mb-3 font-weight-normal"><center>ลงทะเบียน</center></h1>
            <div id="msgError" style="color: red;"></div>
        </div>
        <div class="from-group">
            <label for="inputUsername">ชื่อเข้าระบบ</label>
            <input type="text" name="Username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
            <div id="msgErrorUsername" style="color: red;"></div>
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
        <button type="button" class="btn btn-primary" onclick="signup()">ลงทะเบียน</button>  
    </form>
<?php
    require 'footer.php';
?>