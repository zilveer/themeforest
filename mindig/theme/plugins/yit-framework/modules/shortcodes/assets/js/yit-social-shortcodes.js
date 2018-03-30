jQuery(document).ready(function ($) {
    var hoverEffect = ( function (e) {
        e.stopImmediatePropagation();
        var link_id = '#' + $(this).attr('id');
        var color = ( e.type == 'mouseenter' ) ? $(link_id).data('hover') : $( link_id ).data('normal');
        var styles = {
            borderColor: color,
            color      : color
        };

        $(link_id + ' span.icon-circle').add(link_id + ' i.fa').css(styles);
    } );

    $('.link_socials').hover(hoverEffect, hoverEffect);
});
