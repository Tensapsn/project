<?php
// Include your database connection code here
$host = "localhost";
$username = "root";
$password = "";
$database = "absensi_jumat";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$response = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_student"])) {
    $student_id = $_POST["student_id"];

    // Create a SQL query to delete the student based on their ID
    $delete_sql = "DELETE FROM murid WHERE nis = '$student_id'";

    if (mysqli_query($conn, $delete_sql)) {
        $response = "Student data removed successfully.";
    } else {
        $response = "Error removing student data: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Student</title>
    <script>
        // Use JavaScript to display a notification
        window.onload = function () {
            alert("<?php echo $response; ?>");
            // Redirect the user back to the previous page (you can change this URL)
            window.location.href = "index.php";
        };
    </script>
</head>
</html>
