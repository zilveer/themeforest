jQuery(document).ready(function($) {
    $(document).on('click', '.post_type_inline', function() {
        $clicked = $(this);
        $('.post_type_inline').removeClass('sel');
        $clicked.addClass('sel');
        $('#cb5_post_type').val($clicked.attr('id'));
        $('.post_type_options').slideUp();
        if ($clicked.attr('id')!='default')
        $('#'+$clicked.attr('id')+'_options').slideDown();
        if ($clicked.attr('id')=='portfolio_project')
        $('#portfolio_options').slideDown();
    });
    $(document).on('click', '.toggle-options', function() {
        $(this).parent().parent().parent().next('.innen').slideToggle("slow", function() {
            if ($(this).is(":visible")) {
                $(document).animate({
                    scrollTop: $(this).offset().top
                }, "slow")
            }
        });
        return false;
    });
    $(document).on('change', '#h_header_type', function() {
       // $('.header_default').slideDown();
        $('.header_type').slideUp();
        $('.'+$(this).val()).slideDown();
        $('html, body').animate({scrollTop:$('#h_header_type').offset().top-50},500);
    });

    $(document).on('change', '#h_home_slider', function() {

        $('.slider_type ').slideUp();
        $('.'+$(this).val()).slideDown();

    });



    $(document).on('click', '.fl img', function() {
        var position = $(this).attr('data-position');
        if(position=='none') $('#sidebar_name').slideUp(); else $('#sidebar_name').slideDown();
        $('#sidebar_v').val(position);
        $('.fl img').removeClass('sel');
        $(this).addClass('sel');
        return false;
    });
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
                .html(data.value.toFixed(2));

        });
    jQuery('.output').each(function(){var t=jQuery(this).parent().find('input').val(); jQuery(this).html(t); });

});
