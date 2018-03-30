<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_posts_with_thumb_tabs_VC_ShortCode extends crazyblog_VC_ShortCode {

	static $counter = 0;

	public static function crazyblog_featured_posts_with_thumb_tabs_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured Posts With Thumb Tabs", 'crazyblog' ),
				"base" => "crazyblog_featured_posts_with_thumb_tabs_outpupt",
				"icon" => crazyblog_URI . '',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Number of Posts', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter the number of posts to show', 'crazyblog' )
					),
					array(
						"type" => "multiselect",
						"class" => "",
						"heading" => esc_html__( 'Select Categories', 'crazyblog' ),
						"param_name" => "cat",
						"value" => crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => true ), true ),
						"description" => esc_html__( 'Choose posts categories for which posts you want to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Order', 'crazyblog' ),
						"param_name" => "order",
						"value" => array(
							esc_html__( 'Ascending', 'crazyblog' ) => 'ASC',
							esc_html__( 'Descending', 'crazyblog' ) => 'DESC'
						),
						"description" => esc_html__( "Select sorting order ascending or descending for posts listing", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Character Limit', 'crazyblog' ),
						"param_name" => "limit",
						"description" => esc_html__( 'Enter the Character limit', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Order By", 'crazyblog' ),
						"param_name" => "orderby",
						"value" => array_flip(
								array(
									'date' => esc_html__( 'Date', 'crazyblog' ),
									'title' => esc_html__( 'Title', 'crazyblog' ),
									'name' => esc_html__( 'Name', 'crazyblog' ),
									'author' => esc_html__( 'Author', 'crazyblog' ),
									'comment_count' => esc_html__( 'Comment Count', 'crazyblog' ),
									'random' => esc_html__( 'Random', 'crazyblog' )
								)
						),
						"description" => esc_html__( "Select order by method for posts listing", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_featured_posts_with_thumb_tabs_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';

		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
			'category_name' => $cat,
		);
		$char = (!empty( $limit )) ? $limit : 15;
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$query = new WP_Query( $args );
		$counter = 0;
		if ( $query->have_posts() ) {
			echo '<div class="featured-tabs-wrapper"><div class="featured-tab-carousel">';
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( has_post_thumbnail() ):
					?>
					<div data-hash="tabthumb<?php echo esc_attr( $counter . self::$counter ) ?>" class="featured-tab-post">
						<?php the_post_thumbnail( 'crazyblog_770x458' ) ?>
						<div class="featured-post-desc">
							<div class="featured-post-inner">
								<h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
								<p><?php echo wp_trim_words( get_the_content(), $char, null ) ?></p>
							</div>
						</div>
					</div>
					<?php
				endif;
				$counter++;
			}
			echo '</div><div class="featured-thumbs"><div class="row">';
			wp_reset_postdata();
			$counter2 = 0;
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( has_post_thumbnail() ):
					?>
					<div class="col-md-3">
						<div class="featured-thumb">
							<a class="image-link url" href="#tabthumb<?php echo esc_attr( $counter2 . self::$counter ) ?>" title="">
								<?php the_post_thumbnail( 'crazyblog_462x343' ) ?>
							</a>
							<h5><?php the_title() ?></h5>
						</div><!-- Featured Thumb -->
					</div>
					<?php
				endif;
				$counter2++;
			}
			wp_reset_postdata();
			echo '</div></div></div>';
		}
		?>
		<?php
		$custom_script = 'jQuery(document).ready(function ($) {
				$(".featured-tab-carousel").owlCarousel({
					autoplay: false,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: false,
					dots: false,
					nav: false,
					margin: 0,
					mouseDrag: true,
					singleItem: true,
					URLhashListener: true,
					startPosition: "URLHash",
					autoHeight: true,
					items: 1,
					animateIn: "fadeIn",
					animateOut: "fadeOut"
				});
			});';
		wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
