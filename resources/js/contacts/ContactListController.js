import toastr from 'toastr';

const ContactListController = function () {

    /**
     * Delete contact.
     */
    this.deleteContact = function () {
        const data = {};
        data.user_id = $(this).data('user-id');
        window.swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this contact without new contact request!',
            type: 'warning',
            showCancelButton: true,
            allowOutsideClick: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!'
        }, function () {
            $.ajax({
                url: `/contacts/delete-contact`,
                type: 'POST',
                data: data,
                success: response => {
                    $(`.contact-container[data-user-id='${data.user_id}']`).css('display', 'none');
                    toastr.success('Contact successfully deleted!');
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
        $(document).on('click', '#user-contacts .contact-delete', this.deleteContact);
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
    window.contactListController = new ContactListController();
    window.contactListController.init();
});