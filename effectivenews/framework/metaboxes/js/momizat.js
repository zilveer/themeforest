jQuery(document).ready(function($) {
    "use strict";
        
    //page Sidebars
    $('input[name="mom_page_layout"]').click( function() {
        if ($(this).val() === 'right-sidebar') {
            $('#mom_left_sidebar').parent().parent().slideUp();
            $('#mom_right_sidebar').parent().parent().slideDown();
        } else if ($(this).val() === 'left-sidebar') {
            $('#mom_left_sidebar').parent().parent().slideUp();
            $('#mom_right_sidebar').parent().parent().slideDown();
        } else if ($(this).val() === 'both-sidebars-all' || $(this).val() === 'both-sidebars-right' || $(this).val() === 'both-sidebars-left' || $(this).val() === '') {
            $('#mom_right_sidebar').parent().parent().slideDown();
            $('#mom_left_sidebar').parent().parent().slideDown();
        } else {
            $('#mom_right_sidebar').parent().parent().slideUp();
            $('#mom_left_sidebar').parent().parent().slideUp();
        }
    });
        if ($('input[name="mom_page_layout"]:checked').val() === 'right-sidebar') {
            $('#mom_left_sidebar').parent().parent().hide();
            $('#mom_right_sidebar').parent().parent().show();
        } else if ($('input[name="mom_page_layout"]:checked').val() === 'left-sidebar') {
            $('#mom_left_sidebar').parent().parent().hide();
            $('#mom_right_sidebar').parent().parent().show();
        } else if ($('input[name="mom_page_layout"]:checked').val() === 'both-sidebars-all' || $('input[name="mom_page_layout"]:checked').val() === 'both-sidebars-right' || $('input[name="mom_page_layout"]:checked').val() === 'both-sidebars-left' || $('input[name="mom_page_layout"]:checked').val() === '') {
            $('#mom_right_sidebar').parent().parent().show();
            $('#mom_left_sidebar').parent().parent().show();
        } else {
            $('#mom_right_sidebar').parent().parent().hide();
            $('#mom_left_sidebar').parent().parent().hide();
        }
// page sliders
    $('#mom_slider_type').change(function() {
       if ($(this).val() === 'rs') {
            $('#mom_rev_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($(this).val() === 'ls') {
            $('#mom_layer_slider').parent().parent().slideDown();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($(this).val() === 'flex') {
            $('#mom_flex_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($(this).val() === 'nivo') {
            $('#mom_nivo_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } else if ($(this).val() === 'cute') {
            $('#mom_cute_slider').parent().parent().slideDown();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } else if ($(this).val() === 'apple') {
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideDown();
        } else {
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        }
        if ($(this).val() === 'static') {
            $('.mom_static_content').slideDown();
        } else {
            $('.mom_static_content').slideUp();
        }
    });
       if ($('#mom_slider_type').val() === 'rs') {
            $('#mom_rev_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($('#mom_slider_type').val() === 'ls') {
            $('#mom_layer_slider').parent().parent().slideDown();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($('#mom_slider_type').val() === 'flex') {
            $('#mom_flex_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } 
       else if ($('#mom_slider_type').val() === 'nivo') {
            $('#mom_nivo_slider').parent().parent().slideDown();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } else if ($('#mom_slider_type').val() === 'cute') {
            $('#mom_cute_slider').parent().parent().slideDown();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        } else if ($('#mom_slider_type').val() === 'apple') {
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideDown();
        } else {
            $('#mom_nivo_slider').parent().parent().slideUp();
            $('#mom_layer_slider').parent().parent().slideUp();
            $('#mom_flex_slider').parent().parent().slideUp();
            $('#mom_cute_slider').parent().parent().slideUp();
            $('#mom_rev_slider').parent().parent().slideUp();
            $('#mom_apple_slider').parent().parent().slideUp();
        }
        
       if ($('#mom_slider_type').val() === 'static') {
            $('.mom_static_content').slideDown();
        } else {
            $('.mom_static_content').slideUp();
        }

//Flex Slider
    $('#mom_flex_animation').change(function() {
       if ($(this).val() === 'slide') {
            $('#mom_flex_slide_direction').parent().parent().slideDown();
       } else {
            $('#mom_flex_slide_direction').parent().parent().slideUp();
       }
    });

       if ($('#mom_flex_animation').val() === 'slide') {
            $('#mom_flex_slide_direction').parent().parent().slideDown();
       } else {
            $('#mom_flex_slide_direction').parent().parent().slideUp();
       }

//Nivo Slider
    $('#mom_nivo_animation').change(function() {
       var tvalue = $(this).val();
       if (tvalue.search( /slice/ig )) {
            $('#mom_nivo_slices').parent().parent().parent().parent().slideUp();
       } else {
            $('#mom_nivo_slices').parent().parent().parent().parent().slideDown();
       }

       if (tvalue.search( /box/ig )) {
            $('#mom_nivo_cols').parent().parent().parent().parent().slideUp();
            $('#mom_nivo_rows').parent().parent().parent().parent().slideUp();
       } else {
            $('#mom_nivo_cols').parent().parent().parent().parent().slideDown();
            $('#mom_nivo_rows').parent().parent().parent().parent().slideDown();
       }
    });
    if($('#mom_nivo_animation').length) {
      if ($('#mom_nivo_animation').val().search( /slice/ig )) {
            $('#mom_nivo_slices').parent().parent().parent().parent().slideUp();
       } else {
            $('#mom_nivo_slices').parent().parent().parent().parent().slideDown();
       }

       if ($('#mom_nivo_animation').val().search( /box/ig )) {
            $('#mom_nivo_cols').parent().parent().parent().parent().slideUp();
            $('#mom_nivo_rows').parent().parent().parent().parent().slideUp();
       } else {
            $('#mom_nivo_cols').parent().parent().parent().parent().slideDown();
            $('#mom_nivo_rows').parent().parent().parent().parent().slideDown();
       }
    }
 
});