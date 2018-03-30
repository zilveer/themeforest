<?php
/**
 * Single Campaign Item VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_single_campaign' ) ) {
	function sd_single_campaign( $atts ) {
		$sd = shortcode_atts( array(
			'id' => '',
		), $atts );
		
		$id = $sd['id'];
		
		$sd_campaign  = new ATCF_Campaign( $id );
		
		global $post;
		
		$args = array(
			'post_type'   => 'download',
			'numberposts' => 1,
			'post__in'    => array( $id ),
		);

		$sd_query = get_posts( $args );
	
		$sd_days      = $sd_campaign->days_remaining();
		$sd_goal      = rtrim( rtrim( $sd_campaign->goal(), '0' ), '.' );
		$sd_raised    = rtrim( rtrim( $sd_campaign->current_amount(), '0'), '.' );
		$hide_button  = rwmb_meta('sd_hide_donate_button');
		$hide_bar     = rwmb_meta('sd_hide_donate_bar');
		$hide_details = rwmb_meta('sd_hide_donation_details');
			
		//print_r( get_class_methods( $sd_campaign ) );
	
		ob_start();

	?>

		<div class="row">
			<?php foreach ( $sd_query as $post ) : setup_postdata( $post ); ?>
			<div class="col-md-4">
				<div class="sd-single-shortcode-campaign">
					<?php if ( $sd_campaign->featured() == 1 ) : ?>
						<span class="sd-featured-label"><?php _e( 'FEATURED', 'sd-framework' ); ?></span>
					<?php endif; ?>
					
					<?php if ( ! $sd_campaign->is_endless() ) : ?>
						<span class="sd-days-left <?php if ( $sd_campaign->featured() !== '1' ) { echo 'sd-left'; } ?>"><?php printf( __( '%s DAYS LEFT', 'sd-framework' ), $sd_days ); ?></span>
					<?php endif; ?>
					<div class="clearfix"></div>
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					
					<div class="sd-campaign-excerpt">
						<p><?php echo $post->post_excerpt; ?></p>
					</div>
					<?php if ( $hide_details !== '1' ) : ?>
						<span class="sd-raised"><span><?php _e( 'RAISED', 'sd-framework' ); ?></span> <?php echo $sd_raised; ?></span>
						<span class="sd-goal"><span><?php _e( 'GOAL', 'sd-framework' ); ?></span> <?php echo $sd_goal; ?></span>
					<?php endif; ?>
					<div class="clearfix"></div>
					<?php if ( $hide_button !== '1' ) : ?>
						<div class="sd-donate-button-wrapper">
							<?php $custom_url = rwmb_meta('sd_custom_donate_button_url'); ?>
							<?php if ( ! empty( $custom_url ) ) : ?>
							<a class="sd-custom-url-donate sd-opacity-trans" href="<?php echo esc_url( $custom_url ); ?>" title="<?php _e( 'DONATE NOW', 'sd-framework' ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
						<?php else : ?>
							<a class="sd-donate-button sd-opacity-trans" data-campaign-id="<?php echo esc_attr( $sd_campaign->ID ); ?>"><?php _e( 'DONATE NOW', 'sd-framework' ); ?></a>
						<?php endif; ?>
						</div>
						<!-- sd-donate-button-wrapper -->
					<?php endif; ?>
				</div>
				<!-- sd-single-shortcode-campaign -->
			</div>
			<!-- cold-md-3 -->
		</div>
		<!-- row -->
		
	
		<?php endforeach; wp_reset_postdata(); ?>	
			

		<?php 
			$out = ob_get_clean();
			
			return $out;
	}
	add_shortcode( 'sd_single_campaign', 'sd_single_campaign' );
}

// Register shortcode to VC

add_action( 'init', 'sd_single_campaign_vcmap' );

if ( ! function_exists( 'sd_single_campaign_vcmap' ) ) {
	function sd_single_campaign_vcmap() {
		vc_map( array(
			'name'              => __( 'Single Campaign', 'sd-framework' ),
			'description'       => __( 'Insert a single campaign.', 'sd-framework' ),
			'base'              => "sd_single_campaign",
			'class'             => "sd_single_campaign",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-signle-campaign",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Campaign Id', 'sd-framework' ),
					'param_name'  => 'id',
					'value'       => '',
					'description' => __( 'Insert the id of this campaign.', 'sd-framework' ),
				),
			),
		));
	}
}