<?php
require("connect_db.php");


$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;


if ($id <= 0) {
    die("Error: ไม่ได้ระบุ ID ของผลสอบที่ต้องการแก้ไข");
}


$sql = "SELECT * FROM exam_results WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $exam_result = mysqli_fetch_assoc($result);


    echo "<center>";
    echo "<h2>แก้ไขข้อมูลผลสอบ</h2>";
    echo "<form action='save_exam_result.php' method='post'>";
    echo "<table border=1 width=40%>";


    echo "<input type='hidden' name='id_edit' value='" . htmlspecialchars($exam_result["id"]) . "' />";

    echo "<tr><td>Course Code:</td><td><input type='text' name='course_code' value='" . htmlspecialchars($exam_result["course_code"]) . "' readonly /></td></tr>";
    echo "<tr><td>Student Code:</td><td><input type='text' name='student_code' value='" . htmlspecialchars($exam_result["student_code"]) . "' readonly /></td></tr>";
    echo "<tr><td>Point:</td><td><input type='text' name='point' value='" . htmlspecialchars($exam_result["point"]) . "' /></td></tr>";

    echo "<tr><td colspan=2><center><input type='submit' value='Submit' /></center></td></tr>";

    echo "</table>";
    echo "</form>";
    echo "</center>";
} else {
    echo "<p style='color:red;'>ไม่พบข้อมูลผลสอบสำหรับ ID นี้ในฐานข้อมูล</p>";
}

mysqli_close($conn);
?>