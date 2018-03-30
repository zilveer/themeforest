<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_penta_overlay_post_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_penta_overlay_post_carousel_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Penta Overlay Post Carousel", 'crazyblog' ),
				"base" => "crazyblog_penta_overlay_post_carousel",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/penta-overlay-post-carousel.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts with multiple of five for awesome look (i-e 5,10,15)', 'crazyblog' )
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
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Carousel', 'crazyblog' ),
						"param_name" => "carousel",
						"value" => array( esc_html__( 'Enable Carousel', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable Careousel for posts listing.', 'crazyblog' ),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Autoplay Timeout', 'crazyblog' ),
						"param_name" => "autoplaytimeout",
						"default" => "30000",
						"description" => esc_html__( 'Enter the autoplay timeout for posts carousel', 'crazyblog' ),
						'dependency' => array(
							'element' => 'carousel',
							'value' => array( 'true' )
						),
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Smartspeed', 'crazyblog' ),
						"param_name" => "smartspeed",
						"default" => "2000",
						"description" => esc_html__( 'Enter the smartspeed time for posts carousel', 'crazyblog' ),
						'dependency' => array(
							'element' => 'carousel',
							'value' => array( 'true' )
						),
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Autoplay', 'crazyblog' ),
						"param_name" => "autoplay",
						"value" => array( esc_html__( 'Enable', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable to autoplay the carousel for posts listing', 'crazyblog' ),
						'dependency' => array(
							'element' => 'carousel',
							'value' => array( 'true' )
						),
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Loop', 'crazyblog' ),
						"param_name" => "loop",
						"value" => array( esc_html__( 'Enable', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable circular loop for the carousel of posts listing', 'crazyblog' ),
						'dependency' => array(
							'element' => 'carousel',
							'value' => array( 'true' )
						),
					),
					array(
						"type" => "checkbox",
						"class" => "",
						"heading" => esc_html__( 'Arrows Navigation', 'crazyblog' ),
						"param_name" => "nav",
						"value" => array( esc_html__( 'Enable', 'crazyblog' ) => 'true' ),
						"description" => esc_html__( 'Enable arrows navigation for the carousel of posts listing', 'crazyblog' ),
						'dependency' => array(
							'element' => 'carousel',
							'value' => array( 'true' )
						),
					),
				)
			);
		}
	}

	public static function crazyblog_penta_overlay_post_carousel( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
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

		$no_image = '';
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		$counter1 = 0;
		$counter2 = 0;
		?>

		<?php echo wp_kses_post( ($carousel == "true") ? '<div class="row"><div class="fancy-post-carousel">' : '<div class="row no-gap">'  ); ?>

		<div class="fancy-posts-style">
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php if ( $counter2 % 5 == 0 && $counter2 != 0 ) echo '</div><div class="fancy-posts-style">'; ?>
					<div class="<?php echo esc_attr( ($counter1 < 2 ) ? "col-md-6" : "col-md-4"  ); ?>">
						<div class="fancy-post">
							<?php the_post_thumbnail( ($counter1 < 2 ) ? "crazyblog_1170x590" : "crazyblog_454x344" ); ?>
							<div class="cats"><?php echo crazyblog_get_post_categories( get_the_ID() ); ?></div>
							<div class="fancy-post-overlay">
								<div class="fancy-post-inner">
									<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
									<ul class="meta">
										<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
										<li><?php esc_html_e( 'by ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
									</ul>
								</div>
							</div>
						</div><!-- Fancy Post -->
					</div>
					<?php
					$counter2++;
					$counter1++;
					if ( $counter1 == 5 )
						$counter1 = 0;
					?>
					<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<?php echo wp_kses_post( ($carousel == "true" ) ? '</div></div>' : '</div>'  ); ?>
		<?php if ( $carousel == "true" ) : ?>

			<?php crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) ); ?> 
			<?php
			$autoplay = ($autoplay) ? $autoplay : 'false';
			$autoplayTimeout = ($autoplaytimeout) ? $autoplaytimeout : '2500';
			$smartspeed = ($smartspeed) ? $smartspeed : '2000';
			$loop = ($loop) ? $loop : 'false';
			$nav = ($nav) ? $nav : 'false';
			$custom_script = 'jQuery(document).ready(function ($) {
                            $(".fancy-post-carousel").owlCarousel({
                                autoplay:' . $autoplay . ',
                                autoplayTimeout:' . $autoplayTimeout . ',
                                smartSpeed:' . $smartspeed . ',
                                autoplayHoverPause: true,
                                loop:' . $loop . ',
                                dots: false,
                                nav:' . $nav . ',
                                margin: 0,
                                mouseDrag: true,
                                singleItem: true,
                                items: 1
                            });
                        });';
			wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
		endif;
		?>

		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
