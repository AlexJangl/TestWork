<?php
include ("connection.php");
$query_roles = "SELECT * FROM role ORDER BY id ASC";
$query_roles = mysqli_query($connect, $query_roles);


