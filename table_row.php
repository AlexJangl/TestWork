<?php
if(isset($_POST['data'])){
    $datas = explode('&',$_POST['data']);
    foreach($datas as $data) {
        $v = explode('=',$data);
        $res[array_shift($v)] = array_pop($v);
    }
    if($res['role'] == 1){
        $row['role'] = 'admin';
    }
    else{
        $row['role'] = 'user';
    }
    $row[0] = $res['id'];
    $row['first_name'] = $res['first_name'];
    $row['last_name'] = $res['last_name'];
    $row['role_id'] = $res['role'];

    $row['status'] = $res['status'];
    $output = "";
//echo $output;
//    //die();
}
$output .= "
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
    <td class='text-center align-middle' data-target = 'status'><i class='fa fa-circle circle  ".($row['status']==0 ? 'not-':null)."active-circle'></i></td>
    <td class='text-center align-middle'>
        <div class='btn-group align-top'>
            <button class='btn btn-sm btn-outline-primary badge' type='button' data-role = 'update' data-id = '".$row[0]."' data-whatever='Edit'>Edit</button>
            <button class='btn btn-sm btn-outline-primary badge' type='button' data-role = 'delete' data-id = '".$row[0]."' data-whatever='Delete'>
                <i class='fa fa-trash'></i></button>
        </div>
    </td>
</tr>
";
if(isset($_POST['data'])){
    echo $output;
}

