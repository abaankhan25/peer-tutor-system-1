<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["role"] != "student") {
    echo "Access denied!";
    exit();
}
?>

<h2>Welcome <?php echo $_SESSION["user_name"]; ?> (Student)</h2>

<a href="request.html">Make Request</a><br><br>
<a href="logout.php">Logout</a>