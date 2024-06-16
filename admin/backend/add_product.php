<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["price"]) && isset($_POST["productType"])) {
        // Assign form data to variables
        $productName = $_POST["productName"];
        $productDescription = $_POST["productDescription"];
        $price = $_POST["price"];
        $productType = $_POST["productType"];

        // Check if an image is uploaded
        if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == UPLOAD_ERR_OK) {
            // Upload image
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);

            if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                // Image uploaded successfully, proceed to insert data into the database
                $imagePath = $targetFile;

                // Create connection to MySQL database
                include_once('../../config.php');
                // Prepare SQL statement to insert data into the database
                $sql = "INSERT INTO product (product_name, product_description, price, product_type, product_image) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdss", $productName, $productDescription, $price, $productType, $imagePath);

                // Execute the statement
                if ($stmt->execute()) {
                    header('location:../add_product.php?success="Product added successfully."');
                    // echo "";
                } else {
                    header('location:../add_product.php?success="error"');

                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                // Close connection
                $stmt->close();
                $conn->close();
            } else {
                echo "Error uploading image.";
            }
        } else {
            echo "No image uploaded.";
        }
    } else {
        echo "All fields are required.";
    }
}
?>
