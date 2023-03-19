<?php
include "../db_connectionn.php";
$id = $_POST['id'];
$query = " DELETE from category where id = $id ";
$result = mysqli_query($connection, $query);
if ($result) {
    header('Location:add.php');
}