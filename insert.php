<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password_hash);

    if ($stmt->execute()) {
        echo "<h2>✅ Signup successful!</h2>";
        echo "<a href='form.html'>Add another user</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>