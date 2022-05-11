<?php
include_once ('get_roles.php');
?>

<div class="modal" tabindex="-1" id="user-form-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" aria-label="Close" data-dismiss = "modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="userId" >
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role" required id = 'role'>
                                <option selected>Please Select</option>
                                <?php
                                while ($role =mysqli_fetch_array($query_roles)){
                                    $output .= "
                                    <option value='".$role['id']."'>".$role['role']."</option>
                                ";
                                }
                                echo $output;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-check-label" for="status">Status</label>
                            <div class="form-check form-switch mt-3">
                                <input class="form-check-input" type="checkbox" role="switch" name="status" id="status"/>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss = "modal">Close</button>
                <button class="btn btn-primary" type="submit" id="save">Save Changes</button>
            </div>
        </div>
    </div>
</div>
