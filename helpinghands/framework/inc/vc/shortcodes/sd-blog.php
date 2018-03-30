<?php
/*-----------------------------------------------------------------------------------*/
/*	Latest Blog Items
/*-----------------------------------------------------------------------------------*/

if (!function_exists( 'sd_latest_blog_items' ) ) {
	function sd_latest_blog_items( $atts ) {
		$sd =  shortcode_atts( array(
			'latest'  => 'rb',
			'cats'	  => '',
			'items'	  => '4',
			'columns' => 'four',
		), $atts );
		
		$latest  = $sd['latest'];
		$cats    = $sd['cats'];
		$items   = $sd['items'];
		$columns = $sd['columns'];
		
		if ( $latest == 'rb' ) {
		
			$args = array(
				'post_type'           => 'post',
				'cat'                 => $cats,
				'posts_per_page'      => $items,
				'ignore_sticky_posts' => 1,
				'post_status'         => 'publish',
			);
		
		} else {
			
			$args = array(
				'post_type'           => 'events',
				'posts_per_page'      => $items,
				'ignore_sticky_posts' => 1,
				'post_status'         => 'publish',
				'meta_key'            => 'sd_dov',
				'orderby'             => 'meta_value',
				'order'               => 'DESC',
				'tax_query' => array(
					array(
						'taxonomy' => 'event_category',
						'field'    => 'term_id',
						'terms'    => array( $cats ),
					),
				),
			);
		
			if ( empty( $cats ) ) {
				unset( $args['tax_query'] );
			}
				
		}
		
		$sd_query = new WP_Query( $args );

		ob_start();
		?>
		
		<div class="row">
			<div class="sd-latest-blog-short">
					<div class="sd-latest-blog-carousel">
					<?php if ( $sd_query->have_posts() ) : while ( $sd_query->have_posts() ) : $sd_query->the_post(); ?>
						<?php if ( $columns == 'one' && $latest == 'rb' ) : ?>
							<div class="col-md-12 sd-latest-blog-wide">
								<?php get_template_part( 'framework/inc/vc/shortcodes/latest-blog/content-wide', get_post_format() ); ?>
							</div>
						<?php else : ?>
							<div class="<?php if ( $columns == 'four' ) { echo 'col-md-3 col-sm-3 col-xs-12'; } else { echo 'col-md-12 sd-latest-blog-wide'; } ?>">
								<?php get_template_part( 'framework/inc/vc/shortcodes/latest-blog/content', get_post_format() ); ?>
							</div>
							<!-- col-sm-3 col-md-3 col-sm-12 -->
						<?php endif; ?>

					<?php endwhile; endif;  wp_reset_postdata(); ?>
					</div>
					<!-- sd-latest-blog-carousel -->
			</div>
			<!-- sd-latest-blog-short -->
		</div>
		<!-- row -->
		<?php return ob_get_clean();	
	}
	add_shortcode( 'sd_blog','sd_latest_blog_items' );
}

// Register shortcode to VC

add_action( 'init', 'sd_latest_blog_items_vcmap' );

if ( ! function_exists( 'sd_latest_blog_items_vcmap' ) ) {
	function sd_latest_blog_items_vcmap() {
		vc_map( array(
			'name'              => __( 'Latest Blog/Events', 'sd-framework' ),
			'description'       => __( 'Latest blog or event items', 'sd-framework' ),
			'base'              => "sd_blog",
			'class'             => "sd_blog",
			'category'          => __( 'Helping Hands', 'sd-framework' ),
			'icon'              => "icon-wpb-sd-blog",
			'admin_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'front_enqueue_css' => get_template_directory_uri() . '/framework/inc/vc/assets/css/sd-vc-admin-styles.css',
			'params'            => array(
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Section Type', 'sd-framework' ),
					'param_name'  => 'latest',
					'value'       => array( 
										__( 'Recent Blog', 'sd-framework' )   => 'rb',
										__( 'Recent Events', 'sd-framework' ) => 're',
									 ),
					'description' => __( 'Select the type of the data to be pulled.', 'sd-framework' ),
				),
				array(
					'type'        => 'dropdown',
					'class'       => '',
					'heading'     => __( 'Layout', 'sd-framework' ),
					'param_name'  => 'columns',
					'value'       => array( 
										__( '1 Column', 'sd-framework' )  => 'one',
										__( '4 Columns', 'sd-framework' ) => 'four',
									 ),
					'std'         => 'four',
					'description' => __( 'Full Width or 4 Columns Layout. (full width is best used inside other smaller columns)', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Number of items to show', 'sd-framework' ),
					'param_name'  => 'items',
					'value'       => '4',
					'description' => __( 'Insert the number of items to show.', 'sd-framework' ),
				),
				array(
					'type'        => 'textfield',
					'class'       => '',
					'heading'     => __( 'Categories', 'sd-framework' ),
					'param_name'  => 'cats',
					'value'       => '',
					'description' => __( 'Insert the ids of the categories you want to pull posts from (optional). Comma separated. (eg. 2, 43)', 'sd-framework' ),
				),
			),
		));
	}
}