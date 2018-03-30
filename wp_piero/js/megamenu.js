/* Mega menu */
(function ($) {
    var menuNav = function ($el, options) {
        this.$menu = $($el);
        var defaults = {
            mobMenuClass: 'mob-nav-menu',
            mobPrecedingElSel: '#cshero-main-menu-mobile-bk',
            mobBtnSel: '.btn-navbar',
            mobArrowClass: 'mob-nav-arrow',
            megaMenuClass: 'mega-menu-item',
            megaMenuMaxWidth: 1000,
            megaMenuColumnWidth: 232
        };
        this.o = $.extend(defaults, options);
    };

    var mn = menuNav.prototype;
    mn.getBrowser = function () {
        var browser = {},
            ua,
            match,
            matched;

        if (mn.browser) {
            return mn.browser;
        }

        ua = navigator.userAgent.toLowerCase();

        match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||
            /(webkit)[ \/]([\w.]+)/.exec(ua) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||
            /(msie) ([\w.]+)/.exec(ua) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];

        matched = {
            browser: match[1] || "",
            version: match[2] || "0"
        };

        if (matched.browser) {
            browser[matched.browser] = true;
            browser.version = matched.version;
        }

        // Chrome is Webkit, but Webkit is also Safari.
        if (browser.chrome) {
            browser.webkit = true;
        } else if (browser.webkit) {
            browser.safari = true;
        }

        mn.browser = browser;

        return browser;
    }
    mn.init = function () {
        var self = this,
            browser = mn.getBrowser();

        self.$win = $(window);
		self.win_width = self.$win.width();
        self.$body = $('body');
        self.$mainUl = self.$menu.find('ul:first');
        self.isIE9 = browser.msie && parseInt(browser.version, 10) == 9;

        if (self.$menu.is(':visible')) {
            //init the main navigation functionality
            self.initMain();
        } else {
            $(window).on('resize.pexetodropdown', function () {
                if (self.$menu.is(':visible')) {
                    self.initMain();
                    $(window).off('.pexetodropdown');
                }
            });
        }
    };

    /**
     * Inits the main navigation functionality with the drop-down menus on
     * hover.
     */
    mn.initMain = function () {
        var self = this,
            menuPosition = 'left';

        if (self.$menu.hasClass('center')) {
            menuPosition = 'center';
        } else if (self.$menu.hasClass('right')||self.$menu.hasClass('pull-right')) {
            menuPosition = 'right';
        }
        this.menuPosition = menuPosition;

        //bind the mouseover events
        self.$menu.find('ul li').has('ul').not('ul li.mega-menu-item li').each(function () {

            $(this).hover(function () {
                self.doOnMenuMouseover($(this));
            }, function () {
                self.doOnMenuMouseout($(this));
            });
        });

        self.$menu.find('a[href="#"]').on('click', function (e) {
            e.preventDefault();
        });

        this.initMegaMenu();
    };

    mn.initMegaMenu = function () {
        this.$megaUls = this.$menu.find('ul li.' + this.o.megaMenuClass).has('ul').children('ul');

        if (this.$megaUls.length) {
            if (this.$menu.parents('#cshero-header').length) {
                this.$parentWrapper = this.$menu.parents('#cshero-header');
            } else if (this.$menu.parents('.sticky-wrapper').length) {
                this.$parentWrapper = this.$menu.parents('.sticky-wrapper');
            } else {
                this.$parentWrapper = this.$menu.parents('.container');
            }
            this.$win.on('pexetoresize', $.proxy(this.setMegaMenuWidth, this));

            this.setMegaMenuWidth();
        }

    };

    mn.setMegaMenuMaxWidth = function () {
        var maxWidth = 0;
        switch (this.menuPosition) {
        case 'right':
            if (!this.lastMenuLi) {
                this.lastMenuLi = this.$menu.find('ul:first>li:last');
            }
            if (this.isIE9) {
                this.lastMenuLi.offset();
            }
            maxWidth = this.lastMenuLi.offset().left + this.lastMenuLi.width() - this.$parentWrapper.offset().left;
            break;
        case 'left':
            maxWidth = this.$parentWrapper.width();
            break;
        case 'center':
            maxWidth = this.$parentWrapper.width();
            break;
        }

        this.megaMenuMaxWidth = Math.min(this.o.megaMenuMaxWidth, maxWidth);
    };

    mn.setMegaMenuWidth = function () {
        var self = this;

        this.setMegaMenuMaxWidth();
        this.mainUlWidth = this.$mainUl.width();

        this.$megaUls.each(function () {
            $(this).addClass('colimdi');
            var $ul = $(this),
                liNum = $ul.children('li').length,
                width,
                colsToFit;

            if (liNum > 0) {
                if (self.o.megaMenuMaxWidth < liNum * self.o.megaMenuColumnWidth) {
                    colsToFit = Math.floor(self.megaMenuMaxWidth / self.o.megaMenuColumnWidth) || 1;
                    width = colsToFit * self.o.megaMenuColumnWidth;
                } else {
                    width = liNum * self.o.megaMenuColumnWidth;
                    colsToFit = liNum;
                }
                if (this.lastMegaClass) {
                    $ul.removeClass(this.lastMegaClass);
                }
                this.lastMegaClass = 'mega-columns-' + colsToFit;

                $ul.width(width)
                    .addClass(this.lastMegaClass);

                self.setMegaMenuPosition($ul, width);

            }
        });
    }

    mn.setMegaMenuPosition = function ($ul, ulWidth) {
        var left,
            right,
            $li,
            centerPosition,
            shortestEndDistance;

		$li = $ul.parents('li:first');
		var $li_left = $li.offset().left  + $li.outerWidth();
		var $li_right = (jQuery(window).width() - $li.offset().left);
        if (ulWidth >= this.mainUlWidth) {
            //the mega drop-down is bigger than the parent menu
            switch (this.menuPosition) {
            case 'right':
                //align right
				if($li_left < ulWidth){
					right = ulWidth - $li_left - 20;
				}else{
					right = 0;
				}
                $ul.css({
                    left: 'auto',
                    right: -right
                });
                break;
            case 'left':
                //align left
				if($li_right < ulWidth){
					left = ulWidth - $li_right - 20;
				}else{
					left = 0;
				}
                $ul.css({
                    left: -left
                });
                break;
            case 'center':
                left = -(ulWidth - this.mainUlWidth) / 2;
                $ul.css({
                    left: left
                });
                break;
            }
        } else {
            centerPosition = $li.offset().left + $li.width() / 2;
			if (ulWidth / 2 <= centerPosition) {
                //center
                left = ulWidth / 2;
                $ul.css({
                    left: -left
                });
            } else {
                if (centerPosition <= this.mainUlWidth - centerPosition) {
                    //align left
                    $ul.css({
                        left: 0
                    });
                } else {
                    //align right
                    $ul.css({
                        left: 'auto',
                        right: 0
                    });
                }
            }
        }

    };


    /**
     * Displays the drop-down menu on mouse over.
     * @param  {object} $li the hovered element - jQuery object
     */
    mn.doOnMenuMouseover = function ($li) {
        $(window).trigger('scroll');
        var self = this,
            $ul = $li.find('ul:first'),
            parentUlNum = $ul.parents('ul').length,
            elWidth = $li.width(),
            ulWidth = $ul.width(),
            winWidth = self.$win.width(),
            elOffset = $li.offset().left;


        $li.addClass('hovered');

        if (self.menuPosition == 'right' && !$li.hasClass(self.o.megaMenuClass)) {
            if (parentUlNum > 1 && (elWidth + ulWidth + elOffset > winWidth)) {
                //if the drop down ul goes beyound the screen, move it on the left side
                $ul.css({
                    left: -elWidth
                });
            } else if (parentUlNum === 1) {
                if (ulWidth + elOffset > winWidth) {
                    $ul.css({
                        left: (winWidth - 3 - (ulWidth + elOffset))
                    });
                } else {
                    $ul.css({
                        left: 0
                    });
                }
            }
        }

        /*  display the drop-down */
        $ul.stop().fadeIn(300);
    };

    /**
     * Hides the drop-down on mouse out.
     * @param  {object} $li the hovered li element - jQuery object
     */
    mn.doOnMenuMouseout = function ($li) {
        var $ul = $li.find('ul:first');
        $li.removeClass('hovered');
        $ul.stop().fadeOut(0);
    };
    $.fn.menuNav = function ($opt) {
        return this.each(function () {
            new menuNav(this).init();
        });
    };
    $(document).ready(function(){
        //setTimeout(function(){$('.cs_mega_menu').menuNav();},1000);
    });
})(jQuery);