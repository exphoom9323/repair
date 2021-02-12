<?php
    require 'session.php';
    require 'header.php';
    require 'connectdb.php';
    
    $id = $_GET['id'];
    $strSQL = "select * from user where user_id=" . $id . ";";
    $result = mysqli_query($link, $strSQL);
    $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $user_id = $data['user_id'];
    $user_name = $data['user_name'];
    
    mysqli_free_result($result);
    mysqli_close($link);
	
	session_start();
	$loginid = $_SESSION['UserID'];
?>
    <script>
        function member_name(user_id, loginid) {
            msgConfirm = "ต้องการลบผู้ใช้งาน ใช่หรือไม่ ??";
            if (confirm(msgConfirm)==true) {
				if(loginid != user_id) {
				
				$.ajax({
                   method: "post",
                   url: "remove_member.php",
                   data: {user_id: user_id }
               }).done(function(msg) {
                   if (msg == "ERROR") {
                       alert("ลบข้อมูลแผนกไม่สำเร็จ");
                   } else {
                       alert("ลบข้อมูลแผนกเรียบร้อยแล้ว");
                       location.replace("member.php");
                   }
                });
				
				}else {
					alert("ชื่อผู้ใช้ทำการ Login อยู่ ไม่สามารถลบได้");
				}
            }
        }
    </script>
    
    <link href="css/signin.css" rel="stylesheet">
    <form class="form-signin">
          <center><h4>ลบข้อมูลแผนก</h4></center>
        <label for="inputDepartment">แผนก</label>
		<div class="form-group">
        <input type="text" name="dep_name" class="form-control" id="inputDepratment" readonly value="<?php echo $user_name; ?>">
		</div>
		<div class="form-group">
        <button type="button" class="btn btn-danger" onclick="member_name(<?php echo $user_id ;?>, <?php echo $loginid ;?>)">ลบแผนก</button>
		</div>
    </form>
    <?php    
    require 'footer.php';

