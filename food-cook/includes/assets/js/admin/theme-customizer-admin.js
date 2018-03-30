jQuery(document).ready(function($) {
    $('#customizer-upload').change(function() {
        $('#customizer-submit').removeAttr('disabled');
    });
});