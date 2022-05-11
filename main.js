
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

    $(document).on('click', 'button[data-role = create]', function () {
        //$('#modal-title').html('Create user');


        $('#userId').val(undefined);
        $('#first_name').val('');
        $('#last_name').val('');
        $('#role').val('');
        $('#status').prop('checked', false);
        $('#user-form-modal').modal('toggle', $(this));



    })

    $(document).on('click', 'button[data-role = update]', function () {
        //$('#modal-title').html('Edit user');
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


        if (id) {
            $.ajax({
                url: 'edit_user.php',
                method: 'post',
                data: {id: id, first_name: first_name, last_name: last_name, role: role, status: status},
                success: function (response) {
                    $('#user-form-modal').modal('toggle');
                    load_data();
                }
            })
        } else {

            $.ajax({
                url: 'add_user.php',
                method: 'post',
                data: {first_name: first_name, last_name: last_name, role: role, status: status},
                success: function (data, status) {

                    $('#user-form-modal').modal('toggle');
                    load_data();
                }
            })
        }
    })

    $(document).on('click', 'button[data-role = delete]', function () {
        const id = ($(this).data('id'));
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
                load_data();
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
                $.ajax({
                    url: 'delete_user.php',
                    method: 'post',
                    data: {ids: ids},
                    success: function (response) {
                        load_data();
                    }
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
    })
    $('#delete-form-modal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let recipient = button.attr('data-whatever');
        let modal = $(this);
        modal.find('.modal-title').text(recipient + ' user');
        modal.find('.modal-body').text(recipient + ' user?');
    })

})




