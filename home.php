<?php include ('./conn/conn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PANEL</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand ml-5" href="home.php">ADMIN PANEL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px; margin-left: 80%;">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                My Profile
                </a>
                <ul class="dropdown-menu">
                
                <li><a class="dropdown-item" href="index.php">Sign Out</a></li>

                </ul>
            </li>

            </ul>

        </div>
    </nav>

    <!-- Student Details Table -->
    <div class="main">
    <div class="content">
        <h4>List of students</h4>
        <hr>
        <table class="table table-hover table-collapse">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">High School Marks</th>
                    <th scope="col">Physics Marks</th>
                    <th scope="col">Chemistry Marks</th>
                    <th scope="col">Mathematics Marks</th>
                    <th scope="col">Average</th>
                    <th scope="col">Branch Selected</th>
                    <th scope="col">Branch Alloted</th>
                    <th scope="col">Delete</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $stmt = $conn->prepare("SELECT * FROM `tbl_student` ORDER BY `average_marks` DESC");
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $studentID = $row['student_id'];
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];
                        $contactNumber = $row['contact_number'];
                        $email = $row['email'];
                        $HighSchoolMarks = $row['HighSchool_Marks'];
                        $PhysicsMarks = $row['Physics_Marks'];
                        $ChemistryMarks = $row['Chemistry_Marks'];
                        $MathematicsMarks = $row['Mathematics_Marks'];
                        $AverageMarks = $row['average_marks'];
                        $BranchSelected = $row['Branch_Selected'];
                        $BranchAlloted = $row['Branch_Alloted'];
                ?>
                <tr>
                    <td><?php echo $studentID ?></td>
                    <td><?php echo $firstName ?></td>
                    <td><?php echo $lastName ?></td>
                    <td><?php echo $contactNumber ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $HighSchoolMarks ?></td>
                    <td><?php echo $PhysicsMarks ?></td>
                    <td><?php echo $ChemistryMarks ?></td>
                    <td><?php echo $MathematicsMarks ?></td>
                    <td><?php echo $AverageMarks ?></td>
                    <td><?php echo $BranchSelected ?></td>
                    <td>
                        <?php if (empty($BranchAlloted)) { ?>
                        <form action="./endpoint/allot-branch.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $studentID ?>">
                        <select name="alloted_branch">
                            <option value="CSE"<?php if ($BranchSelected == 'CSE') echo ' selected'; ?>>CSE</option>
                            <option value="ECE"<?php if ($BranchSelected == 'ECE') echo ' selected'; ?>>ECE</option>
                        </select>
                        <button type="submit">Allot Branch</button>
                        </form>
                        <?php } else { ?>
                        <?php echo $BranchAlloted; ?>
                        <?php } ?>
                    </td>
                    <td>
                        <button id="deleteBtn" onclick="delete_student(<?php echo $studentID ?>)">&#128465;</button>
                    </td>
                </tr>    
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
     // Delete student
     function delete_student(id) {
        if (confirm("Do you want to delete this student?")) {
            window.location = "./endpoint/delete-student.php?user=" + id;
        }
    }
</script>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
