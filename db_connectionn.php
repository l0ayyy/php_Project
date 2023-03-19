<?php

$connection=mysqli_connect(
    'localhost',
    'root',
    '',
    'project1');

if(!$connection){
    die('Error' . mysqli_connect_error());

}
?>