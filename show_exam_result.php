<?php
require("connect_db.php");
$sql = "SELECT E.course_code, C.course_name, S.student_code, S.student_name, E.point
FROM exam_results AS E
INNER JOIN students AS S ON E.student_code = S.student_code
INNER JOIN courses AS C ON E.course_code = C.course_code";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
$name = mysqli_fetch_assoc($result);
$result = mysqli_query($conn, $sql);
echo "<center>";
echo "<h1>Exam Result: " . htmlspecialchars($course["course_code"]) ."</h1>";
echo "<table border=1 width=40%>";
echo "<tr><th>Course Code<th>Student Code</th><th>Student Name</th><th>Point</th><th>Operation</th></tr>";
 while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["course_code"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["student_code"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["student_name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["point"]) . "</td>";
    echo "<td>
        <a href='edit_exam_result.php?course_code=" . urlencode($row["course_code"]) 
        . "&student_code=" . urlencode($row["student_code"]) 
        . "&student_name=" . urlencode($row["student_name"]) 
        . "&point=" . urlencode($row["point"]) . "'>Edit</a> | 
        <a href='delete_exam_result.php?course_code=" . urlencode($row["course_code"]) 
        . "&student_code=" . urlencode($row["student_code"]) 
        . "&student_name=" . urlencode($row["student_name"]) 
        . "&point=" . urlencode($row["point"]) . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
      </td>";
}
echo "</table>";
echo "<br><a href=add_exam_result.php>Add Exam Result</a>";
echo "</center>";
echo "</center>";
?>