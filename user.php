<?php

// Validate and sanitize input
$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';

$errors = array();

if (empty($full_name)) {
  $errors[] = "Full name is required.";
}

if (empty($email)) {
  $errors[] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "Invalid email address.";
}

if (empty($gender)) {
  $errors[] = "Gender is required.";
}

if (!empty($errors)) {
  foreach ($errors as $error) {
    echo "<p>Error: $error</p>";
  }
  exit;
}

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_registration";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement using prepared statements
$stmt = $conn->prepare("INSERT INTO students (FullName, Email, Gender) VALUES (?, ?, ?)");

// Bind the parameters and execute the statement
$stmt->bind_param("sss", $full_name, $email, $gender);

if ($stmt->execute()) {
  echo "<p>Registration successful!</p>";
} else {
  echo "<p>Error: " . $stmt->error . "</p>";
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
