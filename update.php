<?php

@include 'config.php';
$id = $_GET['edit'];
if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];//tên hình
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];// lấy file;
    $product_image_folder = 'upload/' . $product_image;// up hình


    if (empty($product_title) || empty($product_price) || empty($product_image)) {
        $message[] = 'please fill out all!';
    } else {
        $update_data = "UPDATE product SET title ='$product_title', price='$product_price', image ='$product_image'  WHERE id = '$id'";
        $upload = $conn->query($update_data);
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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="admin-product-form-container centered">
            <?php
            $sql = "SELECT * FROM product WHERE id = $id";
            $exe = $conn->query($sql);
            $exe->setFetchMode(PDO::FETCH_ASSOC);

            ?>
            <?php while ($row = $exe->fetch()) { ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="title">update the product</h3>
                    <input type="text" class="box" name="product_title" value="<?php echo $row['title']; ?>"
                        placeholder="enter the product name">
                    <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>"
                        placeholder="enter the product price">
                    <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
                    <input type="submit" value="update product" name="update_product" class="btn">
                    <a href="index.php" class="btn">Back</a>
                </form>
            <?php } ?>
        </div>
    </div>
</body>
</html>