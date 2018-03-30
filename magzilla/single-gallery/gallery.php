<?php
if ( function_exists( 'rwmb_meta' ) ) {
    $fave_gallery = rwmb_meta( 'fave_gallery_regular_posts', $args = array('type' => 'image'), get_the_ID() );

}
$unique_key = fave_unique_key();
?>
<div class="post-gallery-wrap">
	<div class="post-gallery">
		<!--<div class="post-gallery-top">
			<div class="post-gallery-title">
				<i class="fa fa-picture-o"></i> <?php /*if( rwmb_meta( 'fave_gallery_title', get_the_ID() ) ) { echo rwmb_meta( 'fave_gallery_title', get_the_ID() ); } */?>
			</div>
		</div>-->
		<div class="post-gallery-body">
			<!-- big images -->
			<div id="sync1-<?php echo intval( $unique_key ); ?>" class="images-owl-carousel">
				<?php
				if ( $fave_gallery != NULL ) { 
					
					foreach ($fave_gallery as $gal_img ) { 
					$fave_image = wp_get_attachment_image_src($gal_img['ID'], array(800, 600));
					$fave_image_full = wp_get_attachment_image_src($gal_img['ID'], 'full');
					?>
						
						<div class="item">
							<a class="magzilla-popup" href="<?php echo esc_url( $fave_image_full[0] ); ?>">
								<img src="<?php echo esc_url( $fave_image[0] ); ?>" title="<?php echo esc_attr( $gal_img['title'] ); ?>" alt="<?php echo esc_attr( $gal_img['alt'] ); ?>" />
							</a>
							<div class="gallery-caption-wrap">
								<span class="gallery-caption"><?php echo esc_attr( $gal_img['caption'] ); ?></span>
							</div>
						</div><!-- item -->
				<?php }
				} ?>
			</div><!-- owl-carousel -->

			<!-- thumbnails -->
			<div id="sync2-<?php echo intval( $unique_key ); ?>" class="thumbnails-owl-carousel">
				
				<?php
				if ( $fave_gallery != NULL ) { 
					
					foreach ($fave_gallery as $gal_img ) { 
					$fave_thumbnail_image = wp_get_attachment_image_src($gal_img['ID'], array(120, 90));
					?>
						
						<div class="item">
							<img src="<?php echo esc_url( $fave_thumbnail_image[0] ); ?>" title="<?php esc_attr( $gal_img['title'] ); ?>" alt="<?php esc_attr( $gal_img['alt'] ); ?>" />
						</div><!-- item -->
				<?php }
				} ?>
				
			</div><!-- owl-carousel -->
		</div><!-- post-gallery-body -->
	</div><!-- post-gallery -->
</div><!-- post-gallery-wrap -->

<?php
wp_register_style( 'fave-slick-css', get_template_directory_uri(). '/slick/slick.css', array(), '1.1.2', 'all' );
wp_register_style( 'fave-slick-theme', get_template_directory_uri(). '/slick/slick-theme.css', array(), '1.1.2', 'all' );
wp_enqueue_style( 'fave-slick-css' );
wp_enqueue_style( 'fave-slick-theme' );

wp_enqueue_script( 'fave-slick.min.js', get_template_directory_uri() . '/slick/slick.min.js', 'jquery', '1.1.2', true );

if ( is_rtl() ) {
	$magzilla_rtl = 'true';
} else {
	$magzilla_rtl = 'false';
}

?>

<script type="text/javascript">
	jQuery(document).ready(function($) {

		var sync1 = $("#sync1-<?php echo intval( $unique_key ); ?>");
		var sync2 = $("#sync2-<?php echo intval( $unique_key ); ?>");

		sync1.slick({
			rtl: <?php echo $magzilla_rtl; ?>,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true,
			arrows: true,
			prevArrow: "<button type='button' class='slick-prev'><i class='fa fa-chevron-left'></i></button>",
			nextArrow: "<button type='button' class='slick-next'><i class='fa fa-chevron-right'></i></button>",
			fade: true,
			asNavFor: sync2
		});
		sync2.slick({
			rtl: <?php echo $magzilla_rtl; ?>,
			slidesToShow: 10,
			slidesToScroll: 1,
			asNavFor: sync1,
			dots: false,
			arrows: false,
			centerMode: false,
			focusOnSelect: true,
			responsive: [
				{
					breakpoint: 1199,
					settings: {
						slidesToShow: 10,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 979,
					settings: {
						slidesToShow: 8,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				},
				{
					breakpoint: 450,
					settings: {
						slidesToShow: 4,
						slidesToScroll: 1,
					}
				}
			]
		});

	});


</script>