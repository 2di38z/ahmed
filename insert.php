<?php
include('config.php');
if(isset($_POST['upload'])){
    $NAME=$_POST['name'];
    $PRICE=$_POST['price'];
    $IMAGE=$_FILES['image'];
    $image_location =$_FILES['image']['tmp_name'];
    $image_name  =$_FILES['image']['name'];
    $image_up  = "images/".$image_name;

    $insertt = "INSERT INTO prod (name , price , image) VALUES ('$NAME','$PRICE','$image_up')";
    mysqli_query($con, $insertt);
    if(move_uploaded_file($image_location,'images/'.$image_name)){
        echo "<script>alert('تم رفع النتج بنجاح')</script>";
    }else{
        echo "<script>alert('في مشكلة')</script>";
    }
    header('location: index.php');
    
}

?>