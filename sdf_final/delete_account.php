<?php
session_start();


if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cms_radjac";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}


if (isset($_POST["confirm"])) {
    $user_id = $_SESSION["user_id"];


    $sql = "DELETE users, posts FROM users LEFT JOIN posts ON users.id = posts.user_id WHERE users.id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Account</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/originals/2d/97/33/2d97334e5d9c578d1868ec02a7a58eb8.gif');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

        .container {
            position: absolute;
            background-color: rgba(246, 241, 247, 0.5);
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container h2 {
            font-size: 24px;
            color: #8a8a8a;
        }

        .container p {
            font-size: 18px;
            color: #8a8a8a;
            margin-bottom: 20px;
        }

        .container input[type="submit"],
        .container a {
            padding: 10px 20px;
            background-color: #ffd5c0;
            color: #8a8a8a;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .container input[type="submit"]:hover,
        .container a:hover {
            background-color: #ff9e80;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Account</h2>
        <p>Are you sure you want to delete your account?</p>
        <form method="post" action="">
            <input type="submit" name="confirm" value="Yes">
            <a href="profile.php">No, go back</a>
        </form>
    </div>
</body>
</html>