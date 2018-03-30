(function ($) {
    $.fn.mobileMenu = function (options) {
        function isMobile() {
            return ($('body').width() < 740);
        }
        var defaults = {
            defaultText: 'Navigate to...',
            className: 'select-menu',
            subMenuClass: 'sub-menu',
            subMenuDash: '--',
			mainMenuSelector: '#site-main-menu'
        	}, 
			settings = $.extend(defaults, options),
            el = $(this),
			output = '',
			first = settings.defaultText;
        this.each(function () {
			output = '';
            el.find('ul').addClass(settings.subMenuClass);
            el.find('a,.separator').each(function () {
            	if($(this).text() == "") {
            		return;
            	}
                var $this = $(this),
                    optText = $this.text(),
                    optSub = $this.parents('.' + settings.subMenuClass),
                    len = optSub.length,
                    dash;
                if ($this.parents('ul').hasClass(settings.subMenuClass)) {
                    dash = Array(len + 1).join(settings.subMenuDash);
                    optText = dash + optText;
                }
                if ($this.is('span'))
					output += '<optgroup label="' + optText + '">';
                else
					output += '<option value="' + this.href + '"' + (this.href == window.location.href ? ' selected="selected"' : '') + '>&nbsp' + optText + '</option>'
				if (this.href == window.location.href)
					first = optText;
            });
			$('<div class="' + settings.className + '">'
				+ '<span class="icon"></span>'
				+ '<span class="holder">' + first + '</span>'
				+ '<select size="1" class="' + settings.className + '-list">' + output + '</select></div>').insertAfter(el);
            $('.' + settings.className + '-list').change(function () {
                var locations = $(this).val();
                if (locations !== '#') {
                    window.location.href = $(this).val();
                }
            });
        });

        function runPlugin() {
            if (isMobile()) {
                $('.'+settings.className).show();
                $(settings.mainMenuSelector).hide();
            } else {
                $('.'+settings.className).hide();
                $(settings.mainMenuSelector).show();
            }
        }
        runPlugin();
        $(window).resize(function () {
            runPlugin();
        });
        return this;
    };
})(jQuery);