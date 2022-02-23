<?php
session_start();

if(isset($_SESSION['id'])){
    header('location:user_welcome.php');
}

if(isset($_SESSION['aid'])){
    header('location:dashboard.php');
}

if(isset($_COOKIE['id'])){
    header('location:user_welcome.php');
}

if(isset($_COOKIE['aid'])){
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
     <?php include 'navbar.php'; ?>
    <div class="container mx-auto text-center   row main">
        

            <div class="col-lg-6 ">
                <div class="card  mx-auto border border-warning p-3 " style="width: 18rem;">
                    <img src="./Assets/./image/./user-icon-free-18.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">USERS</h5>
                        <a href="user_registration.php" class="btn btn-warning">Click here</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 ">
                <div class="card  mx-auto border border-dark p-3" style="width: 18rem;">
                    <img src="./assets/image/Admin.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">ADMIN</h5>
                        <a href="admin_login.php" class="btn btn-dark">Click here</a>
                    </div>
                </div>
            </div>

        
    </div>
</body>

</html>