<?php

include ("connection.php");

$query = "SELECT * FROM users INNER JOIN role ON users.role_id = role.id ";
$res = mysqli_query($connect, $query);

$output = "";

$output .= "
    <table class='table table-bordered'>
        <thead>
        <tr>
            <th class='align-top'>
                <div
                    class='custom-control custom-control-inline custom-checkbox custom-control-nameless m-0'>
                    <input type='checkbox' class='custom-control-input' id='all-items' data-role = 'all'>
                    <label class='custom-control-label' for='all-items' ></label>
                </div>
            </th>
            <th class='max-width'>Name</th>
            <th class='sortable'>Role</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
        </thead>
    
";



if (mysqli_num_rows($res) <1){
    $output .= "
        <tr>
            <td colspan='5' align='center'> NO DATA</td>
        </tr>  
    ";
}
while ($row = mysqli_fetch_array($res)){
    $output .= "
        <tbody>
            <tr id = '".$row[0]."'>
                <td class='align-middle'>
                    <div class='custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top'>
                        <input type='checkbox' class='custom-control-input checkitem select_row' id='item-".$row[0]."'>
                        <label class='custom-control-label' for='item-".$row[0]."'></label>
                    </div>
                </td>
                <input type='hidden' data-target = 'first_name' value=".$row['first_name'].">
                <input type='hidden' data-target = 'last_name' value=".$row['last_name'].">
                <input type='hidden' data-target = 'role' value=".$row['role_id'].">
                <input type='hidden' data-target = 'status' value=".$row['status'].">
                <td class='text-nowrap align-middle' data-target = 'name'>".$row['first_name'].' '.$row['last_name']."</td>
                <td class='text-nowrap align-middle' data-target = 'role'><span>".$row['role']."</span></td>
                <td class='text-center align-middle' data-target = 'status'><i class='fa fa-circle  ".($row['status']==0 ? 'not-':null)."active-circle'></i></td>
                <td class='text-center align-middle'>
                    <div class='btn-group align-top'>
                        <button class='btn btn-sm btn-outline-primary badge' type='button' data-role = 'update' data-id = '".$row[0]."' data-whatever='Edit'>Edit</button>
                        <button class='btn btn-sm btn-outline-primary badge' type='button' data-role = 'delete' data-id = '".$row[0]."' data-whatever='Delete'>
                            <i class='fa fa-trash'></i></button>
                    </div>
                </td>
            </tr>
        </tbody>
    ";
}
echo $output;
