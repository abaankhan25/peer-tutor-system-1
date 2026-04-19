<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $role = strtolower(trim($_POST["role"]));
    $password = $_POST["password"];

    // Validate role (VERY IMPORTANT)
    if ($role !== "student" && $role !== "tutor") {
        die("Invalid role selected!");
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO users (name, email, role, password_hash) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $role, $password_hash);

    if ($stmt->execute()) {
        echo "<h2>✅ Registered successfully!</h2>";
        echo "<a href='login.php'>Go to Login</a>";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
}
?>