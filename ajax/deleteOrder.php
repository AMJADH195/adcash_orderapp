<?php

if(isset($_POST['id']) && isset($_POST['id']) != ""){
    require_once("../dbcontroller.php");
    $db_handle = new DBController();  
    $conn=$db_handle->connectDB();                       

    $order_id = $_POST['id'];                                

    $query = "DELETE FROM tbl_orders WHERE order_id = '$order_id'";     
    if (!$result = mysqli_query($conn, $query)) {            
        exit(mysqli_error($con));
    }
}
?>