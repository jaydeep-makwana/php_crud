<?php

include 'config.php';

$id = $_GET['id'];
$selectPhoto = "SELECT photo FROM user WHERE id=$id ";
$photoQuery = mysqli_query($conn, $selectPhoto);
if (!$photoQuery) {
    echo mysqli_error($conn);
}
$photo = mysqli_fetch_assoc($photoQuery);
unlink($photo['photo']);

$deleteQuery = "DELETE FROM  user WHERE id=$id";

if (mysqli_query($conn, $deleteQuery)) {
    header('location:dashboard.php');
}
