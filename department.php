<?php
    require 'session.php';
    require 'header.php';
    require 'connectdb.php';
    
    $strSQL ="select * from department";
    $result = mysqli_query($link, $strSQL);
    
    echo "<h2>ข้อมูลแผนก</h2>";
    
    if (!$result) {
        echo mysqli_error($link);
    } else if (mysqli_num_rows($result) != 0 ) {
?>
<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr>
            <td>รหัสแผนก</td>
            <td>ชื่อแผนก</td>
            <td>
                <a class="btn btn-outline-success btn-sm" href="dept_new.php">เพิ่มข้อมูลใหม่</a>&nbsp;
				<a class="btn btn-outline-success btn-sm" href="dept_pdf.php" target="_new">PDF</a>
            </td>
        </tr>
    </thead>
    <tbody>
<?php
        while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $data['dep_id'] . "</td>";
            echo "<td>" . $data['dep_name'] . "</td>";
            echo "<td>";
            echo "<a class='btn btn-outline-primary btn-sm' href='dept_edit.php?id=" . $data['dep_id'] . " '>แก้ไขข้อมูล</a>&nbsp;";
            echo "<a class='btn btn-outline-danger btn-sm' href='dept_remove.php?id=" . $data['dep_id'] . " '>ลบข้อมูล</a>";
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
            <td>รหัสแผนก</td>
            <td>ชื่อแผนก</td>
            <td>
                <a class="btn btn-outline-success btn-sm" href="dept_new.php">เพิ่มข้อมูลใหม่</a>
            </td>
        </tr>
    </thead>
    </table>
<?php
    
}
mysqli_free_result($result);
mysqli_close($link);
require 'footer.php';