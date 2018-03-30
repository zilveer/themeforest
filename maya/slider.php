<?php
//if ( !yiw_can_show_slider() )
//    return;
global $post, $wp_query, $woocommerce;

wp_reset_query();

ob_start();

$post_id = yiw_post_id();

if( $slider = get_post_meta( $post_id, 'slider_type', true ) ) {
                                                                         
    if( is_string($slider) && $slider != 'none' && !empty($slider) )
        get_template_part( 'slider', $slider ); 
                                                                 

} elseif( is_home() || is_front_page() || is_page_template('home.php') ) {
    if( ($slider = yiw_get_option( 'slider_type', 'none' )) && $slider != 'none' && !empty($slider))
        get_template_part( 'slider', $slider );         
} else return;

$slider_html = ob_get_clean();

    if ( $slider != 'none' && $slider != 'fixed-image' && yiw_get_option( 'slider_responsive' ) == 'fixed-image' ) : ?>
        <div class="slider-mobile">
           <?php get_template_part( 'slider', 'fixed-image' ); ?>    
        </div>   
    <?php endif; 
    
echo $slider_html;
?>