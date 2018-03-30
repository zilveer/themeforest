var whaterWheel = jQuery("#whaterwheel"),
    allSize = jQuery('.ww_block').size();
jQuery(document).ready(function ($) {
    setupWW();
    if (!whaterWheel.hasClass('yes')) {
        jQuery('.ww_link').click(function () {
            setSlide(parseInt(jQuery(this).attr('data-count')))
        });
        jQuery(document.documentElement).keyup(function (event) {
            if ((event.keyCode == 37) || (event.keyCode == 40)) {
                prev_ww();
                // Right Arrow or Up Arrow
            } else if ((event.keyCode == 39) || (event.keyCode == 38)) {
                next_ww();
            }
        });
        jQuery('#ww_finger').on("swipeleft", function () {
            next_ww();
        });
        jQuery('#ww_finger').on("swiperight", function () {
            prev_ww();
        });
    } else {
        flow_interval = setInterval('play_ww()', whaterWheel.attr('data-int'));
    }
});

function play_ww() {
    clearInterval(flow_interval);
    cur_slide = parseInt(jQuery('.current').attr('data-count'));
    cur_slide++;
    if (cur_slide > allSize) cur_slide = 1;
    if (cur_slide < 1) cur_slide = allSize;
    setSlide(cur_slide);
    flow_interval = setInterval('next_ww()', whaterWheel.attr('data-int'));
}

function next_ww() {
    cur_slide = parseInt(jQuery('.current').attr('data-count'));
    cur_slide++;
    if (cur_slide > allSize) cur_slide = 1;
    if (cur_slide < 1) cur_slide = allSize;
    setSlide(cur_slide);
}
function prev_ww() {
    cur_slide = parseInt(jQuery('.current').attr('data-count'));
    cur_slide--;
    if (cur_slide > allSize) cur_slide = 1;
    if (cur_slide < 1) cur_slide = allSize;
    setSlide(cur_slide);
}

jQuery(window).load(function () {
    setupWW();
    setTimeout("setupWW()", 500);
    setTimeout("setupWW()", 1000);
});
jQuery(window).resize(function () {
    setupWW();
    setTimeout("setupWW()", 500);
    setTimeout("setupWW()", 1000);
});

function setSlide(cur) {
    jQuery('.prev3').removeClass('prev3');
    jQuery('.prev2').removeClass('prev2');
    jQuery('.prev').removeClass('prev');
    jQuery('.current').removeClass('current');
    jQuery('.next').removeClass('next');
    jQuery('.next2').removeClass('next2');
    jQuery('.next3').removeClass('next3');
    jQuery('#ww_block' + cur).addClass('current');
    if (whaterWheel.hasClass('type5')) {
        if ((cur + 1) > allSize) {
            jQuery('#ww_block1').addClass('next');
            jQuery('#ww_block2').addClass('next2');
            jQuery('#ww_block3').addClass('next3');

        } else if ((cur + 1) == allSize) {
            jQuery('#ww_block' + allSize).addClass('next');
            jQuery('#ww_block1').addClass('next2');
            jQuery('#ww_block2').addClass('next3');
        } else if ((cur + 2) == allSize) {
            jQuery('#ww_block' + (allSize - 1)).addClass('next');
            jQuery('#ww_block' + allSize).addClass('next2');
            jQuery('#ww_block1').addClass('next3');
        } else {
            jQuery('#ww_block' + (cur + 1)).addClass('next');
            jQuery('#ww_block' + (cur + 2)).addClass('next2');
            jQuery('#ww_block' + (cur + 3)).addClass('next3');
        }
        if ((cur - 1) < 1) {
            jQuery('#ww_block' + allSize).addClass('prev');
            jQuery('#ww_block' + (allSize - 1)).addClass('prev2');
            jQuery('#ww_block' + (allSize - 2)).addClass('prev3');
        } else if ((cur - 1) == 1) {
            jQuery('#ww_block1').addClass('prev');
            jQuery('#ww_block' + allSize).addClass('prev2');
            jQuery('#ww_block' + (allSize - 1)).addClass('prev3');
        } else if ((cur - 2) == 1) {
            jQuery('#ww_block2').addClass('prev');
            jQuery('#ww_block1').addClass('prev2');
            jQuery('#ww_block' + allSize).addClass('prev3');
        } else {
            jQuery('#ww_block' + (cur - 1)).addClass('prev');
            jQuery('#ww_block' + (cur - 2)).addClass('prev2');
            jQuery('#ww_block' + (cur - 3)).addClass('prev3');
        }
    }

    jQuery('.prev3').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width() * 3);
    jQuery('.prev2').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width() * 2);
    jQuery('.prev').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width());
    jQuery('.current').css('margin-left', -1 * (jQuery('.current').width() / 2));
    jQuery('.next').css('margin-left', 1 * (jQuery('.current').width() / 2));
    jQuery('.next2').css('margin-left', 1 * (jQuery('.current').width() / 2) + jQuery('.current').width());
    jQuery('.next3').css('margin-left', 1 * (jQuery('.current').width() / 2) + jQuery('.current').width() * 2);
}
function setupWW() {
    whaterWheel.height(whaterWheel.find('img').height());
    if (jQuery('.current').size() < 1) {
        if (whaterWheel.find('.ww_block').size() > 4) {
            whaterWheel.addClass('type5');
            jQuery('#ww_block1').addClass('prev2');
            jQuery('#ww_block2').addClass('prev');
            jQuery('#ww_block3').addClass('current');
            jQuery('#ww_block4').addClass('next');
            jQuery('#ww_block5').addClass('next2');
            jQuery('#ww_block6').addClass('next3');
            jQuery('#ww_block' + allSize).addClass('prev3');
        } else if (whaterWheel.find('.ww_block').size() > 2) {
            whaterWheel.addClass('type3');
            jQuery('#ww_block1').addClass('prev');
            jQuery('#ww_block2').addClass('current');
            jQuery('#ww_block3').addClass('next');
        } else if (whaterWheel.find('.ww_block').size() == 2) {
            whaterWheel.addClass('type2');
            jQuery('#ww_block1').addClass('current');
            jQuery('#ww_block2').addClass('next');
        } else if (whaterWheel.find('.ww_block').size() == 1) {
            whaterWheel.addClass('type1');
            jQuery('#ww_block1').addClass('current');
        }
    }
    jQuery('.prev3').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width() * 3);
    jQuery('.prev2').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width() * 2);
    jQuery('.prev').css('margin-left', -1 * (jQuery('.current').width() / 2) - jQuery('.current').width());
    jQuery('.current').css('margin-left', -1 * (jQuery('.current').width() / 2));
    jQuery('.next').css('margin-left', 1 * (jQuery('.current').width() / 2));
    jQuery('.next2').css('margin-left', 1 * (jQuery('.current').width() / 2) + jQuery('.current').width());
    jQuery('.next3').css('margin-left', 1 * (jQuery('.current').width() / 2) + jQuery('.current').width() * 2);
}