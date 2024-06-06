<!-- edit_product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Edit Product</h1>
        <?php
        // include the config.php file to connect to the database
        require_once 'config.php';

        // get the product ID from the query parameter
        $id = $_GET['id'];

        // fetch the product from the database
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();

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

            // update the product in the database
            $sql = "UPDATE products SET title='$title', price=$price, description='$description', availability='$availability', category='$category', image='$image' WHERE id=$id";
            $conn->query($sql);
            unlink('products/image/' . $product['image']);

            // redirect back to the dashboard
            header('Location: index.php');
            exit;
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $product['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="availability">Availability</label>
                <input type="text" name="availability" id="availability" class="form-control" value="<?php echo $product['availability']; ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="<?php echo $product['category']; ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">Back to Dashboard</button>
        </form>
    </div>
</body>
</html>