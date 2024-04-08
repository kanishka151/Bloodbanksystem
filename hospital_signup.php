<?php
session_start();
require("database_connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email=$_POST['email'];

    $password = $_POST['password'];
    
    $contact=$_POST['contact'];

    $sql = "INSERT INTO hr (name,email,password,contact) VALUES ('$name', '$email','$password', '$contact')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Admin registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>
Click <a href="index.php">here</a> to continue.
<?php
mysqli_close($conn);
