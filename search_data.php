<?php
include 'config.php';

$search_value = $_GET['q'];

$decode = json_decode($search_value);
$input = $decode->srch_input;
$field = $decode->field;

# search data from user table
$serch_qry = "SELECT * FROM user WHERE $field LIKE '%$input%'";
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
        <td class="table-warning"><a href="update.php?update_id=<?php echo $myData['id']; ?>"><button class="btn btn-warning">Update</button></a></td>
        <td class="table-danger"><button onclick="delete_data(<?php echo $myData['id']; ?>)" class="btn btn-danger">DELETE</button></td>

    </tr>
<?php
}
?>