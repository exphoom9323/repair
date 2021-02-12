<?php
    require 'session.php';
    require 'header.php';
    require 'connectdb.php';
    
    $id = $_GET['id'];
    $strSQL = "select * from department where dep_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $dep_id = $data['dep_id'];
    $dep_name = $data['dep_name'];
    
    mysqli_free_result($result);
    mysqli_close($link);
?>
    <script>
        function dept_name(dep_id) {
            msgConfirm = "ต้องการลบแผนก ใช่หรือไม่ ??";
            if (confirm(msgConfirm)==true) {
                $.ajax({
                   method: "post",
                   url: "remove_department.php",
                   data: {dep_id: dep_id }
               }).done(function(msg) {
                   if (msg == "ERROR") {
                       alert("ลบข้อมูลแผนกไม่สำเร็จ");
                   } else {
                       alert("ลบข้อมูลแผนกเรียบร้อยแล้ว");
                       location.replace("department.php");
                   }
                });
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">
    <form class="form-signin">
          <center><h4>ลบข้อมูลแผนก</h4></center>
        <label for="inputDepartment">แผนก</label>
		<div class="form-group">
        <input type="text" name="dep_name" class="form-control" id="inputDepratment" readonly value="<?php echo $dep_name; ?>">
		</div>
		<div class="form-group">
        <button type="button" class="btn btn-danger" onclick="dept_name(<?php echo $dep_id; ?>)">ลบแผนก</button>
		</div>
    </form>
    <?php    
    require 'footer.php';

