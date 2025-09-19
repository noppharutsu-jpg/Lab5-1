<?php
require("connect_db.php");

$id = $_GET["id"];

$sql = "SELECT course_code FROM exam_results WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$course_code = $row['course_code'];


$sql = "DELETE FROM exam_results WHERE id='$id'";
mysqli_query($conn, $sql);

header("Location: show_exam_result.php?course_code=$course_code");
exit();
?>