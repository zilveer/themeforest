<?php
/*
    Template Name: Geo Home Page
*/
get_header();
the_post();

?>
<?php
$show_big_map = couponxl_get_option( 'show_big_map' );
if( $show_big_map == 'yes' ){
    $source = couponxl_get_option( 'big_map_source' );
    $height = couponxl_get_option( 'big_map_height' );
    ?>
    <section class="big-map">
        <?php echo do_shortcode( '[gmap source="'.$source.'" height="'.$height.'"]' ); ?>
    </section>
    <?php
}
?>
<section class="geo-home-page-body">
    <div class="container">
        <div class="page-content clearfix">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>