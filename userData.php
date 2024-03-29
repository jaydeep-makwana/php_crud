<?php
include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}

if (!isset($_SESSION['id'])) {
    header('location:user_login.php');
}

# get user's id by logged user
$id = $_SESSION['id'];

# fetch data of logged user
$searchTable = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($conn, $searchTable);

if (!$result) {
    echo mysqli_error($conn);
}
$myData = mysqli_fetch_assoc($result);
if (!$myData) {
    echo mysqli_error($conn);
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
    <title>Your _Details</title>
</head>

<body class="user-bg">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  ">

        <img src="./Assets/./image/ms.png" width="100px" alt="">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse h4" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item active ml-4">
                    <a class="nav-link" href="user_welcome.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <div class="d-flax">

                    <li class="nav-item active ml-4 ">
                        <a class="nav-link" href="user_update.php">Update <span class="sr-only">(current)</span></a>
                    </li>

                </div>

            </ul>

        </div>

    </nav>

    <!-- show user's data in table -->
    <div class="table-responsive">

        <table class="table table-responsive userData text-white border border-light text-center p-2 mt-5 user-table">

            <tr>
                <th colspan="2">
                    <h3>Your Details</h3>
                </th>
            </tr>

            <tr>
                <th>Id</th>
                <td> <?php echo $myData['id']; ?> </td>
            </tr>
            <tr>
                <th>Fisrt_Name</th>
                <td><?php echo $myData['firstName']; ?> </td>

            </tr>

            <tr>
                <th>Last_Name</th>
                <td><?php echo $myData['lastName']; ?> </td>

            </tr>

            <tr>
                <th>Age</th>
                <td><?php echo $myData['age']; ?> </td>

            </tr>

            <tr>
                <th>Gender</th>
                <td><?php echo $myData['gender']; ?> </td>
            </tr>

            <tr>
                <th>Department</th>
                <td><?php echo $myData['department']; ?> </td>
            </tr>

            <tr>
                <th>Date Of Join</th>
                <td><?php echo $myData['date_of_join']; ?> </td>
            </tr>

            <tr>
                <th>Salary</th>

                <td><?php echo $myData['salary']; ?> </td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?php echo $myData['email']; ?> </td>
            </tr>

            <!-- <tr>
                <th>Password</th>
                <td>

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16" id="showPass">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                    </svg>
                    <input type="text" class="form-control" id="userPassword" readonly>

                </td>
            </tr> -->

            <tr>
                <th>Hobbies</th>
                <td><?php echo $myData['hobby']; ?> </td>
            </tr>

            <tr>
                <th>Photo</th>
                <td> <img src="<?php echo $myData['photo']; ?>" alt="Network Error" height='100px' width='100px'> </td>
            </tr>

        </table>

    </div>

    <!-- <script>
        document.getElementById("showPass").addEventListener('click', show);
        let passValue = document.getElementById("userPassword");
        let password = "<?php // echo base64_decode($myData['password']); ?>";
        let star = "";
        for (let index = 0; index < password.length; index++) {
            star = star + '*';
        }
        passValue.value = star;

        function show() {

            let modal = prompt("Enter your password");
            if (modal == "") {
                alert('enter your password');
            } else {
                if (modal == password) {

                    passValue.value = password;
                    document.querySelector("#showPass").style.display = "none";
                }
            }

        }
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>