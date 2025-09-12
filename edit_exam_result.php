<?php
require("connect_db.php");
if (isset($_GET["student_code"]))
    $student_code = $_GET["student_code"];
    $student_code = mysqli_real_escape_string($conn, $student_code);

    $sql = "SELECT S.student_code, S.student_name, E.course_code, E.point 
            FROM exam_results E 
            INNER JOIN students S ON S.student_code = E.student_code 
            WHERE S.student_code = '$student_code'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) 
        $student = mysqli_fetch_assoc($result);
echo "<center>";
echo "<form action=save_exam_result.php method=post>";
echo "<table border=1 width=40%>";
echo "<input type=hidden name=student_code_edit value=$student_code />";
echo "<input type=hidden name=course_code_edit value=$student_code />";
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
