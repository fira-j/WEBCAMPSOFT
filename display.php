<?php
// Database configuration
$host = 'localhost';
$dbname = 'project';
$user = 'root';
$password = '';

try {
    // Connect to the database
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn, $user, $password);

    // Retrieve records when hotel name is "Vectory"
    $hotelName = 'Vectory';

    $query = "SELECT id, name, phoneNumber, address, foodItems, totalPrice, hotel, orderDate 
              FROM orders 
              WHERE hotel = :hotelName";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':hotelName', $hotelName);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the table
    echo '<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>';

    echo '<table>';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Address</th><th>Food Items</th><th>Total Price</th><th>Hotel</th><th>Order Date</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . $order['id'] . '</td>';
        echo '<td>' . $order['name'] . '</td>';
        echo '<td>' . $order['phoneNumber'] . '</td>';
        echo '<td>' . $order['address'] . '</td>';
        echo '<td>' . $order['foodItems'] . '</td>';
        echo '<td>' . $order['totalPrice'] . '</td>';
        echo '<td>' . $order['hotel'] . '</td>';
        echo '<td>' . $order['orderDate'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} catch (PDOException $e) {
    // Handle database connection errors
    echo 'Connection failed: ' . $e->getMessage();
}
?>