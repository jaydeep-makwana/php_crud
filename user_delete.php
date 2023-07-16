<?php
include 'config.php';

$id = $_GET['del_id'];
$deleteQuery = "DELETE FROM  user WHERE id=$id";

if(mysqli_query($conn,$deleteQuery)){
    header('location:user_logout.php');
}
?>