<?php
include 'config.php';
session_start();

# get id from user's id
$id = $_GET['upld_id'];

# fetch data from user's table
$select_data = "SELECT * FROM user WHERE id = $id";
$query = mysqli_query($conn, $select_data);
$fetch_array = mysqli_fetch_assoc($query);
$strToArr = explode(', ', $fetch_array['hobby']);

function value($col_name, $name)
{
    global $fetch_array;
    if (!isset($_POST['submit'])) {
        echo $fetch_array[$col_name];
    } else {
        echo $_POST[$name];
    }
}

function passwordValue($col_name, $name)
{
    global $fetch_array;
    if (!isset($_POST['submit'])) {
        echo base64_decode($fetch_array[$col_name]);
    } else {
        echo $_POST[$name];
    }
}

function cPasswordValue($col_name)
{
    global $fetch_array;
    if (!isset($_POST['submit'])) {
        echo base64_decode($fetch_array[$col_name]);
    } else {
        echo $_POST['cPassword'];
    }
}

function arrChecked($value, $show)
{
    global $strToArr;
    if (in_array($value, $strToArr)) {
        echo $show;
    }
}

function checked($col_name, $value, $show)
{
    global $fetch_array;


    if ($fetch_array[$col_name] == $value) {

        echo $show;
    }
}

$fNameErr = $lNameErr  = $ageErr = $genErr = $depErr = $dojErr = $salaryErr = $emailErr = $passwordErr = $cPasswordErr = $hobbyErr = $fileErr = '';


