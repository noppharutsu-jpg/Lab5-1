<?php
require("connect_db.php");
$student_code_edit = $_POST["student_code_edit"];
$student_code = $_POST["student_code"];
$student_name = $_POST["student_name"];
$point = $_POST["point"];
$sql ="UPDATE exam_results SET student_code='$student_code', student_name='$student_name',
Point=$point WHERE student_code='$student_code_edit'";
mysqli_query($conn, $sql);
header("location: show_exam_result.php");
exit(0);
?>