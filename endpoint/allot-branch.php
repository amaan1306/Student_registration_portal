<?php
// Include database connection
include ('../conn/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve student ID and allotted branch from the form
    $studentID = $_POST['student_id'];
    $allottedBranch = $_POST['alloted_branch'];

    try {
        // Update the `tbl_student` table to allot the branch
        $stmt = $conn->prepare("UPDATE `tbl_student` SET `Branch_Alloted` = :allotted_branch WHERE `student_id` = :student_id");
        $stmt->bindParam(':allotted_branch', $allottedBranch, PDO::PARAM_STR);
        $stmt->bindParam(':student_id', $studentID, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect back to the admin panel page after allotting the branch
        header("Location: ../home.php");
        exit();
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request method is not POST, redirect to the admin panel page
    header("Location: ../home.php");
    exit();
}
?>
