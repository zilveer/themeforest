<?php
if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );

class crazyblog_cats_posts_tabs_VC_ShortCode extends crazyblog_VC_ShortCode {

	static $counter = 0;

	public static function crazyblog_cats_posts_tabs_vc( $atts = null, $contents = '' ) {
		if ( $atts == 'crazyblog_Shortcodes_Map' ) {
			return array(
				"name" => esc_html__( "Category Post Tabs", 'crazyblog' ),
				"base" => "crazyblog_cats_posts_tabs",
				"icon" => crazyblog_URI . 'core/duffers_panel/panel/public/img/vc-icons/category-post-tabs.png',
				"category" => esc_html__( 'CBlog', 'crazyblog' ),
				"params" => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Number', 'crazyblog' ),
						"param_name" => "number",
						"description" => esc_html__( 'Enter number of posts', 'crazyblog' )
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
						"heading" => esc_html__( "Post Column", 'crazyblog' ),
						"param_name" => "column",
						"value" => array_flip( array( 'col-md-6' => esc_html__( 'Two Column', 'crazyblog' ), 'col-md-4' => esc_html__( 'Three Column', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select given number of columns for post", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Feature Post", 'crazyblog' ),
						"param_name" => "feature_post",
						"value" => array_flip( array( 'true' => esc_html__( 'True', 'crazyblog' ), 'false' => esc_html__( 'False', 'crazyblog' ) ) ),
						"description" => esc_html__( "Make First post as a feature post with large thumb", 'crazyblog' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Show Tab", 'crazyblog' ),
						"param_name" => "show_tab",
						"value" => array_flip( array( 'true' => esc_html__( 'True', 'crazyblog' ), 'false' => esc_html__( 'False', 'crazyblog' ) ) ),
						"description" => esc_html__( "show/hide tab", 'crazyblog' )
					),
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__( 'Content Limit', 'crazyblog' ),
						"param_name" => "limit",
						"description" => esc_html__( 'Enter number of character to show post detail', 'crazyblog' ),
						'dependency' => array(
							'element' => 'feature_post',
							'value' => array( 'true' )
						),
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__( "Feature Post Column", 'crazyblog' ),
						"param_name" => "feat_column",
						"value" => array_flip( array( 'col-md-6' => esc_html__( 'Two Column', 'crazyblog' ), 'col-md-4' => esc_html__( 'Three Column', 'crazyblog' ) ) ),
						"description" => esc_html__( "Select given number of columns for feature post", 'crazyblog' ),
						'dependency' => array(
							'element' => 'feature_post',
							'value' => array( 'true' )
						),
					),
				)
			);
		}
	}

