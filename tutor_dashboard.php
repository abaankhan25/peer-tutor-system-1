<?php
session_start();
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["role"] != "tutor") {
    echo "Access denied!";
    exit();
}

echo "<h2>Welcome " . $_SESSION["user_name"] . " (Tutor)</h2>";

$result = $conn->query("
    SELECT 
        b.booking_id,
        b.student_id,
        b.status,
        b.booked_at,
        s.subject,
        s.slot_date,
        s.start_time,
        s.end_time
    FROM bookings b
    JOIN availability_slots s ON b.slot_id = s.slot_id
");

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows == 0) {
    echo "No bookings yet.";
} else {

    while ($row = $result->fetch_assoc()) {

        echo "Booking ID: " . $row["booking_id"] . "<br>";
        echo "Student ID: " . $row["student_id"] . "<br>";
        echo "Subject: " . $row["subject"] . "<br>";
        echo "Date: " . $row["slot_date"] . "<br>";
        echo "Time: " . $row["start_time"] . " - " . $row["end_time"] . "<br>";
        echo "Status: " . $row["status"] . "<br>";
        echo "Booked At: " . $row["booked_at"] . "<br>";

        echo "<hr>";
    }
}

echo "<a href='logout.php'>Logout</a>";
?>