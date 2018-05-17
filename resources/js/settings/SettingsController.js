const SettingsController = function () {
    /**
     * Set buttons handlers.
     */
    const bindHandlerEvents = () => {

    };

    /**
     * Init select with Select2.
     */
    const initSelect = () => {
        $('#users-settings select').select2({width: '100%'});
    };

    /**
     * Initialize function.
     *
     * @return void
     */
    this.init = () => {
        initSelect();
        bindHandlerEvents();
    };
};

$(document).ready(function () {
    window.settingsController = new SettingsController();
    window.settingsController.init();
});