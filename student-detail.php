<?php
include ('./conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $contactNumber = $_POST['contact_number'];
    $email = $_POST['email'];
    $HighSchoolMarks = $_POST['HighSchool_Marks'];
    $PhysicsMarks = $_POST['Physics_Marks'];
    $ChemistryMarks = $_POST['Chemistry_Marks'];
    $MathematicsMarks = $_POST['Mathematics_Marks'];
    $BranchSelected = $_POST['Branch_Selected'];

    try {
        $conn->beginTransaction();

        $stmt = $conn->prepare("INSERT INTO `tbl_student` (`first_name`, `last_name`, `contact_number`, `email`, `HighSchool_Marks`, `Physics_Marks`, `Chemistry_Marks`, `Mathematics_Marks`, `Branch_Selected`) VALUES (:first_name, :last_name, :contact_number, :email, :HighSchool_Marks, :Physics_Marks, :Chemistry_Marks, :Mathematics_Marks, :Branch_Selected)");
        $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':contact_number', $contactNumber, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':HighSchool_Marks', $HighSchoolMarks, PDO::PARAM_STR);
        $stmt->bindParam(':Physics_Marks', $PhysicsMarks, PDO::PARAM_STR);
        $stmt ->bindParam(':Chemistry_Marks', $ChemistryMarks, PDO::PARAM_STR);
        $stmt ->bindParam(':Mathematics_Marks', $MathematicsMarks, PDO::PARAM_STR);
        $stmt ->bindParam(':Branch_Selected', $BranchSelected, PDO::PARAM_STR);
        $stmt->execute();

        $conn->commit();

        echo "
        <script>
        alert('Student Details Added Successfully');
        window.location.href = '../Project1/enter-password.php?id=" . $conn->lastInsertId() . "';
        </script>
        ";
    } catch (PDOException $e) {
        echo"
        <script>
        alert('error');
        window.location.href = 'student-detail.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="./assets/marks.css">
    <style>
        /* Custom CSS for back button */
        .back-btn {
            display: inline-block;
            padding: 5px 5px; /* Adjust padding for smaller size */
            background-color:#b5c9d7;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-right: 10px; /* Add margin to push the button to the left */
        }

        .back-btn:hover {
            background-color:#b5c9d7;
        }

        select {
            width: 500px; /* Adjust the width as needed */
            height: 30px; /* Adjust the height as needed */
            padding: 5px; /* Adjust padding for better appearance */
            font-size: 16px; /* Adjust font size */
            border: 1px solid #ccc; /* Add border for better visibility */
            border-radius: 5px; /* Add border-radius for rounded corners */
            box-sizing: border-box; /* Ensure padding and border are included in the width */
        }

    </style>
</head>
<body>
    <div class="main">
        <div class="form-container">
            <h1>Student Details</h1>
            <form action="student-detail.php" method="POST">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="HighSchool_Marks">High School Marks:</label>
                    <input type="text" id="HighSchool_Marks" name="HighSchool_Marks" required>
                </div>
                <div class="form-group">
                    <label for="Physics_Marks">Physics Marks:</label>
                    <input type="text" id="Physics_Marks" name="Physics_Marks" required>
                </div>
                <div class="form-group">
                    <label for="Chemistry_Marks">Chemistry Marks:</label>
                    <input type="text" id="Chemistry_Marks" name="Chemistry_Marks" required>
                </div>
                <div class="form-group">
                    <label for="Mathematics_Marks">Mathematics Marks:</label>
                    <input type="text" id="Mathematics_Marks" name="Mathematics_Marks" required>
                </div>
                <div class="form-group">
                    <label for="Branch_Selected">Branch:</label>
                    <select id="Branch_Selected" name="Branch_Selected" required>
                    <option value="">Select Branch</option>
                    <option value="CSE">Computer Science And Engineering</option>
                    <option value="ECE">Electronics And Communication Engineering</option>
                    </select>
                </div>
                <button type="submit" class="btn">Submit</button>
                <br></br>
                <a href="index.php" class="btn back-btn">← Back to sign up page</a>
            </form>
        </div>
    </div>
</body>
</html>