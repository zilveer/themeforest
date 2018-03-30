<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_simple_list_view_with_big_thumb_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_simple_list_view_with_big_thumb_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Featured List View With Big Thumb", 'crazyblog' ),
				"base" => "crazyblog_simple_list_view_with_big_thumb_outpupt",
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
						"type" => "textfield",
						"heading" => esc_html__( 'Content Words', 'crazyblog' ),
						"param_name" => "char",
						"description" => esc_html__( 'Enter the number of content words', 'crazyblog' )
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

	public static function crazyblog_simple_list_view_with_big_thumb_outpupt( $atts, $contents = null ) {
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
			echo '<div class="magazine-blog">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
				$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
				$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
				$num_words = ($char) ? $char : 22;
				?>
				<div class="magazine-post">
					<div class="mag-post-img">
						<a class="image-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
							<?php the_post_thumbnail( 'crazyblog_454x344' ) ?>
						</a>
					</div>
					<div class="mag-post-detail">
						<h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
						<span><?php echo get_the_date( get_option( 'post_format' ) ); ?></span>
						<p><?php echo wp_trim_words( get_the_content(), $num_words, null ) ?></p>
						<a class="continue" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e( 'Read More', 'crazyblog' ) ?></a>
						<ul class="meta">
							<li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter( get_the_ID() ) ?></li>
							<li><i class="fa fa-eye"></i> <?php echo esc_html( crazyblog_restyle_text( $view ) ) ?></li>
						</ul>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
			echo '  </div>';
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
					<a id="magzine_list" data-selector=".magazine-blog" data-offset="div.magazine-post" data-type="magzine_list" data-cats="<?php echo esc_attr( $cat ) ?>" data-order="<?php echo esc_attr( $order ) ?>" data-orderby="<?php echo esc_attr( $orderby ) ?>" data-posts="post" data-limit="<?php echo esc_attr( $number ); ?>" data-nonce="<?php echo wp_create_nonce( 'load_posts' ) ?>" class="loadmore" href="javascript:void(0)" title=""><i class="fa fa-refresh"></i><?php esc_html_e( 'Load More', 'crazyblog' ) ?></a>
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
											".magazine-blog  div.magazine-post",
											".magazine-blog",
											"post",
											"' . esc_js( $number ) . '",
											"' . esc_js( $cat ) . '",
											"' . esc_js( $order ) . '",
											"' . esc_js( $orderby ) . '",
											"magzine_list"
											);
								}
							}
						});
					});';
				wp_add_inline_script( 'crazyblog_df-script', $custom_script );
			}
		}
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
