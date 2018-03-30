<?php
extract( shortcode_atts( array(
            'el_class' => '',
            'id' => '',
            'size' => 'small',
            'icon' => '',
            'style' => 'flat',
            'corner_style' => 'pointed',
            'bg_color' => '#444444',
            'txt_color' => '#ddd',
            'underline_color' => '#ddd',
            'outline_skin' => '#444444',
            'outline_hover_skin' => '#fff',
            'outline_border_width' => 2,
            'nudge_skin' => '#444444',
            "url" => '',
            "target" => '_self',
            'margin_bottom' => 15,
            'animation' => '',
            'infinite_animation' => '',
            "align" => 'left',
        ), $atts ) );

$button = '';


$style_id = Mk_Static_Files::shortcode_id();

global $mk_accent_color, $mk_settings;

$bg_color = ($bg_color == $mk_settings['accent-color']) ? $mk_accent_color : $bg_color;


$app_styles = '';

if ( $style == 'three-dimension' || $style == 'flat' ) {
    $app_styles .= '
        .btn-'.$style_id.' {
            background-color:'.$bg_color.';
            color:'.$txt_color.';
            margin-bottom:'.$margin_bottom.'px;
        }
        .btn-'.$style_id.':hover {
            background-color:'.mk_hex_darker($bg_color, 15).';
            color:'.$txt_color.';
        }
        ';
}

if ( $style == 'three-dimension' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        box-shadow: 0 3px 0 '.mk_hex_darker( $bg_color, 20 ).';
                    }
                    .btn-'.$style_id.':active {
                        box-shadow: 0 1px 0 '.mk_hex_darker( $bg_color, 20 ).';
                    }';
}

if ( $style == 'outline' ) {
    $outline_skin = ($outline_skin == $mk_settings['accent-color']) ? $mk_accent_color : $outline_skin;
    $app_styles .= '.btn-'.$style_id.' {
                        border-color:'.$outline_skin.' !important;
                        color:'.$outline_skin.' !important;
                        margin-bottom:'.$margin_bottom.'px;
                        border-width:'.$outline_border_width.'px;
                    }

                    .btn-'.$style_id.':hover {
                        background-color:'.$outline_skin.' !important;
                        color:'.$outline_hover_skin.' !important;
                    }';
}
if ( $style == 'line' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        color:'.$outline_skin.' !important;
                        margin-bottom:'.$margin_bottom.'px;
                    }
                    .btn-'.$style_id.'::after {
                        background-color:'.$outline_skin.' !important;
                    }
                    .btn-'.$style_id.'::before {
                        background-color:'.$outline_skin.' !important;
                    }

                    .btn-'.$style_id.':hover {
                        background-color:'.$outline_skin.' !important;
                        color:'.$outline_hover_skin.' !important;
                    }';
}
if ( $style == 'fill' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        color:'.$outline_skin.' !important;
                        border: '.$outline_border_width.'px solid '.$outline_skin.';
                        margin-bottom:'.$margin_bottom.'px;
                    }
                    .btn-'.$style_id.'::before {
                        background-color:'.$outline_skin.' !important;
                    }
                    .btn-'.$style_id.':hover {
                        color:'.$outline_hover_skin.' !important;
                    }';

}
if ( $style == 'nudge' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        color:'.$nudge_skin.' !important;
                        margin-bottom:'.$margin_bottom.'px;
                    }
                    .btn-'.$style_id.'::after {
                        border: 2px solid '.$nudge_skin.';
                    }';
}
if ( $style == 'radius' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        color:'.$outline_skin.' !important;
                        border: 2px solid '.$outline_skin.' !important;
                        margin-bottom:'.$margin_bottom.'px;
                    }';
}
if ( $style == 'fancy_link' ) {
    $app_styles .= '.btn-'.$style_id.' {
                        color:'.$txt_color.' !important;
                        margin-bottom:'.$margin_bottom.'px;
                    }
                    .btn-'.$style_id.':before {
                        background-color: '.$underline_color.' !important;
                    }
                    .btn-'.$style_id.' .line {
                        background-color: '.$underline_color.' !important;
                    }';
}



$infinite_animation = !empty($infinite_animation) ? (' mk-'.$infinite_animation) : '';
$animation_css = ($animation != '') ? ' mk-animate-element ' . $animation . ' ' : '';


$id = !empty( $id ) ? ( 'id="'.$id.'"' ) : '';
$target = !empty( $target ) ? ( 'target="'.$target.'"' ) : '';


$url_is_smooth = (preg_match('/#/',$url)) ? 'mk-smooth ' : '';

if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( '<i class="'.$icon.'"></i>' ) : ( '<i class="mk-'.$icon.'"></i>' );
} else {
    $icon = '';
}

$button .= '<a href="'.$url.'" '.$target.' '.$id.' class="mk-button btn-'.$style_id.' '.$animation_css.' '.$style.'-button '.$size.' '.$corner_style.' '.$el_class.$infinite_animation.' '.$url_is_smooth.'">'.$icon.'<span>'.do_shortcode( strip_tags( $content ) ).'</span>';
$button .= ($style == 'fancy_link') ? '<span class="line"></span>' : '';
$button .= '</a>';
$output = ( !empty( $align ) ? '<div class="mk-button-align '.$align.'">' : '' ) . $button . ( !empty( $align ) ? '</div>' : '' );
echo $output . "\n\n";


Mk_Static_Files::addCSS($app_styles, $style_id);
