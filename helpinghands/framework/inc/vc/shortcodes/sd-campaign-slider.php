<?php
/**
 * Campaign Slider VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_campaign_slider' ) ) {
	function sd_campaign_slider( $atts ) {
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
		<div class="sd-campaign-slider-wrap">
			<div class="flexslider sd-campaign-slider">
				<ul class="slides">
				<?php foreach ( $sd_query as $post ) : setup_postdata( $post ); ?>
					<li><?php get_template_part('framework/inc/vc/shortcodes/sd-campaign-slider/sd-campaign-item-slider'); ?></li>
				<?php endforeach; wp_reset_postdata(); ?>
				</ul>
			</div>
		</div>

		<?php 
			$out = ob_get_clean();
			
			
			
			return $out;
	}
	add_shortcode( 'sd_campaign_slider', 'sd_campaign_slider' );
}

// Register shortcode to VC

add_action( 'init', 'sd_campaign_slider_vcmap' );

if ( ! function_exists( 'sd_campaign_slider_vcmap' ) ) {
	function sd_campaign_slider_vcmap() {
		vc_map( array(
			'name'              => __( 'Campaign Slider', 'sd-framework' ),
			'description'       => __( 'Insert a campaign slider.', 'sd-framework' ),
			'base'              => "sd_campaign_slider",
			'class'             => "sd_campaign_carousel",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-campaign-slider",
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