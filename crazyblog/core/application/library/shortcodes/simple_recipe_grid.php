<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_simple_recipe_grid_VC_ShortCode extends crazyblog_VC_ShortCode {

	public static function crazyblog_simple_recipe_grid_vc( $atts = null, $contents = '' ) {

		if ( $atts == 'crazyblog_Shortcodes_Map' ) {

			return array(
				"name" => esc_html__( "Simple Recipe Grid", 'crazyblog' ),
				"base" => "crazyblog_simple_recipe_grid_outpupt",
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

	public static function crazyblog_simple_recipe_grid_outpupt( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		$siplitCats = explode( ',', $cat );
		echo '<div class="recipes-posts">';
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';

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
		crazyblog_View::get_instance()->crazyblog_enqueue_scripts( array( 'df-poptrox' ) );
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo '<div class="remove-ext"><div class="row">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$format = get_post_format();
				$post_meta = get_post_meta( get_the_ID(), 'crazyblog_post_meta', true );
				$meta = crazyblog_set( crazyblog_set( $post_meta, 'crazyblog_post_format_options' ), '0' );
				$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
				$year = get_the_time( 'Y' );
				$month = get_the_time( 'm' );
				$day = get_the_time( 'd' );
				?>
				<div class="col-md-4">
					<div class="post-style2">
						<div class="post-thumb2">
							<?php the_post_thumbnail( 'crazyblog_454x344' ) ?>
							<div class="post2-info">
								<a href="<?php the_permalink() ?>" title=""><i class="fa fa-link"></i></a>
								<div class="share">
									<ul class="social-btns">
										<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'google-plus' ), false, false, true ); ?>
									</ul>
								</div>
							</div>
						</div>
						<div class="post-detail2">
							<ul class="meta">
								<li><a href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>" title=""><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
								<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
							</ul>
							<h2><a class="call-popup detail-popup" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
							<ul class="likeshare">
								<li><i class="fa fa-heart-o"></i> <?php echo crazyblog_post_counter( get_the_ID() ) ?></li>
								<li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text( $view ) ?></li>
							</ul>
						</div>
					</div>
				</div>
				<?php
			}
			wp_reset_postdata();
			echo '</div>';
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
					<a id="simple_recipe_grid" data-selector=".remove-ext > .row" data-offset="div.col-md-4" data-type="simple_recipe_grid" data-cats="<?php echo esc_attr( $cat ) ?>" data-order="<?php echo esc_attr( $order ) ?>" data-orderby="<?php echo esc_attr( $orderby ) ?>" data-posts="post" data-limit="<?php echo esc_attr( $number ); ?>" data-nonce="<?php echo wp_create_nonce( 'load_posts' ) ?>" class="loadmore" href="javascript:void(0)" title=""><i class="fa fa-refresh"></i><?php esc_html_e( 'Load More', 'crazyblog' ) ?></a>
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
				                            ".remove-ext > .row div.col-md-4",
				                            ".remove-ext > .row",
				                            "post",
				                            "'.esc_js( $number ).'",
				                            "'.esc_js( $cat ).'",
				                            "'.esc_js( $order ).'",
				                            "'.esc_js( $orderby ).'",
				                            "simple_recipe_grid"
				                            );
				                }
				            }
				        });
				    });';
                                    wp_add_inline_script('crazyblog_df-script', $custom_script);
			}
			echo '</div>';
		}
		echo '</div>';
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
