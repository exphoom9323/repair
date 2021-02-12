<?php
    require 'session.php';
    require 'header.php';
    require 'connectdb.php';
    
    $strSQL ="select * from user";
    $result = mysqli_query($link, $strSQL);
    
    echo "<h2>ข้อมูลผู้ใช้งาน</h2>";
    
    if (!$result) {
        echo mysqli_error($link);
    } else if (mysqli_num_rows($result) != 0 ) {
?>
<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <td>ไอดีผู้ใช้งาน</td>
            <td>ชื่อผู้ใช้งาน</td>
			<td>ตำแหน่ง</td>
            <td>
                <a class="btn btn-outline-success btn-sm" href="member_new.php">เพิ่มผู้ใช้งาน</a>&nbsp;
			<!--	<a class="btn btn-outline-success btn-sm" href="member_pdf.php" target="_new">PDF</a> -->
            </td>
        </tr>
    </thead>
    <tbody>
<?php
        while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $data['user_id'] . "</td>";
            echo "<td>" . $data['user_name'] . "</td>";
			echo "<td>" . $data['user_type'] . "</td>";
            echo "<td>";
            echo "<a class='btn btn-outline-primary btn-sm' href='member_edit.php?id=" . $data['user_id'] . " '>แก้ข้อข้อมูล</a>&nbsp;";
            echo "<a class='btn btn-outline-danger btn-sm' href='member_remove.php?id=" . $data['user_id'] . "'>ลบข้อมูล</a>";
            echo "</td>";
            echo "</tr>";
        }
?>
    </tbody>
    </table>
<?php       
} else {
?>
    <table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <td>ไอดีผู้ใช้งาน</td>
            <td>ชื่อผู้ใช้งาน</td>
            <td>
                <a class="btn btn-outline-success btn-sm" href="member_new.php">เพิ่มผู้ใช้งาน</a>
            </td>
        </tr>
    </thead>
    </table>
<?php
    
}
mysqli_free_result($result);
mysqli_close($link);
    require 'footer.php';