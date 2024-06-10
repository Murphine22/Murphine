<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // or your username
$password = "password"; 
$database = "Mtech"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $duhome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $message = $_POST["message"];

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO contacts (full_name, email, phone_number, message) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $full_name, $email, $phone_number, $message);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        // Send email
        $to = "elishaejimofor@gmail.com"; 
        $subject = "New message from contact form";
        $body = "Name: " . $full_name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Phone: " . $phone_number . "\n";
        $body .= "Message: " . $message . "\n";
        $headers = "elishaejimofor@gmail.com"; 

        if (mail($to, $subject, $body, $headers)) {
            echo "Thank you! Your message has been sent.";
        } else {
            echo "Error: Failed to send email.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
