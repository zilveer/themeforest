<?php

global $mk_options;

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$data_config[] = ( $full_height == 'true' ) ? 'data-mk-component="FullHeight" data-fullHeight-config=\'{"min": '.$min_height.'}\'': '';
$data_config[] = ($video_source == 'social') ? 'data-source="'.$stream_host_website.'"' : '' ;
$data_config[] = ($video_source == 'social') ? 'data-sound="'.$stream_sound.'"' : '' ;
$data_config[] = 'data-intro-effect="' . $intro_effect . '"';

$classes[] = 'mk-page-section';
$classes[] = $video_source.'-hosted';
$classes[] = ($intro_effect != 'false') ? 'intro-true' : '';
$classes[] = 'full-width-' . $id;
$classes[] = 'js-el';
$classes[] = 'js-master-row';
$classes[] = $visibility;
$classes[] = get_viewport_animation_class($animation);
$classes[] = ($top_shadow == 'true') ? 'drop-top-shadow' : '';
$classes[] = $el_class;
if($js_vertical_centered == 'true' || $full_height == 'true') $classes[] = 'center-y';




?>

<?php echo mk_get_shortcode_view('mk_page_section', 'components/wrapper-start', true); ?>

<div class="mk-page-section-wrapper">
    <div <?php echo $section_id; ?> class="<?php echo implode(' ', $classes); ?>" <?php echo implode(' ', $data_config); ?>>

        
            <?php if ($has_top_shape_divider == 'true') {
                echo mk_get_shortcode_view('mk_page_section', 'components/shape-divider', true, $top_shape_atts);
            } ?>

            <div class="mk-page-section-inner">
                <?php echo mk_get_shortcode_view('mk_page_section', 'components/overlay', true, $overlay_atts); ?>

                <?php if ($layout_structure == 'full') {
                    echo mk_get_shortcode_view('mk_page_section', 'components/video-background', true, $video_atts);
                } ?>

                <?php echo mk_get_shortcode_view('mk_page_section', 'components/background-layer', true, $layer_atts); ?>
            </div>
            
            <?php echo mk_get_shortcode_view('mk_page_section', 'components/layout-structure__full', true, $layout_structure_full_atts); ?>

            <?php echo mk_get_shortcode_view('mk_page_section', 'components/layout-structure__half', true, $layout_structure_half_atts); ?>

            <?php echo mk_get_shortcode_view('mk_page_section', 'components/skip-arrow', true, ['skip_arrow' => $skip_arrow, 'skip_arrow_skin' => $skip_arrow_skin]); ?>

            <?php if ($has_bottom_shape_divider == 'true') {
                echo mk_get_shortcode_view('mk_page_section', 'components/shape-divider', true, $bottom_shape_atts);
            } ?>

        
        <div class="clearboth"></div>
    </div>
</div>

<?php echo mk_get_shortcode_view('mk_page_section', 'components/full-width-end', true); ?>

<?php 


if (!function_exists('is_gradient_stop_transparent')) {
    function is_gradient_stop_transparent($color) {
        if (strpos($color, 'rgba') !== false) {
            $var = $color;
            $var = str_replace('rgba(', '', $var);
            $var = str_replace(')', '', $var);
            $var = explode(',', $var);

            if(floatval($var[3]) > 0.05) {
                return false;
            } else {
                return true;
            }

        } else {
            return false;
        }
    }
}


