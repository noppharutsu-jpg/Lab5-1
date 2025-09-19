<?php

require("connect_db.php");

$original_student_code = $_POST['original_student_code'];
$student_code = $_POST['student_code'];
$student_name = $_POST['student_name'];
$gender = $_POST['gender'];


$sql = "UPDATE students SET student_code = ?, student_name = ?, gender = ? WHERE student_code = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param($stmt, "ssss", $student_code, $student_name, $gender, $original_student_code);


if (mysqli_stmt_execute($stmt)) {

    echo "<script>";
    echo "alert('อัปเดตข้อมูลนักเรียนสำเร็จ!');";

    echo "window.location.href = 'student_list.php';";
    echo "</script>";
} else {

    echo "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>