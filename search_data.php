<?php
include 'config.php';

$search_value = $_GET['q'];

  # search data from user table
  $serch_qry = "SELECT * FROM user WHERE firstName LIKE '%$search_value%' ";
  $result = mysqli_query($conn, $serch_qry);

  while ($myData = mysqli_fetch_assoc($result)) {
       ?>
<tr>
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
        <td class="table-warning"><a href="update.php?upld_id=<?php echo $myData['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
        <td class="table-danger"><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">DELETE</button></td>
        <!-- delete Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-dark">&times;</span>
                        </button>

                    </div>
                    <div class="modal-body">
                        Do you really want to delete record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                        <a href="delete.php?del_id=<?php echo $myData['id']; ?>"><button class="btn btn-danger">DELETE</button></a>
                    </div>
                </div>
            </div>
        </div>

    </tr>
       <?php
  }




?>