<?php

include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('location:user_login.php');
}

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}

$id = $_SESSION['id'];
$searchTable = "SELECT * FROM user WHERE id = $id";
$rslt = mysqli_query($conn, $searchTable);


if (!$rslt) {
    echo mysqli_error($conn);
}
$myData = mysqli_fetch_assoc($rslt);
if (!$myData) {
    echo mysqli_error($conn);
}
$welcome = "hello " . $myData['firstName'] . ", Welcome!!"
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <title>Document</title>



</head>

<body class="user_welcome">
    <nav class="navbar navbar-expand-lg navbar-dark  ">
        <img src="./Assets/./image/ms.png" width="100px" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse h4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-4">
                    <a class="nav-link" href="userData.php">Account Details</a>
                </li>

            </ul>
            <div class="d-flex">

                <a href="user_logout.php" class="btn btn-danger l-0">Log out</a>
            </div>
        </div>

    </nav>
    <div class="container-fluid wel_msg_bg mx-auto p-0">


        <h1 class="text-white p-5"> <?php echo $welcome;
                                    ?> </h1>
        <h3 class="m-5 text-justify text-center">Microsoft Corporation is a company that makes computer software and video games. Bill Gates and Paul Allen founded the company in 1975. Microsoft makes Microsoft Windows, Microsoft Office (including Microsoft Word), Edge, MSN and Xbox, among others. Most Microsoft programs cannot be downloaded for free - people have to buy them in a shop or online. Some products (like the Windows operating system) are often already installed when people buy a new computer.</h3>
    </div>



</body>

</html>