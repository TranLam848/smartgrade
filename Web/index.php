<?php
error_reporting(E_ALL ^ E_WARNING);
include('connect.php');
if (isset($_POST['dangnhap'])) {
    $id = $_POST['Name'];
    $password = $_POST['Password'];
    $sql = "SELECT name FROM user WHERE id = '$id' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) {
        // Sử dụng vòng lặp while để lặp kết quả
        while($row = $result->fetch_assoc()) {
            $ten = $row['name'];
            header("Location: dashboard.php?ten=" . urlencode($ten));
            exit();
        }
    } else {
    }
}
?>
<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Đăng Nhập</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Online Login Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link rel="stylesheet" href="style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- online-fonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
<!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		<h1>Hệ Thống Theo Dõi Khu Vườn</h1>
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<div class="wthree-pro">
				<h2>Login Quick</h2>
			</div>
			<form action="#" method="POST">
				<div class="pom-agile">
					<input placeholder="Tên đăng nhập" name="Name" class="user" type="Email" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<div class="pom-agile">
					<input  placeholder="Mật khẩu" name="Password" class="pass" type="password" required="">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<div class="sub-w3l">
					<h6><a href="#">Quên mật khẩu?</a></h6>
					<div class="right-w3l">
						<input name = "dangnhap" type ="submit">
					</div>
				</div>
				
			</form>
		</div>
	</div>
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; 2023 Online Login Form. All rights reserved | Pillage by <a href="http://w3layouts.com">T$L</a></p>
	</div>
	<!--//footer-->
</div>
</body>
</html>