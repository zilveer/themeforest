<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_posts_with_small_thumb_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_posts_with_small_thumb_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Posts with Small Thumb", 'crazyblog' ),
				"base" => "crazyblog_posts_with_small_thumb",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/post-with-small-thumb.png',
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
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Post Column", 'crazyblog' ),
						"param_name" => "column",
						"value" => array_flip( array( 'col-md-6' => esc_html__( 'Two Column', 'crazyblog' ), 'col-md-4' => esc_html__( 'Three Column', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select given number of columns for post", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_posts_with_small_thumb( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-isotope', 'df-init-isotope' ) );
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
		$counter = 0;
		?>

		<div class="row">
			<div class="masonary">
				<div class="texty-style style2">
					<?php if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post(); ?>
							<div class="<?php echo esc_attr( $column ); ?>">
								<div class="texty-post small">
									<div class="texty-post-img">
										<div class="post-thumb">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_454x344' ); ?></a>
										</div>
									</div>
									<div class="texty-post-detail">
										<h2><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<div class="post-info">
											<ul class="meta">
												<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
											</ul>
										</div>
									</div>
								</div><!-- Texty Post Small -->
							</div>							
							<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
