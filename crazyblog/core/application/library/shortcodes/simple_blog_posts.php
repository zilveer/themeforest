<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_simple_blog_posts_VC_ShortCode extends crazyblog_VC_ShortCode {

	static $counter = 0;

	public static function crazyblog_simple_blog_posts_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Simple Blog List View", 'crazyblog' ),
				"base" => "crazyblog_simple_blog_posts",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/simple-blog-list-view.png',
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
						"description" => esc_html__( 'Enter character limit for post description.', 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( 'Load More', 'crazyblog' ),
						"param_name" => "show_loadmore",
						"value" => array( esc_html__( 'Show', 'crazyblog' ) => 'true', esc_html__( 'Hide', 'crazyblog' ) => 'false' ),
						"description" => esc_html__( "Show/Hide Load more button", 'crazyblog' )
					),
				)
			);
		}
	}

	public static function crazyblog_simple_blog_posts( $atts, $contents = null ) {
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

		<div id="lookbook-style<?php echo esc_attr( self::$counter ) ?>" class="lookbook-style">
			<?php
			if ( $query->have_posts() ): while ( $query->have_posts() ): $query->the_post();
					$format = get_post_format();
					?>            
					<?php if ( $counter % 2 != 0 ) : ?>

						<div class="lookbook-post">
							<div class="lookbook-detail">
								<div class="lookbook-border">
									<span><i class="fa fa-image"></i></span>
									<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
									<ul class="meta">
										<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
										<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
									</ul>
									<p><?php echo character_limiter( get_the_content(), $limit ); ?></p>
									<div class="post-info">
										<a class="btn" href="<?php the_permalink(); ?>" title=""><?php esc_html_e( 'CONTINUE READING', 'crazyblog' ); ?></a>
										<span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
										<span>
											<i class="fa fa-share-alt"></i>
											<span class="share-link">
												<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'dribbble' ) ); ?>
											</span>
										</span>
									</div>
								</div>
							</div>
							<div class="lookbook-image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_608x446' ); ?></a>
							</div>
						</div><!-- Lookbook Post -->
					<?php else: ?>
						<div class="lookbook-post reverse">
							<div class="lookbook-image">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail( 'crazyblog_608x446' ); ?></a>
							</div>
							<div class="lookbook-detail">
								<div class="lookbook-border">
									<span><i class="fa fa-image"></i></span>
									<h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
									<ul class="meta">
										<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
										<li><?php esc_html_e( 'By ', 'crazyblog' ); ?><a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></li>
									</ul>
									<p><?php echo character_limiter( get_the_content(), $limit ); ?></p>
									<div class="post-info">
										<a class="btn" href="<?php the_permalink(); ?>" title=""><?php esc_html_e( 'CONTINUE READING', 'crazyblog' ); ?></a>
										<span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text( get_comments_number( get_the_ID() ) ) ?></span></span>
										<span>
											<i class="fa fa-share-alt"></i>
											<span class="share-link">
												<?php crazyblog_social_share_output( array( 'facebook', 'twitter', 'pinterest', 'dribbble' ) ); ?>
											</span>
										</span>
									</div>
								</div>
							</div>
						</div><!-- Lookbook Post -->
					<?php endif; ?>
					<?php
					$counter++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div><!-- Lookbook Style -->

		<?php if ( $show_loadmore == "true" ) : ?>  
			<div class="load-btn">
                            <a class="loadmore" href="#" title=""><i class="fa fa-refresh"></i><?php esc_html_e( 'Load More', 'crazyblog' ); ?></a>
			</div>
			<div class="loading"></div>
			<?php 
			    $custom_script = 'jQuery(document).ready(function ($) {
			        jQuery(".loadmore").on("click", function () {
			            var limit = '.esc_js( $limit ).';
			            var offset = jQuery("div#lookbook-style'.esc_js(self::$counter).' div.lookbook-post").length;
			            var orderby = "'.esc_js( $orderby ).'";
			            var order = "'.esc_js( $order ).'";
			            var cat = "'.esc_js( $cat ).'";

			            var action = "load_post_list";
			            data = "action=" + action + "&offset=" + offset + "&limit=" + limit + "&orderby=" + orderby + "&order=" + order + "&cat=" + cat;
			            $.ajax({
			                type: "POST",
			                url: ajaxurl,
			                data: data,
			                beforeSend: function () {
			                    jQuery(".load-btn").hide(200);
			                    jQuery(".loading").show(200);
			                    jQuery(".loading").append("<img src=\" + theme_url + /assets/assets/ajax-loader.gif\" class=\"loader\" />");
			                },
			                success: function (response) {
			                    if (response != "true") {
			                        jQuery(".loading").hide(200);
			                        jQuery(".loading").children("img").remove();
			                        jQuery(".lookbook-style").append(response);
			                        jQuery(".load-btn").show(300);
			                    } else {
			                        jQuery(".load-btn").css("display", "block");
			                        jQuery(".load-btn a").html("<i class=\"fa fa-stop\"></i>'.esc_html__("No More Posts", "crazyblog").'");
			                        jQuery(".loading").children("img").remove();
			                        jQuery(".load-btn a").css("pointer-events", "none");
			                    }
			                }
			            });
			            return false;
			        });
			    });';
			wp_add_inline_script('crazyblog_df-script', $custom_script);
		endif;
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
