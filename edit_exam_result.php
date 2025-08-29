<?php
require("connect_db.php");
$course_code = $_GET["course_code"];
$sql = "SELECT * FROM exam_results WHERE course_code='$course_code'";
$result = mysqli_query($conn, $sql);
$course = mysqli_fetch_assoc($result);
echo "<center>";
echo "<form action=save_exam_result.php method=post>";
echo "<table border=1 width=40%>";
echo "<input type=hidden name=course_code_edit value=$course_code />";
echo "<tr><td>Student Code:</td><td><input type=text name=course_code value=".$course["course_code"]."
/></td></tr>";
echo "<tr><td>Student Name:</td><td><input type=text name=student_code value=".$course["student_code"]."
/></td></tr>";
echo "<tr><td>Point:</td><td><input type=text name=point value=".$course["point"]." /></td></tr>";
echo "<tr><td colspan=2><center><input type=submit value=Submit /></center></td></tr>";
echo "</table>";
echo "</form>";
echo "</center>";
?>