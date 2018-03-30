<?php
/**
 * Single Featured Campaign VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if (!function_exists( 'sd_single_campaign_featured' ) ) {
	function sd_single_campaign_featured( $atts ) {
		$sd = shortcode_atts( array(
			'id'             => '',
			'style'          => '',
			'show_backers'   => '',
			'donors_title'   => '',
			'btn_bg_color'   => '',
			'line_color'     => '',
			'btn_text_color' => '',
			'text_circle'    => '',
			'raised_text'    => '',
		), $atts );
		
		$id             = $sd['id'];
		$style          = $sd['style'];
		$show_backers   = $sd['show_backers'];
		$donors_title   = $sd['donors_title'];
		$btn_bg_color   = $sd['btn_bg_color'];
		$line_color     = $sd['line_color'];
		$btn_text_color = $sd['btn_text_color'];
		$text_circle    = $sd['text_circle'];
		$raised_text    = $sd['raised_text'];
		
		$sd_campaign    = new ATCF_Campaign( $id );
		
		$btn_bg_color   = ( ! empty( $btn_bg_color ) ? 'background-color: ' . $btn_bg_color . ';' : '' );
		$btn_text_color = ( ! empty( $btn_text_color ) ? 'color: ' . $btn_text_color . ';' : '' );
		$line_style     = ( ! empty( $line_color ) ? 'background-color: ' . $line_color . ';' : '' );
		$text_circle    = ( ! empty( $text_circle ) ? 'style="color: ' . $text_circle . ';"' : '' );
		$raised_text    = ( ! empty( $raised_text ) ? 'style="color: ' . $raised_text . ';"' : '' );
		
		$btn_style      = ( ! empty( $btn_bg_color) || ! empty( $btn_text_color ) ) ? 'style="' . $btn_bg_color . $btn_text_color . '"' : '';
		
		global $post;
		
		$args = array(
			'post_type'   => 'download',
			'numberposts' => 1,
			'post__in'    => array( $id ),
		);

		$sd_query = get_posts( $args );
	
		$sd_days    = $sd_campaign->days_remaining();
		$sd_goal    = rtrim( rtrim( $sd_campaign->goal(), '0' ), '.' );
		$sd_raised  = rtrim( rtrim( $sd_campaign->current_amount(), '0'), '.' );
		$sd_percent = $sd_campaign->percent_completed( 'raw' ) > 100 ? '100%' : $sd_campaign->percent_completed();
		$sd_backers = $sd_campaign->backers();
			
		//print_r( get_class_methods( $sd_campaign ) );

		ob_start();

	?>
		<div class="sd-single-campaign-featured">
			<?php foreach ( $sd_query as $post ) : setup_postdata( $post ); ?>
				<?php 
					if ( $style == 1 ) {
						require_once( 'sd-single-campaign-featured/style-1.php');
					} else {
						require_once( 'sd-single-campaign-featured/style-2.php');
					}
				?>
				<?php if ( $show_backers == 1 ) : ?>
					<?php if ( ! empty( $sd_backers ) ) : ?>
						<div class="sd-campaign-backers">
							<?php if ( !empty( $donors_title ) ) : ?>
								<h4><?php echo $donors_title; ?></h4>
							<?php endif; ?>
							<div class="row">
					
						<?php
							$i = 0;
							
							foreach ( $sd_backers as $sd_backer ) : 
				
								$sd_payment_id = get_post_meta( $sd_backer->ID, '_edd_log_payment_id', true );
								$sd_payment    = get_post( $sd_payment_id );
				
								if ( ! is_object( $sd_payment ) )
									continue;
				
								$sd_meta      = edd_get_payment_meta( $sd_payment->ID );
								$sd_user_info = edd_get_payment_meta_user_info( $sd_payment_id );
				
								if ( empty( $sd_user_info ) )
									continue;
				
								$sd_anonymous = isset ( $sd_meta[ 'anonymous' ] ) ? $sd_meta[ 'anonymous' ] : 0;
							?>
								<div class="col-md-2 col-xs-6 col-sm-2 sd-backer">
									<?php echo get_avatar( $sd_anonymous ? '' : $sd_user_info[ 'email' ], 165 ); ?>
									<div class="sd-backer-title">
										<?php if ( $sd_anonymous ) : ?>
											<?php _ex( 'Anonymous', 'Donor chose to hide their name', 'sd-framework' ); ?>
										<?php else : ?>
											<?php echo $sd_user_info[ 'first_name' ]; ?> <?php echo $sd_user_info[ 'last_name' ]; ?>
										<?php endif; ?>
										<span>
											<?php _e( 'Donated', 'sd-framework' ); ?>
											<?php
												$sd_payment_meta = edd_get_payment_meta( $sd_payment_id );
												$sd_cart_details = $sd_payment_meta['cart_details']; 
												$id_price        = array_column( $sd_cart_details, 'price', 'id');
												$sd_final_amount = edd_currency_filter( edd_format_amount( $id_price[get_the_ID()] ) );
												
												echo rtrim( rtrim( $sd_final_amount, '0'), '.' );
											?>
										</span>
									</div>
									<!-- sd-backer-title -->
								</div>
								<!-- col-md-2 -->
						<?php
							if ( $i++ == 5 ) break; 
							endforeach;  
						?>
							</div>
							<!-- row -->
						</div>
						<!-- sd-campaign-backers -->
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; wp_reset_postdata(); ?>	
		</div>
		<!-- sd-single-campaign-featured -->

		<?php 
			$out = ob_get_clean();
			
			return $out;
	}
	add_shortcode( 'sd_single_campaign_featured', 'sd_single_campaign_featured' );
}

// Register shortcode to VC

add_action( 'init', 'sd_single_campaign_featured_vcmap' );

if ( ! function_exists( 'sd_single_campaign_featured_vcmap' ) ) {
	function sd_single_campaign_featured_vcmap() {
		vc_map( array(
			'name'              => __( 'Single Campaign Featured', 'sd-framework' ),
			'description'       => __( 'Insert a single featured campaign.', 'sd-framework' ),
			'base'              => "sd_single_campaign_featured",
			'class'             => "sd_single_campaign_featured",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-signle-campaign-featured",
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
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Campaign Style', 'sd-framework' ),
					'param_name'  => 'style',
					'value'       => array( 
										__( 'Style 1 (bar)', 'sd-framework' )    => '1',
										__( 'Style 2 (circle)', 'sd-framework' ) => '2',
									 ),
					'save_always' => true,
					'std'         => '1',
					'description' => __( 'Select the style layout.', 'sd-framework' ),
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Display Donors?', 'sd-framework' ),
					'param_name'  => 'show_backers',
					'value'       => array( 
										__( 'Yes', 'sd-framework' ) => '1',
										__( 'No', 'sd-framework' )  => '2',
									 ),
					'description' => __( 'Display latest campaign donors', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Donors Section Title', 'sd-framework' ),
					'param_name'  => 'donors_title',
					'value'       => __( 'OUR VALUABLE DONORS', 'sd-framework' ),
					'description' => __( 'Insert the title of the donors section.', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Line Color/Circle', 'sd-framework' ),
					'param_name'  => 'line_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Button Background Color', 'sd-framework' ),
					'param_name'  => 'btn_bg_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Button Text Color', 'sd-framework' ),
					'param_name'  => 'btn_text_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Text Inside Circle (circle style only)', 'sd-framework' ),
					'param_name'  => 'text_circle',
					'group'       => __( 'Styling', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( '2' ),
					),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Raised Text Color (circle style only)', 'sd-framework' ),
					'param_name'  => 'raised_text',
					'group'       => __( 'Styling', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'style',
						'value'   => array( '2' ),
					),
				),
			),
		));
	}
}