<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_weekly_featured_posts_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_weekly_featured_posts_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Weekly Featured Posts", 'crazyblog' ),
				"base" => "crazyblog_weekly_featured_posts_outpupt",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/About-Us-Custom-Contents.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Number of Posts', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter the number of posts to show', 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Content Words', 'crazyblog' ),
						"param_name" => "char",
						"description" => esc_html__( 'Enter the number of content words', 'crazyblog' )
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

	public static function crazyblog_weekly_featured_posts_outpupt( $atts, $contents = null ) {
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

		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<div class="weekly-featured-posts">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$format = get_post_format();
				$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
				$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
				$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
				$num_words = ($char) ? $char : 22;
				?>
				<div class="weekly-post">
					<div class="weekly-post-thumb">
						<?php if ( $format == 'video' ): ?>
							<a class="image-link" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail( 'crazyblog_454x344' ) ?></a>
							<?php
							if ( crazyblog_set( $meta, 'crazyblog_post_video_link' ) != '' ):
								crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-poptrox' ) );
								?>
								<span class="lightbox">
									<a href="<?php echo crazyblog_set( $meta, 'crazyblog_post_video_link' ) ?>" title="" class="cat-btn">
										<?php esc_html_e( 'Video ', 'crazyblog' ) ?><i class="fa fa-play"></i>
									</a>
								</span>
								<?php
								$custom_script = 'jQuery(document).ready(function ($) {
										$("span.lightbox").poptrox({
											usePopupCaption: false,
											usePopupNav: false,
										});
									});';
								wp_add_inline_script( 'crazyblog_df-poptrox', $custom_script );
							endif;
							?>
						<?php else: ?>
							<a class="image-link" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail( 'crazyblog_454x344' ) ?></a>
				<?php endif; ?>
					</div>
					<div class="weekly-post-detail">
						<ul class="meta">
							<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
							<li><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?><?php esc_html_e( ' AGO', 'crazyblog' ) ?></li>
						</ul>
						<h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
						<p><?php echo wp_trim_words( get_the_content(), $num_words, null ); ?></p>
						<div class="post-info">
							<span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
							<span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text( $view ) ?></span></span>
							<span>
								<i class="fa fa-share-alt"></i>
								<span class="share-link">
				<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'google-plus' ) ); ?>
								</span>
							</span>
						</div>
					</div>
				</div>


				<?php
			}
			wp_reset_postdata();
			echo '</div>';
			crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-onscreen' ) );
			?>
			<?php
			$custom_script = 'jQuery(document).ready(function ($) {
                                jQuery(window).scroll(function () {
                                    jQuery(".image-link > img").each(function (i, el) {
                                        var el = $(el);
                                        if (el.visible(true)) {
                                            el.addClass("animated zoomIn");
                                        }
                                    });
                                });
                            });';
			wp_add_inline_script( 'crazyblog_df-onscreen', $custom_script );
		}

		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
