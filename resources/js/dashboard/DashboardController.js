import 'fullcalendar';

const DashboardController = function () {
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
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,listWeek,listDay'
            },
            editable: true,
            events: [

            ]
        });
    };

    /**
     * Init select with Select2.
     */
    const initSelect = () => {
        $('#dashboard #filters select').select2({width: '100%'});
    };

    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        onFilterChange();
        initSelect();
        bindHandlerEvents();
    }
};

$(document).ready(function () {
    window.dashboardController = new DashboardController();
    window.dashboardController.init();
});