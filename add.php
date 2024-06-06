<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Add Product</h1>
        <?php
        // include the config.php file to connect to the database
        require_once 'config.php';

        // if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // get the form data
            $title = $_POST['title'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $availability = $_POST['availability'];
            $category = $_POST['category'];
            $image = $_FILES['image']['name'];

            // move the uploaded image to the uploads folder
            move_uploaded_file($_FILES['image']['tmp_name'], 'products/image/' . $image);

            // insert the product into the database
            $sql = "INSERT INTO products (title, price, description, availability, category, image) VALUES ('$title', $price, '$description', '$availability', '$category', '$image')";
            $conn->query($sql);

            // display an alert message
            echo "<script>alert('Product added successfully!');</script>";
            header('Location: index.php');
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="availability">Availability</label>
                <input type="text" name="availability" id="availability" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>
</html>