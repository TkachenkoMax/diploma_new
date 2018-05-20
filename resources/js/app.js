import helpers from './helpers/helpers';

$(document).ready(function () {
    window.dataTableIsActive = true;

    //Datatables date validation format
    $.fn.dataTable.moment('MMM DD, YYYY');

    //Correctly working search in select2 in bootstrap modals
    $.fn.modal.Constructor.prototype.enforceFocus = function() {};

    //Catch the status code 401 and redirect to login page
    $.fn.dataTable.ext.errMode = function (settings, tn, msg) {
        if (settings && settings.jqXHR && settings.jqXHR.status == 401) {
            window.location.href = '/login';

            return;
        }

        alert(msg);
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        error: function(xhr) {
            if (xhr.status === 401)
                window.location.href = '/login';
        }
    });

    helpers.initIChecks();
});