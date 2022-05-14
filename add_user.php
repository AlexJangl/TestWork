<?php
include ("connection.php");

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['role']))
{
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $status = $_POST['status'];
    $role = $_POST['role'];
    $query = "INSERT INTO users (first_name, last_name, status, role_id) VALUES ('$first_name','$last_name', '$status', '$role')  ";

    $res =mysqli_query($connect, $query);

   echo json_encode(array('status' => true));
}
 else {
    echo json_encode(array('status' => false, 'error'=>['code'=> 100, 'messeage'=>"not data"]));
}