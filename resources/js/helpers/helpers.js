export default class Helpers {

    static initIChecks($wrapper) {
        const $wrap = $wrapper || $('body');

        $wrap.find('[data-role="i-check"]').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    }
}