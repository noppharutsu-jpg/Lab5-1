<?php
require("connect_db.php");


if (isset($_POST["new_course_code"]) && isset($_POST["new_course_name"]) && isset($_POST["new_credit"])) {
    $new_code = trim($_POST["new_course_code"]);
    $new_name = trim($_POST["new_course_name"]);
    $new_credit = intval($_POST["new_credit"]);

    if (!empty($new_code) && !empty($new_name) && $new_credit > 0) {
        $sql = "INSERT INTO courses (course_code, course_name, credit) 
                VALUES ('$new_code', '$new_name', '$new_credit')";
        if (mysqli_query($conn, $sql)) {
            echo "<center style='color:green;'>✅ เพิ่มรายวิชา $new_code ($new_name) หน่วยกิต $new_credit เรียบร้อย</center>";
        } else {
            echo "<center style='color:red;'>❌ เพิ่มรายวิชาไม่สำเร็จ: " . mysqli_error($conn) . "</center>";
        }
    }
}


if (isset($_POST["course_code"]) && !empty($_POST["course_code"])) {
    $course_code = $_POST["course_code"];

    $sql = "SELECT * FROM courses WHERE course_code='$course_code'";
    $course_rs = mysqli_query($conn, $sql);
    $course = mysqli_fetch_assoc($course_rs);

    $sql = "SELECT * FROM students";
    $students = mysqli_query($conn, $sql);

    echo "<center>Course: " . $course["course_code"] . " (" . $course["course_name"] . ") [หน่วยกิต: " . $course["credit"] . "]<br>";
    ?>
    <form action="save_add_exam_result.php" method="post">
        <table border="1">
            <input type="hidden" name="course_code" value="<?php echo $course_code; ?>">
            <tr>
                <td>Student</td>
                <td>
                    <select name="student_code">
                        <?php while ($row = mysqli_fetch_assoc($students)) { ?>
                            <option value="<?php echo $row["student_code"] ?>">
                                <?php echo $row["student_code"] ?> - <?php echo $row["student_name"] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Point</td>
                <td><input type="text" name="point"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <br><a href="add_exam_result.php">เลือกวิชาใหม่</a>
    </center>
    <?php
} else {

    $sql = "SELECT * FROM courses";
    $courses = mysqli_query($conn, $sql);
    ?>
    <center>
        <h3>Course Name</h3>
        <form action="add_exam_result.php" method="post">
            <select name="course_code">
                <?php while ($row = mysqli_fetch_assoc($courses)) { ?>
                    <option value="<?php echo $row["course_code"] ?>">
                        <?php echo $row["course_code"] ?> - <?php echo $row["course_name"] ?> (<?php echo $row["credit"] ?>
                        หน่วยกิต)
                    </option>
                <?php } ?>
            </select>
            <input type="submit" value="เลือก">
        </form>

        <hr>
        <h3>Add Exam_result</h3>
        <form action="add_exam_result.php" method="post">
            <input type="text" name="new_course_code" placeholder="รหัสวิชา(Course Code)" required>
            <input type="text" name="new_course_name" placeholder="ชื่อวิชา(Course Name)" required>
            <input type="number" name="new_credit" placeholder="หน่วยกิต(Point)" min="1" required>
            <input type="submit" value="เพิ่มวิชา(Submit)">
        </form>
    </center>
    <?php
}
?>