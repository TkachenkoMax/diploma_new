const CalendarsManagementController = function () {
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