<?php
include 'config.php';
session_start();

# user login logic

if (isset($_SESSION['id'])) {
    header('location:user_welcome.php');
}
if (isset($_COOKIE['id'])) {
    header('location:user_welcome.php');
}
$emailErr = $passwordErr = '';
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email)) {
        $emailErr = " email required";
    } elseif (empty($pass)) {
        $passwordErr = "password required";
    } else {
        $selectTable = "SELECT * FROM user WHERE email ='$email'";
        $query = mysqli_query($conn, $selectTable);
        $num_rows = mysqli_num_rows($query);
        $arr = mysqli_fetch_assoc($query);
        if ($num_rows) {

            if ($arr['password'] == base64_encode($pass)) {
                $_SESSION['id'] = $arr['id'];
                setcookie('id', $_SESSION['id'], time() + 60 * 10);
                header('location:user_welcome.php');
            } else {
                $passwordErr = "invalid password";
            }
        } else {
            $emailErr = "invalid email";
        }
    }
}


# admin login logic

if (isset($_SESSION['aid'])) {
    header('location:dashboard.php');
}
if (isset($_COOKIE['aid'])) {
    header('location:dashboard.php');
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
if (isset($_POST['asubmit'])) {

    if (empty($_POST['userName']) || empty($_POST['password'])) {

        $loginErr = "username and password required";
    } else {


        $uname = $_POST['userName'];
        $pass = $_POST['password'];

        $fetch_array = mysqli_fetch_assoc($tblQuery);

        if ($uname == $fetch_array['userName'] && $pass == $fetch_array['password']) {
            $_SESSION['aid'] = $fetch_array['id'];
            setcookie('aid', $fetch_array['id'], time() + 60 * 10);
            header('location:dashboard.php');
        } else {
            $loginErr = "username or password invalid";
        }
    }
}


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
    <title>Login</title>
</head>

<body class="login-bg">
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <!-- user login form -->
    <div class="container mt-5 text-dark  mx-auto  row w-100">
        <div class="col-lg-4 form-bg-user   mx-auto">
            
            <form method="post">

                <h1 class="text-center p-3">User Log in</h1>

                <div class="form-group">
                    <label for="" class="">Email</label>
                    <input class="form-control" type="text" name="email" value="<?php setValue('email'); ?>">
                    <small class="red"><?php echo $emailErr; ?></small>
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" id="password" name="password" value="<?php setValue('password'); ?>">
                    <small class="red"><?php echo $passwordErr; ?></small>
                </div>

                <div class="form-check showPassword">
                    <input type="checkbox" class="form-check-input" id="signInPass">
                    <label for="signInPass" class="form-check-label">show password</label>
                </div>

                <input type="submit" name="submit" value='Log in' class="btn btn-primary">

                <div class="form-group mt-5 text-center bg-light ">
                    <p class="text-danger"> don't have have an account </p>
                    <a href="user_registration.php"> click here</a>
                </div>

            </form>

        </div>


        <div class="col-lg-4 form-bg-admin mx-auto">

            <form method="post">
                <h1 class="text-center p-3"> Admin Log in</h1>
                <small class="red"><?php echo $loginErr; ?></small>

                <div class="form-group">
                    <label for="" class="">User Name</label>
                    <input class="form-control" type="text" name="userName" value="<?php setValue('userName'); ?>">
                </div>

                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" type="password" id="apassword" name="password" value="<?php setValue('password'); ?>">
                </div>

                <div class="form-check showPassword">
                    <input type="checkbox" class="form-check-input" id="asignInPass">
                    <label for="asignInPass" class="form-check-label">show password</label>
                </div>

                <input type="submit" name="asubmit" value='Log in' class="btn btn-primary">

            </form>

        </div>

    </div>

    <script src="Assets/JS/signin_pass.js"></script>
</body>

</html>