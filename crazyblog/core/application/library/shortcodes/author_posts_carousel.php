<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_author_posts_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_author_posts_carousel_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Author Post Carousel", 'crazyblog' ),
				"base" => "crazyblog_author_posts_carousel",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/author-post-carousel.png',
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
						"value" => array_flip( crazyblog_get_categories( array( 'taxonomy' => 'category', 'hide_empty' => TRUE ), true ) ),
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
				)
			);
		}
	}

	public static function crazyblog_author_posts_carousel( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );

		$aurhors = array_flip( crazyblog_get_registered_authors() );
		$category = explode( ',', $cat );
		$c = 0;
		?>
		<div class="author-post-carousel">

			<?php
			if ( !empty( $aurhors ) ) : foreach ( $aurhors as $a ) :
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'author' => $a,
					);
					if ( !empty( $category ) ) {
						$args['tax_query'] = array( array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category ) );
					}
					$query = new WP_Query( $args );
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) :
							$query->the_post();
							?>
							<div class="author-post">
								<span><?php echo get_avatar( $a, 63 ); ?></span>
								<i><?php esc_html_e( 'by ', 'crazyblog' ); ?><?php the_author(); ?></i>
								<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
							</div>
							<?php
							$c++;
						endwhile;
						wp_reset_postdata();
					endif;
				endforeach;
			endif;
			$loop = ($c > 1) ? 'true' : 'false';
			?>
		</div><!-- Author Post Carousel -->
		<?php $author_carousel = 'jQuery(document).ready(function ($) {
				$(".author-post-carousel").owlCarousel({
					autoplay: true,
					autoplayTimeout: 2500,
					smartSpeed: 2000,
					autoplayHoverPause: true,
					loop: '.esc_js( $loop ).',
					dots: false,
					nav: true,
					margin: 0,
					mouseDrag: true,
					singleItem: true,
					autoHeight: true,
					items: 1,
					animateIn: "bounceInDown",
					animateOut: "bounceOutDown"
				});
			});';
                        wp_add_inline_script('crazyblog_df-owl', $author_carousel);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
