<?php

include 'config.php';
session_start();

if (!isset($_SESSION['aid'])) {
    header('location:admin_login.php');
}

if (!isset($_SESSION['aid'])) {
    $_SESSION['aid'] = $_COOKIE['aid'];
}

# select data from admin table
$id = $_SESSION['aid'];
$searchTable = "SELECT * FROM admin WHERE id = $id";
$rslt = mysqli_query($conn, $searchTable);

if (!$rslt) {
    echo mysqli_error($conn);
}

$myData = mysqli_fetch_assoc($rslt);
if (!$myData) {
    echo mysqli_error($conn);
}

$welcome = "hello " . $myData['userName'] . ", Welcome!!";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <title>Document</title>
</head>

<body class="admin_welcome">

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  ">

        <img src="./Assets/./image/ms.png" width="100px" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse h4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-4">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
            </ul>

            <div class="d-flex">
                <a href="admin_logout.php" class="btn btn-danger l-0">Log out</a>
            </div>
        </div>

    </nav>


    <!-- welcome message -->
    <div class="container-fluid wel_msg_bg mx-auto p-0">
        <h1 class="text-white p-5"> <?php echo $welcome; ?> </h1>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>


