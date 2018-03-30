jQuery(document).ready(function ($) {
    var $postTypeSwitcher = $('#post-formats-select');
    $postTypeSwitcher.change(function () {
        $('input', $postTypeSwitcher).each(function () {
            $('#post-' + $(this).val() + '-meta').hide();
        });
        $('#post-' + $(this).find(':checked').val() + '-meta').fadeIn('fast');
    }).change();
});