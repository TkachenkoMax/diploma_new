import * as _ from 'lodash';
const toastr = require('toastr');

const UsersListController = function () {
    /**
     * Make headcount table as DataTable.
     *
     * @return void
     */
    const getDataForDataTable = () => {
        if (!window.dataTableIsActive) {
            return;
        }

        $('#users-table').on('processing.dt', function (e, settings, processing) {
            if (processing) {
                $(this).closest('.ibox-content').addClass('sk-loading');
            } else {
                $(this).closest('.ibox-content').removeClass('sk-loading');
            }
        }).DataTable({
            serverSide: false,
            info: false,
            pagingType: 'simple_numbers',
            bLengthChange: false,
            pageLength: 50,
            responsive: true,
            bFilter: false,
            destroy: true,
            ajax: {
                url: '/admin/users/data',
                type: 'GET',
                data: function (data) {
                    data.user_role = $('#filter-by-role').val();
                    data.name      = $('#filter-by-name').val();
                },
                dataSrc: (json) => {
                    return json.data;
                }
            },
            columns: [
                {data: 'firstname', name: 'First Name', class: 'users-first-name'},
                {data: 'lastname', name: 'Last Name', class: 'users-last-name'},
                {data: 'email', name: 'Email', class: 'users-email'},
                {data: 'roles', render: '[, ].name', name: 'Roles', class: 'users-roles'},
                {data: (data) => {
                        return `
                            <div class='btn-group table-action-buttons'>
                                <a class='btn btn-xs no-margins color-black view-user' data-id='${data.id}' data-style='zoom-in'>
                                    <i class='fa fa-lg fa-pencil'></i>
                                </a>
                                <a class='btn btn-xs no-margins color-black color-red-hover delete-user' data-id='${data.id}' data-style='zoom-in'>
                                    <i class='fa fa-lg fa-trash'></i>
                                </a>
                            </div>
                        `;
                    }, name: 'Actions', class: 'users-actions', 'orderable': false},
            ],
            drawCallback: function() {
                const pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
            }
        });
    };

    /**
     * Shows edit form.
     */
    this.showUserView = function () {
        const modalForm = '#view_user';
        const userId = $(this).data('id');

        $(modalForm + ' .view-user-body').html(
            `<div class='sk-spinner sk-spinner-double-bounce'>
                <div class='sk-double-bounce1'></div>
                <div class='sk-double-bounce2'></div>
            </div>`
        );

        $.ajax({
            url: `/admin/user/${userId}/view/`,
            type: 'GET',
            success: (data) => {
                $(modalForm +' .view-user-body').html(data);
                $(modalForm + ' #user_roles').select2({width: '100%', dropdownParent: $('#view_user')});
                $(modalForm).modal('show');
            },
            error: function (data) {
                $(modalForm).modal('hide');
                toastr.error('Something went wrong!', data.responseJSON.error);
            }
        });
    };

    /**
     * Save user's permissions.
     */
    const saveUserPermissions = (form, modal) => {
        const $form = $(form),
            data = $(form).serializeArray(),
            url = $form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            beforeSend: function() {
                $('#save_roles').attr('disabled', 'disabled');
            },
            success: function () {
                toastr.success('Permissions updated!');
                $(modal).modal('hide');

                getDataForDataTable();
            },
            error: function (data) {
                toastr.error('Something went wrong!', data.responseJSON.error);
                $(modal).modal('hide');
            }
        });
    };

    /**
     * Delete user.
     */
    this.deleteUser = function () {
        const userId = $(this).data('id');

        window.swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete him!'
        }, function () {
            $.ajax({
                url: `/admin/user/${userId}/delete/`,
                type: 'GET',
                success: () => {
                    toastr.success('User successfully deleted!');
                    getDataForDataTable();
                },
                error: data => {
                    toastr.error('Something went wrong!', data.responseJSON.error);
                }
            });
        });
    };

    /**
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {
        $(document).on('click', '#users-list .view-user', this.showUserView);
        $(document).on('click', '#users-list .delete-user', this.deleteUser);
        $(document).on('submit', '#view_user form', function(e) {
            e.preventDefault();
            saveUserPermissions(this, '#view_user');
        });

        $('#filter-by-role').on('change', () => {
            $('#users-list #reset-filter').removeClass('hidden');
            getDataForDataTable();
        });

        const debounce = _.debounce(getDataForDataTable, 2000, false);

        $('#users-list #filter-by-name').keyup(function() {
            $('#users-list #reset-filter').removeClass('hidden');
            return debounce();
        });

        $('#users-list button#reset-filter').click(function () {
            window.dataTableIsActive = false;

            $('#users-list #filter-by-role').select2('val', 'all');
            $('#users-list #filter-by-name').val('');
            $('#users-list #reset-filter').addClass('hidden');

            window.dataTableIsActive = true;
            getDataForDataTable();
        });
    };

    /**
     * Init select with Select2.
     */
    const initSelect = () => {
        $('#users-list #filters select').select2({width: '100%'});
        $('span.select2-container').css('margin-top', '4px');
    };

    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        initSelect();
        bindHandlerEvents();
        getDataForDataTable();
    };
};

$(document).ready(function () {
    window.usersListController = new UsersListController();
    window.usersListController.init();
});