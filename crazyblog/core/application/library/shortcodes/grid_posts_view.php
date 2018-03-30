<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_grid_posts_view_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_grid_posts_view_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Grid Posts View", 'crazyblog' ),
				"base" => "crazyblog_grid_posts_view",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/grid-post-View.png',
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
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Content Limit', 'crazyblog' ),
						"param_name" => "limit",
						"description" => esc_html__( 'Enter words limit for post description.', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Post Column", 'crazyblog' ),
						"param_name" => "column",
						"value" => array_flip( array( 'col-md-12' => esc_html__( 'One Column', 'crazyblog' ), 'col-md-6' => esc_html__( 'Two Column', 'crazyblog' ), 'col-md-4' => esc_html__( 'Three Column', 'crazyblog' ), 'col-md-3' => esc_html__( 'Four Column', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select Column from given list to show post", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_grid_posts_view( $atts, $contents = null ) {
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
		$year = get_the_time( 'Y' );
		$month = get_the_time( 'm' );
		$day = get_the_time( 'd' );
		$counter = 0;
		?>

		<div class="row">
			<div class="texty-style">
				<?php
				if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
						$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
						?>
						<div class="<?php echo esc_attr( $column ); ?>">
							<div class="texty-post">
								<div class="texty-post-img">
									<div class="post-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_454x344' ); ?></a>
									</div>
									<a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
									</a>
								</div>
								<div class="texty-post-detail">
									<div class="categories">
										<?php echo crazyblog_get_post_categories( get_the_ID() ); ?>
									</div>
									<h2><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<ul class="meta">
										<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
										<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
									</ul>
									<p><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
									<div class="post-info">
										<span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
										<span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text( $view ) ?></span></span>
										<span>
											<i class="fa fa-share-alt"></i>
											<span class="share-link">
												<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'dribbble' ) ); ?>
											</span>
										</span>
									</div>
								</div>
							</div><!-- Texty Post -->
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
