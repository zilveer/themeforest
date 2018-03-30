<?php

global $ish_options;

echo '<style type="text/css">';

$c1 = ( isset( $ish_options['color1'] ) && '' != $ish_options['color1'] ) ? $ish_options['color1'] : ISH_COLOR_1;
$c2 = ( isset( $ish_options['color2'] ) && '' != $ish_options['color2'] ) ? $ish_options['color2'] : ISH_COLOR_2;
$c3 = ( isset( $ish_options['color3'] ) && '' != $ish_options['color3'] ) ? $ish_options['color3'] : ISH_COLOR_3;
$c4 = ( isset( $ish_options['color4'] ) && '' != $ish_options['color4'] ) ? $ish_options['color4'] : ISH_COLOR_4;

$c_text = ( isset( $ish_options['text_color'] ) && '' != $ish_options['text_color'] ) ? $ish_options['text_color'] : ISH_TEXT_COLOR;
$c_body = ( isset( $ish_options['body_color'] ) && '' != $ish_options['body_color'] ) ? $ish_options['body_color'] : '#ffffff';
$c_background = ( isset( $ish_options['background_color'] ) && '' != $ish_options['background_color'] ) ? $ish_options['background_color'] : '#ffffff';

$c1_rgb = ishyoboy_hex2rgb($c1);
$c2_rgb = ishyoboy_hex2rgb($c2);
$c3_rgb = ishyoboy_hex2rgb($c3);
$c4_rgb = ishyoboy_hex2rgb($c4);

$c_text_rgb = ishyoboy_hex2rgb($c_text);

global $ish_fonts;

// FONT SETTINGS
ishyoboy_load_font_settings('body_font', $ish_options);
ishyoboy_load_font_settings('header_font', $ish_options);
ishyoboy_load_font_settings('h1_font', $ish_options);
ishyoboy_load_font_settings('h2_font', $ish_options);
ishyoboy_load_font_settings('h3_font', $ish_options);
ishyoboy_load_font_settings('h4_font', $ish_options);
ishyoboy_load_font_settings('h5_font', $ish_options);
ishyoboy_load_font_settings('h6_font', $ish_options);


foreach ( $ish_fonts as $key => $val){

    switch ( $val['variant'] ){
        case '100' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '100italic' :
            $ish_fonts[$key]['variant'] = '100';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '200' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '200italic' :
            $ish_fonts[$key]['variant'] = '200';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '300' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '300italic' :
            $ish_fonts[$key]['variant'] = '300';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case 'regular' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case 'italic' :
            $ish_fonts[$key]['variant'] = '400';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '500' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '500italic' :
            $ish_fonts[$key]['variant'] = '500';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '600' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '600italic' :
            $ish_fonts[$key]['variant'] = '600';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '700' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '700italic' :
            $ish_fonts[$key]['variant'] = '700';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '800' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '800italic' :
            $ish_fonts[$key]['variant'] = '800';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
        case '900' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'normal';
            break;
        case '900italic' :
            $ish_fonts[$key]['variant'] = '900';
            $ish_fonts[$key]['font-style'] = 'italic';
            break;
    }
}

$images_path = IYB_HTML_URI . '/core/images';

?>

/* 7.1 Font family ****************************************************************************************************/

/*
* Font Open Sans
*/
.tp-caption *{
font-family: <?php echo $ish_fonts['body_font']['name'];  ?>, sans-serif !important;
font-weight: <?php echo $ish_fonts['body_font']['variant']; ?>;
}

/*
* Headlines
*/
.tp-caption h1, .tp-caption .h1, .tp-caption[class*="minicorp_big_"] {
font-family: <?php echo $ish_fonts['h1_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h1_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h1_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h1_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h1_font']['line_height'];  ?>px;
}

.tp-caption h2, .tp-caption .h2,  .tp-caption[class*="minicorp_medium_"] {
font-family: <?php echo $ish_fonts['h2_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h2_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h2_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h2_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h2_font']['line_height'];  ?>px;
}

.tp-caption h3, .tp-caption .h3,  .tp-caption[class*="minicorp_small_"] {
font-family: <?php echo $ish_fonts['h3_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h3_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h3_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h3_font']['font-style'];  ?>;
letter-spacing: -1px;
line-height: <?php echo $ish_fonts['h3_font']['line_height'];  ?>px;
}

