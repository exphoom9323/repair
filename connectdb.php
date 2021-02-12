<?php

    $link = mysqli_connect("localhost", "root", "root", "repair");
    
    if (mysqli_connect_errno()) {
        echo "ไม่สามารถติดต่อฐานข้อมูลได้" . mysqli_connect_error();
        exit();
        
    }
    
    mysqli_set_charset($link, "utf8");