import toastr from 'toastr';
import * as _ from "lodash";

const ContactsManagementController = function () {

    /**
     * Make headcount table as DataTable.
     *
     * @return void
     */
    const getDataForDataTable = () => {
        $('#users-search').removeClass('hidden').on('processing.dt', function (e, settings, processing) {
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
            order: [[1, 'desc']],
            ajax: {
                url: '/contacts/management/search',
                type: 'GET',
                data: function (data) {
                    data.name = $('#filter-by-name').val();
                },
                dataSrc: (json) => {
                    return json.data;
                }
            },
            columns: [
                {data: (data) => {
                        return `
                           <img alt='image' class='img-circle' style='width: 50px;' src='${data.profile_picture}'>
                        `;
                    }, name: 'Photo', class: 'users-photo', 'orderable': false},
                {data: 'fullname', name: 'Fullname', class: 'users-fullname align-middle'},
                {data: 'formatted_birthday', name: 'Date of Birth', class: 'users-birthday align-middle'},
                {data: 'work_information', name: 'Date of Birth', class: 'users-work align-middle'},
                {data: (data) => {
                        return `
                           <div>
                                <i class='fas fa-plus-circle fa-lg color-green-hover cursor-pointer send-request' data-user-id=${data.id}></i>
                           </div>
                        `;
                    }, name: 'Actions', class: 'users-actions align-middle', 'orderable': false},
            ],
            drawCallback: function() {
                const pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
            }
        });
    };

    /**
     * Delete contact request.
     */
    this.declineRequest = function () {
        const data = {};
        data.user_id = $(this).data('user-id');
        window.swal({
            title: 'Are you sure?',
            text: 'This contact request will be declined!',
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!'
        }, function () {
            $.ajax({
                url: `/contacts/management/decline`,
                type: 'POST',
                data: data,
                success: response => {
                    $(`tr[data-user-id='${data.user_id}']`).css('display', 'none');
                    toastr.success('Contact request successfully deleted!');
                },
                error: data => {
                    toastr.error('Something went wrong!', data.responseJSON.error);
                }
            });
        });
    };

    /**
     * Accept contact request.
     */
    this.acceptRequest = function () {
        const data = {};
        data.user_id = $(this).data('user-id');

        $.ajax({
            url: `/contacts/management/accept`,
            type: 'POST',
            data: data,
            success: response => {
                $(`tr[data-user-id='${data.user_id}']`).css('display', 'none');
                toastr.success('Contact request successfully accepted!');
            },
            error: data => {
                toastr.error('Something went wrong!', data.responseJSON.error);
            }
        });
    };

    /**
     * Send contact request.
     */
    this.sendRequest = function () {
        const data = {};
        data.user_id = $(this).data('user-id');

        $.ajax({
            url: `/contacts/management/send`,
            type: 'POST',
            data: data,
            success: response => {
                getDataForDataTable();
                toastr.success('Contact request successfully sent!');
            },
            error: data => {
                toastr.error('Something went wrong!', data.responseJSON.error);
            }
        });
    };

    /**
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {
        $(document).on('click', '#users-management .accept-request', this.acceptRequest);
        $(document).on('click', '#users-management .decline-request', this.declineRequest);
        $(document).on('click', '#users-management .send-request', this.sendRequest);

        const debounce = _.debounce(getDataForDataTable, 2000, false);

        $('#users-management #filter-by-name').keyup(function() {
            return debounce();
        });
    };

    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        bindHandlerEvents();
    };
};

$(document).ready(function () {
    window.contactsManagementController = new ContactsManagementController();
    window.contactsManagementController.init();
});