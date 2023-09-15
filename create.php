<?php
@include 'config.php';
if (isset($_POST['add_product'])) {

    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'upload/' . $product_image;

    if (empty($product_title) || empty($product_price) || empty($product_image)) {
        $message[] = 'Please fill out all';
    } else {
        $insert = "INSERT INTO product(title, price,image) VALUES('$product_title', '$product_price', '$product_image')";
        $upload = $conn->query($insert);
        $upload->setFetchMode(PDO::FETCH_ASSOC);
        if ($upload) {  
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header('location:index.php');
        } else {
            $message[] = 'Please Enter the correct request ';
        }
    }
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="btn btn-successfully">' . $message . '</span>';
        }
    }
    ?>
    <div class="container">
        <div class="admin-product-form-container">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Add news product</h3>
                <input type="text" placeholder="Product Name" name="product_title" class="box">
                <input type="number" placeholder="Product Price" name="product_price" class="box">
                <input type="file" accept="image/jpg" name="product_image" class="box">
                <input type="submit" class="btn" name="add_product" value="Add product">
                <a href="index.php" class="btn">Back</a>
            </form>
        </div>
    </div>
</body>

</html>