if($bg_gradient != 'false') {

    $el = '.full-width-'.$id.' .mk-video-color-mask';
    $vertical = $horizontal = $left_top = $left_bottom = $radial = '';
    $gr_start = $video_color_mask;

    $gr_start = is_gradient_stop_transparent($gr_start) ? 'transparent' : $gr_start;
    $gr_end   = is_gradient_stop_transparent($gr_end)   ? 'transparent' : $gr_end;
    
    if($bg_gradient == 'vertical')
        $vertical = "
            background: ".$gr_start."; /* Old browsers */
            background: -moz-linear-gradient(top,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
            background: linear-gradient(to bottom,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
        ";

    if($bg_gradient == 'horizontal')
        $horizontal = "
            background: ".$gr_start."; /* Old browsers */
            background: -moz-linear-gradient(left,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, right top, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(left,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
            background: linear-gradient(to right,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
        ";

    if($bg_gradient == 'left_top')
        $left_top = "
            background: ".$gr_start."; /* Old browsers */
            background: -moz-linear-gradient(-45deg,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(-45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
            background: linear-gradient(135deg,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
        ";

    if($bg_gradient == 'left_bottom')
        $left_bottom = "
            background: ".$gr_start."; /* Old browsers */
            background: -moz-linear-gradient(45deg,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
            background: linear-gradient(45deg,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
        ";

    if($bg_gradient == 'radial')
        $radial = "
            background: ".$gr_start."; /* Old browsers */
            background: -moz-radial-gradient(center, ellipse cover,  ".$gr_start." 0%, ".$gr_end." 100%); /* FF3.6+ */
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,".$gr_start."), color-stop(100%,".$gr_end.")); /* Chrome,Safari4+ */
            background: -webkit-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* Chrome10+,Safari5.1+ */
            background: -o-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* Opera 12+ */
            background: -ms-radial-gradient(center, ellipse cover,  ".$gr_start." 0%,".$gr_end." 100%); /* IE10+ */
            background: radial-gradient(ellipse at center,  ".$gr_start." 0%,".$gr_end." 100%); /* W3C */
        ";

    Mk_Static_Files::addCSS($el .'{'
        .$vertical
        .$horizontal
        .$left_top
        .$left_bottom
        .$radial
    .'}', $id);
}



$bg_color_css = $bg_color ? ('background-color:' . $bg_color . ';') : '';
$bg_layer_bg_css = $blend_mode !== 'none' ? ('background-color:' . $bg_color . ';') : '';
// $backgroud_image = ($layout_structure == 'full') ? (!empty($bg_image) ? 'background-image:url(' . $bg_image . '); ' : '') : '';
$border_css = (!empty($border_color)) ? 'border:1px solid ' . $border_color . ';border-left:none;border-right:none;' : '';


if ($attachment == 'fixed') {
    $bgAttachment = 'position: fixed;';
}
if ($attachment == 'fixed' && $parallax == 'true') {
    if($mk_options['smoothscroll'] == 'true') {
        $bgAttachment = 'position: absolute;';
    }
}

$padding_top = ($has_top_shape_divider == 'true') ? (floatval($padding_top) + 100) : $padding_top;
$padding_bottom = ($has_bottom_shape_divider == 'true') ? (floatval($padding_bottom) + 100) : $padding_bottom;

Mk_Static_Files::addCSS("
    .full-width-{$id} {
        min-height:{$min_height}px;
        margin-bottom:{$margin_bottom}px;
        {$bg_color_css}
        {$border_css}
    }

    .full-width-{$id} .page-section-content {
        padding:{$padding_top}px 0 {$padding_bottom}px;
    }
    #background-layer--{$id} {
        {$bg_layer_bg_css};
        background-position:{$bg_position};
        background-repeat:{$bg_repeat};
        {$bgAttachment};
    }

    #background-layer--{$id} .mk-color-layer {
        {$bg_layer_bg_css};
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

", $id);

if($has_bottom_shape_divider == 'true') {
Mk_Static_Files::addCSS("
    .full-width-{$id} .mk-skip-to-next {
        bottom: 100px;
    }
", $id);
}

if(!empty($bg_color)) {
Mk_Static_Files::addCSS( "
    .full-width-{$id} .mk-fancy-title.pattern-style span,
    .full-width-{$id} .mk-blog-view-all
    {
        background-color: {$bg_color} !important;
    }
", $id);
}
