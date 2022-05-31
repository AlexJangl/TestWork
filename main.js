
$(document).ready(function () {

    load_data();

    function load_data() {
        $.ajax({
            url: "load_data.php",
            method: "POST",
            success: function (data) {
                load_button();
                $(".result").html(data);

            }
        })
    }

    function load_button() {
        $.ajax({
            url: "load_button.php",
            method: "POST",
            success: function (data) {
                $(".butBlock").html(data);
            }
        })
    }

    function load_row(data) {
        $.ajax({
            url: "table_row.php",
            method: "POST",
            data:{data: data},
            success: function (data, status) {
                $('tbody').append(data);
            }
        })
    }

    $(document).on('click', 'button[data-role = create]', function () {
        $('#modal-error').text('');
        $('#userId').val(undefined);
        $('#first_name').val('');
        $('#last_name').val('');
        $('#role').val('');
        $('#status').prop('checked', false);

        $('#user-form-modal').modal('toggle', $(this));
    })

    $(document).on('click', 'button[data-role = update]', function () {
        $('#modal-error').text('');
        let id = ($(this).data('id'));
        let first_name = $('#' + id).children('input[data-target = first_name]').val();
        let last_name = $('#' + id).children('input[data-target = last_name]').val();
        let role = $('#' + id).children('input[data-target = role]').val();
        let status = $('#' + id).children('input[data-target = status]').val();
        $('#userId').val(id);
        $('#first_name').val(first_name);
        $('#last_name').val(last_name);
        $('#role').val(role);
        $('#status').val(status);
        if (status == 1) {
            $('#status').prop('checked', true);
        } else {
            $('#status').prop('checked', false);
        }
        $('#user-form-modal').modal('toggle', $(this));
    })

    $('#save').click(function () {

        let id = $('#userId').val();
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let role = $('#role').val();
        let is_status = document.getElementById('status');
        let status = is_status.checked ? 1 : 0;

        if (first_name == '') {
            $('#modal-error').text('first name is empty');
            return false;
        }
        if (last_name == '') {
            $('#modal-error').text('last name is empty');
            return false;
        }
        if (role == '') {
            $('#modal-error').text('role is empty');
            return false;
        }


        if (id) {
            $.ajax({
                url: 'edit_user.php',
                method: 'post',
                data: {id: id, first_name: first_name, last_name: last_name, role: role, status: status},
                success: function (response) {
                    let jsonData = JSON.parse(response);
                    if (jsonData.state == true)
                    {
                        $('#user-form-modal').modal('toggle');
                        let id = jsonData.id;
                        $('#' + id + 'input[data-target = first_name]').val(jsonData.first_name);
                        $('#' + id + 'input[data-target = last_name]').val(jsonData.last_name);
                        $('#' + id + 'input[data-target = role]').val(jsonData.role);
                        $('#' + id + 'input[data-target = status]').val(jsonData.status);
                        $('#' + id).children('td[data-target = name]').text(jsonData.first_name+' '+jsonData.last_name);
                        let role = '';
                        if (jsonData.role == 1){
                            role = 'admin'
                        }
                        else {
                            role = 'user'
                        }
                        $('#' + id).children('td[data-target = role]').text(role);
                        $('#' + id + ' td[data-target = status] i').removeClass('not-active-circle active-circle');
                        if (jsonData.status == 1){
                           status = 'active-circle';
                        }
                        else {
                            status = 'not-active-circle';
                        }
                        $('#' + id + ' td[data-target = status] i').addClass(status);

                    }
                    else
                    {
                        alert(jsonData.error['messeage']);
                    }
                }
            })
        } else {

            $.ajax({
                url: 'add_user.php',
                method: 'post',
                data: {first_name: first_name, last_name: last_name, role: role, status: status},
                success: function (response) {
                    let jsonData = JSON.parse(response);
                    if (jsonData.state == true)
                    {
                        $('#user-form-modal').modal('toggle');
                        data = '';
                        data+= "id="+jsonData.id;
                        data+= "&first_name="+jsonData.first_name;
                        data+= "&last_name="+jsonData.last_name;
                        data+= "&role="+jsonData.role;
                        data+= "&status="+jsonData.status;
                        load_row(data);
                    }
                    else
                    {
                        alert(jsonData.error['messeage']);
                    }

                }
            })
        }
    })

    $(document).on('click', 'button[data-role = delete]', function () {
        const id = ($(this).data('id'));
        let first_name = $('#' + id).children('input[data-target = first_name]').val();
        let last_name = $('#' + id).children('input[data-target = last_name]').val();
        $('#first_name_del').text(first_name);
        $('#last_name_del').text(last_name);
        $('#userIdDel').val(id);
        $('#delete-form-modal').modal('toggle', $(this));
    })

    $('#delete').click(function () {
        const id = $('#userIdDel').val();

        $.ajax({
            url: 'delete_user.php',
            method: 'post',
            data: {id: id},
            success: function (response) {
                $('#delete-form-modal').modal('toggle');
                document.getElementById(id).style.display ='none';
                $('#first_name_del').text('');
                $('#last_name_del').text('');
            }
        })
    })

    $(document).on('click', 'input[data-role = all]', function () {
        $(this).change(function () {
            $('.checkitem').prop('checked', $(this).prop('checked'));
        })
        $('.checkitem').change(function () {
            if ($(this).prop('checked') == false) {
                $('#all-items').prop('checked', false)
            }
            if ($('.checkitem:checked').length == $('.checkitem').length) {
                $('#all-items').prop('checked', true)
            }
        })
    })
    $(document).on('click', '.butUp button[data-role = ok]', function () {
        let val = $('.butUp select').val();
        select_checked_run(val);
    })
    $(document).on('click', '.butDown button[data-role = ok]', function () {
        let val = $('.butDown select').val();
        select_checked_run(val);
    })

    function select_checked_run(val) {
        const ids = [];
        $('.select_row:checked').each(function (index, id) {
            ids.push(id.id.split('item-')[1]);
        })
        if (ids.length == 0) {
            $('#userErrorModal').modal('toggle');
        }
        switch (val) {
            case '1':
            case '2': {
                $.ajax({
                    url: 'status_user.php',
                    method: 'post',
                    data: {ids: ids, val: val},
                    success: function (response) {
                        load_data();
                    }
                })

                break;
            }
            case '3': {
                $('#delete-form-modal').modal('toggle');
                $('#delete').click(function () {
                    $.ajax({
                        url: 'delete_user.php',
                        method: 'post',
                        data: {ids: ids},
                        success: function (response) {
                            $('#delete-form-modal').modal('toggle');
                            load_data();
                        }
                    })
                })


                break;
            }
            default:
                $('#selectErrorModal').modal('toggle');
        }
    }

    $('#user-form-modal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.attr('data-whatever');
        let modal = $(this);
        modal.find('.modal-title').text(recipient + ' user');
        if(recipient === 'Add'){
            modal.find('.modal-button').text(recipient + ' user');
        }else {
            modal.find('.modal-button').text('Seve user');
        }
    })
    $('#delete-form-modal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.attr('data-whatever');
        let modal = $(this);
        if (recipient == 'Delete'){
            modal.find('.modal-title').text(recipient + ' user');
            modal.find('.span-modal-body').text("Are you sure you want to delete the user ");
        }else {
            modal.find('.modal-title').text('Delete users');
            modal.find('.span-modal-body').text("You want to delete selected users");
        }
    })

})




