<?php
// Include database connection file
require_once("database_connect.php");

// Start session
session_start();

// Check if user is not logged in, then redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: Receiver_login.html");
    exit();
}

// Handle request sample action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_sample'])) {
    // Retrieve receiver details from session
    $email = $_SESSION['email'];

    // Prepare and execute the SQL query to retrieve receiver details
    $sql = "SELECT name, email, gender, age FROM rr WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        // Receiver found, fetch details
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $age = $row['age'];

        // Retrieve blood type and hospital name from HTML form
        $blood_type = $_POST['blood_type'];
        $hospital_name = $_POST['hospital_name'];

        // Insert receiver details into requesteduser table
        $insert_sql = "INSERT INTO requesteduser (name, email, gender, age, hospital, blood_type) VALUES (?, ?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ssssss", $name, $email, $gender, $age, $hospital_name, $blood_type);
        if (mysqli_stmt_execute($insert_stmt)) {
            echo "Sample requested successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Receiver details not found.";
    }
}
?>
Click <a href="index.php">here</a> if succesfully requested..
<!DOCTYPE html>
<html>
<head>
    <title>Available Blood Samples</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <h1>Check Blood Recipients</h1>
</header>
<div class="container">
    <h2>Available Blood Samples</h2>
    <table>
        <tr>
            <th>Blood Type</th>
            <th>Hospital</th>
            <th>Action</th>
        </tr>
        <?php
        // Fetch and display blood samples from the database
        $sql = "SELECT blood_type, name FROM blood_samples JOIN hr ON blood_samples.hospital_id = hr.id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['blood_type'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                // Display request button only if the user is eligible
                echo "<td><form method='post'>";
                echo "<input type='hidden' name='blood_type' value='" . $row['blood_type'] . "'>";
                echo "<input type='hidden' name='hospital_name' value='" . $row['name'] . "'>";
                echo "<button type='submit' name='request_sample'>Request Sample</button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No blood samples available</td></tr>";
        }
         
        // Close database connection
        mysqli_close($conn);
        ?>
    </table>
    
</div>
<footer>
    <p>&copy; Life Source Blood Bank</p>
</footer>
</body>
</html>
