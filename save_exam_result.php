<?php
require("connect_db.php");
$student_code_edit = $_POST["student_code_edit"];
$student_code = $_POST["student_code"];
$student_name = $_POST["student_name"];
$point = $_POST["point"];
$sql ="UPDATE students SET student_code='$student_code', student_name='$student_name',
Point=$point WHERE student_code='$student_code_edit'";
mysqli_query($conn, $sql);
header("location: student_list.php");
exit(0);
?>