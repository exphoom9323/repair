<?php
    require_once __DIR__ . '/mPDF/vendor/autoload.php';
    require "connectdb.php";

    $str_html = "<h3 style='text-align: center;'>ข้อมูลแผนก</h3>";
    $str_html .= "<table width='100%' style='border-collapse: collapse; border: 1px solid black;'>";
    $str_html .= "<thead>";
    $str_html .= "<tr style='border: 1px solid black;'>";
    $str_html .= "<th width='30%' style='border: 1px solid black;'>รหัสแผนก</th>";
    $str_html .= "<th width='70%'>ชื่อแผนก</th>";
    $str_html .= "</tr>";
    $str_html .= "</thead>";
    $str_html .= "<tbody>";

    $strSQL = "select * from department;";
    $result = mysqli_query($link, $strSQL);

    while ($data = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $str_html .= "<tr style='border: 1px solid black;'>";
        $str_html .= "<td style='border: 1px solid black; text-align: center;'>" . $data['dep_id'] . "</td>";
        $str_html .= "<td>" . $data['dep_name'] . "</td>";
        $str_html .= "</tr>";
    }

    $str_html .= "</tbody>";
    $str_html .= "</table>";
    
    mysqli_free_result($result);
    mysqli_close($link);

// Create an instance of the class:
    $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => 16,
        'default_font' => 'sarabun'
    ]);

    $mpdf->WriteHTML($str_html);

// Output a PDF file directly to the browser
    $mpdf->Output();
