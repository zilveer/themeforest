<?php
/**
 * Campaign Carousel VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_campaign_carousel' ) ) {
	function sd_campaign_carousel( $atts ) {
		$sd = shortcode_atts( array(
			'cats'  => '',
			'items' => '4',
		), $atts );
		
		$cats  = $sd['cats'];
		$items = $sd['items'];
		
		if ( ! empty( $cats ) ) {
			$cats = explode( ", ", ", $cats  " );
		}
		
		global $post;
		
		ob_start();
		
		$args = array(
			'post_type'   => 'download',
			'numberposts' => $items,
			'tax_query' => array(
				array(
					'taxonomy' => 'download_category',
					'field'    => 'term_id',
					'terms'    => $cats,
				),
			),
		);
		
		if ( empty( $cats ) ) {
			unset( $args['tax_query'] );
		}

		$sd_query = get_posts( $args );
		
		$carousel_id = mt_rand( 10, 1000 );

		?>
		
		<div class="row sd-carousel-row">
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('.sd-campaign-carousel-<?php echo esc_attr( $carousel_id ); ?>').slick({
						dots: true,
						arrows: false,
						infinite: false,
						autoplay: false,
						speed: 300,
						slidesToShow: 3,
						slidesToScroll: 1,
						responsive: [
						{
						  breakpoint: 1024,
						  settings: {
							slidesToShow: 3,
							slidesToScroll: 1,
							infinite: false,
							dots: true
						  }
						},
						{
						  breakpoint: 992,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 1,
							infinite: false,
							dots: true
						  }
						},
						{
						  breakpoint: 600,
						  settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						  }
						},
						{
						  breakpoint: 480,
						  settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						  }
						}
						]
					});
				});
				</script>
			<div class="sd-campaign-carousel-<?php echo esc_attr( $carousel_id ); ?>">
				<?php foreach ( $sd_query as $post ) : setup_postdata( $post ); ?>
					<div class="col-md-4">
						<?php get_template_part('framework/inc/vc/shortcodes/sd-campaign-carousel/sd-campaign-item-carousel'); ?>
					</div>
					<!-- col-md-4 -->
				<?php endforeach; wp_reset_postdata(); ?>	
			</div>
		</div>
		<!-- row -->
		
			
		

		<?php 
			$out = ob_get_clean();
			
			
			
			return $out;
	}
	add_shortcode( 'sd_campaign_carousel', 'sd_campaign_carousel' );
}

// Register shortcode to VC

add_action( 'init', 'sd_campaign_carousel_vcmap' );

if ( ! function_exists( 'sd_campaign_carousel_vcmap' ) ) {
	function sd_campaign_carousel_vcmap() {
		vc_map( array(
			'name'              => __( 'Campaign Carousel', 'sd-framework' ),
			'description'       => __( 'Insert a campaign carousel.', 'sd-framework' ),
			'base'              => "sd_campaign_carousel",
			'class'             => "sd_campaign_carousel",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-campaign-carousel",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Category Ids', 'sd-framework' ),
					'param_name'  => 'cats',
					'value'       => '',
					'description' => __( 'Insert the id of the categories to pull campaigns from (eg. 1,3,5). Leave empty to display all campaigns.', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number of Items', 'sd-framework' ),
					'param_name'  => 'items',
					'value'       => '',
					'description' => __( 'Insert the number of items to show in the carousel. Default is 4.', 'sd-framework' ),
				),
			),
		));
	}
}