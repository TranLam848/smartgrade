<?php include('connect.php');
if (isset($_POST['status'])) {
  $status = $_POST['status'];


  $sql = "UPDATE controlmotor SET trangthai = '$status' WHERE id = 1";

  // Execute the SQL query
  if (mysqli_query($conn, $sql)) {
    echo "Database updated successfully";
  } else {
    echo "Error updating database: " . mysqli_error($conn);
  }

}
?>