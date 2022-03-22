<?php

include 'config.php';

$id = $_GET['id'];

$deleteQuery = "DELETE FROM  user WHERE id=$id";

if(mysqli_query($conn,$deleteQuery)){
    header('location:dashboard.php');
}

?>