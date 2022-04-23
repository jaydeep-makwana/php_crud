<?php
include 'config.php';

$fNameErr = $lNameErr  = $ageErr = $genErr = $depErr = $dojErr = $salaryErr = $emailErr = $passwordErr = $cPasswordErr = $hobbyErr = $fileErr = '';

# insert data through user
if (isset($_POST['submit'])) {

    $selectTable = "SELECT * FROM user";

    if (!mysqli_query($conn, $selectTable)) {
        $createTable = "CREATE TABLE user (
     id int(10) AUTO_INCREMENT not null primary key,
     firstName varchar(10) not null,
     lastName varchar(10) not null,
     age text  ,
     gender text not null,
     department text not null,
     date_of_join date not null,
     salary int(10) not null,
     email  varchar(100) not null,
     password varchar(100) not null,
     hobby text not null,
     photo varchar(100) not null)";

        if (!mysqli_query($conn, $createTable)) {
            echo mysqli_error($conn);
        }
    }

    $email = $_POST['email'];
    $password= $_POST['password'];

    $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $selectEmail);
    $email_exist = mysqli_num_rows($result);


    if (empty($_POST['fName'])) {
        $fNameErr = 'first name should be not empty';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
        $fNameErr = 'only enter alphabet ';
    } elseif (empty($_POST['lName'])) {
        $lNameErr = 'last name should be not empty ';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
        $lNameErr = 'only enter alphabet ';
    } elseif (empty($_POST['age'])) {
        $ageErr = 'age should be not empty ';
    } elseif (!preg_match("/\d/", $_POST['age'])) {
        $ageErr = 'age must be in digit';
    } elseif ($_POST['age'] < 18) {
        $ageErr = 'age should not be less than 18 ';
    } elseif (empty($_POST['gender'])) {
        $genErr = 'gender should be not empty';
    } elseif (empty($_POST['department'])) {
        $depErr = 'please choose your department';
    } elseif (empty($_POST['doj'])) {
        $dojErr = 'when did you join this company?';
    } elseif ($_POST['doj'] > date('Y-m-d')) {
        $dojErr = 'invalid date';
    } elseif (empty($_POST['salary'])) {
        $salaryErr = 'enter your  salary ';
    } elseif (!preg_match("/\d/", $_POST['salary'])) {
        $salaryErr = 'salary must be in digit';
    } elseif ($_POST['salary'] < 1) {
        $salaryErr = 'salary should not be less than 1 ';
    } elseif (!preg_match("/\d/", $_POST['salary'])) {
        $salaryErr = 'salary must be in digit';
    } elseif (empty($_POST['email'])) {
        $emailErr = 'email should be not empty';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'email invalid';
    } elseif ($email_exist) {
        $emailErr = 'this email is already registered';
    } elseif (empty($password)) {
        $passwordErr = 'Password should be not empty';
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $passwordErr = 'Password should contain at least one Capital Letter';
    } elseif (!preg_match("/[a-z]/", $password)) {
        $passwordErr = 'Password should contain at least one small Letter';
    } elseif (!preg_match("/\d/", $password)) {
        $passwordErr = 'Password should contain at least one digit';
    } elseif (!preg_match("/\W/", $password)) {
        $passwordErr = 'Password should contain at least one special character';
    } elseif (strlen($password) < 8) {
        $passwordErr = 'Password should be 8 characters';
    } elseif (empty($_POST['cPassword'])) {
        $cPasswordErr = 'enter your confirm password';
    } elseif ($_POST['cPassword'] != $password) {
        $cPasswordErr = 'password and confirm password are not match';
    } elseif (empty($_POST['hobby'])) {
        $hobbyErr = 'hobby should be not empty';
    } elseif (!file_exists($_FILES["file"]["tmp_name"])) {
        $fileErr = 'Choose image file to upload ';
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

        $imagePath = $target_dir . basename($_FILES['file']['name']);

        $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);

        $insertQuery = "INSERT INTO user (`firstName`,`lastName`,`age`,`gender`,`department`,`date_of_join`,`salary`,`email`,`password`, `hobby`,`photo`) VALUES ('$firstName','$lastName','$age','$gender','$department ','$dateOfJoin','$salary ','$email','$password','$ArrToString','$imagePath')";
        if (mysqli_query($conn, $insertQuery) && $movefile) {
             ?>
   <script>
       alert('you are successfully registerd');
       location.replace('login.php');
   </script>
             <?php 

        } else {
            echo mysqli_error($conn);
        }
    }
}




