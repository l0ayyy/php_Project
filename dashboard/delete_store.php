<?php
include "../db_connectionn.php";
$id = $_POST['id'];
$query = "DELETE from store where id = $id";
$result = mysqli_query($connection, $query);
if ($result) {
    header('Location:storedash.php');
}