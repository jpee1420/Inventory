<!-- add_product.php -->
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $availability = $_POST["availability"];
    $category = $_POST["category"];

    // Upload image
    $target_dir = "uploads/";
    $target_file = $target_dir. basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check!== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "jpeg") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        require_once 'config.php';
        $upload_dir = 'products/image/'; // set your desired directory path
        $target_file = $upload_dir. basename($_FILES["image"]["name"]);
        
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true); // create the directory if it doesn't exist
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO products (title, price, description, availability, category, image) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $title, $price, $description, $availability, $category, $target_file);
            $stmt->execute();
            echo "Product added successfully!";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>