.tp-caption h4, .tp-caption .h4 {
font-family: <?php echo $ish_fonts['h4_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h4_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h4_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h4_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h4_font']['line_height'];  ?>px;
}

.tp-caption h5, .tp-caption .h5 {
font-family: <?php echo $ish_fonts['h5_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h5_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h5_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h5_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h5_font']['line_height'];  ?>px;
}

.tp-caption h6, .tp-caption .h6 {
font-family: <?php echo $ish_fonts['h6_font']['name'];  ?>, sans-serif !important;
font-size: <?php echo $ish_fonts['h6_font']['size'];  ?>px;
font-weight: <?php echo $ish_fonts['h6_font']['variant'];  ?>;
font-style: <?php echo $ish_fonts['h6_font']['font-style'];  ?>;
line-height: <?php echo $ish_fonts['h6_font']['line_height'];  ?>px;
}

.tp-caption[class*="with_bg"]{
    padding: 5px 10px;
}

.tp-caption[class*="with_bg"]{
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
}


/*
* 1.
*/
.tp-caption h1.color1, .tp-caption h2.color1, .tp-caption h3.color1, .tp-caption h4.color1, .tp-caption h5.color1, .tp-caption h6.color1,
.tp-caption .h1.color1, .tp-caption .h2.color1, .tp-caption .h3.color1, .tp-caption .h4.color1, .tp-caption .h5.color1, .tp-caption .h6.color1,
.tp-caption[class*="_color1"]{
    color: <?php echo $c1; ?>;
}

.tp-caption[class*="color1_with_bg"]{
    background: <?php echo $c1; ?>;
    background: rgba(<?php echo $c1_rgb; ?>, 0.95);
}

/*
* 2.
*/
.tp-caption h1.color2, .tp-caption h2.color2, .tp-caption h3.color2, .tp-caption h4.color2, .tp-caption h5.color2, .tp-caption h6.color2,
.tp-caption .h1.color2, .tp-caption .h2.color2, .tp-caption .h3.color2, .tp-caption .h4.color2, .tp-caption .h5.color2, .tp-caption .h6.color2,
.tp-caption[class*="_color2"]{
    color: <?php echo $c_text; ?>;
}

.tp-caption[class*="color3_with_bg"], .tp-caption[class*="color4_with_bg"]{
    color: <?php echo $c_text; ?>!important;
}

.tp-caption[class*="color2_with_bg"]{
    background: <?php echo $c2; ?>;
    background: rgba(<?php echo $c2_rgb; ?>, 0.95);
}

/*
* 3.
*/
.tp-caption h1.color3, .tp-caption h2.color3, .tp-caption h3.color3, .tp-caption h4.color3, .tp-caption h5.color3, .tp-caption h6.color3,
.tp-caption .h1.color3, .tp-caption .h2.color3, .tp-caption .h3.color3, .tp-caption .h4.color3, .tp-caption .h5.color3, .tp-caption .h6.color3,
.tp-caption[class*="_color3"]{
    color: <?php echo $c3; ?>;
}

.tp-caption[class*="color3_with_bg"]{
    background: <?php echo $c3; ?>;
    background: rgba(<?php echo $c3_rgb; ?>, 0.95);
}

/*
* 4.
*/
.tp-caption h1.color4, .tp-caption h2.color4, .tp-caption h3.color4, .tp-caption h4.color4, .tp-caption h5.color4, .tp-caption h6.color4,
.tp-caption .h1.color4, .tp-caption .h2.color4, .tp-caption .h3.color4, .tp-caption .h4.color4, .tp-caption .h5.color4, .tp-caption .h6.color4,
.tp-caption[class*="_color4"], .tp-caption[class*="color1_with_bg"], .tp-caption[class*="color2_with_bg"]{
    color: <?php echo $c4; ?>;
}

.tp-caption[class*="color4_with_bg"]{
    background: <?php echo $c4; ?>;
    background: rgba(<?php echo $c4_rgb; ?>, 0.95);
}

<?php echo '</style>'; ?>