	public static function crazyblog_cats_posts_tabs( $atts, $contents = null ) {
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_atts.php';
		ob_start();
		include crazyblog_ROOT . 'core/application/library/shortcodes/shortcode_defaut_atts_output.php';
		crazyblog_VIEW::get_instance()->crazyblog_enqueue_scripts( array( 'df-bootstrap-min' ) );
		$category = explode( ',', $cat );
		$counter1 = 0;
		$counter2 = 0;
		?>

		<?php if ( $show_tab == "true" ) : ?>
			<ul class="nav nav-tabs"> 
				<?php
				if ( !empty( $category ) ) : foreach ( $category as $c ) :
						$cat_object = get_category_by_slug( $c );
						?>
						<li class="<?php echo esc_attr( ($counter1 == 0) ? "active" : ""  ); ?>">
							<a href="#<?php echo esc_attr( crazyblog_set( $cat_object, 'slug' ) . self::$counter ); ?>" data-toggle="tab">
								<?php echo esc_html( crazyblog_set( $cat_object, 'name' ) ); ?>
							</a>
						</li> 
						<?php
						$counter1++;
					endforeach;
				endif;
				?>
			</ul> 
			<?php
		endif;
		if ( $show_tab == "true" ) :
			?>
			<div class="tab-content"> 
				<?php
			endif;
			if ( $show_tab == 'true' ) {
				if ( !empty( $category ) ) :
					foreach ( $category as $c ) :
						$cat_opt = get_category_by_slug( $c );
						?>
						<div id="<?php echo esc_attr( crazyblog_set( $cat_opt, 'slug' ) . self::$counter ); ?>" class="tab-pane fade in <?php echo esc_attr( ($counter2 == 0) ? "active" : ""  ); ?>"> 
							<div class="row">
								<div class="texty-style">
									<?php
									$args = array(
										'post_type' => 'post',
										'post_status' => 'publish',
										'orderby' => $orderby,
										'order' => $order,
										'showposts' => $number,
										'category_name' => $c,
									);
									$query = new WP_Query( $args );
									$year = get_the_time( 'Y' );
									$month = get_the_time( 'm' );
									$day = get_the_time( 'd' );
									$post_count = 0;

									if ( $query->have_posts() ) :
										while ( $query->have_posts() ) :
											$query->the_post();
											$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
											if ( $feature_post == "true" && $post_count == 0 ) :
												?>
												<div class="<?php echo esc_attr( $feat_column ); ?>">
													<div class="texty-post">
														<div class="texty-post-img">
															<div class="post-thumb">
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																	<?php the_post_thumbnail( 'crazyblog_454x344' ); ?>
																</a>
															</div>
															<a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
																<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
															</a>
														</div>
														<div class="texty-post-detail">
															<div class="categories">
																<?php echo crazyblog_get_post_categories( get_the_ID() ); ?>
															</div>
															<h2>
																<a title="" href="<?php the_permalink(); ?>">
																	<?php echo character_limiter( get_the_title(), '30' ); ?>
																</a>
															</h2>
															<ul class="meta">
																<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
															</ul>
															<p><?php echo character_limiter( get_the_content(), $limit ); ?></p>
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
											<?php else: ?>
												<div class="<?php echo esc_attr( $column ); ?>">
													<div class="texty-post small">
														<div class="texty-post-img">
															<div class="post-thumb">
																<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
																	<?php the_post_thumbnail( 'crazyblog_454x344' ); ?>
																</a>
															</div>
														</div>
														<div class="texty-post-detail">
															<h2>
																<a href="<?php the_permalink(); ?>" title="">
																	<?php echo character_limiter( get_the_title(), '30' ); ?>
																</a>
															</h2>
															<div class="post-info">
																<ul class="meta">
																	<li><a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>"><?php echo get_the_date( get_option( 'post_format' ) ); ?></a></li>
																</ul>
															</div>
														</div>
													</div><!-- Texty Post Small -->
												</div>
											<?php
											endif;
											$post_count++;
										endwhile;
										wp_reset_postdata();
									endif;
									?>
								</div>
							</div>
						</div> 
						<?php
						$counter2++;
					endforeach;
				endif;
			}
			if ( $show_tab == "true" ) :
				?>
			</div>
			<?php
		endif;
		if ( $show_tab == 'false' ) {
			?>
			<div class="tab-pane fade in active"> 
				<div class="row">
					<div class="texty-style">
						<?php
						$cat_ids = array();
						if ( !empty( $category ) ) {
							foreach ( $category as $c ) {
								$detail = get_term_by( 'slug', $c, 'category' );
								$cat_ids[] = $detail->term_id;
							}
						}
						$args = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'orderby' => $orderby,
							'order' => $order,
							'showposts' => $number,
							'category__in' => array( implode( ',', $cat_ids ) ),
						);
						$query = new WP_Query( $args );
						$year = get_the_time( 'Y' );
						$month = get_the_time( 'm' );
						$day = get_the_time( 'd' );
						$post_count = 0;
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								$view = (get_post_meta( get_the_ID(), 'crazyblog_post_views', true )) ? get_post_meta( get_the_ID(), 'crazyblog_post_views', true ) : '0';
								if ( $feature_post == "true" && $post_count == 0 ) :
									?>
									<div class="<?php echo esc_attr( $feat_column ); ?>">
										<div class="texty-post">
											<div class="texty-post-img">
												<div class="post-thumb">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php the_post_thumbnail( 'crazyblog_454x344' ); ?>
													</a>
												</div>
												<a title="" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
													<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
												</a>
											</div>
											<div class="texty-post-detail">
												<div class="categories">
													<?php echo crazyblog_get_post_categories( get_the_ID() ); ?>
												</div>
												<h2>
													<a title="" href="<?php the_permalink(); ?>">
														<?php echo character_limiter( get_the_title(), '30' ); ?>
													</a>
												</h2>
												<ul class="meta">
													<li>
														<a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>">
															<?php echo get_the_date( get_option( 'post_format' ) ); ?>
														</a>
													</li>
												</ul>
												<p><?php echo character_limiter( get_the_content(), $limit ); ?></p>
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
								<?php else: ?>
									<div class="<?php echo esc_attr( $column ); ?>">
										<div class="texty-post small">
											<div class="texty-post-img">
												<div class="post-thumb">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php the_post_thumbnail( 'crazyblog_454x344' ); ?>
													</a>
												</div>
											</div>
											<div class="texty-post-detail">
												<h2>
													<a href="<?php the_permalink(); ?>" title="">
														<?php echo character_limiter( get_the_title(), '30' ); ?>
													</a>
												</h2>
												<div class="post-info">
													<ul class="meta">
														<li>
															<a title="" href="<?php echo esc_url( get_day_link( $year, $month, $day ) ); ?>">
																<?php echo get_the_date( get_option( 'post_format' ) ); ?>
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div><!-- Texty Post Small -->
									</div>
								<?php
								endif;
								$post_count++;
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>
			</div> 
			<?php
		}
		self::$counter++;
		$output = ob_get_contents();
		ob_clean();
		return $output;
	}

}
