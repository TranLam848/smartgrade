<?php
// error_reporting(E_ALL ^ E_WARNING);
include('connect.php');
if (isset($_GET['ten'])) {
    $ten = $_GET['ten'];
} else {
}
$nd = "";
$da = "";
$sql = "SELECT * FROM DHT22 ORDER BY id DESC LIMIT 1";
$myObj = (object)array();
// Thực thi câu truy vấn
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $nd = $row['temperature'];
        $da = $row['humidity'];
    }
} else {
    echo "Không có dữ liệu.";
}
$sql = "SELECT status_SR04 FROM controlSR04 ORDER BY id_SR04 DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$thongbaonuoc = "";
$ttn = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ttn = $row['status_SR04'];
        if($ttn == 0){
            $thongbaonuoc = "Hết nước! Xin hãy mở máy bơm";
        }
        else if($ttn == 1){
            $thongbaonuoc = "Nước còn nhiều không cần bơm";
        }
    }
} else {
    echo "Không có dữ liệu.";
}
$sql ="SELECT CAST(ROUND(AVG(temperature)) AS UNSIGNED) AS tbnd FROM DHT22 WHERE YEAR(createat) = 2023";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$tbnd = $row['tbnd'];
$thang1="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 01;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang1 = $row['tbda'];
$thang2="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 02;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang2 = $row['tbda'];
$thang3="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 03;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang3 = $row['tbda'];
$thang4="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 04;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang4 = $row['tbda'];
$thang5="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 05;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang5 = $row['tbda'];
$thang6="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 06;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang6 = $row['tbda'];
$thang7="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 07;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang7 = $row['tbda'];
$thang8="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 08;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang8 = $row['tbda'];
$thang9="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 09;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang9 = $row['tbda'];
$thang10="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 10;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang10 = $row['tbda'];
$thang11="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 11;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang11 = $row['tbda'];
$thang12="";
$sql = "SELECT CAST(ROUND(AVG(humidity)) AS UNSIGNED) AS tbda FROM DHT22 WHERE MONTH(createat) = 12;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$thang12 = $row['tbda'];
//Cảm biến chuyển động
$sqlcn = "SELECT PIR.status FROM PIR WHERE id =1";
$connguoi = "";
$result = $conn->query($sqlcn);
if ($result->num_rows > 0)
{
// Sử dụng vòng lặp while để lặp kết quả
while($row = $result->fetch_assoc()) {
$connguoi = $row['status'];
}
}
else {
echo "Không có record nào";
}
// Tạo đường dẫn ảnh tương ứng
if ($connguoi == 1) {
$imgSrc = "connguoi.png";
} else {
$imgSrc = "khongconnguoi.png";
}

