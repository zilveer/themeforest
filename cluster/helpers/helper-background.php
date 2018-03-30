<?php

$image_ids = stag_get_option('site_background');
$bgColor   = stag_get_option('site_background_color');
$opacity   = stag_get_option('site_background_opacity');
$title     = stag_get_option('site_title');
$subtitle  = stag_get_option('site_subtitle');

if( is_page() ){
    $image_ids  = array_filter( explode(',', get_post_meta( get_the_ID(), '_stag_image_ids', true) ) );
    if( empty($image_ids) || $image_ids[0] === "false" ) $image_ids = stag_get_option('site_background');

    $bgColor  = get_post_meta(get_the_ID(), '_stag_custom_background_color', true);
    $opacity  = get_post_meta(get_the_ID(), '_stag_custom_background_opacity', true);
    $title    = get_post_meta(get_the_ID(), '_stag_custom_title', true);
    $subtitle = get_post_meta(get_the_ID(), '_stag_custom_subtitle', true);
}


if( is_single() ){
    $image_ids  = array_filter( explode(',', get_post_meta( get_the_ID(), '_stag_image_ids', true) ) );
    if( empty($image_ids) || $image_ids[0] === "false" ) $image_ids = stag_get_option('site_background');

    $bgColor = get_post_meta(get_the_ID(), '_stag_custom_background_color', true);
    if($bgColor == '') $bgColor = stag_get_option('site_background_color');

    if(get_post_meta(get_the_ID(), '_stag_custom_background_color', true) != '' && get_post_meta(get_the_ID(), '_stag_custom_background', true) === ''){
        $bg = '';
    }

    $opacity = get_post_meta(get_the_ID(), '_stag_custom_background_opacity', true);
    if($opacity == '') $opacity = stag_get_option('site_background_opacity');

    $title = get_post_meta(get_the_ID(), '_stag_custom_title', true);
    if($title == '') $title = stag_get_option('site_title');

    $subtitle = get_post_meta(get_the_ID(), '_stag_custom_subtitle', true);
    if($subtitle == '') $subtitle = stag_get_option('site_subtitle');
}

if( is_single() && 'portfolio' === get_post_type() || is_page_template( 'template-portfolio.php' ) ){
    $image_ids   = array_filter( explode(',', get_post_meta( get_the_ID(), '_stag_image_ids', true) ) );
    if( empty($image_ids) || $image_ids[0] === "false" ) $image_ids = stag_get_option('portfolio_background');

    $bgColor = get_post_meta(get_the_ID(), '_stag_custom_background_color', true);
    if($bgColor == '') $bgColor = stag_get_option('portfolio_background_color');

    $opacity = get_post_meta(get_the_ID(), '_stag_custom_background_opacity', true);
    if($opacity == '') $opacity = stag_get_option('portfolio_background_opacity');

    $title = get_post_meta(get_the_ID(), '_stag_custom_title', true);
    if($title == '') $title = stag_get_option('portfolio_title');

    $subtitle = get_post_meta(get_the_ID(), '_stag_custom_subtitle', true);
    if($subtitle == '') $subtitle = stag_get_option('portfolio_subtitle');
}

if( is_archive() && is_tax('skill') ) {

    $term = get_the_terms( get_the_ID(), 'skill' );

    $title = current($term)->name;

    $image_ids = stag_get_option('portfolio_background');
    $bgColor   = stag_get_option('portfolio_background_color');
    $opacity   = stag_get_option('portfolio_background_opacity');
    $subtitle  = '';
}


?>

<div class="custom-background-wrapper">
    <div id="custom-background-<?php echo get_the_ID(); ?>" class="custom-background <?php if(!is_page() || !is_single()) echo 'universal'; ?>">

        <div class="custom-background-content">
            <?php if(!empty($title)) echo "<h2>".htmlspecialchars_decode(stripslashes($title))."</h2>"; ?>
            <?php if(!empty($subtitle)) echo "<h3>".htmlspecialchars_decode(stripslashes($subtitle))."</h3>"; ?>
        </div>

        <?php

        if( ! empty( $image_ids ) ) {
            $paths = array();

            if( is_array( $image_ids ) ) {
                foreach( $image_ids as $image ) {
                    $src = wp_get_attachment_image_src( $image, 'full' );
                    $paths[] = '"'. $src[0] .'"';
                }
            } else {
                foreach( explode(',', $image_ids) as $src ){
                    $paths[] = '"'. $src .'"';
                }
            }

            $path = implode(',', $paths);

            ?>

            <script>
            jQuery(document).ready(function($){
                if ($.fn.backstretch) {
                    $('#custom-background-<?php echo get_the_ID(); ?>').backstretch([<?php echo $path; ?>], {duration: <?php echo stag_get_option('site_slide_duration'); ?>, fade: <?php echo stag_get_option('site_fade_duration'); ?>});
                }
            });
            </script>

            <?php } ?>

    </div><!-- #custom-background-<?php echo get_the_ID(); ?> -->
</div><!-- .custom-background-wrapper -->
