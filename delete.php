<?php
include('config.php');
echo $ID = $_GET['id'];
mysqli_query($con, "DELETE FROM prod WHERE id_prod=$ID");
header('location: index.php');

?>