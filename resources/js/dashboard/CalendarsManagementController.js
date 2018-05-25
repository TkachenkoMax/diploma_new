import toastr from 'toastr';

const CalendarsManagementController = function () {

    /**
     * Shows edit form.
     */
    this.showEditCalendar = () => {
        const modalForm = '#create_calendar';
        const calendarId = $(this).data('id');

        $(modalForm + ' .update-calendar-body').html(
            `
                <div class='sk-spinner sk-spinner-double-bounce'>
                    <div class='sk-double-bounce1'></div>
                <div class='sk-double-bounce2'>
            `);

        $.ajax({
            url: `/calendars/${calendarId}/edit`,
            type: 'GET',
            success: (data) => {
                $(modalForm + ' .update-calendar-body').html(data);
                $(modalForm).modal('show');
            },
            error: (data) => {
                $(modalForm).modal('hide');
                toastr.error('Something going wrong!', data.responseJSON.error);
            }
        });
    };

    /**
     * Send crate new calendar request.
     */
    this.createCalendar = () => {
        const $form = $('#create-calendar');
        const data = {};

        data.name = $('#name').val();
        data.description = $('#description').val();
        data.is_public = $('#is_public').is(':checked') ? '1' : '0';
        data.is_editable = $('#is_editable-critical').is(':checked') ? '1' : '0';
        data.assigned_users = $('#assigned_users').val();

        $.ajax({
            url : $form.attr('action'),
            type: 'POST',
            data: data,
            success: () => {
                $('#create_calendar').modal('hide');
                toastr.success('Calendar has been created successfully', 'Done!');
            },
            error: () => {
                toastr.error('Something going wrong!', 'Error')
            }
        });
    };

    /**
     * Bind on filter change.
     */
    const onFilterChange = () => {
        //Filters events
    };

    /**
     * Binds handlers.
     */
    const bindHandlerEvents = () => {
        $(document).on('click', '#edit_calendar', this.showEditCalendar);

        $(document).on('click', '#create_new_calendar', (e) => {
            e.preventDefault();
            $('#create_calendar select').select2({width: '100%'});
            $('#create_calendar').modal('show');
        });

        $(document).on('submit', '#create-calendar',  (e) => {
            e.preventDefault();
            this.createCalendar();
        });
    };


    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        onFilterChange();
        bindHandlerEvents();
    }
};

$(document).ready(function () {
    window.calendarsManagementController = new CalendarsManagementController();
    window.calendarsManagementController.init();
});