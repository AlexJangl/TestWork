<?php
include ("connection.php");

$status = $_POST['val'] === '1' ? 1 : 0;
$ids = $_POST['ids'];
foreach ($ids as $id){
    $query = "UPDATE users SET status='$status' WHERE id='$id' ";
    mysqli_query($connect, $query);
}