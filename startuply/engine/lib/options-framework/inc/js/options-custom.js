/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {

    // Loads the color pickers
    $('.of-color').wpColorPicker();

    // Image Options
    $('.of-radio-img-img').click(function(){
        $(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
    });

    $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();

    // Loads tabbed sections if they exist
    if ( $('.nav-tab-wrapper').length > 0 ) {
        options_framework_tabs();
    }

    $('#optionsframework-wrap .settings-error > p').delay(3000).fadeOut(600, function () {
        $('#optionsframework-wrap .settings-error').hide();
    });

    $('#optionsframework').on('click', '.minimize', function () {
        var $block = $(this).closest('.section');

        $block.toggleClass('closed');
    });

    $.each($('.slider-container'), function () {
        var id = $(this).attr('data-id'),
            value = $(this).attr('data-value'),
            $slider;

        $(this).siblings('label').find('input').on('change keyup blur', function () {
            $(this).val(parseInt($(this).val()));
            if ( parseInt($(this).val()) > 100 ) $(this).val(100);
            if ( parseInt($(this).val()) < 0 || $(this).val() == '' || $(this).val() == 'NaN' ) $(this).val(0);
            $slider.slider( 'value', $(this).val() );
        });

        $slider = $(this).slider({
            range: 'min',
            value: value,
            min: 0,
            max: 100,
            slide: function( event, ui ) {
                $('#'+id).val( ui.value );
            }
        });
    });

    $.each($('.section.percent-slider'), function () {
        var $input = $(this).find('input[type="text"]'),
            id = $input.attr('id'),
            value = $input.attr('value'),
            $slider;

        $('<div data-id="' + id + '" data-value="' + value + '" class="slider-container"></div>').insertBefore($input);
        $input.wrap('<label for="' + id + '"></label>');
        $input.removeClass('of-input').addClass('slider-input');

        $input.on('change keyup blur', function () {
            $(this).val(parseInt($(this).val()));
            if ( parseInt($(this).val()) > 100 ) $(this).val(100);
            if ( parseInt($(this).val()) < 0 || $(this).val() == '' || $(this).val() == 'NaN' ) $(this).val(0);
            $slider.slider( 'value', $(this).val() );
        });

        $slider = $(this).find('.slider-container').slider({
            range: 'min',
            value: value,
            min: 0,
            max: 100,
            slide: function( event, ui ) {
                $('#'+id).val( ui.value );
            }
        });
    });

    $('.depend-on-prev-checkbox').map(function() {
        if ( !$(this).prev().hasClass('depend-on-prev-checkbox') ) {
            return $(this).nextUntil(':not(.depend-on-prev-checkbox)').andSelf();
        }
    }).wrap("<div class='depend-block-wrap' />");


    $('.depend-off-prev-checkbox').map(function() {
        if ( !$(this).prev().hasClass('depend-off-prev-checkbox') ) {
            return $(this).nextUntil(':not(.depend-off-prev-checkbox)').andSelf();
        }
    }).wrap("<div class='depend-off-block-wrap' />");

    $.each($('.depend-block-wrap'), function () {
        var $block = $(this),
            invert = $block.find('.depend-on-prev-checkbox').hasClass('invert'),
            height = $block.height(),
            $checkbox = $block.prev().find('input[type="checkbox"]');

        if ( !$checkbox.attr('checked') ) {
            if ( !invert ) $block.height(0);
        }

        $checkbox.on('change', function () {
            if ( ( this.checked && !invert ) || ( invert && !this.checked ) ) {
                $block.height(height);
                setTimeout(function() { $block.height(''); }, 300);
            } else {
                height = $block.height();
                $block.height(height);
                $block.height(0);
                if ( $block.is('.section-upload') ) $block.find('input.remove-file').trigger('click');
                else $block.find('input[type="text"]').val('');
            }
        });
    });


    $.each($('.depend-off-block-wrap'), function () {

        var $block = $(this),
            invert = $block.find('.depend-off-prev-checkbox').hasClass('invert'),
            height = $block.height(),
            $checkbox = $block.prev().prev().find('input[type="checkbox"]');


        if ( $checkbox.attr('checked') ) {
            if ( !invert ) $block.height(0);
        }

        $checkbox.on('change', function () {
            if ( ( this.checked && !invert ) || ( invert && !this.checked ) ) {
                height = $block.height();
                $block.height(height);
                $block.height(0);
            } else {
                $block.height(height);
                setTimeout(function() { $block.height(''); }, 300);
            }
        });
    });

    function options_framework_tabs() {

        var $group = $('.group'),
            $navtabs = $('.nav-tab-wrapper a'),
            active_tab = '';

        // Hides all the .group sections to start
        $group.hide();

        // Find if a selected tab is saved in localStorage
        if ( typeof(localStorage) != 'undefined' ) {
            active_tab = localStorage.getItem('active_tab');
        }

        // If active tab is saved and exists, load it's .group
        if ( active_tab != '' && $(active_tab).length ) {
            $(active_tab).fadeIn();
            $(active_tab + '-tab').addClass('nav-tab-active');
        } else {
            $('.group:first').fadeIn();
            $('.nav-tab-wrapper a:first').addClass('nav-tab-active');
        }

        $('.nav-tab-wrapper .dropdown-menu').height(0);

        if ( $(active_tab + '-tab').is('.dropdown-toggle') || $(active_tab + '-tab').closest('.dropdown-menu').length ) {
            var $menu = ( $(active_tab + '-tab').is('.dropdown-toggle') ) ? $('[data-id="' + $(active_tab + '-tab').attr('id') + '"]') : $(active_tab + '-tab').closest('.dropdown-menu'),
                height = 0;

            $.each($menu.find('>li'), function () { height += $(this).height(); });
            $menu.height(height);
        }

        // Bind tabs clicks
        $navtabs.click(function(e) {

            //console.log('click');

            e.preventDefault();

            if ( !$(this).closest('.dropdown-menu').length ) $('.nav-tab-wrapper .dropdown-menu').height(0);

            if ( $(this).is('.dropdown-toggle') ) {
                var id = this.id,
                    $menu = $('ul[data-id="' + id + '"]'),
                    height = 0;

                $.each($menu.find('>li'), function () { height += $(this).height(); });
                $menu.height(height);
            }

            // Remove active class from all tabs
            $navtabs.removeClass('nav-tab-active');

            $(this).addClass('nav-tab-active').blur();

            if (typeof(localStorage) != 'undefined' ) {
                localStorage.setItem('active_tab', $(this).attr('href') );
            }

            var selected = $(this).attr('href');

            $group.hide();
            $(selected).fadeIn();

        });
    }

});
