<?php
require("connect_db.php");
if (isset($_GET["course_code"])) 
    $course_code = mysqli_real_escape_string($conn, $_GET["course_code"]);
$course_code = $_GET["course_code"];
$sql = "SELECT * FROM courses WHERE course_code='$course_code'";
$result = mysqli_query($conn, $sql);
$course = mysqli_fetch_assoc($result);
if ($course)
$sql = "SELECT E.*,S.student_name";
$sql .= " FROM exam_results AS E";
$sql .= " INNER JOIN students AS S ON E.student_code=S.student_code";
$sql .= " WHERE E.course_code='$course_code'";

$result = mysqli_query($conn, $sql);
echo "<center>";
echo "<h1>Exam Result: " . htmlspecialchars($course["course_name"]) . "</h1>";
echo "<table border=1 width=40%>";
echo "<tr><th>Student Code</th><th>Student Name</th><th>Point</th><th>Operation</th></tr>";
 while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["student_code"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["student_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["point"]) . "</td>";
    echo "<td><a href='edit_exam_result.php?student_code=" . urlencode($row["student_code"]) . "&course_code=" . urlencode($course_code) . "'>Edit</a> | <a href='delete_exam_result.php?student_code=" . urlencode($row["student_code"]) . "&course_code=" . urlencode($course_code) . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
echo "<br><a href=add_exam_result.php>Add Exam Result</a>";
echo "</center>";
echo "</center>";