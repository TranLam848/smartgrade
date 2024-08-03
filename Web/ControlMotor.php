<?php include('connect.php');
    $sql = "SELECT * FROM controlmotor WHERE id = 1";
    $result = mysqli_query($conn, $sql);
    $myObj = (object)array();
    if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Fetch the data from the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Access the columns by their names
            $id = $row['id'];
            $status = $row['trangthai'];
            $myObj->id = $id;
            $myObj->trangthaimt = $status;
            $myJSON = json_encode($myObj);
            echo $myJSON;
        }
    } else {
        echo "No rows found in the controlLed table.";
    }
} else {
    echo "Error executing the SQL query: " . mysqli_error($conn);
}
    
?>