<?php
session_start();
# if session set then redirect spacific file

# user
if (isset($_SESSION['id'])) {
    header('location:user_welcome.php');
}
if (isset($_COOKIE['id'])) {
    header('location:user_welcome.php');
}

# admin
if (isset($_SESSION['aid'])) {
    header('location:dashboard.php');
}
if (isset($_COOKIE['aid'])) {
    header('location:dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <title>HOME</title>
</head>

<body class="home-bg">

    <!-- navbar -->
    <?php include 'navbar.php'; ?>
    <!-- main content -->
    <div class="container mx-auto text-center   row main">

        <div class="col-lg-6 ">
            <div class="background mx-auto p-3 border border-light " style="width: 18rem;">
            <a href="user_registration.php"><img src="./assets/image/users.png" class="card-img-top" alt="..."></a>
                <div class="card-body mt-4">
                    <h5 class="card-title">USER</h5>
                    <a href="user_registration.php" class="btn btn-dark border-light">Click here</a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 ">
            <div class="background mx-auto border border-light p-3" style="width: 18rem;">
                <a href="login.php"><img src="./assets/image/Admin.png" class="card-img-top" alt="..."></a>
                <div class="card-body">
                    <h5 class="card-title">ADMIN</h5>
                    <a href="login.php" class="btn btn-dark border-light">Click here</a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>