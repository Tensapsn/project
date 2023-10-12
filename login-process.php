<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "absensi_jumat";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin_sql = "SELECT username FROM pj WHERE username = '$username' AND password = '$password'";
    $admin_result = $conn->query($admin_sql);

    $user_sql = "SELECT username FROM ps WHERE username = '$username' AND password = '$password'";
    $user_result = $conn->query($user_sql);

    if ($admin_result->num_rows == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'admin'; 
        header("Location: index.php?notification=Login%20successful.");
        exit();
    } elseif ($user_result->num_rows == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'user';
        header("Location: ps.php?notification=Login%20successful.");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: login.php?error=Invalid%20username%20or%20password.");
        exit();
    }
}

$conn->close();
?>
