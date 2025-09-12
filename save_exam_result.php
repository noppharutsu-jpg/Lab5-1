<?php
require("connect_db.php");
$exam_result_edit = $_POST["student_code_edit"];
$student_code = $_POST["student_code"];
$student_name = $_POST["student_name"];
$point = $_POST["point"];
$sql ="UPDATE exam_results SET student_code='$student_code',student_name='$student_name' ,point=$point 
WHERE student_code='$student_code_edit' 
AND student_code='$exam_result_edit'";
mysqli_query($conn, $sql);
header("location: show_exam_result.php");
exit(0);
?>