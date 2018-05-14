export default class Helpers {

    static initIChecks($wrapper) {
        const $wrap = $wrapper || $('body');

        $wrap.find('[data-role="i-check"]').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });
    }

    static initSelect2($wrapper) {
        const $wrap = $wrapper || $('body');
        let $selectParent = '';

        if ($wrapper == undefined) {
            $selectParent = $('body');
        } else if ($wrapper.is('form')) {
            $selectParent = $wrapper;
        } else {
            $selectParent = $wrap.find('form');
        }

        $wrap.find('[data-role="select2"]').select2({
            dropdownParent: $selectParent,
            width: '100%'
        });

        $wrap.find('[data-role="select2-search-disabled"]').select2({
            dropdownParent: $selectParent,
            width: '100%',
            minimumResultsForSearch: Infinity
        });

        $wrap.find('[data-role="select2-search-disabled-allowclear"]').select2({
            dropdownParent: $selectParent,
            width: '100%',
            minimumResultsForSearch: Infinity,
            placeholder: '...',
            allowClear: true
        });
    }
}