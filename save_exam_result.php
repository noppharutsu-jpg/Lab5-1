<?php
require("connect_db.php");
if (isset($_POST["student_code_edit"], $_POST["student_code"], $_POST["point"], $_POST["course_code"]))
$student_code_edit = $_POST["student_code_edit"];
$student_code = $_POST["student_code"];
$student_name = $_POST["student_name"];
$point = $_POST["point"];
$sql ="UPDATE exam_results SET student_code='$student_code', point=$point WHERE student_code='$student_code_edit' 
AND course_code='$course_code'";
mysqli_query($conn, $sql);
header("location: show_exam_result.php");
exit(0);
?>