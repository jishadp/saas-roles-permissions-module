$(document).ready(function () {
    $('#offcanvasEditRoleForm').on('shown.bs.offcanvas', function () {
        $('#roleName').focus();
    });

    $(document).on('click', '.editButtonModal', function (e) {
        e.preventDefault();
        const url = $(this).data('action');

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#roleId').val(response.id);
                $('#roleName').val(response.name);
                $('#groupForm').attr('action', $('#groupForm').data('update-url'));
                $('#offcanvasGroupFormLabel').text('Edit Role');
                $('#offcanvasEditRoleForm').offcanvas('show');
                $('#groupForm').addClass('edit-mode');
            }
        });
    });

    $('.create-new').click(function() {
        $('#roleId').val('');
        $('#groupForm').attr('action', $('#groupForm').data('save-url'));
        $('#offcanvasGroupFormLabel').text('Add Role');
        $('#offcanvasEditRoleForm').offcanvas('show');
        $('#groupForm').removeClass('edit-mode');
    });

    $('#groupForm').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const data = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (response) {
                $('#offcanvasEditRoleForm').offcanvas('hide');
                form.trigger('reset');
                let message = form.attr('action').includes('update') ? 'Role updated successfully.' : 'Role created successfully.';
                sessionStorage.setItem('message', message);
                location.reload();
            },
            error: function (xhr) {
                alert('An error occurred. Please try again.');
            }
        });
    });

    $(document).on('click', '.deleteAction', function (e) {
        e.preventDefault();
        const url = $(this).attr('action');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        sessionStorage.setItem('message', 'Role deleted successfully.');
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.responseText.includes('SQLSTATE[23000]: Integrity constraint violation')) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'This Role is associated with other records and cannot be deleted.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            alert('There was an error deleting the Role.');
                        }
                    }
                });
            }
        });
    });

    if (sessionStorage.getItem('message')) {
        displayMessage(sessionStorage.getItem('message'), 'success');
        sessionStorage.removeItem('message');
    }

    function displayMessage(message, type) {
        const messageDiv = $('#message');
        messageDiv.html(`<div class="alert alert-${type}" role="alert">${message}</div>`);
        setTimeout(function () {
            messageDiv.empty();
        }, 5000);
    }

  });
