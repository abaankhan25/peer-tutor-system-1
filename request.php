<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["user_id"])) {
    echo "Please login first!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_SESSION["user_id"];
    $subject = $_POST["subject"];
    $level = $_POST["level"];
    $time = $_POST["time"];

    $stmt = $conn->prepare("INSERT INTO bookings (student_id, subject, level, preferred_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $student_id, $subject, $level, $time);

    if ($stmt->execute()) {
        echo "<h2>✅ Request submitted!</h2>";
        echo "<a href='dashboard.php'>Back to dashboard</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>