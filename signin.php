<?php 
    require 'header.php';
?>
    <script>
        function signin() {
            var usr = $("#inputUsername").val();
            var pwd = $("#inputPassword").val();
            
            if (usr == "") {
                $("#inputUsername").setCustomValidity("กรุณาพิมพ์ชื่อผู้ใช้");
            } else if (pwd == "") {
                $("#inputPassword").setCustomValidity("กรุณาพิมพ์รหัสผ่าน");
            } else {
                $.ajax({
                    method: "post",
                    url: "login.php",
                    data: { username: usr, password: pwd }
                }).done(function(msg) {
                    if (msg == "NotFound") {
                        alert("ชื่อผู้ใช้หรือรหัสผ่าน ไม่ถูกต้อง");
                    }else if (msg == "Found") {
                        location.replace("index.php");
                    }
                });
            }
            
        }
    </script>

      <link href="css/signin.css" rel="stylesheet">
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal"><center>เข้าสู่ระบบ</center></h1>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus oninvalid="this.setCustomValidity('กรุณาพิมพ์ชื่อผู้ใช้')" oninput="setCustomValidity('')">
        <label for="inputPassword" class="sr-only">รหัส</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required oninvalid="this.setCustomValidity('กรุณาพิมพ์รหัสผ่าน')" oninput="setCustomValidity('')">
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="signin()">Sign in</button>
        <center><a href="signup.php">ลงทะเบียนใหม่</a></center>
    </form>
<?php
    require 'footer.php';
?>