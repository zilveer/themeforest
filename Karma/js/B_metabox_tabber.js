jQuery(function () {
    var tabbed_metaboxes = jQuery('div[id^="b_tabbed_meta_box_"]'),
        prev_elem,
        container,
        handlers;

    if (!tabbed_metaboxes.length) {
        return;
    }

    prev_elem = tabbed_metaboxes.eq(0);
    container = jQuery('<div id="b_tabbed_meta_boxes"></div>');
    handlers = jQuery('<ul>');

    tabbed_metaboxes.each(function () {
        var li = jQuery('<li/>'),
            a = jQuery('<a/>');

        a.text(jQuery(this).find('.cmb_metabox_title').eq(0).text());
        a.attr('href', '#' + jQuery(this).attr('id'));
        handlers.append(li.append(a));
    });

    container.append(handlers);

    container.insertBefore(prev_elem);

    container.append(tabbed_metaboxes);
    container.tabs();
});
