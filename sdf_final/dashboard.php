<?php
include 'dbcon.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: reglog.php?error=Please Login First."); // kung direct sa file
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tb_reglog WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>| To Do List |</title>
</head>
<body>
    <h1 class="title">
        To do list 
    </h1>

        <div class="todo-list">
            <div class="list-head">
                <input type="text" class="entered-list">
                <button class="add-list"> Add </button>
				<button class="add-list"> Add </button>
            </div>

            <div class="task">
                <div class="item">
                    <p>New Item Here.</p>
                    <div class="item-btn">
                    <i class="fa-solid fa-pencil"></i>
                    <i class="fa-solid fa-xmark"></i>
                    </div>
                </div>
            </div>
        </div>

    <script src="./dashboard.js"></script>
</body>
</html>
