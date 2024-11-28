<?php
include ('../conn/conn.php');

if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {

        $query = "DELETE FROM `tbl_student` WHERE `student_id` = '$user'";
        $stmt = $conn->prepare($query);

        $query_execute = $stmt->execute();

        if ($query_execute) {
            echo "
            <script>
                alert('Student Deleted Successfully');
                window.location.href = 'http://localhost/project1/home.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Student to Delete Subject');
                window.location.href = 'http://localhost/project1/home.php';
            </script>
            ";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>