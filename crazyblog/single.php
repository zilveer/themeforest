<?php
get_header();
$settings = crazyblog_opt();
$single_setting = $settings;
$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
$object = get_queried_object_id();
$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_options' ), '0' );

if ( crazyblog_set( $meta, 'post_title_section' ) == '' ) {
	$show_banner = crazyblog_set( $settings, 'single_title_section' );
	$bg = (crazyblog_set( $settings, 'single_title_section_bg' )) ? 'background:url(' . crazyblog_set( $settings, 'single_title_section_bg' ) . ')' : "";
} else {
	$show_banner = crazyblog_set( $meta, 'post_title_section' );
	$bg = (crazyblog_set( $meta, 'title_section_bg' )) ? 'background:url(' . crazyblog_set( $meta, 'title_section_bg' ) . ')' : "";
}

if ( crazyblog_set( $meta, 'layout' ) == '' && crazyblog_set( $meta, 'layout' ) != 'full' ) {
	$sidebar = (crazyblog_set( $settings, 'single_page_sidebar' )) ? crazyblog_set( $settings, 'single_page_sidebar' ) : "";
	$layout = ($sidebar && crazyblog_set( $settings, 'single_sidebar_layout' )) ? crazyblog_set( $settings, 'single_sidebar_layout' ) : "";
	$cols = ($layout != "full" && $sidebar ) ? "col-md-8" : 'col-md-12';
} else {
	$sidebar = (crazyblog_set( $meta, 'sidebar' )) ? crazyblog_set( $meta, 'sidebar' ) : "";
	$layout = ($sidebar && crazyblog_set( $meta, 'layout' )) ? crazyblog_set( $meta, 'layout' ) : "";
	$cols = ($layout != "full" && $sidebar ) ? "col-md-8" : 'col-md-12';
}

$no_image = "";
$year = get_the_time( 'Y' );
$month = get_the_time( 'm' );
$day = get_the_time( 'd' );
crazyblog_set_posts_views( get_the_ID() );
crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-magnific' ) );
?>

<?php if ( $show_banner ) : ?>
	<div class="pagetop" style="<?php echo esc_attr( $bg ); ?>">
		<div class="page-name">
			<div class="container">
				<span>
					<?php echo esc_html( get_the_title( $object ) ); ?>
				</span>
				<?php echo crazyblog_get_breadcrumbs(); ?>
			</div>
		</div>
	</div><!-- Page Top -->
<?php endif; ?>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
				<?php if ( is_active_sidebar( $sidebar ) && $layout == "left" ) : ?>
					<aside class="col-md-4 column sidebar left-sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
				<?php
				if ( have_posts() ) : while ( have_posts() ) :
						the_post();
						$format = get_post_format( get_the_ID() );
						if ( $format == '' ) {
							$format = 'standard';
						}
						if ( $format == "video" ) {
							include crazyblog_ROOT . "core/application/library/single/format-video.php";
						} elseif ( $format == "audio" ) {
							include crazyblog_ROOT . "core/application/library/single/format-audio.php";
						} elseif ( $format == "gallery" ) {
							include crazyblog_ROOT . "core/application/library/single/format-gallery.php";
						} elseif ( $format == "quote" ) {
							include crazyblog_ROOT . "core/application/library/single/format-quote.php";
						} elseif ( $format == "link" ) {
							include crazyblog_ROOT . "core/application/library/single/format-link.php";
						} elseif ( $format == "image" ) {
							include crazyblog_ROOT . "core/application/library/single/format-image.php";
						} else {
							include crazyblog_ROOT . "core/application/library/single/format-image.php";
						}
					endwhile;
					wp_reset_postdata();
				endif;
				?>
				<?php if ( is_active_sidebar( $sidebar ) && $layout == "right" ) : ?>
					<aside class="col-md-4 column sidebar right-sidebar">
						<?php dynamic_sidebar( $sidebar ); ?>
					</aside>
				<?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) ); ?>
<?php
$custom_script = 'jQuery(document).ready(function ($) {
        jQuery(".related-carousel").owlCarousel({
            autoplay: true,
            autoplayTimeout: 2500,
            smartSpeed: 2000,
            autoplayHoverPause: true,
            loop: false,
            dots: false,
            nav: true,
            margin: 30,
            mouseDrag: true,
            autoHeight: true,
            items: 2,
            responsive: {
                1200: {items: 2},
                980: {items: 2},
                768: {items: 2},
                480: {items: 2},
                0: {items: 1}
            }
        });
        jQuery(".related-posts").removeClass("none");
    });';
wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
?>
<?php get_footer(); ?>