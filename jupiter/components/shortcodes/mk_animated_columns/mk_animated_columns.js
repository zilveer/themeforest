(function($) {
    'use strict';

    function mk_animated_cols() {
        function equalheight (container){
            var currentTallest = 0,
                 currentRowStart = 0,
                 rowDivs = new Array(),
                 $el,
                 topPosition = 0;
             $(container).each(function() {

               $el = $(this);
               $($el).height('auto');
               topPosition = $el.position().top;

               if (currentRowStart != topPosition) {
                 for (var currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                   rowDivs[currentDiv].height(currentTallest);
                 }
                 rowDivs.length = 0; // empty the array
                 currentRowStart = topPosition;
                 currentTallest = $el.height();
                 rowDivs.push($el);
               } else {
                 rowDivs.push($el);
                 currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
              }
               for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                 rowDivs[currentDiv].height(currentTallest);
               }

             });

            // console.log('recalc' + container + ' ' + currentTallest);

            return currentTallest;
        }


        function prepareCols(el) {
            var $this = el.parent().parent().find('.mk-animated-columns');

            var iconHeight  = equalheight('.vc_row .animated-column-icon, .animated-column-holder .mk-svg-icon'),
                titleHeight = equalheight('.vc_row .animated-column-title'),
                descHeight  = equalheight('.vc_row .animated-column-desc'),
                btnHeight   = $this.find('.animated-column-btn').innerHeight();

            if ($this.hasClass('full-style')) {
                $this.find('.animated-column-item').each(function() {
                    var $this = $(this),
                        contentHeight = (iconHeight + 30) + (titleHeight + 10) + (descHeight + 70) + 34;

                    $this.height(contentHeight * 1.5 + 50);

                    var $box_height = $this.outerHeight(true),
                        $icon_height = $this.find('.animated-column-icon, .animated-column-holder .mk-svg-icon').height();

                    $this.find('.animated-column-holder').css({
                        'paddingTop': $box_height / 2 - $icon_height
                    });


                    $this.animate({opacity:1}, 300);
                });
            } else {
                $this.find('.animated-column-item').each(function() {
                    var $this = $(this),
                        halfHeight = $this.height() / 2,
                        halfIconHeight = $this.find('.animated-column-icon, .animated-column-holder .mk-svg-icon').height()/2,
                        halfTitleHeight = $this.find('.animated-column-simple-title').height()/2;

                    $this.find('.animated-column-holder').css({
                        'paddingTop': halfHeight - halfIconHeight
                    });

                    $this.find('.animated-column-title').css({
                        'paddingTop': halfHeight - halfTitleHeight
                    });

                    $this.animate({
                        opacity:1
                    }, 300);

                });
            }
        }

        $('.mk-animated-columns').each(function() {
            var that = this;
            MK.core.loadDependencies([ MK.core.path.plugins + 'tweenmax.js' ], function() {
                var $this = $(that),
                    $parent = $this.parent().parent(),
                    $columns = $parent.find('.column_container'),
                    index = $columns.index($this.parent());
                    // really bad that we cannot read it before bootstrap - needs full shortcode refactor

                if($this.hasClass('full-style')) {
                    $this.find('.animated-column-item').hover(
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.5, {
                            top: '-15%',
                            ease: Back.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-desc"), 0.5, {
                            top: '50%',
                            ease: Expo.easeOut
                        }, 0.4);
                        TweenLite.to($(this).find(".animated-column-btn"), 0.3, {
                            top: '50%',
                            ease: Expo.easeOut
                        }, 0.6);
                    },
                    function() {

                        TweenLite.to($(this).find(".animated-column-holder"), 0.5, {
                            top: '0%',
                            ease: Back.easeOut, easeParams:[3]
                        });
                        TweenLite.to($(this).find(".animated-column-desc"), 0.5, {
                            top: '100%',
                            ease: Back.easeOut
                        }, 0.4);
                        TweenLite.to($(this).find(".animated-column-btn"), 0.5, {
                            top: '100%',
                            ease: Back.easeOut
                        }, 0.2);
                    });
                }

                if($this.hasClass('simple-style')) {
                    $this.find('.animated-column-item').hover(
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.7, {
                            top: '100%',
                            ease: Expo.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-title"), 0.7, {
                            top: '0%',
                            ease: Back.easeOut
                        }, 0.2);
                    },
                    function() {
                        TweenLite.to($(this).find(".animated-column-holder"), 0.7, {
                            top: '0%',
                            ease: Expo.easeOut
                        });
                        TweenLite.to($(this).find(".animated-column-title"), 0.7, {
                            top: '-100%',
                            ease: Back.easeOut
                        }, 0.2);
                    });
                }

                if($columns.length === index + 1) {
                    prepareCols($this);
                    $(window).on("resize", function() {
                            setTimeout(prepareCols($this), 1000);
                    });
                }

                MK.utils.eventManager.subscribe('iconsInsert', function() {
                    prepareCols($this);
                });
            });

        });
    }

    $(window).on('load', mk_animated_cols);

}(jQuery));