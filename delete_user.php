<?php
include ("connection.php");
$ids = $_POST['ids'];
if(isset($_POST['id'])){
    $ids [] = $_POST['id'];
}
foreach ($ids as $id){
    $query = "DELETE FROM users WHERE id='$id'";
    mysqli_query($connect, $query);
}


