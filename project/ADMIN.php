<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <?php
    // Check if the administrator is logged in
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }

    // Database credentials
    $servername = "localhost";
    $username = "admin";
    $password = "password";
    $dbname = "hotel_database";

    // Function to sanitize user input
    function sanitizeInput($input)
    {
        // Implement your sanitization logic here
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Add Hotel functionality
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_hotel'])) {
        // Validate and sanitize user inputs
        $name = sanitizeInput($_POST['name']);
        $address = sanitizeInput($_POST['address']);
        $rating = (int) $_POST['rating'];

        // Perform database insert
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO hotels (name, address, rating) VALUES ('$name', '$address', $rating)";
        if ($conn->query($sql) === true) {
            echo "<p>Hotel added successfully!</p>";
        } else {
            echo "<p>Error adding hotel: " . $conn->error . "</p>";
        }

        $conn->close();
    }

    // Update and Delete Hotel functionality
    if (isset($_GET['action']) && isset($_GET['hotel_id'])) {
        $action = $_GET['action'];
        $hotel_id = $_GET['hotel_id'];

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($action === 'delete') {
            $sql = "DELETE FROM hotels WHERE id = $hotel_id";
            if ($conn->query($sql) === true) {
                echo "<p>Hotel deleted successfully!</p>";
            } else {
                echo "<p>Error deleting hotel: " . $conn->error . "</p>";
            }
        } elseif ($action === 'update') {
            // Get the hotel details from the database
            $sql = "SELECT * FROM hotels WHERE id = $hotel_id";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $address = $row['address'];
                $rating = $row['rating'];

                // Display the update form
                echo <<<HTML
                <h2>Update Hotel</h2>
                <form action="admin.php" method="post">
                    <input type="hidden" name="hotel_id" value="$hotel_id">
                    
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="$name" required>
                    
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" value="$address" required>
                    
                    <label for="rating">Rating:</label>
                    <input type="number" name="rating" id="rating" value="$rating" required>
                    
                    <input type="submit" name="update_hotel" value="Update Hotel">
                </form>
                HTML;
            } else {
                echo "<p>Hotel not found!</p>";
            }
        }

        $conn->close();
    }

    // Update Hotel functionality (after form submission)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_hotel'])) {
        // Validate and sanitize user inputs
        $hotel_id = (int) $_POST['hotel_id'];
        $name = sanitizeInput($_POST['name']);
        $address = sanitizeInput($_POST['address']);
        $rating = (int) $_POST['rating'];

        // Perform database update
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE hotels SET name='$name', address='$address', rating=$rating WHERE id=$hotel_id";
        if ($conn->query($sql) === true) {
            echo "<p>Hotel updated successfully!</p>";
        } else {
            echo "<p>Error updating hotel: " . $conn->error . "</p>";
        }

        $conn->close();
    }

    // Display existing hotels
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM hotels";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Existing Hotels</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Address</th>";
        echo "<th>Rating</th>";
        echo "<th>Actions</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["rating"] . "</td>";
            echo "<td>";
            echo "<a href='admin.php?action=update&hotel_id=" . $row["id"] . "'>Update</a> | ";
            echo "<a href='admin.php?action=delete&hotel_id=" . $row["id"] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No hotels found</p>";
    }

    $conn->close();
    ?>

    <h2>Add Hotel</h2>
    <form action="admin.php" method="post">
        <input type="hidden" name="add_hotel" value="1">

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" required>

        <input type="submit" value="Add Hotel">
    </form>

    <a href="logout.php">Logout</a>

</body>
</html>