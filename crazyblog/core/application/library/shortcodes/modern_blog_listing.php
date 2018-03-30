<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_modern_blog_listing_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_modern_blog_listing_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Modern Blog Listing", 'crazyblog' ),
				"base" => "crazyblog_modern_blog_listing_outpupt",
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
					)
				)
			);
		}
	}

	public static function crazyblog_modern_blog_listing_outpupt( $atts, $contents = null ) {
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
		$counter = 0;
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			?>
			<div class="travel-blog">
				<div class="row">
					<div class="col-md-12">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							$format = get_post_format();
							$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
							$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
							$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
							$style = ($counter == 0 || $counter % 3 === 0) ? '' : 'style2';
							$year = get_the_time( 'Y' );
							$month = get_the_time( 'm' );
							$day = get_the_time( 'd' );
							?>
							<div class="travel-post <?php echo esc_attr( $style ) ?>">
								<a class="image-link" href="<?php the_permalink() ?>" title="">
									<?php
									if ( $style == 'style2' ) {
										the_post_thumbnail( 'crazyblog_400x400' );
									} else {
										the_post_thumbnail( 'crazyblog_1170x590' );
									}
									?>
								</a>
								<div class="travel-post-details">
									<h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
									<ul class="meta">
										<li><a href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>" title=""><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
										<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
										<li><a href="javascript:void(0)" title=""><i class="fa fa-heart"></i><?php echo crazyblog_post_counter( get_the_ID() ) ?></a></li>
										<li><a href="javascript:void(0)" title=""><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text( $view ) ?></a></li>
									</ul>									
									<p><?php echo wp_trim_words( get_the_content(), $num_words = 22, $more = null ); ?></p>
									<a class="readmore" href="<?php the_permalink() ?>" title=""><?php esc_html_e( 'READ MORE', 'crazyblog' ) ?></a>
								</div>
							</div>
							<?php
							$counter++;
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
			<?php
		}

		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
