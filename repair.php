<?php
	require "session.php";
	require "header.php";
        require "connectdb.php";
        $user_id = $_SESSION['UserID'];
        $user_name = $_SESSION['Username'];
        $strSQL = "select * from department";
        $result = mysqli_query($link, $strSQL);
?>
    <script>
        function repair() {
            var user_id = $("#UserID").val();
            var user_name = $("#Username").val();
            var dep_id = $("#SelectDepartment").val();
            var detail = $("#inputRepair").val();
            
            if (detail == "") {
                $("#msgErrorRepair").text("กรุณาพิมพ์ข้อความแจ้งซ่อม");
                $("#inputRepair").focus();
            } else {
                //alert(user_id+"--"+user_name+"--"+dep_id+"--"+detail);
                $.ajax({
                    method: "post",
                    url: "AddNewRepair.php",
                    data: { dep_id: dep_id, user_id: user_id, detail: detail}
                }).done (function(msg) {
                    //alert(msg);
                    if (msg == "ERROR") {
                        $("#msgErrorRepair").text("เกิดข้อผิดพลาด บันทึกข้อมูลไม่สำเร็จ");
                        //alert(msg);
                    } else if (msg == "COMPLETED") {
                        location.replace("index.php");
                        location.replace("LINE_Notify.php?detail="+detail);
                        alert("บันทึกข้อมูลการแจ้งซ่อม เรียบร้อยแล้ว");
                    } else {
                        alert(msg);
                    }
                });
            }
        }
    </script>
    <form>
        <h4>แจ้งซ้อมอุปกรณ์คอมพิวเตอร์</h4>
        <div class="form-group">
            <label for="Username">ผู้แจ้ง</label>
            <input type="text" name="Username" class="form-control" id="Username" readonly value="<?php echo $user_name . "(" . $user_id . ")"; ?>">
            <input type="hidden" id="UserID" value="<?php echo $user_id; ?>">
        </div>
        <div class="form-group">
            <label>แผนก</label>
            <select class="form-control" id="SelectDepartment">
                <?php
                    while ($date = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                        echo "<option value='" . $date['dep_id'] . "'>" . $date['dep_name'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="inputRepair">ข้อความแจ้งซ่อม</label>
            <input type="text" name="Repair" class="form-control" id="inputRepair" placeholder="พิมข้อความแจ้งซ่อม" required>
            <div id="msgErrorRepair" style="color: red;"></div>
        </div>
        
        <button type="button" class="btn btn-primary" onclick="repair()">บันทึกข้อความแจ้งซ่อม</button>
    </form>
    <?php
        require "footer.php";