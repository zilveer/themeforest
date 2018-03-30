<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_featured_posts_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_featured_posts_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Featured Posts Carousal", 'crazyblog' ),
				"base" => "crazyblog_featured_posts_output",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/author-post-carousel.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "multiselect",
						"heading" => esc_html__( 'Select Posts', 'crazyblog' ),
						"param_name" => "posts",
						"value" => crazyblog_posts( 'post' ),
						"description" => esc_html__( 'Select Posts that you want to show', 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_featured_posts_output( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
		$siplit = explode( ',', $posts );
		$args = array(
			'post_type' => 'post',
			'post__in' => $siplit
		);
		$query = new WP_Query( $args );
		$loop = (crazyblog_set( $query, 'post_count' ) > 1) ? 'true' : 'false';
		if ( $query->have_posts() ) {
			crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-owl' ) );
			?>
			<div class="featured-posts">
				<div class="carousel">
					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
						$year = get_the_time( 'Y' );
						$month = get_the_time( 'm' );
						$day = get_the_time( 'd' );
						$categories = get_the_category( get_the_ID() );
						$firstCat = array_shift( $categories );
						?>
						<?php if ( has_post_thumbnail() ): ?>
							<div class="featured-post1">
								<?php the_post_thumbnail( 'crazyblog_1170x590' ); ?>
								<div class="featured-post-detail">
									<span><a href="<?php echo get_category_link( $firstCat->term_id ) ?>" title="<?php echo esc_attr( sprintf( esc_html__( "View all posts in %s", 'crazyblog' ), $firstCat->name ) ) ?>"><?php echo esc_html( $firstCat->cat_name ) ?></a></span>
									<ul class="meta">
										<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
										<li><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?><?php esc_html_e( ' AGO', 'crazyblog' ) ?></li>
									</ul>
									<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
								</div>
							</div>
							<?php
						endif;
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
			<?php 
			    $custom_script = 'jQuery(document).ready(function ($) {
			        $(".carousel").owlCarousel({
			            autoplay: true,
			            autoplayTimeout: 2500,
			            smartSpeed: 2000,
			            autoplayHoverPause: true,
			            loop: '.esc_js( $loop ).',
			            dots: true,
			            nav: false,
			            margin: 0,
			            mouseDrag: true,
			            singleItem: true,
			            items: 1,
			            autoHeight: true
			        });
			    });';
                            wp_add_inline_script('crazyblog_df-owl', $custom_script);
		}
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
