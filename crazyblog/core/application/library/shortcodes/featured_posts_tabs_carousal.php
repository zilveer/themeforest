<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_posts_tabs_carousal_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_posts_tabs_carousal_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Featured Posts Tab Carousal", 'crazyblog' ),
				"base" => "crazyblog_featured_posts_tabs_carousal_outpupt",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title', 'crazyblog' ),
						"param_name" => "title",
						"description" => esc_html__( 'Enter the title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Sub Title', 'crazyblog' ),
						"param_name" => "sub_title",
						"description" => esc_html__( 'Enter the sub title for this section', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Number of Posts', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter the number of posts to show', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
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

	public static function crazyblog_featured_posts_tabs_carousal_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		//include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-slick' ) );
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'orderby' => $orderby,
			'order' => $order,
			'showposts' => $number,
			'category_name' => $cat,
		);

		$query = new WP_Query( $args );
		?>
		<div class="auto-blog">
			<div class="auto-blog-carousel">
				<div class="main-area">
					<ul class="slider-for">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							if ( has_post_thumbnail() ):
								?>
								<li>
									<div class="autoblog-post">
										<?php the_post_thumbnail( 'crazyblog_939x586' ) ?>
										<div class="autoblog-post-detail">
											<i class="fa fa-edit"></i>
											<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
											<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
										</div>
									</div>
								</li>
								<?php
							endif;
						}
						wp_reset_postdata();
						?>
					</ul>
				</div>
				<div class="side-area">
					<div class="side-title">
						<div class="side-title-inner">
							<h2><?php echo esc_html( $title ) ?></h2>
							<p><?php echo esc_html( $sub_title ) ?></p>
						</div>
					</div>
					<ul class="slider-nav">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							if ( has_post_thumbnail() ):
								?>
								<li>
									<div class="tab-post">
										<i><?php the_post_thumbnail( 'crazyblog_200x200' ) ?></i>
										<h5><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h5>
										<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
									</div>
								</li>
								<?php
							endif;
						}
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>
		</div>
		<?php 
                    $custom_script = 'jQuery(document).ready(function ($) {
				$(".slider-for").slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					slide: "li",
					fade: false,
					asNavFor: ".slider-nav"
				});
				$(".slider-nav").slick({
					slidesToShow: 4,
					slidesToScroll: 1,
					asNavFor: ".slider-for",
					dots: false,
					arrows: false,
					slide: "li",
					vertical: true,
					centerMode: true,
					centerPadding: "0px",
					focusOnSelect: true,
					responsive: [
						{
							breakpoint: 1200,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 1,
							}
						},
						{
							breakpoint: 980,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
								vertical: false,
							}
						},
						{
							breakpoint: 768,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 1,
								vertical: false,
							}
						},
						{
							breakpoint: 480,
							settings: {
								slidesToShow: 1,
								slidesToScroll: 1,
								vertical: false,
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
