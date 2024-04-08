<?php
session_start();
require_once("database_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM hr WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hospital_id = $row['id']; // Fetch hospital ID from the result

        $_SESSION['email'] = $email;
        $_SESSION['id'] = $hospital_id; // Store hospital ID in session
        header("location: add_blood_info.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>
