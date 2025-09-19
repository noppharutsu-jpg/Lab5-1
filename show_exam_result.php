<?php
require("connect_db.php");


$course_code = isset($_GET["course_code"]) ? $_GET["course_code"] : null;


if (!$course_code) {
    die("Error: ไม่ได้ระบุรหัสวิชา (course_code)");
}

echo "<center>";


$sql_course = "SELECT course_name FROM courses WHERE course_code = ?";
$stmt_course = mysqli_prepare($conn, $sql_course);
mysqli_stmt_bind_param($stmt_course, "s", $course_code);
mysqli_stmt_execute($stmt_course);
$result_course = mysqli_stmt_get_result($stmt_course);
$course = mysqli_fetch_assoc($result_course);

$course_name = $course ? htmlspecialchars($course["course_name"]) : "ไม่พบรายวิชา";
echo "<h1>Exam Results: " . $course_name . "</h1>";



$sql_results = "SELECT E.id, E.course_code, E.student_code, E.point, S.student_name
                FROM exam_results AS E
                INNER JOIN students AS S ON E.student_code = S.student_code
                WHERE E.course_code = ?";
$stmt_results = mysqli_prepare($conn, $sql_results);
mysqli_stmt_bind_param($stmt_results, "s", $course_code);
mysqli_stmt_execute($stmt_results);
$result = mysqli_stmt_get_result($stmt_results);


echo "<table border=1 width=60%>";
echo "<tr><th>Student Code</th><th>Name</th><th>Point</th><th>Operation</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["student_code"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["student_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["point"]) . "</td>";


        echo "<td><a href='edit_exam_result.php?id=" . $row["id"] . "'>Edit</a> " .
            "<a href='delete_exam_result.php?id=" . $row["id"] . "' onclick=\"return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?');\">Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Not Found</td></tr>";
}

echo "</table>";
echo "<br><a href='add_exam_result.php?course_code=" . htmlspecialchars($course_code) . "'>Add Student</a>";
echo "</center>";

mysqli_close($conn);
?>