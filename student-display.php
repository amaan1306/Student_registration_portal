<?php
session_start();

if (!isset($_SESSION['student'])) {
    echo "No student is currently logged in.";
    exit();
}

$student = $_SESSION['student'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo htmlspecialchars($student['first_name']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .student-details {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }

        .student-details h1 {
            color: #007BFF;
        }

        .student-details p {
            color: #333;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="student-details">
        <h1>Welcome, <?php echo htmlspecialchars($student['first_name']) . " " . htmlspecialchars($student['last_name']); ?></h1>
        <p>ID: <?php echo htmlspecialchars($student['student_id']); ?></p>
        <p>Branch Selected: <?php echo htmlspecialchars($student['Branch_Selected']); ?></p>
        <p>Branch Alloted: <?php echo htmlspecialchars($student['Branch_Alloted']); ?></p>
        <a class="dropdown-item" href="index.php">Sign Out</a>
    </div>
</body>
</html>
