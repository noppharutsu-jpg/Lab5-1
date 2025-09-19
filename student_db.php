<?php
require("connect_db.php");
$sql = "SELECT student_code, student_name, gender FROM students";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo "Code: " . $row["student_code"] . " Name: " . $row["student_name"] . " Gender: " .
            $row["gender"] . "<br>";
    }
} else {
    echo "0 results";
}
mysqli_close($conn);
?>