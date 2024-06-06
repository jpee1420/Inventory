<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="https:<!-- delete_product.php -->">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Delete Product</h1>
        <?php
        require_once 'config.php';

        $id = $_GET['id'];

        $sql = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();

        $sql = "DELETE FROM products WHERE id=$id";
        $conn->query($sql);

        unlink('products/image/' . $product['image']);

        header('Location: index.php');
        exit;
        ?>
    </div>
</body>
</html>