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


$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];

   
    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$user_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully!";
        $row["username"] = $username;
        $row["email"] = $email;
		header("Location: profile.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        body {
            padding: 80px 0 0;
            margin: 0;
            background-image: url('https://i.pinimg.com/originals/2d/97/33/2d97334e5d9c578d1868ec02a7a58eb8.gif?fbclid=IwAR15OWUd7PNguFh8hRpuOnadAMBgbkrOfDUPuzldTrBku1ksl8UDWFNLJdw');
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(246, 241, 247, 0.5);
            border-radius: 10px;
            margin: 0 auto;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .header h2 {
            color: #8a8a8a;
            margin: 0;
            font-size: 24px;
        }

        .header a {
            padding: 10px 20px;
            background-color: #ffd5c0;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-right: 50px;
        }

        .header a:hover {
            background-color: #ff9e80;
        }

        .container {
            background-color: rgba(246, 241, 247, 0.5);
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            width: 400px;
            margin: 0 auto;
            margin-top: 20px;
        }

        .container h2 {
            color: #8a8a8a;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 6px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            font-family: "Poppins", sans-serif;
        }

        input[type="submit"] {
            background-color: #ff9e80;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #ff7d59;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Edit Profile</h2>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>Edit Profile</h2>
        <form method="post" action="">
            <input type="text" name="username" value="<?php echo $row["username"]; ?>"><br>
            <input type="email" name="email" value="<?php echo $row["email"]; ?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>