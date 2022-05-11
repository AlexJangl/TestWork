<?php
$buttonGroup = "<div class='btn-group my-2'>
        <button type='button' class='btn btn-outline-primary' data-role = 'create'>add</button>
      </div>
      <div class='btn-group' role='group' aria-label='Button group with nested dropdown bg-primary'>
        <select class='custom-select border-primary border-2' >
            <option selected>Please Select</option>
            <option value='1'>Set active</option>
            <option value='2'>Set not active</option>
            <option value='3'>Delete</option>
        </select>
        <button type='button' class='btn btn-outline-primary' id='btn-ok' data-role = 'ok'>Ok</button>
      </div> 
";
echo $buttonGroup;