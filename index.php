<?php

@include 'config.php';
if (isset($_GET['add_product'])) {
    $message[] = 'new product added successfully';
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM product WHERE id = $id";
    $exe = $conn->query($sql);
    $exe->setFetchMode(PDO::FETCH_ASSOC);
    header('location:index.php');
};

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
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
        <?php
        $sql = "SELECT * FROM product";
        $exe = $conn->query($sql);
        $exe->setFetchMode(PDO::FETCH_ASSOC);
        ?>
       <a href="create.php" class="btn">Add</a>
        <div class="product-display">
            <table class="product-display-table">
                <thead>
                    <tr>
                        <th>product image</th>
                        <th>product name</th>
                        <th>product price</th>
                        <th>action</th>
                    </tr>
                </thead>
                <?php while ($row = $exe->fetch()) { ?>
                    <tr>
                        <td><img src="upload/<?php echo $row['image']; ?>" height="100" alt=""></td>
                        <td>
                            <?php echo $row['title']; ?>
                        </td>
                        <td>
                            <?php echo number_format($row['price']); ?> Đ
                        </td>
                        <td>
                            <a href="update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i>
                                edit </a>
                            <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure?')"> <i class="fas fa-trash"></i>
                                delete </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>

</html>