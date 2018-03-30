/* General demo helpers */
jQuery(function() {
    // Smallipop creation calls
    jQuery('.smallipop').smallipop();

    jQuery('.smallipopOrange').smallipop({
        theme: 'orange'
    });
    jQuery('.smallipopBlack').smallipop({
        theme: 'black'
    });
    jQuery('.smallipopHideBlack').smallipop({
        theme: 'black',
        hideTrigger: true
    });

    jQuery('.smallipopBlue').smallipop({
        theme: 'blue',
        invertAnimation: true
    });

    jQuery('.smallipopBlueFatShadow').smallipop({
        theme: 'blue fatShadow',
        invertAnimation: true
    });

    jQuery('.smallipopHideBlue').smallipop({
        theme: 'blue',
        hideTrigger: true,
        popupYOffset: 40,
        invertAnimation: true
    });

    jQuery('.smallipopWhite').smallipop({
        theme: 'white'
    });

    jQuery('.smallipopHide').smallipop({
        hideTrigger: true,
        theme: 'white',
        popupYOffset: 5
    });

    jQuery('.smallipopHideTrans').smallipop({
        hideTrigger: true,
        theme: 'white whiteTransparent',
        popupYOffset: 20
    });

    jQuery('.smallipopStatic').smallipop({
        theme: 'black',
        popupDistance: 0,
        popupYOffset: -14,
        popupAnimationSpeed: 100
    });

    jQuery('.smallipopBottom').smallipop({
        theme: 'black',
        preferredPosition: 'bottom'
    });

    jQuery('.smallipopHorizontal').smallipop({
        preferredPosition: 'right',
        theme: 'black',
        popupOffset: 10,
        invertAnimation: true
    });

    jQuery('.smallipopFormElement').smallipop({
        preferredPosition: 'right',
        theme: 'black',
        popupOffset: 0,
        triggerOnClick: true
    });

    jQuery('#tipcustomhint').smallipop({}, "I'm the real hint!");

    jQuery(document).delegate('#tipkiller', 'click', function(e) {
        e.preventDefault();
        jQuery('#ajaxContainer').html('<div>Some new content</div>');
    });

    jQuery(document).delegate('#tipkiller2', 'click', function(e) {
        e.preventDefault();
        jQuery('#ajaxContainer2').html("<div>Some new content</div>");
    });

    jQuery('#tipChangeContent').smallipop({
        onAfterShow: function(trigger) {
            jQuery.smallipop.setContent(trigger, "I'm the new content and I have replaced the old boring content!");
        },
        onBeforeHide: function(trigger) {
            jQuery.smallipop.setContent(trigger, "Bye bye");
        }
    });

    jQuery('#tipCSSAnimated').smallipop({
        cssAnimations: {
            enabled: true,
            show: 'animated bounceInDown',
            hide: 'animated hinge'
        }
    });

    jQuery('#tipCSSAnimated2').smallipop({
        cssAnimations: {
            enabled: true,
            show: 'animated flipInX',
            hide: 'animated flipOutX'
        }
    });

    jQuery('#tipCSSAnimated3').smallipop({
        cssAnimations: {
            enabled: true,
            show: 'animated fadeInLeft',
            hide: 'animated fadeOutRight'
        }
    });

    jQuery('#tipCSSAnimated4').smallipop({
        cssAnimations: {
            enabled: true,
            show: 'animated rotateInDownLeft',
            hide: 'animated rotateOutUpRight'
        }
    });

    jQuery('#tipDontHideOnTriggerClick').smallipop({
        hideOnTriggerClick: false
    });
    jQuery('#tipDontHideOnContentClick').smallipop({
        hideOnPopupClick: false
    });

    jQuery('.smallipopTour').smallipop({
        theme: 'black',
        cssAnimations: {
            enabled: true,
            show: 'animated flipInX',
            hide: 'animated flipOutX'
        }
    });

    jQuery('#runTour').click(function() {
        jQuery('.smallipopTour').smallipop('tour');
    });

    // Animate smallipops when scrolling
    if (jQuery('.wobbler').length) {
        jQuery(document).scroll(function() {
            var wobblers = jQuery('.wobbler:not(.wobble)'),
                win = jQuery(window);
            wobblers.each(function() {
                var self = jQuery(this);
                offset = self.offset();
                if (offset.top > win.scrollTop() + 50 && offset.top < win.scrollTop() - 50 + win.height())
                    self.addClass('wobble');
            })
        }).trigger('scroll');
    }
});
