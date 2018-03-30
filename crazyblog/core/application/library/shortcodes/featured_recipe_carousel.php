<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_recipe_carousel_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_recipe_carousel_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured Recipe Carousel", 'crazyblog' ),
				"base" => "crazyblog_featured_recipe_carousel_outpupt",
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
						"value" => crazyblog_get_categories( array( 'taxonomy' => 'recipe_category', 'hide_empty' => true ), true ),
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
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Item Padding', 'crazyblog' ),
						"param_name" => "padding",
						"description" => esc_html__( 'Enter the number of item\' padding: Default is 195', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_featured_recipe_carousel_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		echo '<div class="bigguide">';
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		$siplitCats = explode( ',', $cat );
		$args = array(
			'post_type' => 'crazyblog_recipe',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
		);
		if ( !empty( $siplitCats ) ) {
			$args['tax_query'] = array(
				'taxonomy' => 'recipe_category',
				'field' => 'slug',
				'terms' => $siplitCats,
			);
		}
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-slick' ) );
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<ul class="bigguide-carousel">';
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( has_post_thumbnail() ):
					$categories = get_the_terms( get_the_ID(), 'recipe_category' );
					$firstCat = (!empty( $categories )) ? array_shift( $categories ) : '';
					?>
					<li class="bigguide-div">
						<div class="bigguide-img">
							<?php the_post_thumbnail( 'crazyblog_1170x590' ) ?>
						</div>
						<div class="bigguide-detail">
							<?php if ( !empty( $firstCat ) ): ?><span><?php echo esc_html( $firstCat->name ) ?></span><?php endif; ?>
							<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
							<p><?php echo wp_trim_words( get_the_content(), 23, null ) ?></p>
							<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e( 'View More', 'crazyblog' ) ?></a>
						</div>
					</li>
					<?php
				endif;
			}
			wp_reset_postdata();
			echo '</ul>';
		}
		echo '</div>';
		$pad = (!empty( $padding )) ? $padding : 195;
		?>
		<?php 
                    $custom_script = 'jQuery(document).ready(function ($) {
				$(".bigguide-carousel").slick({
					centerMode: true,
					autoplay: false,
					infinite: true,
					speed: 500,
					centerPadding: "'.esc_attr( $pad ).'px",
					slide: "li",
					slidesToShow: 1,
					responsive: [
						{
							breakpoint: 980,
							settings: {
								arrows: false,
								centerMode: false,
								centerPadding: 0,
								slidesToShow: 1
							}
						}
					]
				});
			});';
                        wp_add_inline_script('crazyblog_df-slick', $custom_script);
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
