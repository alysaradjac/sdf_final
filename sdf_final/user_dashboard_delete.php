<?php
include 'dbcon.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tb_add WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("location: ./user_dashboard.php");
    }
}
?>
