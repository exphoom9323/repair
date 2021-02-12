<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ระบบแจ้งซ่อมอุปกรณ์คอมพิวเตอร์</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    
    <script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">หน้าแรก</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <?php
                        session_start();
                        if (isset($_SESSION['Username'])) {
                            if ($_SESSION['UserType'] == "Admin") {
                    ?>
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbaDropdown" rol="button" data-toggle="dropdown" aris-haspopup="true" aris-expanded="false">
                                   จัดการข้อมูล 
                                </a>
                                <div class="dropdown-menu" aris-labelledby="navbardropdown">
                                    <a class="dropdown-item" href="member.php">ข้อมูลสมาชิก</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="department.php">ข้อมูลแผนก</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#">แสดงรายงาน</a>
                            </li> 
                    <?php
                            }else if ($_SESSION['UserType'] == "Staff") {
                    ?>           
                        <li class="nav-item active">
                                <a class="nav-link" href="show_repair.php">แสดงรายการแจ้งซ่อม</a>
                            </li>                       
                   <?php  
                        }else{  
                    ?>       
                            <li class="nav-item active">
                                <a class="nav-link" href="repair.php">แจ้งซ่อมอุปกรณ์คอมพิวเตอร์</a>
                            </li>
                    <?php            
                            }
                        }
                   ?> 
                    
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        session_start();
                        if (!isset($_SESSION['Username'])) { 
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="signin.php">เข้าสู่ระบบ</a>
                    </li> 
                    <?php
                        } else {
                            ?>
                        <li class="nav-item active">
                        <a class="nav-link" href="signout.php">ออกจากระบบ</a>
                    </li>     
                  <?php  
                        }
                    ?>
                    
                </ul>
            </div>
        </div>
    </nav>

    <main role="main" class="container">
        
