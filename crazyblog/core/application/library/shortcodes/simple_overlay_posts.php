<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_simple_overlay_posts_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_simple_overlay_posts_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Simple Overlay Post Carousel", 'crazyblog' ),
				"base" => "crazyblog_simple_overlay_posts",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/simple-overlay-post-carousel.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts', 'crazyblog' )
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Select Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => array_flip( crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => true ), true ) ),
						"description" => esc_html__( 'Choose posts categories for which posts you want to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Order', 'crazyblog' ),
						"param_name" => "order",
						"value" => array( esc_html__( 'Ascending', 'crazyblog' ) => 'ASC', esc_html__( 'Descending', 'crazyblog' ) => 'DESC' ),
						"description" => esc_html__( "Select sorting order ascending or descending for posts listing", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Order By", 'crazyblog' ),
						"param_name" => "orderby",
						"value" => array_flip( array( 'date' => esc_html__( 'Date', 'crazyblog' ), 'title' => esc_html__( 'Title', 'crazyblog' ), 'name' => esc_html__( 'Name', 'crazyblog' ), 'author' => esc_html__( 'Author', 'crazyblog' ), 'comment_count' => esc_html__( 'Comment Count', 'crazyblog' ), 'random' => esc_html__( 'Random', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select order by method for posts listing", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Autoplay Timeout', 'crazyblog' ),
						"param_name" => "autoplaytimeout",
						"default" => "30000",
						"description" => esc_html__( 'Enter the autoplay timeout for posts carousel', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Smartspeed', 'crazyblog' ),
						"param_name" => "smartspeed",
						"default" => "2000",
						"description" => esc_html__( 'Enter the smartspeed time for posts carousel', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Margin', 'crazyblog' ),
						"param_name" => "margin",
						"default" => "30",
						"description" => esc_html__( 'Enter the margin for posts listing', 'crazyblog' ),
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Autoplay', 'crazyblog' ),
						"param_name" => "autoplay",
						"value" => array( esc_html__( 'Enable', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable to autoplay the carousel for posts listing', 'crazyblog' ),
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Loop', 'crazyblog' ),
						"param_name" => "loop",
						"value" => array( esc_html__( 'Enable', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable circular loop for the carousel of posts listing', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Desktop Item', 'crazyblog' ),
						"param_name" => "desktop_item",
						"description" => esc_html__( 'Enter number of posts to show on desktop screen', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Mobile Item', 'crazyblog' ),
						"param_name" => "mobile_item",
						"description" => esc_html__( 'Enter number of posts to show on mobile screen', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_simple_overlay_posts( $atts, $contents = null ) {

		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$category = explode( ',', $cat );

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
		);
		if ( !empty( $category ) )
			$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category ) );

		$query = new WP_Query( $args );
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		?>

		<div class="posts-carousel none">
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ): $query->the_post(); ?>
					<div class="post-item">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_343x241' ); ?></a>
						<div class="post-item-hover">
							<div class="post-item-center">
								<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
								<span ><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
								<a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
							</div>
						</div>
					</div><!-- Post Item -->
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<?php 
                   
                    $autoplayTimeout = ($autoplaytimeout) ? $autoplaytimeout : '2500';
                    $smartspeed = ($smartspeed) ? $smartspeed : '2000';
                    $loop = ($loop) ? $loop : 'false';
                    $margin = ($margin) ? $margin : "0";
                    $items = ($desktop_item) ? $desktop_item : 4;
                    $mobile_item = ($mobile_item) ? $mobile_item : 4;
		    $custom_script = 'jQuery(document).ready(function ($) {
		        jQuery(".posts-carousel").owlCarousel({
		            autoplay: true,
		            autoplayTimeout:'.$autoplayTimeout.',
		            smartSpeed:'.$smartspeed.',
		            autoplayHoverPause: true,
		            loop:'.$loop.',
		            dots: false,
		            nav: false,
		            margin:'.$margin.',
		            mouseDrag: true,
		            singleItem: true,
		            autoHeight: true,
		            items:'.$items.',
		            responsive: {
		                1200: {items:'.$items.'},
		                980: {items: 3},
		                768: {items: 2},
		                480: {items:'.$mobile_item.'},
		                0: {items: 1}
		            }
		        });
		        $("div.posts-carousel").show();
		    });';
		wp_add_inline_script('crazyblog_df-owl', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
