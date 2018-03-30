//accordion on single product
(function($) {
    
    var allPanels = $('.pix-accordion > li > .panel__entry-content');

    $('.pix-accordion > li:first-child').addClass('panel-active');

    $('.pix-accordion > li > a').click(function() {
        if($(this).parent().hasClass('panel-active')) return false;

        $(this).parent().addClass('panel-active').siblings().removeClass('panel-active');
        allPanels.slideUp();
        $(this).siblings('.panel__entry-content').slideDown();
        return false;
    });

})(jQuery);