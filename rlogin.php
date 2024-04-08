<?php
session_start();
require_once("database_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM rr WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
         // Fetch hospital ID from the result
        
        $_SESSION['email'] = $email;
         // Store hospital ID in session
        header("location: index.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>
