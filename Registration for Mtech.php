<?php
// Database connection details
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "mtech_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$address = $_POST['address'];
$amount_to_pay = $_POST['amount_to_pay'];
$mode_of_payment = $_POST['mode_of_payment'];
$payment_method = $_POST['payment_method'];
$marital_status = $_POST['marital_status'];

// Upload passport photo
$passport_photo_name = $_FILES['passport_photo']['name'];
$passport_photo_temp = $_FILES['passport_photo']['tmp_name'];
$passport_photo_destination = "uploads/" . $passport_photo_name;
move_uploaded_file($passport_photo_temp, $passport_photo_destination);

// Upload certificates
$certificates_name = $_FILES['certificates']['name'];
$certificates_temp = $_FILES['certificates']['tmp_name'];
$certificates_destination = "uploads/" . $certificates_name;
move_uploaded_file($certificates_temp, $certificates_destination);

// Insert data into database
$sql = "INSERT INTO registration_form (full_name, phone_number, email, address, amount_to_pay, mode_of_payment, payment_method, marital_status, passport_photo, certificates)
        VALUES ('$full_name', '$phone_number', '$email', '$address', '$amount_to_pay', '$mode_of_payment', '$payment_method', '$marital_status', '$passport_photo_destination', '$certificates_destination')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
