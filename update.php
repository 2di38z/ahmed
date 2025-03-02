<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>moath'shope</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
    
    include('config.php');
    $ID=$_GET['id'];
    $ID= intval($ID);
    $upp = mysqli_query($con,"select * from prod where id_prod=$ID");
    $data = mysqli_fetch_array($upp);
    $ID = isset($_GET['id']) ? intval($_GET['id']) : 0;
    ?>
    <center>
    <div class="main">
    <form action="up.php" method="post" enctype="multipart/form-data">
        <h2>عرض تحديث المنتجات</h2>
        <img src="m1.jpg" alt="logo" width="450px">
        <br>
        <br>
        <input type="hidden" name="id" value="<?php echo $ID; ?>">
        <br>
        <input type="text" name="name" value='<?php echo $data['name']; ?>'>
        <br>
        <input type="text" name="price" value='<?php echo $data['price']; ?>'>
        <br>
        <!-- <label for="file">اختيار صورة للمنتج</label> -->
        <input type="file" name="image" id="flie" style='border.none;' >
        
        <br>
        <br>
        <button name="update" type='submit'>تحديث المنتج</button>
        <br><br>
        <a href="products.php">عرض كل المنتجات</a>

    </form>
    </div>
    <p>developre by moath</p>
    <!-- style='display:none;' -->
    </center>
    
</body>
</html>