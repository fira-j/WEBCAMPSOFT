<?php
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "project"; // Replace with your database name

// Assuming you have established a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    foodItems TEXT NOT NULL,
    totalPrice DECIMAL(10, 2) NOT NULL,
    hotel VARCHAR(255) NOT NULL,
    photo VARCHAR(255)
)";

if ($conn->query($sql) === false) {
    echo "Error creating table: " . $conn->error;
    $conn->close();
    exit;
}

// Assuming you have prepared an INSERT statement with the `hotel` and `photo` fields included
$stmt = $conn->prepare("INSERT INTO orders (name, phoneNumber, address, foodItems, totalPrice, hotel, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Assuming you have retrieved the form data, including the `hotel` and `photo` fields
$name = $_POST["name"];
$phoneNumber = $_POST["phoneNumber"];
$address = $_POST["address"];
$foodItems = $_POST["foodItems"];
$totalPrice = $_POST["totalPrice"];
$hotel = $_POST["hotel"];
$targetFile = "your_target_file"; // Replace with the path to your target file

// Assuming all form fields are of string type, adjust the data types as needed
$stmt->bind_param("sssssss", $name, $phoneNumber, $address, $foodItems, $totalPrice, $hotel, $targetFile);

// Execute the statement
if ($stmt->execute()) {
    // Insertion successful
    echo "Order placed successfully.";
} else {
    // Error occurred
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>