<?php

require("connect_db.php");


$student_code = $_GET["student_code"];


$sql = "SELECT * FROM students WHERE student_code = ?";


$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $student_code);


mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


if (!$student) {
    echo "ไม่พบข้อมูลนักเรียนรหัส: " . htmlspecialchars($student_code);
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
</head>

<body>
    <center>
        <h2>Edit Student Information</h2>
        <form action="save_student.php" method="post">
            <input type="hidden" name="original_student_code"
                value="<?php echo htmlspecialchars($student['student_code']); ?>">

            <table border="1" width="40%">
                <tr>
                    <td>Student Code:</td>
                    <td><input type="text" name="student_code"
                            value="<?php echo htmlspecialchars($student['student_code']); ?>" /></td>
                </tr>
                <tr>
                    <td>Student Name:</td>
                    <td><input type="text" name="student_name"
                            value="<?php echo htmlspecialchars($student['student_name']); ?>" /></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td><input type="text" name="gender" value="<?php echo htmlspecialchars($student['gender']); ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <center><input type="submit" value="Save Changes" /></center>
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>

</html>