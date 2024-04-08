<?php
session_start();
require_once("database_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital_id = $_SESSION['id']; // Assuming hospital ID is stored in session after login
    $blood_type = $_POST['blood_type'];

    $check_hospital_query = "SELECT id FROM hr WHERE id = '$hospital_id'";
    $result = mysqli_query($conn, $check_hospital_query);
    
    if (mysqli_num_rows($result) == 0) {
        // Hospital ID does not exist, handle the error as needed
        echo "Error: Hospital ID does not exist.";
    } else {
        // Hospital ID exists, proceed with the insertion
        $insert_query = "INSERT INTO blood_samples (hospital_id, blood_type) VALUES ('$hospital_id', '$blood_type')";
        
        if (mysqli_query($conn, $insert_query)) {
            // Blood sample added successfully
            header("Location: add_blood_info.php");
        } else {
            // Error occurred during insertion
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