# update data of user by admin
if (isset($_POST['submit'])) {

    if (empty($_POST['fName'])) {
        $fNameErr = 'first name should be not empty';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
        $fNameErr = 'only enter alphabet';
    } elseif (empty($_POST['lName'])) {
        $lNameErr = 'last name should be not empty';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
        $lNameErr = '* only enter alphabet ';
    } elseif (empty($_POST['age'])) {
        $ageErr = 'age should be not empty';
    } elseif (!preg_match("/\d/", $_POST['age'])) {
        $ageErr = 'age must be in digit';
    } elseif ($_POST['age'] < 18) {
        $ageErr = 'age shold not be less than 18 ';
    } elseif ($_POST['doj'] > date('Y-m-d')) {
        $dojErr = 'invalid date';
    } elseif (empty($_POST['salary'])) {
        $salaryErr = 'enter your  salary ';
    } elseif (!preg_match("/\d/", $_POST['salary'])) {
        $salaryErr = 'salary must be in digit';
    } elseif ($_POST['salary'] < 1) {
        $salaryErr = 'salary shold not be less than 1 ';
    } elseif (empty($_POST['email'])) {
        $emailErr = 'email should be not empty';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'email invalid';
    } elseif (empty($_POST['password'])) {
        $passwordErr = 'Password should be not empty';
    } elseif (!preg_match("/[A-Z]/", $_POST['password'])) {
        $passwordErr = 'Password should contain at least one Capital Letter';
    } elseif (!preg_match("/[a-z]/", $_POST['password'])) {
        $passwordErr = 'Password should contain at least one small Letter';
    } elseif (!preg_match("/\d/", $_POST['password'])) {
        $passwordErr = 'Password should contain at least one digit';
    } elseif (!preg_match("/\W/", $_POST['password'])) {
        $passwordErr = 'Password should contain at least one special character';
    } elseif (strlen($_POST['password']) < 8) {
        $passwordErr = 'Password should be minimum 8 characters';
    } elseif (empty($_POST['cPassword'])) {
        $cPasswordErr = 'enter your confirm password';
    } elseif ($_POST['cPassword'] != $_POST['password']) {
        $cPasswordErr = 'password and confirm password are not match';
    } elseif (empty($_POST['hobby'])) {
        $hobbyErr = 'hobby should be not empty';
    } elseif ($_FILES["file"]["size"] > 1000000) {
        $fileErr = 'image size should be less than 1 MB';
    } else {
        $firstName = $_POST['fName'];
        $lastName = $_POST['lName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $dateOfJoin = $_POST['doj'];
        $email = $_POST['email'];
        $password = base64_encode($_POST['password']);
        $salary = $_POST['salary'];
        $hobby = $_POST['hobby'];

        $ArrToString = implode(", ", $hobby);

        $target_dir = "assets/pics/";

        if (!file_exists($_FILES["file"]["tmp_name"])) {
            $imagePath = $fetch_array['photo'];
        } else {

            $imagePath = $target_dir . basename($_FILES['file']['name']);
        }

        $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);
        $updateQuery = "UPDATE user SET firstName = '$firstName', lastName = '$lastName', age = '$age', gender = '$gender', department = '$department', date_of_join = '$dateOfJoin', email = '$email', password = '$password', salary = '$salary', hobby = '$ArrToString', photo = '$imagePath' WHERE id=$id";

        if (mysqli_query($conn, $updateQuery)) {
            header('location:dashboard.php');
        }
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
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <title>welcome user </title>
</head>

<body class="admin-bg">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">

        <img src="./Assets/./image/ms.png" width="100px" alt="">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse h4" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item active ml-4">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item active ml-4">
                    <a class="nav-link" href="addUser.php">Add Users</a>
                </li>

            </ul>

        </div>

    </nav>


    <!-- update form, update user's data by admin -->
    <div class="container w-100">
        <form method="post" class="form-bg-admin mt-5  p-3" enctype="multipart/form-data">
            <h1 class="text-center">Update Record </h1>

            <div class="row">

                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="" class="">First Name</label>
                        <input class="form-control" type="text" name="fName" value="<?php value('firstName', 'fName');  ?>">
                        <small class="red"><?php echo $fNameErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input class="form-control" type="text" name="lName" value="<?php value('lastName', 'lName'); ?>">
                        <small class="red"><?php echo $lNameErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="text" class="form-control" name="age" value="<?php value('age', 'age'); ?>">
                        <small class="red"><?php echo $ageErr; ?></small>
                    </div>


                    <label for="">Gender
                        <div class="form-check">
                            <label for="" class="form-check-label">
                                <input type="radio" value="male" class="form-check-input" name="gender" <?php checked('gender', 'male', 'checked'); ?>> Male
                            </label>
                        </div>
                        <div class="form-check">

                            <label for="" class="form-check-label">

                                <input type="radio" value="female" class="form-check-input" name="gender" <?php checked('gender', 'female', 'checked'); ?>> Female
                            </label>
                        </div>
                    </label>


                    <div class="form-ckeck">
                        <label for="department">Department
                            <select name="department" class="form-control" id="department">
                                <option value="<?php echo $fetch_array['department']; ?>" selected><?php echo $fetch_array['department']; ?></option>
                                <option value="R & D">R & D</option>
                                <option value="Sales">Sales</option>
                                <option value="Marketing">Marketing</option>
                                <option value="HR">HR</option>
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="">Date Of Join</label>
                        <input type="date" class="form-control" name="doj" value="<?php value('date_of_join', 'doj'); ?>">
                        <small class="red"><?php echo $dojErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label for="">Salary</label>
                        <input type="text" class="form-control" name="salary" value="<?php value('salary', 'salary'); ?>">
                        <small class="red"><?php echo $salaryErr; ?></small>
                    </div>

                </div>

                <div class="col-lg-6  ">

                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php value('email', 'email'); ?>">
                        <small class="red"><?php echo $emailErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php passwordValue('password', 'password'); ?>">
                        <small class="red"><?php echo $passwordErr; ?></small>
                    </div>

                    <div class="form-group">
                        <label for="cPassword">Confirm Password</label>
                        <input type="password" class="form-control" name="cPassword" id="cPassword" value="<?php cPasswordValue('password'); ?>">
                        <small class="red"><?php echo $cPasswordErr; ?></small>
                    </div>
                    <div class="form-check showPassword">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label for="showPassword" class="form-check-label">show password</label>
                    </div>


                    <label for=""> Hobby
                        <small class="red"><?php echo $hobbyErr; ?></small>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="reading" <?php arrChecked('reading', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">reading</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="dancing" <?php arrChecked('dancing', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Dancing</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="programming" <?php arrChecked('programming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Programming</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="hobby" value="gaming" <?php arrChecked('gaming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Gaming</label>
                        </div>

                    </label>


                    <div>
                        <img src="<?php echo $fetch_array['photo']; ?>" width="120px" alt="">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Your Photo</label>
                        <small class="red"><?php echo $fileErr; ?></small>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <input type="submit" name="submit" value='Update' class="btn btn-primary">
                    <a href="dashboard.php" class="btn btn-warning">Back </a>

                </div>

            </div>
        </form>
    </div>

    <script src="Assets/JS/signup_pass.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>