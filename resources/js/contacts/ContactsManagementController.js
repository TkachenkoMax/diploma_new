import toastr from 'toastr';

const ContactsManagementController = function () {

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
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {
        $(document).on('click', '#users-management .accept-request', this.acceptRequest);
        $(document).on('click', '#users-management .decline-request', this.declineRequest);
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