<?php 
require("connect_db.php");

$student = null; // กำหนดตัวแปรให้เริ่มต้น

if (isset($_GET["student_code"])) {
    $student_code = mysqli_real_escape_string($conn, $_GET["student_code"]);

    $sql = "SELECT E.course_code, C.course_name, S.student_code, S.student_name, E.point
            FROM exam_results AS E
            INNER JOIN students AS S ON E.student_code = S.student_code
            INNER JOIN courses AS C ON E.course_code = C.course_code
            WHERE S.student_code = '$student_code'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        echo "<center><h3>No student found with code $student_code</h3></center>";
        exit;
    }
} else {
    echo "<center><h3>No student code provided.</h3></center>";
    exit;
}

echo "<center>";
echo "<form action='save_exam_result.php' method='post'>";
echo "<table border=1 width=40%>";
echo "<input type='hidden' name='student_code_edit' value='" . htmlspecialchars($student_code) . "' />";
echo "<input type='hidden' name='course_code_edit' value='" . htmlspecialchars($student["course_code"]) . "' />";
echo "<tr><td>Course Code:</td><td><input type='text' name='course_code' value='" . htmlspecialchars($student["course_code"]) . "' /></td></tr>";
echo "<tr><td>Student Code:</td><td><input type='text' name='student_code' value='" . htmlspecialchars($student["student_code"]) . "' /></td></tr>";
echo "<tr><td>Student Name:</td><td><input type='text' name='student_name' value='" . htmlspecialchars($student["student_name"]) . "' /></td></tr>";
echo "<tr><td>Point:</td><td><input type='text' name='point' value='" . htmlspecialchars($student["point"]) . "' /></td></tr>";
echo "<tr><td colspan=2><center><input type='submit' value='Submit' /></center></td></tr>";
echo "</table>";
echo "</form>";
echo "</center>";
?>