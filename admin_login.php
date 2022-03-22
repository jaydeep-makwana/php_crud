 <?php
    include 'config.php';
    session_start();

    if (isset($_SESSION['aid'])) {
        header('location:admin_login.php');
    }

    # select data form admin table and create table if not exist
    $selectTable = "SELECT * FROM admin ";
    $tblQuery = mysqli_query($conn, $selectTable);

    if (!$tblQuery) {
        $createTable = "CREATE TABLE  admin ( id int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userName varchar(100) NOT NULL, password varchar(100) NOT NULL )";
        if (!mysqli_query($conn, $createTable)) {
            echo mysqli_errno($conn);
        }
    }

    # admin login with session and cookie
    $loginErr = '';
    if (isset($_POST['submit'])) {

        if (empty($_POST['userName']) || empty($_POST['password'])) {

            $loginErr = "username and password required";
        } else {


            $uname = $_POST['userName'];
            $pass = $_POST['password'];

            $fetch_array = mysqli_fetch_assoc($tblQuery);

            if ($uname == $fetch_array['userName'] && $pass == $fetch_array['password']) {
                $_SESSION['aid'] = $fetch_array['id'];
                setcookie('aid', $fetch_array['id'], time() + 60 * 60 * 24 * 7);
                header('location:dashboard.php');
            } else {
                $loginErr = "username or password invalid";
            }
        }
    }

    # set value in input field
    function setValue($value)
    {
        if (isset($_POST[$value])) {
            echo $_POST[$value];
        }
    }

    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./assets/./bootstrap-4.6.1-dist/./css/./bootstrap.min.css">
     <link rel="stylesheet" href="./assets/./CSS/./style.css">
     <title>Admin_Login</title>
 </head>

 <body class="admin-bg">
     <!-- navbar -->
     <?php include 'navbar.php'; ?>

     <!-- admin login form -->
     <div class="container mt-5 p-3 form-bg-admin col-lg-3">

         <form method="post">
             <h1 class="text-center">Log in</h1>
             <small class="red"><?php echo $loginErr; ?></small>

             <div class="form-group">
                 <label for="" class="">User Name</label>
                 <input class="form-control" type="text" name="userName" value="<?php setValue('userName'); ?>">
             </div>

             <div class="form-group">
                 <label for="">Password</label>
                 <input class="form-control" type="password" id="password" name="password" value="<?php setValue('password'); ?>">
             </div>

             <div class="form-check showPassword">
                 <input type="checkbox" class="form-check-input" id="signInPass">
                 <label for="signInPass" class="form-check-label">show password</label>
             </div>

             <input type="submit" name="submit" value='Log in' class="btn btn-primary">

         </form>

     </div>


     <script src="Assets/JS/signin_pass.js"></script>
 </body>

 </html>