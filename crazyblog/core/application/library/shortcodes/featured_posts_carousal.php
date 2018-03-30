<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_posts_carousal_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_posts_carousal_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Fancy Posts Carousal", 'crazyblog' ),
				"base" => "crazyblog_featured_posts_carousal",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/post-with-ajax-navigation.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts with multiple of five for awesome look (i-e 3,6,9). "Note: For use Pagination please leave blank"', 'crazyblog' )
					),
					array(
						"type" => "multiselect",
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
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Description', 'crazyblog' ),
						"param_name" => "show_desc",
						"value" => array( esc_html__( 'Show', 'crazyblog' ) => 'true', esc_html__( 'Hide', 'crazyblog' ) => 'false' ),
						"description" => esc_html__( "Show/Hide Description", 'crazyblog' )
					)
				)
			);
		}
	}

	public static function crazyblog_featured_posts_carousal( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );

		$category = explode( ',', $cat );
		global $wp_query;
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
			'posts_per_page' => get_option( 'posts_per_page' ),
		);
		if ( !empty( $category ) ) {
			$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category ) );
		}
		$query = new WP_Query( $args );
		?>
		<div class="mainslide-carousel">
			<?php
			if ( $query->have_posts() ) {
				$counter = 0;
				while ( $query->have_posts() ) {
					$query->the_post();
					if ( has_post_thumbnail() ) {
						?>
						<div class="slide-carousel-post">
							<?php the_post_thumbnail( 'crazyblog_1170x380' ) ?>
							<div class="slider-postdetail">
								<ul class="slider-postinfo">
									<li>
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 46 ); ?>
									</li>
									<li>
										<?php esc_html_e( 'By ', 'crazyblog' ) ?> 
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title=""><?php the_author(); ?></a>
									</li>
								</ul>
								<h4>
									<a href="<?php the_permalink() ?>" title=""><?php the_title() ?></a></h4>
								<div class="social-share">
									<strong><?php esc_html_e( 'Share This', 'crazyblog' ) ?>:</strong>
									<ul>
										<?php crazyblog_social_share_output2( array( 'facebook', 'twitter', 'google-plus', 'reddit' ), false, false, true ); ?>
									</ul>
								</div>
							</div>
						</div>
						<?php
						$contents++;
					}
				}
				wp_reset_postdata();
			}
			$loop = ($counter > 1) ? 'true' : 'false';
			?> 
		</div>
		<?php
                    $custom_script = 'jQuery(document).ready(function ($) {
				$(".mainslide-carousel").owlCarousel({
					autoplay: true,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: '.esc_js( $loop ).',
					dots: false,
					nav: false,
					margin: 0,
					mouseDrag: true,
					singleItem: true,
					autoHeight: true,
					items: 1,
					animateIn: "fadeIn",
					animateOut: "fadeOut"
				});
			});';
                    wp_add_inline_script('crazyblog_df-owl', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
