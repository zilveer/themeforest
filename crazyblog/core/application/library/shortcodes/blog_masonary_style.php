<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_blog_masonary_style_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_blog_masonary_style_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Blog Masonary Style", 'crazyblog' ),
				"base" => "crazyblog_blog_masonary_style",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/blog-masonary-style.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts with multiple of 6. If carousel enable', 'crazyblog' )
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
						"heading" => esc_html__( 'Carousel', 'crazyblog' ),
						"param_name" => "show_carousel",
						"value" => array( esc_html__( 'True', 'crazyblog' ) => 'true', esc_html__( 'False', 'crazyblog' ) => 'false' ),
						"description" => esc_html__( "Enable/Disable Carousel", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_blog_masonary_style( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-isotope', 'df-init-isotope', 'df-slick' ) );
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
		$size = array( 'crazyblog_454x344', 'crazyblog_376x350', 'crazyblog_454x344', 'crazyblog_376x350', 'crazyblog_376x350', 'crazyblog_454x344', );
		$walker = 0;
		$counter = 0;
		?>

		<div class="square-post-wrapper">
			<div class="square-posts-style">
				<div class="row">
					<div class="masonary">
						<?php
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) :
								$query->the_post();
								?>
								<?php if ( $counter % 6 == 0 && $counter != 0 ) echo '</div></div><div class="row"><div class="masonary">'; ?>
								<div class="col-md-4">
									<div class="square-post">
										<div class="square-img">
											<?php the_post_thumbnail( $size[$walker] ); ?>
											<span><i class="fa fa-heart"></i><?php echo " " . crazyblog_post_counter( get_the_ID() ); ?></span>
											<a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
											<a class="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="">
												<?php echo get_avatar( get_the_author_meta( 'ID' ), 200 ); ?>
											</a>
										</div>
										<h4><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
										<ul class="meta">
											<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
											<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
										</ul>
									</div><!-- Square Post -->
								</div>
								<?php
								$walker++;
								if ( $walker == 6 ) {
									$walker = 0;
								}
								$counter++;
							endwhile;
							wp_reset_postdata();
						}
						?>
					</div>
				</div><!-- Square Post Style -->
			</div>
			<div class="slick-btns"></div>
		</div>
		<?php if ( $show_carousel == 'true' ) : ?>
			<?php $slick_carousel = '
			    jQuery(document).ready(function () {
			        setTimeout(function () {
			            jQuery(".square-posts-style").slick({
			                dots: false,
			                infinite: true,
			                speed: 300,
			                center: true,
			                slidesToShow: 1,
			                vertical: true,
			                adaptiveHeight: true
			            });
			            var a = jQuery(".slick-prev");
			            var b = jQuery(".slick-next");
			            jQuery(".slick-btns").append(a);
			            jQuery(".slick-btns").append(b);
			        }, 2500);

			    });';
                            wp_add_inline_script('crazyblog_df-slick', $slick_carousel);
			?>
		<?php endif; ?>	

		<?php
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
