<?php
require("connect_db.php");
$student_code = $_GET["student_code"];
$sql = "SELECT * FROM exam_results WHERE student_code='$student_code'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);
echo "<center>";
echo "<form action=save_exam_result.php method=post>";
echo "<table border=1 width=40%>";
echo "<input type=hidden name=student_code_edit value=$student_code />";
echo "<tr><td>Student Code:</td><td><input type=text name=student_code value=".$student["student_code"]."
/></td></tr>";
echo "<tr><td>Student Name:</td><td><input type=text name=student_name value=".$student["student_name"]."
/></td></tr>";
echo "<tr><td>Point:</td><td><input type=text name=point value=".$student["point"]." /></td></tr>";
echo "<tr><td colspan=2><center><input type=submit value=Submit /></center></td></tr>";
echo "</table>";
echo "</form>";
echo "</center>";
?>