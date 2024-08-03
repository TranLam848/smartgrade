<?php include('connect.php'); ?>
<?php
    if (isset($_POST["temperature"]) && isset($_POST["humidity"])) {
    $t = $_POST['temperature'];
    $h = $_POST['humidity'];
    $tb = $_POST['SR04'];
    $ldr = $_POST['LDR'];
    $PIR = $_POST['PIR'];
    $sql = 'INSERT INTO DHT22 (temperature,humidity) VALUES ('.$t.','.$h.')';
    $sql2 = 'INSERT INTO controlSR04 (status_SR04) VALUES ('.$tb.')';
    $sql3 = "UPDATE `LDR` SET `status`=$ldr WHERE id=1";
    $sql4 = "UPDATE `PIR` SET `status`=$PIR WHERE id=1";
    echo $sql2;
    if(mysqli_query($conn, $sql)){
        mysqli_query($conn, $sql2);
        mysqli_query($conn, $sql3);
        mysqli_query($conn, $sql4);
        echo "Them thanh cong";
    }
    }
    else{
        echo "Thất bại";
    }
    
?>
    