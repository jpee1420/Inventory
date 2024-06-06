<!-- index.php -->
<?php
require_once 'config.php';

// fetch products from the database
$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$products = array();
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Product Dashboard</h1>
        <a href="add.php" class="btn btn-primary mb-3">Add Product</a>
        <div class="view-switcher">
            <button class="btn btn-secondary mb-3 mr-1 active" id="list-view-btn">List View</button>
            <button class="btn btn-secondary mb-3 ml-1" id="grid-view-btn">Grid View</button>
        </div>
        <div id="list-view">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Availability</th>
                        <th scope="col">Category</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) {?>
                    <tr>
                        <td data-th="ID"><?= $product["id"]?></td>
                        <td data-th="Title"><?= $product["title"]?></td>
                        <td data-th="Price"><?= $product["price"]?></td>
                        <td data-th="Description"><?= $product["description"]?></td>
                        <td data-th="Availability"><?= $product["availability"]?></td>
                        <td data-th="Category"><?= $product["category"]?></td>
                        <td data-th="Image"><img src="products/image/<?= $product["image"]?>" width="100"></td>
                        <td data-th="Action">
                            <a href="edit_product.php?id=<?= $product["id"]?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?= $product["id"]?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div id="grid-view" style="display: none;">
            <div class="row">
                <?php foreach ($products as $product) {?>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <img src="products/image/<?= $product["image"]?>" class="card-img-top" alt="<?= $product["title"]?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product["title"]?></h5>
                            <p class="card-text"><?= $product["description"]?></p>
                            <p class="card-text">Price: <?= $product["price"]?></p>
                            <p class="card-text">Availability: <?= $product["availability"]?></p>
                            <p class="card-text">Category: <?= $product["category"]?></p>
                            <a href="edit_product.php?id=<?= $product["id"]?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete_product.php?id=<?= $product["id"]?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#grid-view-btn").click(function() {
                $("#list-view").hide();
                $("#grid-view").show();
                $("#grid-view-btn").addClass("active");
                $("#list-view-btn").removeClass("active");
            });
            $("#list-view-btn").click(function() {
                $("#list-view").show();
                $("#grid-view").hide();
                $("#list-view-btn").addClass("active");
                $("#grid-view-btn").removeClass("active");
            });
        });
    </script>
</body>
</html>