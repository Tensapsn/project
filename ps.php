<?php
session_start();

if (!isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #007acc;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007acc;
            color: #fff;
        }
        h1 {
            text-align:center;
        }

        .logout-container {
            text-align: center;
            margin-top: 20px;
        }

        .logout-button {
            background-color: #007acc;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-bottom: 20px;
        }

        .logout-button:hover {
            background-color: #005a9e;
        }
    </style>
    <title>PS Page</title>
</head>
<body>
    <h1>Data Absensi Jumat</h1>

    <div class="container">
        <table border='1'>
            <tr><th>Student ID</th><th>Name</th><th>Rayon</th><th>Attendance</th></tr>

            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "absensi_jumat";

            $conn = mysqli_connect($host, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM murid ORDER BY rayon";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["nis"] . "</td>";
                    echo "<td>" . $row["nama"] . "</td>";
                    echo "<td>" . $row["rayon"] . "</td>";
                    echo "<td>" . $row["hadir"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No students found.</td></tr>";
            }

            mysqli_close($conn);
            ?>

        </table>
    </div>
    <div class="logout-container">
        <a class="logout-button" href="logout.php">Logout</a>
    </div>
</body>
</html>
