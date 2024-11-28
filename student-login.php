<?php
include ('./conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to join tbl_student and tbl_loginstudent
    $stmt = $conn->prepare("SELECT * FROM `tbl_student` 
                            INNER JOIN `tbl_loginstudent` 
                            ON `tbl_student`.`email` = `tbl_loginstudent`.`email` 
                            WHERE `tbl_student`.`email` = :email 
                            AND `tbl_loginstudent`.`password` = :password");

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        session_start();
        $_SESSION['student'] = $row;
        header("Location: student-display.php");
        exit();
    } else {
        echo "No student found with the given username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./assets/marks.css">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background: url("https://t3.ftcdn.net/jpg/02/67/43/44/360_F_267434405_rVfKoBDQpb6smmbNtDRWvzAYCYpsX47E.jpg");
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            width: 90%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Student Login</h1>
        <form action="student-login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
