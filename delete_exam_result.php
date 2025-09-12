<?php
require("connect_db.php");
$exam_result_code = $_GET["exam_results"];

$sql ="DELETE FROM exam_results WHERE exam_result_code='$exam_result_code'";
mysqli_query($conn, $sql);
header("location: show_exam_result.php");
exit(0);
?>