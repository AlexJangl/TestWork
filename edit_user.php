<?php
include ("connection.php");
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['role']) && isset($_POST['id'])){
    $id =$_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $query = "UPDATE users SET first_name='$first_name', last_name = '$last_name', role_id='$role', status='$status' WHERE id='$id' ";
    $res =mysqli_query($connect, $query);
    echo json_encode(array('status' => true));
}
else {

    echo json_encode(array('status' => false, 'error'=>['code'=> 100, 'message'=>"not data"]));
}
