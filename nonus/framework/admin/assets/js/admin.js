jQuery(document).ready(function ($) {

    jQuery('select.ct-toggler').change(function () {
        var $s = jQuery(this).find(":selected");
        var g = $s.attr('data-group');
        var tar = $s.attr('data-toggle');
        if (g) {
            jQuery(g).hide();
        }

        if (tar && tar.length) {
            if (tar.substring(0, 1) != '#' && tar.substring(0, 1) != '.') {
                tar = '.'+tar;
            }
            jQuery(tar).fadeIn();
        }

    }).change();


    $(document).on('click', '#visual_composer_content .controls_row a.child_clone', function () {
        var $a = $(this).closest('.wpb_content_holder').find('.wpb_element_wrapper .wpb_content_element:last a.column_clone');
        $a.click();
        return false;
    });
});