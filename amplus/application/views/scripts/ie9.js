jQuery(document).ready(function($) {
    $(document).on('loadedNextItems', function() {
        $('a.fancybox, a.lightbox').hover(
            function() {
                $(this).find('img').animate({opacity: .4}, 300);
            },
            function() {
                $(this).find('img').animate({opacity: 1}, 300);
            });
    });
    $.event.trigger({type: 'loadedNextItems'});
});