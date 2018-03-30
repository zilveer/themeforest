(function($) {

    $(document)
        .ready(function() {

            // -------------------------------------------------------------------------------------------------------
            // First Word
            // -------------------------------------------------------------------------------------------------------

            $('h3').each(function() {
                if ($(this).contents().first().is('a')) {
                    $(this).contents().first().css('color', '#fff');
                } else {
                    var node = $(this).contents().filter(function() {
                        return this.nodeType == 3;
                    }).first();
                    var text = node.text();
                    var first = text.slice(0, text.indexOf(" "));
                    node[0].nodeValue = text.slice(first.length);
                    node.before('<span style="color:#fff">' + first + '</span>');
                }
            });

        });

})(window.jQuery);