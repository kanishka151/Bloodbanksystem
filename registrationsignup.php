
<?php
session_start();
require("database_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $bloodgroup = $_POST['bloodgroup']; // Assuming this is the sixth variable

    


    // Prepare and bind SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO rr (name, email, password, gender, age, bloodgroup) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $password, $gender, $age, $bloodgroup);

    if ($stmt->execute()) {
        echo "Receiver registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
Click <a href="index.php">here</a> to Continue.

