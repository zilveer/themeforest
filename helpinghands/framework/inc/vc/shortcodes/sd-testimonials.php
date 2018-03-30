<?php
/**
 * Testimonials VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'sd_testimonials' ) ) {
	function sd_testimonials( $atts ) {
		$sd = shortcode_atts( array(
			'items'       => '3',
			'bg_color'    => '',
			'quote_color' => '',
			'text_color'  => '',
			'name_color'  => '',
			'desc_color'  => '',
		), $atts );
		
		$items       = $sd['items'];
		$bg_color    = $sd['bg_color'];
		$quote_color = $sd['quote_color'];
		$text_color  = $sd['text_color'];
		$name_color  = $sd['name_color'];
		$desc_color  = $sd['desc_color'];
		
		$args = array(
			'post_type'      => 'testimonials',
			'post_status'    => 'publish',
			'posts_per_page' => $items,
		);
		
		$triangle_color = ( !empty( $bg_color) ? 'style="color: ' . $bg_color . ';"' : '' );
		$bg_color = ( !empty( $bg_color) ? 'style="background-color: ' . $bg_color . ';"' : '' );
		$quote_color = ( !empty( $quote_color) ? 'style="color: ' . $quote_color . ';"' : '' );
		$name_color = ( !empty( $name_color) ? 'style="color: ' . $name_color . ';"' : '' );
		$desc_color = ( !empty( $desc_color) ? 'style="color: ' . $desc_color . ';"' : '' );

		$testimonials_query = new WP_Query( $args );
		
		$rand = mt_rand( 10, 1000 );
		
		ob_start();
	?>
		<?php if ( !empty( $text_color ) ) : ?>
			<style type = "text/css" scoped>
				.sd-testimonial-<?php echo $rand; ?> p {
					color: <?php echo $text_color; ?>;
				}
			</style>
		<?php endif; ?>
		<div class="sd-testimonials">
			<div class="row">
			
				<?php $i = 0; ?>
			
				<?php if ( $testimonials_query->have_posts() ) : while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post(); $i++ ?> 
		
					<div class="col-md-4 <?php if ( $items > '3' ) echo 'sd-margin-bottom'; ?>">
						<div class="sd-testimonial-wrapper">
							<div class="sd-testimonial <?php echo !empty( $text_color ) ? 'sd-testimonial-' . $rand : ''; ?>" <?php echo $bg_color; ?>>
								<span class="sd-open-quote" <?php echo $quote_color; ?>>&ldquo;</span>
								<?php the_content(); ?>
								<i class="fa fa-caret-down sd-testimonial-arrow" <?php echo $triangle_color; ?>></i>
							</div>
							<!-- sd-testimonial -->
							<?php $desc = rwmb_meta( 'sd_testimonial_desc' ); ?>
							<h4 class="sd-testimonial-author" <?php echo $name_color; ?>><?php the_title(); ?></h4>
							<?php if ( !empty( $desc ) ) : ?>
								<span class="sd-testimonial-desc" <?php echo $desc_color; ?>><?php echo $desc; ?></span>
							<?php endif; ?>
						</div>
						<!-- sd-testimonial-wrapper -->
					</div>
					<!-- col-md-4 -->
				<?php
					if ( $i == 3 ) {
						echo '<div class="clearfix"></div>';
						$i = 0;
					}
				?>
			
				<?php endwhile; endif;  wp_reset_postdata(); ?>
			</div>
			<!-- row -->
		</div>
		<!-- sd-testimonials -->
	
<?php
		return ob_get_clean();	
	}
	add_shortcode( 'sd_testimonials','sd_testimonials' );
}

// register shortcode to VC

add_action( 'init', 'sd_testimonials_vcmap' );

if ( ! function_exists( 'sd_testimonials_vcmap' ) ) {
	function sd_testimonials_vcmap() {
		vc_map( array(
			'name'              => __( 'Testimonials', 'sd-framework' ),
			'description'       => __( 'Testimonials slider', 'sd-framework' ),
			'base'              => "sd_testimonials",
			'class'             => "sd_testimonials",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-testimonials",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number of items to display', 'sd-framework' ),
					'param_name'  => 'items',
					'value'       => '3',
					'description' => __( 'Insert the number of items to be displayed.', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Background Color', 'sd-framework' ),
					'param_name'  => 'bg_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Text Color', 'sd-framework' ),
					'param_name'  => 'text_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Name Color', 'sd-framework' ),
					'param_name'  => 'name_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Position Color', 'sd-framework' ),
					'param_name'  => 'desc_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Quote Color', 'sd-framework' ),
					'param_name'  => 'quote_color',
					'group'       => __( 'Styling', 'sd-framework' ),
				),
			),
		));
	}
}