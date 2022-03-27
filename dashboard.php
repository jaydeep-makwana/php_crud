<?php
include 'config.php';
session_start();

# admin code
if (!isset($_SESSION['aid'])) {
    $_SESSION['aid'] = $_COOKIE['aid'];
}

if (!isset($_SESSION['aid'])) {
    header('location:login.php');
}

# select data from admin table
$id = $_SESSION['aid'];
$searchTable = "SELECT * FROM admin WHERE id = $id";
$rslt = mysqli_query($conn, $searchTable);

if (!$rslt) {
    echo mysqli_error($conn);
}

$myData = mysqli_fetch_assoc($rslt);
if (!$myData) {
    echo mysqli_error($conn);
}

$welcome = "hello " . $myData['userName'] . ", Welcome!!";

# user code

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


#fetch columns from database

// Query to get columns from table
$query = "SELECT * FROM user";

$result = mysqli_query($conn, $query);

// $num = mysqli_num_rows($result);
$assoc = mysqli_fetch_assoc($result);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap-4.6.1-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <title>Document</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  ">
        <img src="./Assets/./image/ms.png" width="100px" alt="">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse h4" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active ml-4">
                    <a class="nav-link" href="addUser.php">Add Users</a>
                </li>
            </ul>

            <!-- search form start -->
            <form class="form-inline my-2 my-lg-0" method="post">
                <!-- searching input -->
                <input class="form-control mr-sm-2 ml-3" id="search" placeholder="select any filed for search" disabled onkeyup="searchData()">


                <!-- dropdowm for field -->
                <div class="form-ckeck" width="5">
                    <select class="form-control" id="search_dropdown" onchange="placeholder()">
                        <option value="" selected disabled>select from here</option>
                        <?php foreach ($assoc as $i => $key) {
                            if ($i == 'photo' || $i == 'password') {
                                continue;
                            }
                        ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php }   ?>
                    </select>

                </div>
            </form>
            <!-- search form end -->

            <div class="d-flex user-data ml-3">

                <img src="./assets/./image/./Admin.png" alt="Network Error" width='45px' height='45px' data-toggle="modal" data-target="#exampleModa">

                <!-- Modal -->
                <div class="modal fade " id="exampleModa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog user-info">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h2><?php echo $myData['userName']; ?></h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>


                            <div class="modal-body">
                                <h2><a href="admin_logout.php" class="btn btn-danger">Log out</a></h2>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- modal finished -->
            </div>


    </nav>



    <!--  show data of users  -->
    <div class="table-responsive ">
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>

                    <th class="table-light">Id</th>
                    <th class="table-light">Fisrt Name</th>
                    <th class="table-light">Last Name</th>
                    <th class="table-light">Age</th>
                    <th class="table-light">Gender</th>
                    <th class="table-light">Department</th>
                    <th class="table-light">Date Of Join</th>
                    <th class="table-light">Salary</th>
                    <th class="table-light">Email</th>
                    <th class="table-light">Password</th>
                    <th class="table-light">Hobbies</th>
                    <th class="table-light">Photos</th>
                    <th class="table-warning">Edit</th>
                    <th class="table-danger">Delete</th>

                </tr>
            </thead>

            <tbody id="rows">
                <?php

                # fetch data from user table
                $selectTable = "SELECT * FROM user";
                $result = mysqli_query($conn, $selectTable);
                while ($myData = mysqli_fetch_assoc($result)) { ?>
                    <tr id="row<?php echo $myData['id']; ?>">
                        <td class="table-light"> <?php echo $myData['id']; ?> </td>
                        <td class="table-light"><?php echo $myData['firstName']; ?> </td>
                        <td class="table-light"><?php echo $myData['lastName']; ?> </td>
                        <td class="table-light"><?php echo $myData['age']; ?> </td>
                        <td class="table-light"><?php echo $myData['gender']; ?> </td>
                        <td class="table-light"><?php echo $myData['department']; ?> </td>
                        <td class="table-light"><?php echo $myData['date_of_join']; ?> </td>
                        <td class="table-light"><?php echo $myData['salary']; ?> </td>
                        <td class="table-light"><?php echo $myData['email']; ?> </td>
                        <td class="table-light"><?php echo base64_decode($myData['password']); ?> </td>
                        <td class="table-light"><?php echo $myData['hobby']; ?> </td>
                        <td class="table-light"> <img src="<?php echo $myData['photo']; ?>" alt="Network Error" hright='100px' width='100px'> </td>
                        <!-- <td class="table-warning"><a href="update.php?upld_id=<?php // echo $myData['id']; 
                                                                                    ?>"><button class="btn btn-warning">Update</button></a></td> -->
                        <td class="table-warning"><button class="btn btn-warning" onclick="update(<?php echo $myData['id']; ?>)">Update</button></td>
                        <td class="table-danger"><button onclick="delete_data(<?php echo $myData['id']; ?>)" class="btn btn-danger">DELETE</button></td>

                    </tr>

                    <!-- # UPDATE modal -->
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div id="data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal finish -->

                <?php  }


                ?>

            </tbody>

        </table>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        let modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')) // Returns a Bootstrap modal instance
        let data = document.getElementById('data'); // Returns a Bootstrap modal instance
        // Show or hide:
        function update(id) {
            data.innerHTML = id;
            modal.show();
        }
        // modal.hide();
    </script>

    <script src="./Assets/./JS/delete.js"></script>
    <script src="./Assets/./JS/search.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>