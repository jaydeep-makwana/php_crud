<?php

include 'conn.php';

$id = $_GET['upld_id'];

$select_data = "SELECT * FROM user WHERE id = $id";
$query = mysqli_query($conn, $select_data);
$fetch_array = mysqli_fetch_assoc($query);
$strToArr = explode(', ', $fetch_array['hobby']);



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
        $confirm_password = base64_encode($_POST['cPassword']);
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
        $updateQuery = "UPDATE user SET firstName = '$firstName', lastName = '$lastName', age = '$age', gender = '$gender', department = '$department', date_of_join = '$dateOfJoin', email = '$email', password = '$password', confirm_password = '$confirm_password', salary = '$salary', hobby = '$ArrToString', photo = '$imagePath' WHERE id=$id";

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
    <link rel="stylesheet" href="Assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <title>Update</title>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5 bg-light w-100 ">
        <form method="post" enctype="multipart/form-data">
            <h1 class="text-center">Update</h1>
            <div class="row   ">

                <div class="col-lg-6  ">

                    <div class="form-group">
                        <label for="" class="">First Name</label>
                        <input class="form-control" type="text" name="fName" value="<?php echo $fetch_array['firstName']; ?>">
                    </div>


                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input class="form-control" type="text" name="lName" value="<?php echo $fetch_array['lastName']; ?>">
                    </div>


                    <div class="form-group">
                        <label for="">Age</label>
                        <input type="text" class="form-control" name="age" value="<?php echo $fetch_array['age']; ?>">
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
                        <input type="date" class="form-control" name="doj" value="<?php echo $fetch_array['date_of_join']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="">Salary</label>
                        <input type="text" class="form-control" name="salary" value="<?php echo $fetch_array['salary']; ?>">
                    </div>
                </div>
                <div class="col-lg-6  ">



                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $fetch_array['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" name="password" id="password" value="<?php echo base64_decode($fetch_array['password']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="cPassword">Confirm Password</label>
                        <input type="text" class="form-control" name="cPassword" id="cPassword" value="<?php echo base64_decode($fetch_array['confirm_password']); ?>">
                    </div>

                    <label for=""> Hobby

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



                    <div class="custom-file">

                        <!-- <label for="file" class="custom-file-label">choose file</label> -->
                        <input type="file" class="" name="file" id="file" value="ja.png">
                    </div>


                    <input type="submit" name="submit" value='Update' class="btn btn-primary">
                    <input type="reset" name="submit" value="Reset" class="btn btn-warning">

                    <a href="dashboard.php " class="btn btn-info"> back
                    </a>


                </div>
            </div>
        </form>
    </div>

</body>

</html>