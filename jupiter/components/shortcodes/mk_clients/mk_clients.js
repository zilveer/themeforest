(function($) {
    "use strict";

    $('.mk-clients.column-style').each(function() {
        var $group = $(this),
            $listItems = $group.find('li'),
            listItemsCount = $listItems.length,
            listStyle = $group.find('ul').attr('style') || '',
            fullRowColumnsCount = $group.find('ul:first-of-type li').length;

        function recreateGrid() { 
            var i;

            $listItems.unwrap();

            if (window.matchMedia('(max-width: 550px)').matches && fullRowColumnsCount >= 1) {
                for (i = 0; i < listItemsCount; i += 1) {
                    $listItems.slice(i, i + 1)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else if (window.matchMedia('(max-width: 767px)').matches && fullRowColumnsCount >= 2) {
                for (i = 0; i < listItemsCount; i += 2) {
                    $listItems.slice(i, i + 2)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else if (window.matchMedia('(max-width: 960px)').matches && fullRowColumnsCount >= 3) {
                for (i = 0; i < listItemsCount; i += 3) {
                    $listItems.slice(i, i + 3)
                        .wrapAll('<ul class="mk-clients-fixed-list" style="' + listStyle + '"></ul>');
                }
            } else {
                for (i = 0; i < listItemsCount; i += fullRowColumnsCount) {
                    $listItems.slice(i, i + fullRowColumnsCount)
                        .wrapAll('<ul style="' + listStyle + '"></ul>');
                }
            }
        }
        
        recreateGrid();
        $(window).on('resize', recreateGrid);

    });

}(jQuery));