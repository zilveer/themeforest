<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.0.0
 */

global $post, $woocommerce, $product, $yith_wcmg;

$columns = floor( yiw_shop_large_w() / ( yiw_shop_thumbnail_w() + 18 ) );

$enable_slider = (bool) ( get_option('yith_wcmg_enableslider') == 'yes' && ( count( $product->get_gallery_attachment_ids() ) + 1 ) > $columns );
?>

<div class="images">
	
	<?php if( !yith_wcmg_is_enabled() ): ?>
		
		<!-- Default Woocommerce Template -->
		<?php if ( has_post_thumbnail() ) : ?>

            <a itemprop="image" href="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>" class="zoom" rel="thumbnails[product-gallery]" title="<?php echo esc_attr( get_the_title( get_post_thumbnail_id() ) ); ?>"><?php
                $image = yit_image( array( 'size' => apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ), false );
                echo apply_filters( 'woocommerce_single_product_image_html' , $image, $post->ID );
                ?></a>
	
		<?php else : ?>
	
			<img src="<?php echo wc_placeholder_img_src(); ?>" alt="Placeholder" />
	
		<?php endif; ?>
	<?php else: ?>
		
		<!-- YITH Magnifier Template -->
		<?php if ( has_post_thumbnail() ) : ?>

            <a itemprop="image" href="<?php esc_url( yit_image( 'size=shop_magnifier&output=url' ) ); ?>" class="yith_magnifier_zoom" rel="thumbnails"><?php
                $image = yit_image( array( 'size' => apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ), false );
                echo apply_filters( 'woocommerce_single_product_image_html' , $image, $post->ID );
                ?></a>

		<?php else: ?>
			
			<img src="<?php echo wc_placeholder_img_src(); ?>" alt="Placeholder" />
			
		<?php endif ?>
		
	<?php endif ?>


	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>

<?php if( yith_wcmg_is_enabled() ): ?>
<script type="text/javascript" charset="utf-8">
var yith_magnifier_options = {
	enableSlider: <?php echo $enable_slider ? 'true' : 'false' ?>,

	<?php if( $enable_slider ): ?>
	sliderOptions: {
		//responsive: true,
		items: <?php echo $columns ?>,
		circular: <?php echo get_option('yith_wcmg_slider_circular') == 'yes' ? 'true' : 'false' ?>,
		infinite: <?php echo get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false' ?>,
		direction: '<?php echo get_option('yith_wcmg_slider_direction') == 'yes' ? 'left' : get_option('yith_wcmg_slider_direction') ?>',  
		debug: false,
		auto: false,
		align: 'left',
		prev	: {	
    		button	: "#slider-prev",
    		key		: "left"
    	},
    	next	: { 
    		button	: "#slider-next",
    		key		: "right"
    	},
        width   : 'variable',
	    scroll : {
	    	items     : 1,
	    	pauseOnHover: true
	    }, 
    	items   : {
    	    //visible: <?php echo apply_filters( 'woocommerce_product_thumbnails_columns', get_option( 'yith_wcmg_slider_items', $columns ) ) ?>,
            width: 'variable'
        }
	},
	<?php endif ?>
	
	showTitle: false,	
	zoomWidth: '<?php echo get_option('yith_wcmg_zoom_width') ?>',
	zoomHeight: '<?php echo get_option('yith_wcmg_zoom_height') ?>',
	position: '<?php echo get_option('yith_wcmg_zoom_position') ?>',
	tint: <?php echo get_option('yith_wcmg_tint') == '' ? 'false' : "'".get_option('yith_wcmg_tint')."'" ?>,
	lensOpacity: <?php echo get_option('yith_wcmg_lens_opacity') ?>,
	softFocus: <?php echo get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false' ?>,
	adjustY: 0,
	disableRightClick: false,
	phoneBehavior: '<?php echo get_option('yith_wcmg_zoom_mobile_position') ?>',
	loadingLabel: '<?php echo stripslashes(get_option('yith_wcmg_loading_label')) ?>',
    zoom_wrap_additional_css: '<?php echo apply_filters ( 'yith_ywzm_zoom_wrap_additional_css', '' ); ?>'
};
</script>
<?php endif ?>