# insert data through admin
if (isset($_POST['add_user'])) {

    $selectTable = "SELECT * FROM user";

    if (!mysqli_query($conn, $selectTable)) {
        $createTable = "CREATE TABLE user (
     id int(10) AUTO_INCREMENT not null primary key,
     firstName varchar(10) not null,
     lastName varchar(10) not null,
     age text ,
     gender text not null,
     department text not null,
     date_of_join date not null,
     salary int(10) not null,
     email  varchar(100) not null,
     password varchar(100) not null,
     hobby text not null,
     photo varchar(100) not null)";

        if (!mysqli_query($conn, $createTable)) {
            echo mysqli_error($conn);
        }
    }
 
    $email = $_POST['email'];
    $password= $_POST['password'];

    $selectEmail = "SELECT * FROM user WHERE email = '$email' ";
    $result = mysqli_query($conn, $selectEmail);
    $email_exist = mysqli_num_rows($result);

    if (empty($_POST['fName'])) {
        $fNameErr = 'first name should be not empty';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['fName'])) {
        $fNameErr = 'only enter alphabet ';
    } elseif (empty($_POST['lName'])) {
        $lNameErr = 'last name should be not empty ';
    } elseif (!preg_match("/^[a-zA-Z]*$/", $_POST['lName'])) {
        $lNameErr = 'only enter alphabet ';
    } elseif (empty($_POST['age'])) {
        $ageErr = 'age should be not empty ';
    } elseif (!preg_match("/\d/", $_POST['age'])) {
        $ageErr = 'age must be in digit';
    } elseif ($_POST['age'] < 18) {
        $ageErr = 'age should not be less than 18 ';
    } elseif (empty($_POST['gender'])) {
        $genErr = 'gender should be not empty';
    } elseif (empty($_POST['department'])) {
        $depErr = 'please choose your department';
    } elseif (empty($_POST['doj'])) {
        $dojErr = 'when did you join this company?';
    } elseif ($_POST['doj'] > date('Y-m-d')) {
        $dojErr = 'invalid date';
    } elseif (empty($_POST['salary'])) {
        $salaryErr = 'enter your  salary ';
    } elseif (!preg_match("/\d/", $_POST['salary'])) {
        $salaryErr = 'salary must be in digit';
    } elseif ($_POST['salary'] < 1) {
        $salaryErr = 'salary should not be less than 1 ';
    } elseif (!preg_match("/\d/", $_POST['salary'])) {
        $salaryErr = 'salary must be in digit';
    } elseif (empty($_POST['email'])) {
        $emailErr = 'email should be not empty';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'email invalid';
    } elseif ($email_exist) {
        $emailErr = 'this email is already registered';
    } elseif (empty($password)) {
        $passwordErr = 'Password should be not empty';
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $passwordErr = 'Password should contain at least one Capital Letter';
    } elseif (!preg_match("/[a-z]/", $password)) {
        $passwordErr = 'Password should contain at least one small Letter';
    } elseif (!preg_match("/\d/", $password)) {
        $passwordErr = 'Password should contain at least one digit';
    } elseif (!preg_match("/\W/", $password)) {
        $passwordErr = 'Password should contain at least one special character';
    } elseif (strlen($password) < 8) {
        $passwordErr = 'Password should be 8 characters';
    } elseif (empty($_POST['cPassword'])) {
        $cPasswordErr = 'enter your confirm password';
    } elseif ($_POST['cPassword'] != $_POST['password']) {
        $cPasswordErr = 'password and confirm password are not match';
    } elseif (empty($_POST['hobby'])) {
        $hobbyErr = 'hobby should be not empty';
    } elseif (!file_exists($_FILES["file"]["tmp_name"])) {
        $fileErr = 'Choose image file to upload ';
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

        $imagePath = $target_dir . basename($_FILES['file']['name']);

        $movefile = move_uploaded_file($_FILES['file']['tmp_name'], $imagePath);

        $insertQuery = "INSERT INTO user (`firstName`,`lastName`,`age`,`gender`,`department`,`date_of_join`,`salary`,`email`,`password`, `hobby`,`photo`) VALUES ('$firstName','$lastName','$age','$gender','$department ','$dateOfJoin','$salary ','$email','$password','$ArrToString','$imagePath')";
        if (mysqli_query($conn, $insertQuery) && $movefile) {

            header('location:dashboard.php');
        } else {
            echo mysqli_error($conn);
        }
    }
}
  


