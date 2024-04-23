<?php
if (isset($_POST['add'])) {
    // Retrieve the form data
    $foodData = $_POST['food_data'];

    // Handle the uploaded image files
    $targetDirectory = "uploads/";

    // Save the form data to the database (modify the database connection parameters accordingly)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the new food items into the hotels table
    foreach ($foodData as $foodItem) {
        if (isset($foodItem['food_name']) && isset($foodItem['food_price']) && isset($foodItem['food_description']) && isset($foodItem['food_category']) && isset($foodItem['hotel_name'])) {
            $foodName = $foodItem['food_name'];
            $foodPrice = $foodItem['food_price'];
            $foodDescription = $foodItem['food_description'];
            $foodCategory = $foodItem['food_category'];
            $hotelName = $foodItem['hotel_name'];

            // Handle the uploaded image file
            $fileName = $_FILES["food_image"]["name"][0];
            $tmpName = $_FILES["food_image"]["tmp_name"][0];
            $targetFile = $targetDirectory . basename($fileName);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the image file is a valid image
            $check = getimagesize($tmpName);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if the file already exists
            if (file_exists($targetFile)) {
                echo "Sorry, the file already exists.";
                $uploadOk = 0;
            }

            // Check if the file size is within the limit (in this example, 5MB)
            $maxFileSize = 5 * 1024 * 1024;
            if ($_FILES["food_image"]["size"][0] > $maxFileSize) {
                echo "Sorry, the file is too large.";
                $uploadOk = 0;
            }

            // Allow only specific image file formats (you can modify/add more if needed)
            $allowedFormats = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
                $uploadOk = 0;
            }

            // If the file is valid, move it to the target directory
            if ($uploadOk == 1) {
                if (move_uploaded_file($tmpName, $targetFile)) {
                    echo "The file " . basename($fileName) . " has been uploaded successfully.";

                    // Insert the food item into the hotels table
                    $insertQuery = "INSERT INTO hotelss (name, price, description, category, hotel, image)
                                    VALUES ('$foodName', '$foodPrice', '$foodDescription', '$foodCategory', '$hotelName', '$targetFile')";

                    if ($conn->query($insertQuery) === true) {
                        echo "<p>Food item added successfully!</p>";
                    } else {
                        echo "Error: " . $insertQuery . "<br>" . $conn->error;
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    // Close the database connection
    $conn->close();
}
?>