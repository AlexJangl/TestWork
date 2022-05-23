<?php

include ("connection.php");

$query = "SELECT * FROM users INNER JOIN role ON users.role_id = role.id ORDER BY users.id ASC ";
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
$output .= "<tbody>";
while ($row = mysqli_fetch_array($res)){
    include 'table_row.php';
}
$output .= "</tbody>";
echo $output;
