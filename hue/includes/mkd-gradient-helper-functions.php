<?php
if(!function_exists('hue_mikado_get_gradient_left_to_right_styles')) {
    function hue_mikado_get_gradient_left_to_right_styles($string_add = '', $empty_val = false, $custom_val = false) {
        $styles = array(
            'mkd-type1-gradient-left-to-right'.$string_add => 'Style 1',
            'mkd-type2-gradient-left-to-right'.$string_add => 'Style 2',
            'mkd-type3-gradient-left-to-right'.$string_add => 'Style 3',
            'mkd-type4-gradient-left-to-right'.$string_add => 'Style 4',
			'mkd-type5-gradient-left-to-right'.$string_add => 'Style 5',
			'mkd-type6-gradient-left-to-right'.$string_add => 'Style 6'
        );

        if($empty_val) {
            $styles = array_merge(array(
                '' => ''
            ), $styles);
        }

        if($custom_val) {
            $styles = array_merge($styles,
                array(
                'mkd-custom-gradient-top-to-bottom' => 'Custom (top to bottom)'
            ));
        }

        return $styles;
    }
}

if(!function_exists('hue_mikado_get_gradient_styles')) {
    function hue_mikado_get_gradient_bottom_to_top_styles($string_add = '', $empty_val = false) {
        $styles = array(
            'mkd-type1-gradient-bottom-to-top'.$string_add => 'Style 1',
            'mkd-type2-gradient-bottom-to-top'.$string_add => 'Style 2',
            'mkd-type3-gradient-bottom-to-top'.$string_add => 'Style 3',
            'mkd-type4-gradient-bottom-to-top'.$string_add => 'Style 4',
			'mkd-type5-gradient-bottom-to-top'.$string_add => 'Style 5',
			'mkd-type6-gradient-bottom-to-top'.$string_add => 'Style 6'
        );

        if($empty_val) {
            $styles = array_merge(array(
                '' => ''
            ), $styles);
        }

        return $styles;
    }
}

if(!function_exists('hue_mikado_get_gradient_left_bottom_to_right_top_styles')) {
    function hue_mikado_get_gradient_left_bottom_to_right_top_styles($string_add = '', $empty_val = false) {
        $styles = array(
            'mkd-type1-gradient-left-bottom-to-right-top'.$string_add => 'Style 1',
            'mkd-type2-gradient-left-bottom-to-right-top'.$string_add => 'Style 2',
            'mkd-type3-gradient-left-bottom-to-right-top'.$string_add => 'Style 3',
            'mkd-type4-gradient-left-bottom-to-right-top'.$string_add => 'Style 4',
			'mkd-type5-gradient-left-bottom-to-right-top'.$string_add => 'Style 5',
			'mkd-type6-gradient-left-bottom-to-right-top'.$string_add => 'Style 6'
        );

        if($empty_val) {
            $styles = array_merge(array(
                '' => ''
            ), $styles);
        }

        return $styles;
    }
}

if (!function_exists('hue_mikado_animated_gradient_overlay')) {
    /**
     * Function that returns animated gradient overlay parameters
     **/

    function hue_mikado_animated_gradient_overlay($color1,$color2,$color3,$color4){
        $animated_gradient_overlay = array();

        $color1def = '#e14b4f';
        $color2def = '#58b0e3';
        $color3def = '#48316b';
        $color4def = '#913156';

        $color1 = $color1 !== $color1def && $color1 !== '' ? $color1 : $color1def;
        $color2 = $color2 !== $color2def && $color2 !== '' ? $color2 : $color2def;
        $color3 = $color3 !== $color3def && $color3 !== '' ? $color3 : $color3def;
        $color4 = $color4 !== $color4def && $color4 !== '' ? $color4 : $color4def;

        $color1rgb = hue_mikado_hex2rgb($color1);
        $color2rgb = hue_mikado_hex2rgb($color2);
        $color3rgb = hue_mikado_hex2rgb($color3);
        $color4rgb = hue_mikado_hex2rgb($color4);

        $animated_gradient_overlay['gradient_overlay_color1_data'] = $color1rgb[0].','.$color1rgb[1].','.$color1rgb[2];
        $animated_gradient_overlay['gradient_overlay_color2_data'] = $color2rgb[0].','.$color2rgb[1].','.$color2rgb[2];
        $animated_gradient_overlay['gradient_overlay_color3_data'] = $color3rgb[0].','.$color3rgb[1].','.$color3rgb[2];
        $animated_gradient_overlay['gradient_overlay_color4_data'] = $color4rgb[0].','.$color4rgb[1].','.$color4rgb[2];

        return $animated_gradient_overlay;
    }
}