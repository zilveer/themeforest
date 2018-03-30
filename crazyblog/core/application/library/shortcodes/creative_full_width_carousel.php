<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_creative_full_width_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_creative_full_width_carousel_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Creative Full Width Carousel", 'crazyblog' ),
				"base" => "crazyblog_creative_full_width_carousel_outpupt",
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

	public static function crazyblog_creative_full_width_carousel_outpupt( $atts, $contents = null ) {
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
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<div class="full-posts-carousel">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$format = get_post_format();
				$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
				$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
				$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
				if ( has_post_thumbnail() ):
					?>
					<div class="full-post">
						<div class="full-img">
							<?php the_post_thumbnail( 'full' ) ?>
						</div>
						<div class="full-post-detail">
							<h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
							<p><?php echo wp_trim_words( get_the_content(), 45, null ) ?></p>
							<ul class="meta">
								<li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter( get_the_ID() ) ?></li>
								<li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text( $view ) ?></li>
							</ul>
							<a class="continue" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e( 'Read More', 'crazyblog' ) ?></a>
						</div>
					</div>
					<?php
				endif;
			}
			wp_reset_postdata();
			echo '</div>';
		}
		?>
		<?php
		$custom_script = 'jQuery(document).ready(function ($) {
		        $(".full-posts-carousel").owlCarousel({
		            autoplay: false,
		            autoplayTimeout: 2500,
		            smartSpeed: 2000,
		            loop: false,
		            dots: false,
		            nav: true,
		            margin: 0,
		            mouseDrag: false,
		            singleItem: true,
		            items: 1,
		            autoHeight: true,
		            animateIn: "fadeIn",
		            animateOut: "fadeOut"
		        });
		    });';
		wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
		?>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
