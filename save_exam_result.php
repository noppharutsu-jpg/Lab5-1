<?php

require("connect_db.php");


$id = isset($_POST['id_edit']) ? (int) $_POST['id_edit'] : 0;
$point = isset($_POST['point']) ? $_POST['point'] : null;
$course_code = isset($_POST['course_code']) ? $_POST['course_code'] : '';


if ($id <= 0 || $point === null || empty($course_code)) {
    die("Error: ข้อมูลที่ส่งมาไม่สมบูรณ์");
}


$sql = "UPDATE exam_results SET point = ? WHERE id = ?";


$stmt = mysqli_prepare($conn, $sql);


mysqli_stmt_bind_param($stmt, "di", $point, $id);


if (mysqli_stmt_execute($stmt)) {

    echo "<script>";
    echo "alert('บันทึกการแก้ไขสำเร็จ!');";
    echo "window.location.href = 'show_exam_result.php?course_code=" . urlencode($course_code) . "';";
    echo "</script>";
} else {

    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>