//Cảm biến ánh sáng
$sqlldr = "SELECT LDR.status FROM LDR WHERE id = 1";
$anhsang = "";
$ttas="";
$result = $conn->query($sqlldr);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $ttas = $row['status'];
        if($ttas == 0){
            $anhsang = "Trời tối ! Đèn đang bật";
        }
        else if($ttas == 1){
            $anhsang = "Trời sáng! Đã tắt đèn";
        }
    }
} 
else {
    $anhsang= "Không có dữ liệu.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Quản Lý Khu Vườn</title>

    <!-- Custom fonts for this template-->
    <link href="all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="sb-admin-2.min.css" rel="stylesheet">
    <style>
.switch .led-btn:checked + .sw-btn:after {
    left: 100%;
    margin-left: -29px;
    background: #008000;
    content: 'on';
}
.led-btn:checked + .sw-btn:after {
    left: 100%;
    margin-left: -29px;
    background: #008000;
    content: 'on';
}
.sw-btn{
  width:60px;
  height:30px;
  border-radius:15px;
  background:#000;
  display:block;
  position:relative;
}
.sw-btn:after{
  position:absolute;
  height:28px;
  width:28px;
  display:block;
  border-radius:50%;
  background:#ff0000;
  top:1px;
  left:1px;
  content:'off';
  -webkit-transition: all 200ms ease-in-out;
  -moz-transition: all 200ms ease-in-out;
  -o-transition: all 200ms ease-in-out;
  transition: all 200ms ease-in-out;
  text-align:center;
  line-height:29px;
  color:#fff;
  font-size:12px;
}
.sw-btn.active:after{
  left:100%;
  margin-left:-29px;
  background:#008000;
  content:'on';
}
.sw-btn1 input[type="checkbox"]{
  opacity:0;
}
.sw-btn1{
  width:60px;
  height:30px;
  border-radius:15px;
  background:#000;
  display:block;
  position:relative;
}
.sw-btn1:after{
  position:absolute;
  height:28px;
  width:28px;
  display:block;
  border-radius:50%;
  background:#ff0000;
  top:1px;
  left:1px;
  content:'off';
  -webkit-transition: all 200ms ease-in-out;
  -moz-transition: all 200ms ease-in-out;
  -o-transition: all 200ms ease-in-out;
  transition: all 200ms ease-in-out;
  text-align:center;
  line-height:29px;
  color:#fff;
  font-size:12px;
}
.sw-btn1.active:after{
  left:100%;
  margin-left:-29px;
  background:#008000;
  content:'on';
}
.sw-btn1 input[type="checkbox"]{
  opacity:0;
}

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PTUD-IOT<sup>o</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang chủ</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào <?php echo $ten;?></span>
                                <img class="img-profile rounded-circle"
                                    src="iconlogin.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Thiết bị</h1>
                        <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Đăng xuất</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card-body" style = "background-image: linear-gradient(-225deg, #FFFEFF 0%, #D7FFFE 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Nhiệt độ</div></center>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><img src="tempe.png" style="width: 120px; height: 100px;" alt=""><?php echo $nd;?><sup>o</sup>C</div>
                                        </div>
                                        
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body" style="background-color: #E4E4E1;
 background-image: radial-gradient(at top center, rgba(255,255,255,0.03) 0%, rgba(0,0,0,0.03) 100%), linear-gradient(to top, rgba(255,255,255,0.1) 0%, rgba(143,152,157,0.60) 100%);
 	background-blend-mode: normal, multiply;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Độ ẩm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><img src="humi.png" style="width: 120px; height: 100px;" alt=""><?php echo $da;?>%</div>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body" style="background-image: linear-gradient(-225deg, #FFFEFF 0%, #D7FFFE 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Giếng nước</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><img src="water.png" style="width: 120px; height: 100px;" alt=""><br><?php echo $thongbaonuoc;?></div>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body" style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class="font-weight-bold text-primary text-uppercase mb-1">
                                                Chuyển động</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <img id="PIR-image" src="khongconnguoi.png" onload="loadImage()" style="height: 100px;" class="PIR" alt="Không thể tải ảnh">
                                            </div>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body" style="background-image: linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Bóng đèn</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <img id="ledid1" src="ledoff.png" style="width: 100px; height: 100px;" alt="">
                                                <label class="sw-btn"><input type="checkbox"></label>
                                            </div>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 ">
                                <div class="card-body" style="background-image: linear-gradient(-225deg, #FFFEFF 0%, #D7FFFE 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Máy bơm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><img id="motor" src="motoroff.png" style="width: 100px; height: 100px;" alt=""></div>
                                            <label class="sw-btn1"><input type="checkbox"></label>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 ">
                                <div class="card-body" style = "background-image: linear-gradient(to top, #dfe9f3 0%, white 100%);">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-info text-uppercase mb-1">Thống kê nhiệt độ trung bình năm 2023
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $tbnd; ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 ">
                                <div class="card-body" style="background-color: #E4E4E1;
 background-image: radial-gradient(at top center, rgba(255,255,255,0.03) 0%, rgba(0,0,0,0.03) 100%), linear-gradient(to top, rgba(255,255,255,0.1) 0%, rgba(143,152,157,0.60) 100%);
 	background-blend-mode: normal, multiply;">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-primary text-uppercase mb-1">
                                                Ánh sáng</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><img src="R.png" style="width: 120px; height: 100px;" alt=""><?php echo $anhsang;?></div>
                                        </div>
                                        </center>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-warning text-uppercase mb-1">
                                                Ngày hiện tại</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $today = date("d-m-Y");
                                                echo $today;?></div></center>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <center><div class=" font-weight-bold text-warning text-uppercase mb-1">
                                                Hướng dẫn tìm kiếm bằng giọng nói</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <label>Sử dụng tính năng tìm kiếm bằng giọng nói bằng cách nhấn giữ chuột</label>
                                                <script src="./app.js"></script>
                                            </div></center>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Thống kê độ ẩm trung bình theo tháng</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Tháng 1<span
                                            class="float-right"><?php echo $thang1; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width:<?php echo $thang1; ?>%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 2<span
                                            class="float-right"><?php echo $thang2; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $thang2; ?>%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 3<span
                                            class="float-right"><?php echo $thang3; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $thang3; ?>%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 4<span
                                            class="float-right"><?php echo $thang4; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $thang4; ?>%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 5<span
                                            class="float-right"><?php echo $thang5; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $thang5; ?>%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 6<span
                                            class="float-right"><?php echo $thang6; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $thang6; ?>%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 7<span
                                            class="float-right"><?php echo $thang7; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $thang7; ?>%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 8<span
                                            class="float-right"><?php echo $thang8; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo $thang8; ?>%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 9<span
                                            class="float-right"><?php echo $thang9; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $thang9; ?>%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 10<span
                                            class="float-right"><?php echo $thang10; ?>%</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $thang10; ?>%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 11<span
                                            class="float-right"><?php echo $thang11; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $thang11; ?>%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Tháng 12<span
                                            class="float-right"><?php echo $thang12; ?>%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $thang12; ?>%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    
                                </div>
                            </div>

                             Color System 
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-info text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-warning text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-secondary text-white shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-light text-black shadow">
                                        <div class="card-body">
                                            
                                            <div class="text-black-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-dark text-white shadow">
                                        <div class="card-body">
                                            <div class="text-white-50 small"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="jquery.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <!--<script src="Chart.min.js"></script>-->

    <!-- Page level custom scripts -->
    <!--<script src="chart-area-demo.js"></script>-->
    <!--<script src="chart-pie-demo.js"></script>-->

</body>

</html>
<script src="jquery.min.js"></script>
<script>
    var mymotor = document.getElementById("motor");
    $('.sw-btn1').on('click', function(){
      if($(this).children().is(':checked')){
        $(this).addClass('active');
        mymotor.src = "motoron.png";
        updateDatabaseLed("1");
      }
      else{
        $(this).removeClass('active');
        mymotor.src = "motoroff.png";
        updateDatabaseLed("0");
      }
      function updateDatabaseLed(status) {
        $.ajax({
          url: "updatemotor.php", // Specify the URL of the PHP file to handle the request
          method: "POST", // Use the POST method to send data
          data: { status: status }, // Pass the status value to the server
          success: function(response) {
            
            console.log(response);
          },
          error: function(xhr, status, error) {
             
            console.error(error);
          }
        });
      }
    });
    
</script>
<script>
    var myIcon = document.getElementById("ledid1");
    $('.sw-btn').on('click', function(){
      if($(this).children().is(':checked')){
        $(this).addClass('active');
        myIcon.src = "ledon.png";
        updateDatabaseLed("1");
      }
      else{
        $(this).removeClass('active');
        myIcon.src = "ledoff.png";
        updateDatabaseLed("0");
      }
      function updateDatabaseLed(status) {
        $.ajax({
          url: "update.php", // Specify the URL of the PHP file to handle the request
          method: "POST", // Use the POST method to send data
          data: { status: status }, // Pass the status value to the server
          success: function(response) {
            
            console.log(response);
          },
          error: function(xhr, status, error) {
             
            console.error(error);
          }
        });
      }
    });
    
</script>
<!--// Phát hiện chuyển dộng, load trang đổi ảnh hiển thị-->
<script>
  window.onload = function() {
    var img = document.getElementById("PIR-image");
    img.src = "<?php echo $imgSrc; ?>";
  }
</script>
<!--Xử lý giọng nói-->
<script>
    class SpeechRecognitionApi {
    constructor(options) {
        const SpeechToText = window.speechRecognition || window.webkitSpeechRecognition;
        this.speechApi = new SpeechToText();
        this.speechApi.continuous = true;
        this.speechApi.interimResults = false;
        this.output = options.output ? options.output : document.createElement('div');
        console.log(this.output);
        this.isListening = false;
        this.speechApi.onstart = () => {
            this.isListening = true;
            console.log('Speech recognition service has started');
        };
        this.speechApi.onend = () => {
            this.isListening = false;
            console.log('Speech recognition service disconnected');
        };
        this.speechApi.onresult = (event) => {
            console.log(event);
            var resultIndex = event.resultIndex;
            var transcript = event.results[resultIndex][0].transcript;
            console.log('transcript>>', transcript);
            console.log(this.output);
            this.output.textContent = transcript;

            // Tìm kiếm từ khóa trên Google
            var searchUrl = "https://www.google.com/search?q=" + transcript;
            window.open(searchUrl, "_blank");
        };
    }

    start() {
        if (!this.isListening) {
            console.log('Starting speech recognition service');
            this.speechApi.start();
        }
    }

    stop() {
        if (this.isListening) {
            console.log('Stopping speech recognition service');
            this.speechApi.stop();
        }
    }
}

var output = document.querySelector('.output');

function displayTranscript(transcript) {
    output.value += transcript + "\n";
}

var speech = new SpeechRecognitionApi({
    output: output
});

document.addEventListener('mousedown', () => {
    speech.start();
});

document.addEventListener('mouseup', () => {
    speech.stop();
});
</script>
