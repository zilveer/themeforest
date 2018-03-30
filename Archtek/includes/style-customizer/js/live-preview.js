jQuery(document).ready(function($) {
    
    /* #Global: Primary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[primary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('#logo h1, #header-search-input, .slider-caption .caption-title, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, .testimonial-inner, #footer-content h5').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('#header-search-input, .slider-caption .caption-title, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, .testimonial-inner, #footer-content h5').css('font-family', '');
            }
        } );
    } );
    
    /* #Global: Secondary Font
    ================================================== */
    wp.customize('uxbarn_sc_global_styles[secondary_font]', function(value) {
        value.bind(function(newval) {
            if(newval != '-1') {
                $('#logo p, #root-menu, .slider-caption .caption-body, #content-container, #content-container .columns, #intro p, #footer-content-container, #footer-bar-container').css('font-family', getCleanValueForGoogleFonts(newval));
            } else {
                $('#logo p, #root-menu, .slider-caption .caption-body, #content-container, #content-container .columns, #intro p, #footer-content-container, #footer-bar-container').css('font-family', '');
            }
        } );
    } );
    
    /* #Site Background: Bg color
    ================================================== */
    wp.customize('uxbarn_sc_site_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-color', newval);
        } );
    } );
    
    /* #Site Background: Bg image and attributes
    ================================================== */
    wp.customize('uxbarn_sc_site_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_site_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_site_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('body').css('background-position', newval);
        } );
    } );
    
    
    /* #Header Background: Bg color
    ================================================== */
    wp.customize('uxbarn_sc_header_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#header-container').css({
                'background-color': 'rgb(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ')',
                'background-color': 'rgba(' + hexToR(newval) + ',' + hexToG(newval) + ',' + hexToB(newval) + ',' + wp.customize('uxbarn_sc_header_styles_background_opacity').get() + ')',
            });
        } );
    } );
    
    wp.customize('uxbarn_sc_header_styles_background_opacity', function(value) {
        value.bind(function(newval) {
            var selectedColor = wp.customize('uxbarn_sc_header_styles[background_color]').get();
            $('#header-container').css({
                'background-color': 'rgb(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ')',
                'background-color': 'rgba(' + hexToR(selectedColor) + ',' + hexToG(selectedColor) + ',' + hexToB(selectedColor) + ',' + newval + ')',
            });
        } );
    } );
    
    /* #Header Background: Bg image and attributes
    ================================================== */
    wp.customize('uxbarn_sc_header_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#header-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_header_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#header-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_header_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#header-container').css('background-position', newval);
        } );
    } );
    
    /* #Header Background: Text color
    ================================================== */
    wp.customize('uxbarn_sc_header_styles[text_color]', function(value) {
        value.bind(function(newval) {
            $('#logo, #logo h1').css('color', newval);
        } );
    } );
    
    
    /* #Home Slider: Caption colors
    ================================================== */
    wp.customize('uxbarn_sc_home_slider_styles[title_color]', function(value) {
        value.bind(function(newval) {
            $('.slider-caption .caption-title').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_home_slider_styles[body_color]', function(value) {
        value.bind(function(newval) {
            $('.slider-caption .caption-body').css('color', newval);
        } );
    } );
    
    /* #Home Slider: Controller colors
    ================================================== */
    wp.customize('uxbarn_sc_home_slider_styles[controller_color]', function(value) {
        value.bind(function(newval) {
            $('#slider-prev, #slider-next').css('background', newval);
        } );
    } );
    
    /* #Page Intro: Colors
    ================================================== */
    wp.customize('uxbarn_sc_page_intro_styles[title_color]', function(value) {
        value.bind(function(newval) {
            $('#intro h1, #intro h2').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_page_intro_styles[body_color]', function(value) {
        value.bind(function(newval) {
            $('#intro p').css('color', newval);
        } );
    } );
    
    /* #Content: Body colors
    ================================================== */
    wp.customize('uxbarn_sc_content_body_styles[heading_color]', function(value) {
        value.bind(function(newval) {
            $('#inner-content-container h1, #inner-content-container h2, #inner-content-container h3, #inner-content-container h4, #inner-content-container h5').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_content_body_styles[text_color]', function(value) {
        value.bind(function(newval) {
            $('#inner-content-container .columns').css('color', newval);
        } );
    } );
    
    /* #Content: Content bg
    ================================================== */
    wp.customize('uxbarn_sc_content_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#inner-content-container .row, .columns.with-sidebar, #content-container .fixed-box').not('#intro, #footer-bar-container, .grey-bg').attr('style', 'background-color: ' + newval + ';');
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('.row, .columns.with-sidebar, .columns.with-sidebar, #content-container .fixed-box').not('#intro, #footer-bar-container, .grey-bg').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('.row, .columns.with-sidebar, .columns.with-sidebar, #content-container .fixed-box').not('#intro, #footer-bar-container, .grey-bg').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_content_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('.row, .columns.with-sidebar, .columns.with-sidebar, #content-container .fixed-box').not('#intro, #footer-bar-container, .grey-bg').css('background-position', newval);
        } );
    } );
    
    /* #Footer: Body colors
    ================================================== */
    wp.customize('uxbarn_sc_footer_body_styles[heading_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-content h5').css('color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_footer_body_styles[text_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-content-container').css('color', newval);
        } );
    } );
    
    /* #Footer: Bg 
    ================================================== */
    wp.customize('uxbarn_sc_footer_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-content-container').css('background-color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_footer_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#footer-content-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_footer_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#footer-content-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_footer_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#footer-content-container').css('background-position', newval);
        } );
    } );
    
    /* #Footer Bar: Body colors
    ================================================== */
    wp.customize('uxbarn_sc_footer_bar_body_styles[text_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-bar-container').css('color', newval);
        } );
    } );
    
    /* #Footer Bar: Bg 
    ================================================== */
    wp.customize('uxbarn_sc_footer_bar_background_styles[background_color]', function(value) {
        value.bind(function(newval) {
            $('#footer-bar-container').css('background-color', newval);
        } );
    } );
    wp.customize('uxbarn_sc_footer_bar_background_styles[background_image]', function(value) {
        value.bind(function(newval) {
            $('#footer-bar-container').css('background-image', 'url(' + newval + ')');
        } );
    } );
    wp.customize('uxbarn_sc_footer_bar_background_styles[background_repeat]', function(value) {
        value.bind(function(newval) {
            $('#footer-bar-container').css('background-repeat', newval);
        } );
    } );
    wp.customize('uxbarn_sc_footer_bar_background_styles[background_position]', function(value) {
        value.bind(function(newval) {
            $('#footer-bar-container').css('background-position', newval);
        } );
    } );
    
    
    
    
    
    
    
    
    /* #Utilities
    ================================================== */
    function getCleanValueForGoogleFonts(input) {
        // Clean value only if it's Google Fonts
        if(input.indexOf('[#GF#]') != -1) {
            input = input.replace('[#GF#]', '').split(':');//.replace(/[^a-zA-Z\s]/gi, '');
            input = '\'' + input[0] + '\', sans-serif';
        }
        
        return input;
    }
    

    function hexToR(h) {return parseInt((cutHex(h)).substring(0,2),16)}
    function hexToG(h) {return parseInt((cutHex(h)).substring(2,4),16)}
    function hexToB(h) {return parseInt((cutHex(h)).substring(4,6),16)}
    function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}
    
    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
    
        console.log(out);
    
        // or, if you wanted to avoid alerts...
    
        /*var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)*/
    }
    
});