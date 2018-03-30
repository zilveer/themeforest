/**
 * Created by cb-theme on 08.11.13.
 */
jQuery(document).ready(function($) {
    jQuery(".color" ).wpColorPicker();
    $("[data-slider]")
        .each(function () {
            var input = $(this);
            $("<span>")
                .addClass("output")
                .insertAfter($(this));
        })
        .bind("slider:ready slider:changed", function (event, data) {
            $(this)
                .nextAll(".output:first")
                .html(data.value.toFixed(0));

        });
    jQuery('.output').each(function(){var t=jQuery(this).parent().find('input').val(); jQuery(this).html(t); });
    jQuery('.extend_button').click(function() {
        jQuery(this).next('.extend').slideToggle();
        if (jQuery(this).find('i').hasClass('fa-angle-down'))jQuery(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
        else
            jQuery(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
    });
});

