/**
 * hoverIntent r5 // 2007.03.27 // jQuery 1.1.2+
 * <http://cherne.net/brian/resources/jquery.hoverIntent.html>
 *
 * @param  f  onMouseOver function || An object with configuration options
 * @param  g  onMouseOut function  || Nothing (use configuration options object)
 * @author    Brian Cherne <brian@cherne.net>
 */
(function($) {
    $.fn.hoverIntent = function(f, g) {
        var cfg = {
            sensitivity: 7,
            interval: 100,
            timeout: 0
        };
        cfg = $.extend(cfg, g ? {
            over: f,
            out: g
        } : f);
        var cX, cY, pX, pY;
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };
        var compare = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            if ((Math.abs(pX - cX) + Math.abs(pY - cY)) < cfg.sensitivity) {
                $(ob).unbind("mousemove", track);
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob, [ev]);
            } else {
                pX = cX;
                pY = cY;
                ob.hoverIntent_t = setTimeout(function() {
                    compare(ev, ob);
                }, cfg.interval);
            }
        };
        var delay = function(ev, ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob, [ev]);
        };
        var handleHover = function(e) {
            var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
            while (p && p != this) {
                try {
                    p = p.parentNode;
                } catch (e) {
                    p = this;
                }
            }
            if (p == this) {
                return false;
            }
            var ev = jQuery.extend({}, e);
            var ob = this;
            if (ob.hoverIntent_t) {
                ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            }
            if (e.type == "mouseover") {
                pX = ev.pageX;
                pY = ev.pageY;
                $(ob).bind("mousemove", track);
                if (ob.hoverIntent_s != 1) {
                    ob.hoverIntent_t = setTimeout(function() {
                        compare(ev, ob);
                    }, cfg.interval);
                }
            } else {
                $(ob).unbind("mousemove", track);
                if (ob.hoverIntent_s == 1) {
                    ob.hoverIntent_t = setTimeout(function() {
                        delay(ev, ob);
                    }, cfg.timeout);
                }
            }
        };
        return this.mouseover(handleHover).mouseout(handleHover);
    };
})(jQuery);

