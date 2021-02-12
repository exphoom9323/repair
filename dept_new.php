<?php
    require "session.php";
    require "header.php";
?>
    <script>
        function dept_new() {
            var dept_name = $("#inputDepartment").val();
            $("#msgErrorDepartment").text("");
            
            if (dept_name == "") {
                $("#msgErrorDepartment").text("กรุณาพิมพ์ชื่อแผนกใหม่");
                $("#inputDepartment").focus();
            } else {
                $.ajax({
                    method: "post",
                    url: "AddNewDepartment.php",
                    data: {dept_name: dept_name}
                }).done(function(msg) {
                    if (msg == "ERROR") {
                        $("#msgErrorDepartment").text("บันทึกข้อมูลไม่สำเร็จ");
                    } else if (msg == "COMPLETE") {
                        alert("บันทึกข้อมูลแผนกใหม่ เรียบร้อยแล้ว");
                        location.replace("department.php");
                    }
                });
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">

    <form class="form-signin">
        <center><h4>เพิ่มข้อมูลแผนก</h4></center>
        <div class="form-group">
            <label for="inputDepartment">แผนก</label>
            <input type="text" name="department_name" class="form-control" id="inputDepartment" placeholder="ชื่อแผนกใหม่" required autofocus>
            <div id="msgErrorDepartment" style="color: red;"></div>
        </div>
        
        <button type="button" class="btn btn-primary" onclick="dept_new()">บันทึก</button>
    </form>
    
<?php    
    require "footer.php";
