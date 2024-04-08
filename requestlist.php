<?php
// Include database connection file
require_once("database_connect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected blood group from the form
    $bloodGroup = $_POST['bloodGroup'];

    // Prepare and execute the SQL query to retrieve requests for the selected blood group
    $sql = "SELECT * FROM requesteduser WHERE blood_type = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $bloodGroup);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any requests for the selected blood group
    if (mysqli_num_rows($result) > 0) {
        // Display the requests
        echo "<h2>Requests for Blood Group: $bloodGroup</h2>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Gender</th><th>Age</th><th>Blood Type</th><th>Hospital Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['blood_type'] . "</td>";
            echo "<td>" . $row['hospital'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No requests found for blood group: $bloodGroup";
    }
}

// Close database connection
mysqli_close($conn);
?>
