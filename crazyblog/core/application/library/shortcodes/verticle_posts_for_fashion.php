<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_verticle_posts_for_fashion_VC_ShortCode extends crazyblog_VC_ShortCode {

	static public $counter = 0;

	public static function crazyblog_verticle_posts_for_fashion_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Verticle Posts For Fashion", 'crazyblog' ),
				"base" => "crazyblog_verticle_posts_for_fashion_outpupt",
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
						"type" => "textarea",
						"heading" => esc_html__( 'Description', 'crazyblog' ),
						"param_name" => "desc",
						"description" => esc_html__( 'Enter the short description for this section', 'crazyblog' )
					),
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
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Show Load More', 'crazyblog' ),
						"param_name" => "load_more",
						"value" => array(
							esc_html__( 'True', 'crazyblog' ) => 'true',
							esc_html__( 'False', 'crazyblog' ) => 'false'
						),
						"description" => esc_html__( "show or hide load more post functionality", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Infinite Scroll', 'crazyblog' ),
						"param_name" => "infinite_scroll",
						"value" => array(
							esc_html__( 'False', 'crazyblog' ) => 'false',
							esc_html__( 'True', 'crazyblog' ) => 'true'
						),
						"description" => esc_html__( "Infinite scroll pagination functionality", 'crazyblog' ),
						'dependency' => array(
							'element' => 'load_more',
							'value' => array( 'true' )
						),
					),
				)
			);
		}
	}

	public static function crazyblog_verticle_posts_for_fashion_outpupt( $atts, $contents = null ) {
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
		?>
		<div class="descriptive-title">
			<h2><?php echo wp_kses_post( $title ) ?></h2>
			<p><?php echo wp_kses_post( $desc ) ?></p>
		</div>
		<?php
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<div class="fashion-blog" id="fashion-blog' . self::$counter . '"><div class="row">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$format = get_post_format();
				$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
				$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
				$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
				?>
				<div class="col-md-4">
					<div class="fashion-post">
						<a class="image-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
							<?php the_post_thumbnail( 'crazyblog_470x540' ) ?>
						</a>
						<div class="fashion-detail">
							<ul class="meta">
								<li><?php echo human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ?><?php esc_html_e( ' AGO', 'crazyblog' ) ?></li>
								<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
							</ul>
							<h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
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
					</div><!-- Fashion Post -->
				</div>
				<?php
			}
			wp_reset_postdata();
			echo '</div></div>';
			if ( $load_more == 'true' && $infinite_scroll == 'false' ) {
				?>
				<div id="loaded">
					<div class="cssload-loader">
						<div class="cssload-inner cssload-one"></div>
						<div class="cssload-inner cssload-two"></div>
						<div class="cssload-inner cssload-three"></div>
					</div>
				</div>
				<div class="load-btn">
					<a id="fashion_posts" data-selector="#fashion-blog<?php echo esc_attr( self::$counter ) ?> > .row" data-offset="div.col-md-4" data-type="fashion_posts" data-cats="<?php echo esc_attr( $cat ) ?>" data-order="<?php echo esc_attr( $order ) ?>" data-orderby="<?php echo esc_attr( $orderby ) ?>" data-posts="post" data-limit="<?php echo esc_attr( $number ); ?>" data-nonce="<?php echo wp_create_nonce( 'load_posts' ) ?>" class="loadmore" href="javascript:void(0)" title=""><i class="fa fa-refresh"></i><?php esc_html_e( 'Load More', 'crazyblog' ) ?></a>
				</div>
				<?php
			} else if ( $load_more == 'true' && $infinite_scroll == 'true' ) {
				?>
				<div id="loaded">
					<div class="cssload-loader">
						<div class="cssload-inner cssload-one"></div>
						<div class="cssload-inner cssload-two"></div>
						<div class="cssload-inner cssload-three"></div>
					</div>
				</div>
				<?php
				$custom_script = 'jQuery(document).ready(function ($) {
						$(window).scroll(function () {
							if ($(window).scrollTop() == $(document).height() - $(window).height()) {
								if (!jQuery("div#loaded").hasClass("laod_ajax") && !jQuery("div#loaded").hasClass("infinite_end")) {
									infinite_scroll(
											"#fashion-blog' . esc_js( self::$counter ) . ' > .row div.col-md-4",
											"#fashion-blog' . esc_js( self::$counter ) . ' > .row",
											"post",
											"' . esc_js( $number ) . '",
											"' . esc_js( $cat ) . '",
											"' . esc_js( $order ) . '",
											"' . esc_js( $orderby ) . '",
											"fashion_posts"
											);
								}
							}
						});
					});';
				wp_add_inline_script( 'crazyblog_df-owl', $custom_script );
			}
		}
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
