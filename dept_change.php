<?php
    require "session.php";
    require "header.php";
    
    require "connectdb.php";
    $id = $_GET['id'];
    $strSQL = "select * from department where dep_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $dep_id = $data['dep_id'];
    $dep_name = $data['dep_name'];
    mysqli_free_result($result);
    mysqli_close($link);
?>
    <script>
        function dept_remove(dep_id) {
            var dept_name = $("#inputDepartment").val();
            $("#msgErrorDepartment").text("");
            
            if (dept_name == "") {
                $("#msgErrorDepartment").text("กรุณาพิมพ์ชื่อแผนกที่ต้องการแก้ไข");
                $("#inputDepartment").focus();
            } else {
                $.ajax({
                    method: "post",
                    url: "ChangeDepartment.php",
                    data: {dept_id: dep_id, dept_name: dept_name}
                }).done(function(msg) {
                    if (msg == "ERROR") {
                        $("#msgErrorDepartment").text("แก้ไขข้อมูลไม่สำเร็จ");
                    } else if (msg == "COMPLETE") {
                        alert("แก้ไขข้อมูลแผนก เรียบร้อยแล้ว");
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
            <input type="text" name="department_name" class="form-control" id="inputDepartment" autofocus value="<?php echo $data['dep_name']; ?>">
            <div id="msgErrorDepartment" style="color: red;"></div>
        </div>
        
        <button type="button" class="btn btn-primary" onclick="dept_remove(<?php echo $data['dep_id'];?>)">แก้ไขแผนก</button>
    </form>
    
<?php
    require "footer.php";