/*
 * DC Mega Menu - jQuery mega menu
 * Copyright (c) 2011 Design Chemical
 * http://www.designchemical.com/blog/
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 */
(function($) {
    $.fn.dcMegaMenu = function(options) {
        var defaults = {
            classParent: 'dc-mega',
            classContainer: 'sub-container',
            classSubParent: 'mega-hdr',
            classSubLink: 'mega-hdr',
            classWidget: 'dc-extra',
            rowItems: 3,
            speed: 'medium',
            effect: 'fade',
            event: 'hover',
            fullWidth: false,
            onLoad: function() {},
            beforeOpen: function() {},
            beforeClose: function() {}
        };
        var options = $.extend(defaults, options);
        var $dcMegaMenuObj = this;
        return $dcMegaMenuObj.each(function(options) {
            var clSubParent = defaults.classSubParent;
            var clSubLink = defaults.classSubLink;
            var clParent = defaults.classParent;
            var clContainer = defaults.classContainer;
            var clWidget = defaults.classWidget;
            megaSetup();

            function megaOver() {
                var subNav = $('.sub', this);
                $(this).addClass('mega-hover');
                if (defaults.effect == 'fade') {
                    $(subNav).fadeIn(defaults.speed)
                }
                if (defaults.effect == 'slide') {
                    $(subNav).show(defaults.speed)
                }
                defaults.beforeOpen.call(this)
            }

            function megaAction(obj) {
                var subNav = $('.sub', obj);
                $(obj).addClass('mega-hover');
                if (defaults.effect == 'fade') {
                    $(subNav).fadeIn(defaults.speed)
                }
                if (defaults.effect == 'slide') {
                    $(subNav).show(defaults.speed)
                }
                defaults.beforeOpen.call(this)
            }

            function megaOut() {
                var subNav = $('.sub', this);
                $(this).removeClass('mega-hover');
                $(subNav).slideUp('medium');
                defaults.beforeClose.call(this)
            }

            function megaActionClose(obj) {
                var subNav = $('.sub', obj);
                $(obj).removeClass('mega-hover');
                $(subNav).slideUp('medium');
                defaults.beforeClose.call(this)
            }

            function megaReset() {
                $('li', $dcMegaMenuObj).removeClass('mega-hover');
                $('.sub', $dcMegaMenuObj).hide()
            }

            function megaSetup() {
                $arrow = '<span class="dc-mega-icon"></span>';
                var clParentLi = clParent + '-li';
                var menuWidth = $dcMegaMenuObj.outerWidth();
                $('> li', $dcMegaMenuObj).each(function() {
                    var $mainSub = $('> ul', this);
                    var $primaryLink = $('> a', this);
                    if ($mainSub.length) {
                        $primaryLink.addClass(clParent).append($arrow);
                        $mainSub.addClass('sub').wrap('<div class="' + clContainer + '" />');
                        var pos = $(this).position();
                        pl = pos.left;
                        if ($('ul', $mainSub).length) {
                            $(this).addClass(clParentLi);
                            $('.' + clContainer, this).addClass('mega');
                            $('> li', $mainSub).each(function() {
                                if (!$(this).hasClass(clWidget)) {
                                    $(this).addClass('mega-unit');
                                    if ($('> ul', this).length) {
                                        $(this).addClass(clSubParent);
                                        $('> a', this).addClass(clSubParent + '-a')
                                    } else {
                                        $(this).addClass(clSubLink);
                                        $('> a', this).addClass(clSubLink + '-a')
                                    }
                                }
                            });
                            var hdrs = $('.mega-unit', this);
                            rowSize = parseInt(defaults.rowItems);
                            for (var i = 0; i < hdrs.length; i += rowSize) {
                                hdrs.slice(i, i + rowSize).wrapAll('<div class="row" />')
                            }
                            $mainSub.show();
                            var pw = $(this).width();
                            var pr = pl + pw;
                            var mr = menuWidth - pr;
                            var subw = $mainSub.outerWidth();
                            var totw = $mainSub.parent('.' + clContainer).outerWidth();
                            var cpad = totw - subw;
                            if (defaults.fullWidth == true) {
                                var fw = menuWidth - cpad;
                                $mainSub.parent('.' + clContainer).css({
                                    width: fw + 'px'
                                });
                                $dcMegaMenuObj.addClass('full-width')
                            }
                            var iw = $('.mega-unit', $mainSub).outerWidth(true);
                            var rowItems = $('.row:eq(0) .mega-unit', $mainSub).length;
                            var inneriw = iw * rowItems;
                            var totiw = inneriw + cpad;
                            $('.row', this).each(function() {
                                $('.mega-unit:last', this).addClass('last');
                                var maxValue = undefined;
                                $('.mega-unit > a', this).each(function() {
                                    var val = parseInt($(this).height());
                                    if (maxValue === undefined || maxValue < val) {
                                        maxValue = val
                                    }
                                });
                                $('.mega-unit > a', this).css('height', maxValue + 'px');
                                $(this).css('width', inneriw + 'px')
                            });
                            var ml = mr < ml ? ml + ml - mr : (totiw - pw) / 2;
                            var subLeft = pl - ml;
                            var params = {
                                left: pl + 'px',
                                marginLeft: -ml + 'px'
                            };
                            if (subLeft < 0 || defaults.fullWidth == true) {
                                params = {
                                    left: 0
                                }
                            } else if (mr < ml) {
                                params = {
                                    right: 0
                                }
                            }
                            $('.' + clContainer, this).css(params);
                            $('.row', $mainSub).each(function() {
                                var rh = $(this).height();
                                $('.mega-unit', this).css({
                                    height: rh + 'px'
                                });
                                $(this).parent('.row').css({
                                    height: rh + 'px'
                                })
                            });
                            $mainSub.hide()
                        } else {
                            $('.' + clContainer, this).addClass('non-mega').css('left', pl + 'px')
                        }
                    }
                });
                var menuHeight = $('> li > a', $dcMegaMenuObj).outerHeight(true);
                $('.' + clContainer, $dcMegaMenuObj).css({
                    top: menuHeight + 'px'
                }).css('z-index', '1000');
                if (defaults.event == 'hover') {
                    var config = {
                        sensitivity: 2,
                        interval: 100,
                        over: megaOver,
                        timeout: 400,
                        out: megaOut
                    };
                    $('li', $dcMegaMenuObj).hoverIntent(config)
                }
                if (defaults.event == 'click') {
                    $('body').mouseup(function(e) {
                        if (!$(e.target).parents('.mega-hover').length) {
                            megaReset()
                        }
                    });
                    $('> li > a.' + clParent, $dcMegaMenuObj).click(function(e) {
                        var $parentLi = $(this).parent();
                        if ($parentLi.hasClass('mega-hover')) {
                            megaActionClose($parentLi)
                        } else {
                            megaAction($parentLi)
                        }
                        e.preventDefault()
                    })
                }
                defaults.onLoad.call(this)
            }
        })
    }
})(jQuery);