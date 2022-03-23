<?php

include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}

# get user's id by logged user
$id = $_SESSION['id'];

# fetch data by logged user
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
    <title>Document</title>
</head>


<body class="user_welcome">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

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


            <div class="d-flex user-data">

                <img src="<?php echo $myData['photo']; ?>" alt="Network Error" width='50px' height='50px' data-toggle="modal" data-target="#exampleModal">

                <!-- Modal -->
                <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog user-info">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h2><?php echo $myData['firstName']; ?></h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>

                            <div class="modal-body">
                                <h2><a href="user_delete.php?del_id=<?php echo $myData['id']; ?>" class="btn btn-danger">Delete Account</a></h2>
                            </div>


                            <div class="modal-body">
                                <h2><a href="user_logout.php" class="btn btn-danger">Log out</a></h2>
                            </div>

                        </div>

                    </div>

                </div>
        <!-- modal finished -->
            </div>

        </div>

    </nav>

    <!-- welcome message of logged user -->
    <div class="container-fluid wel_msg_bg mx-auto p-0">

        <h1 class="text-white p-5"> <?php echo $welcome; ?> </h1>

        <h3 class="m-5 text-justify text-center">Microsoft Corporation is a company that makes computer software and video games. Bill Gates and Paul Allen founded the company in 1975. Microsoft makes Microsoft Windows, Microsoft Office (including Microsoft Word), Edge, MSN and Xbox, among others. Most Microsoft programs cannot be downloaded for free - people have to buy them in a shop or online. Some products (like the Windows operating system) are often already installed when people buy a new computer.</h3>

    </div>








    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>