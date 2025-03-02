<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    h3{
        font-family: 'Courier New', Courier, monospace; 
        /* background-color:red; */
        font-weight: bold;
    }
    .card{
        float: right;
        margin-top: 20px;
        margin-left:10px;
        margin-righ:10px;
    }
    .card img{
        width:100%;
        height:200px;

    }
    main{
        width:60%;
        margin-top: 20px;
    }

    </style>
  
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <br>
    <center>
    <h3>عرض جميع النتجات</h3>
    </center>

    <?php
    include('config.php');
    $result =mysqli_query($con, "SELECT * FROM prod");
    while($row = mysqli_fetch_array($result)){
        echo "
        <center>
        <main>
    <div class='card' style='width: 20rem;'>
    <img src='$row[image]' class='card-img-top' alt='...'>
    <div class='card-bod'>
    <h5 class='card-title'>$row[name]</h5>
    <p class='card-text'>$row[price]</p>
    <a href='delete.php? id=$row[id_prod]' class='btn btn-danger'>حذف منتج</a>
    <a href='update.php? id=$row[id_prod]' class='btn btn-primary'>تعديل منتج</a>
    <a href='#' class='btn btn-primary'>اضافة منتج</a>
    </div>
    </main>
        </center>
    ";
    }
    
    ?>

    
</div>
  </body>
</html>