<?php
include('insert.php');
session_start();

if (isset($_SESSION['id'])) {
    header('location:user_welcome.php');
}

# functions for set value in input field and keep checked radio button and checkbox
function setValue($value)
{
    if (isset($_POST[$value])) {
        echo $_POST[$value];
    }
}

function checked($name, $value, $show)
{
    if (isset($_POST[$name])) {
        if ($_POST[$name] == $value)
            echo  $show;
    }
}

function arrChecked($name, $value, $show)
{
    if (isset($_POST[$name])) {
        if (in_array($value, $_POST[$name])) {
            echo $show;
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
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <title>Register</title>
</head>



<body class="user-bg">
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <!-- register form -->
    <div class="container mt-5  text-white border border-light w-100 ">
        <form method="post" enctype="multipart/form-data">
            <h1 class="text-center">Register</h1>

            <div class="row">

                <div class="col-lg-6 ">

                    <div class="form-group">
                        <label for="" class="">First Name</label> 
                        <input class="form-control" type="text" name="fName" value="<?php setValue('fName'); ?>">
                        <small> * <?php echo $fNameErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Last Name</label> 
                        <input class="form-control" type="text" name="lName" value="<?php setValue('lName'); ?>">
                        <small>* <?php echo $lNameErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Age</label> 
                        <input type="text" class="form-control" name="age" value="<?php setValue('age'); ?>">
                        <small>* <?php echo $ageErr; ?> </small>
                    </div>


                    <label for="">Gender <small> * <?php echo $genErr; ?> </small>
                        <div class="form-check">
                            <label for="" class="form-check-label">
                                <input type="radio" value="male" class="form-check-input" name="gender" <?php checked('gender', 'male', 'checked'); ?>> male
                            </label>
                        </div>
                        <div class="form-check">

                            <label for="" class="form-check-label">

                                <input type="radio" value="female" class="form-check-input" name="gender" <?php checked('gender', 'female', 'checked'); ?>> female
                            </label>
                        </div>
                    </label>


                    <div class="form-ckeck">
                        <label for="department">Department 
                            <select name="department" class="form-control" id="department">
                                <option value="" selected disabled>---Choose Department</option>
                                <option value="R & D" <?php checked('department', 'R & D', 'selected'); ?>>R & D</option>
                                <option value="Sales" <?php checked('department', 'Sales', 'selected'); ?>>Sales</option>
                                <option value="Marketing" <?php checked('department', 'Marketing', 'selected'); ?>>Marketing</option>
                                <option value="HR" <?php checked('department', 'HR', 'selected'); ?>>HR</option>
                            </select>
                            <small> * <?php echo $depErr;  ?> </small>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="">Date Of Join</label>
                        <input type="date" class="form-control" name="doj" value="<?php setValue('doj'); ?>">
                        <small> * <?php echo $dojErr; ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="">Salary</label> 
                        <input type="text" class="form-control" name="salary" value="<?php setValue('salary'); ?>">
                        <small> * <?php echo $salaryErr;  ?> </small>
                    </div>

                </div>


                <div class="col-lg-6  ">

                    <div class="form-group">
                        <label for="">Email</label> 
                        <input type="text" class="form-control" name="email" value="<?php setValue('email'); ?>">
                        <small> * <?php echo $emailErr;  ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php setValue('password'); ?>">
                        <small> * <?php echo $passwordErr;  ?> </small>
                    </div>

                    <div class="form-group">
                        <label for="cPassword">Confirm Password</label> 
                        <input type="password" class="form-control" name="cPassword" id="cPassword" value="<?php setValue('cPassword'); ?>">
                        <small> * <?php echo $cPasswordErr;  ?> </small>
                    </div>

                    <div class="form-check showPassword">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label for="showPassword" class="form-check-label">show password</label>
                    </div>


                    <label for=""> Hobby <small> * <?php echo $hobbyErr;  ?> </small>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="reading" <?php arrChecked('hobby', 'reading', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">reading</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="dancing" <?php arrChecked('hobby', 'dancing', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Dancing</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="programming" <?php arrChecked('hobby', 'programming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Programming</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="hobby[]" id="" value="gaming" <?php arrChecked('hobby', 'gaming', 'checked'); ?>>
                            <label for="hobby" class="form-check-label">Gaming</label>
                        </div>

                    </label>


                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Your Photo</label> 
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        <small> * <?php echo $fileErr;  ?> </small>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary">
                    <input type="reset" name="submit" value="Reset" class="btn btn-warning">

                    <div class="form-group mt-5 text-center   bg-light ">
                        <p class="text-danger">already have an account?</p>
                        <a href="login.php "> click here</a>
                    </div>

                </div>

            </div>
        </form>
    </div>


    <script src="Assets/JS/signup_pass.js"></script>

</body>

</html>