<?php
/**
 * Staff VC Shortcode
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'sd_staff' ) ) {
	function sd_staff( $atts ) {
		$sd = shortcode_atts( array(
			'type'  => '1',
			'items' => '',
			'cols'  => '',
			'ids'   => '',
			'slug'  => '',
		), $atts );
		
		$type = $sd['type'];
		$slug = $sd['slug'];
		$cols = ( ! empty( $sd['cols'] ) ) ? $sd['cols'] : '3';
		$cols = esc_attr( $cols );
		$ids  = $sd['ids'];
		
		if ( $type == '2' ) {
			$items = '1';	
		} else {
			$items = $sd['items'];	
		}
		
		if ( ! empty( $ids ) ) {
			$ids = explode( ", ", ", $ids  " );
		}

		
		$args = array(
			'post_type'      => 'staff',
			'posts_per_page' => $items,
			'post_status'    => 'publish',
			'name'           => $slug,
			'post__in'       => $ids,
		);
		
		if ( empty( $ids ) ) {
			unset( $args['post__in'] );
		} else if ( $type == '2' ) {
			unset( $args['post__in'] );
		} else if ( $type == '1' ) {
			unset( $args['name'] );
		}

		$staff_query = new WP_Query( $args );

		ob_start();
	?>
		<div class="sd-staff">
			<div class="row">
				<?php $i = 0; ?>
				<?php if ( $staff_query->have_posts() ) : while ( $staff_query->have_posts() ) : $staff_query->the_post(); ?> 
				
					<?php $position = rwmb_meta( 'sd_staff_position' );	?>
					
					<?php if ( $type == '1' ) : ?>
					
						<div class="sd-staff-col col-md-<?php echo $cols; ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<figure>
									<?php the_post_thumbnail( 'sd-staff-thumbs' ); ?>
								</figure>
							<?php endif; ?>
							<div class="sd-staff-content">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<?php if ( !empty( $position ) ) : ?> 
									<span class="sd-staff-position"><?php echo $position; ?></span>
								<?php endif; ?>
								
							</div>
							<!-- sd-staff-content -->
						</div>
						<!-- sd-staff-col col-md-3 -->
						<?php
							$i++;
							if ( $cols == 3 )  {
								if ( $i == 4 ) {
									echo '<div class="clearfix"></div>';
									$i = 0;
								}
							} elseif ( $cols == 2 ) {
								if ( $i == 6 ) {
									echo '<div class="clearfix"></div>';
									$i = 0;
								}
							}
						?>
					<?php elseif ( $type == '2' ) : ?>
					
						<div class="sd-staff-col col-md-12 sd-staff-featured">
							<?php if ( has_post_thumbnail() ) : ?>
								<figure>
									<?php the_post_thumbnail( 'sd-staff-thumbs' ); ?>
								</figure>
							<?php endif; ?>
							<div class="sd-staff-content">
								<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<?php if ( !empty( $position ) ) : ?> 
									<span class="sd-staff-position"><?php echo $position; ?></span>
								<?php endif; ?>
								
							</div>
							<!-- sd-staff-content -->
						</div>
						<!-- sd-staff-col col-md-3 -->
					
					<?php endif; ?>
				<?php endwhile; endif;  wp_reset_postdata(); ?>
			</div>
		</div>	
	
<?php
		return ob_get_clean();	
	}
	add_shortcode( 'sd_staff','sd_staff' );
}

// register shortcode to VC

add_action( 'init', 'sd_staff_vcmap' );

if ( ! function_exists( 'sd_staff_vcmap' ) ) {
	function sd_staff_vcmap() {
		vc_map( array(
			'name'              => __( 'Staff', 'sd-framework' ),
			'description'       => __( 'Staff Members', 'sd-framework' ),
			'base'              => "sd_staff",
			'class'             => "sd_staff",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-staff",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Type', 'sd-framework' ),
					'param_name'  => 'type',
					'value'       => array( 
						__( 'Items Grid', 'sd-framework' )            => '1',
						__( 'Single Featured Item', 'sd-framework' )  => '2',
					),
					'description' => __( 'Select the type of content you want to display.', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Post Slug', 'sd-framework' ),
					'param_name'  => 'slug',
					'value'       => '',
					'description' => __( 'Insert the slug of the featured staff member (eg. john-doe)', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'type',
						'value'	  => array( '2' ),
					),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number of items to display', 'sd-framework' ),
					'param_name'  => 'items',
					'value'       => '4',
					'description' => __( 'Insert the number of items to be displayed.', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'type',
						'value'	  => array( '1' ),
					),
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Columns', 'sd-framework' ),
					'param_name'  => 'cols',
					'value'       => array( 
						__( 'Four', 'sd-framework' ) => '3',
						__( 'Six', 'sd-framework' )  => '2',
					),
					'description' => __( 'Select the number of columns.', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'type',
						'value'	  => array( '1' ),
					),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Items IDs', 'sd-framework' ),
					'param_name'  => 'ids',
					'value'       => '',
					'description' => __( 'Optional. Insert the items ids you want to display (comma separated, eg. 3, 5).', 'sd-framework' ),
					'dependency'  => array(
						'element' => 'type',
						'value'	  => array( '1' ),
					),
				),
			),
		));
	}
}