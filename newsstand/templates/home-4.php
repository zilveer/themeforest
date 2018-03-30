<?php
	/* Template Name: Home 4 */
get_header(); ?>

<?php
	function filter_where_3($where = '') {
		// show posts form last 3 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	    return $where;
	}
	add_filter('posts_where', 'filter_where_3');

	$args = array('post_type'=>'post', 'posts_per_page'=>6, 'orderby'=>'comment_count', 'order'=>'DESC', 'post__not_in' => get_option( 'sticky_posts' ));
	$wp_query = new WP_Query( $args );
?>
<?php if ($wp_query->have_posts()): ?>
	<section class="most-popular full-width">
	    <div class="container">
	        <div class="popular-title sameHeight">
	            <span><?php echo _e('Most <span>Popular</span>News', 'newsstand'); ?></span>
	        </div>
	        <div class="popular-slider">

	            <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	            	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

					<div class="single">
					    <a href="<?php the_permalink(); ?>" class="image plus-hover" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><span class="plus"></span></a>
					    <div class="info">
					        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </div>
					</div><!-- end of single -->

	            <?php endwhile; ?>


	        </div>
	    </div>
	</section>
<?php endif ?>

<?php remove_filter('posts_where', 'filter_where_3'); ?>

<?php wp_reset_query(); ?>

<?php
	$banner_3_image = get_post_meta( get_the_ID(), 'newsstand_banner_3_image', 1, true );
	$banner_3_link = get_post_meta( get_the_ID(), 'newsstand_banner_3_link', 1, true );
?>

<?php if (!empty($banner_3_link) && !empty($banner_3_link)): ?>
	<section class="big-banner-holder">
	    <div class="container">
	        <a href="<?php echo esc_url($banner_3_link); ?>" target="_blank"><img src="<?php echo esc_url($banner_3_image); ?>" alt=""></a>
	    </div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>


	<section class="big-latest">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-3">
	                <div class="black-sidebar">
	                	<?php
	                		$block_4left = get_post_meta( get_the_ID(), 'newsstand_block_4left_show', 1, true );
	                		$block_4left_cat = get_post_meta( get_the_ID(), 'newsstand_block_4left_category', 1, true );

	                		$args = "";

	                		if ($block_4left=='latest') {
	                		    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
	                		} elseif($block_4left=='mostpopular') {
	                		    function filter_where_661($where = '') {
	                		        // show posts form last 3 days
	                		        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	                		        return $where;
	                		    }
	                		    add_filter('posts_where', 'filter_where_661');
	                		    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
	                		} elseif($block_4left=='category') {
	                		    $cat_id = $block_4left_cat;
	                		    $cat_id_name = get_category($cat_id);
	                		    $cat_id_name = $cat_id_name->cat_name;

	                		    $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
	                		}

	                		$wp_query = new WP_Query( $args );
	                	?>
	                	<?php if ($wp_query->have_posts()): ?>
	                		<div class="box">
	                		    <?php if ($block_4left=='latest'): ?>
	                		    	<h3 class="box-title"><span><?php _e('Latest News', 'newsstand'); ?></span></h3>
	                		    <?php elseif($block_4left=='mostpopular'): ?>
	                		    	<h3 class="box-title"><span><?php _e('Most Popular', 'newsstand'); ?></span></h3>
	                		    <?php elseif($block_4left=='category'): ?>
	                		    	<h3 class="box-title"><span><?php _e('From', 'newsstand'); echo esc_html(' '.$cat_id_name); ?></span></h3>
	                		    <?php endif ?>
	                		    <div class="scrollable">
	                		        <div class="latest-news-box">

	                		        	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

	                		        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

											<div class="single">
											    <div class="post-info">
											        <span><?php the_time($newsstand_dateformat); ?></span>
											        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
											    </div>
											    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
											        <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
											    </div>
											    <div class="post-content">
											        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
											        <p><?php echo newsstand_excerpt(80); ?></p>
											    </div>
											</div><!-- end of single -->

	                		        	<?php endwhile; ?>

	                		        </div>
	                		    </div>
	                		</div><!-- end of box -->
	                	<?php endif ?>

	                	<?php remove_filter('posts_where', 'filter_where_661'); ?>

	                	<?php wp_reset_query(); ?>

	                	<?php
	                		$user_query = new WP_User_Query( array( 'role' => 'editor', 'fields' => 'all_with_meta', 'number' => 3, 'orderby' => 'post_count', 'order' => 'DESC' ) );
	                	?>
						<?php if (!empty($user_query->results)): ?>
	                    	<div class="box">
	                        <h3 class="box-title"><span><?php _e('Editors', 'newsstand'); ?></span></h3>
	                        <div class="scrollable">
	                            <div class="authors-boxes">

	                            	<?php foreach ( $user_query->results as $user ): ?>

	                            		<?php
	                            		    $user_info = get_userdata($user->ID);
	                            		    $user_position = get_user_meta($user->ID, 'newsstand_user_position', 1);
	                            		    $user_stats = get_user_meta($user->ID, 'newsstand_user_stats', 1);
	                            		    $user_photo = get_user_meta($user->ID, 'newsstand_user_photo', 1);
	                            		?>

		                                <div class="single">
		                                    <div class="author-info">
		                                        <a href="<?php echo get_author_posts_url( $user->ID ); ?>">
		                                        	<?php if (!empty($user_photo)): ?>
		                                        	    <div class="image" style="background-image: url(<?php echo esc_url($user_photo); ?>);"></div>
		                                        	<?php endif ?>
		                                            <span class="rinfo">
		                                                <span class="name"><?php echo esc_html($user->display_name); ?></span>
		                                                <?php if (!empty($user_position)): ?>
		                                                    <span class="location"><?php echo esc_html($user_position); ?></span>
		                                                <?php endif ?>
		                                            </span>
		                                        </a>
		                                    </div>
		                                    <div class="author-stats">
		                                        <ul>
		                                            <li>
		                                                <span class="title"><?php _e('Articles Written', 'newsstand'); ?></span>
		                                                <span class="num"><?php echo count_user_posts($user->ID); ?></span>
		                                            </li>
		                                            <?php if (isset($user_stats) && !empty($user_stats)): ?>
		                                                <?php foreach ($user_stats as $stats): ?>
		                                                    <li>
		                                                    	<span class="title"><?php echo esc_html($stats['title']); ?></span>
		                                                    	<span class="num"><?php echo esc_htmL($stats['number']); ?></span>
		                                                    </li>
		                                                <?php endforeach ?>
		                                            <?php endif ?>
		                                        </ul>
		                                    </div>
		                                </div><!-- end of single -->

	                            	<?php endforeach; ?>

	                            </div>
	                        </div>
	                    	</div><!-- end of box -->
	                	<?php endif; ?>
	                </div>
	            </div>

	            <?php wp_reset_query(); ?>

	            <div class="col-md-6">
	                <div class="middle-content">

						<?php
							$post_slug = get_post_meta( get_the_ID(), 'newsstand_specific_post_slug', 1, true );
							$post_related = get_post_meta( get_the_ID(), 'newsstand_specific_post_related', 1, true );
							$post_id;

							$args = array('name' => $post_slug, 'post_status' => 'publish', 'post_type' => 'post', 'numberposts' => 1);
							$wp_query = new WP_Query( $args );
						?>

						<?php if (!empty($post_slug) && $wp_query->have_posts()): ?>
							<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
								<?php
									$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
									$post_id = $post->ID;
								?>

								<div class="big-latest-news">
								    <div class="post-info">
								        <span><?php the_time($newsstand_dateformat); ?></span>
								        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
								    </div>
								    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
								    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
								    <p><?php echo newsstand_excerpt(240); ?></p>
								</div><!-- end of big-latest-news -->
							<?php endwhile; ?>
						<?php endif ?>

						<?php if (!empty($post_slug) && !empty($post_id)): ?>
							<?php
								$tags = wp_get_post_tags($post_id);
							?>

							<?php if ($tags): ?>

								<?php
									$tag_ids = array();
								?>

								<?php foreach ($tags as $tag): ?>
									<?php $tag_ids[] = $tag->term_id; ?>
								<?php endforeach ?>

								<?php
									$args=array(
									    'tag__in' => $tag_ids,
									    'post__not_in' => array($post_id, get_option( 'sticky_posts' )),
									    'posts_per_page'=>4, // Number of related posts to display.
									    );
									$wp_query = new wp_query( $args );
								?>

								<?php if ($wp_query->have_posts()): ?>
									<div class="related-news">
									    <h3>Related News</h3>
									    <ul>
											<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
												<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
											<?php endwhile; ?>
										</ul>
									</div>
								<?php endif ?>

							<?php endif ?>
						<?php endif ?>

						<?php wp_reset_query(); ?>

						<?php
							$pb_display = get_post_meta( get_the_ID(), 'newsstand_show_pb', 1, true );
							$pbposts = get_post_meta( get_the_ID(), 'newsstand_block_pb_show', 1, true );
							$pbposts_cat = get_post_meta( get_the_ID(), 'newsstand_block_pb_category', 1, true );

							if ($pbposts=='latest') {
							    $args = array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ));
							} elseif($pbposts=='mostpopular') {
							    function filter_where_4($where = '') {
							        // show posts form last 3 days
							        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
							        return $where;
							    }
							    add_filter('posts_where', 'filter_where_4');
							    $args = array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
							} elseif($pbposts=='category') {
							    $pbposts_cat = get_category($pbposts_cat[0]);
							    $cat_id = $pbposts_cat->cat_ID;

							    $args = array('post_type'=>'post', 'posts_per_page'=>4, 'cat'=>$cat_id);
							    $wp_query = new WP_Query( $args );
							}

							$wp_query = new WP_Query( $args );
						?>

						<?php if ($pb_display=='on'): ?>
							<?php if ($wp_query->have_posts()): ?>
								<div class="boxed-news">
								    <div class="row">

								    	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

								    		<?php
								    			$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
								    		?>

								        <div class="col-md-6">
								            <div class="single">
								                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
								                <div class="post-info">
								                    <span><?php the_time($newsstand_dateformat); ?></span>
								                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
								                </div>
								                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
								                <p><?php echo newsstand_excerpt(130); ?></p>
								            </div><!-- end of single -->
								        </div><!-- end of col -->

								        <?php endwhile; ?>

								    </div>
								</div>
							<?php endif ?>
						<?php endif ?>

						<?php remove_filter('posts_where', 'filter_where_4'); ?>

						<?php wp_reset_query(); ?>

						<?php
							$spb_display = get_post_meta( get_the_ID(), 'newsstand_show_2pb', 1, true );
							$spbposts = get_post_meta( get_the_ID(), 'newsstand_block_pb_show', 1, true );
							$spbposts_cat = get_post_meta( get_the_ID(), 'newsstand_block_pb_category', 1, true );

							if ($spbposts=='latest') {
							    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
							} elseif($spbposts=='mostpopular') {
							    function filter_where_812($where = '') {
							        // show posts form last 3 days
							        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
							        return $where;
							    }
							    add_filter('posts_where', 'filter_where_812');
							    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
							} elseif($spbposts=='category') {
							    $spbposts_cat = get_category($spbposts_cat[0]);
							    $cat_id = $spbposts_cat->cat_ID;

							    $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
							    $wp_query = new WP_Query( $args );
							}

							$wp_query = new WP_Query( $args );
						?>

						<?php if ($spb_display=='on'): ?>
							<?php if ($wp_query->have_posts()): ?>
								<div class="line-news">
									<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
										<?php
											$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
										?>

									    <div class="single">
									        <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>)"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
									        <div class="post-content">
									            <div class="post-info">
									                <span><?php the_time($newsstand_dateformat); ?></span>
									                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
									            </div>
									            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
									            <p><?php echo newsstand_excerpt(130); ?></p>
									        </div>
									    </div><!-- end of single -->
									<?php endwhile; ?>

								</div>
							<?php endif ?>
						<?php endif ?>

						<?php remove_filter('posts_where', 'filter_where_812'); ?>
	                </div>
	            </div>

	            <div class="col-md-3">
	                <div class="white-sidebar">
	                	<?php wp_reset_query(); ?>

	                	<?php
	                		$block_4right = get_post_meta( get_the_ID(), 'newsstand_block_4right_show', 1, true );
	                		$block_4right_cat = get_post_meta( get_the_ID(), 'newsstand_block_4right_category', 1, true );

	                		$args = "";

	                		if ($block_4right=='latest') {
	                		    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ));
	                		} elseif($block_4right=='mostpopular') {
	                		    function filter_where_236($where = '') {
	                		        // show posts form last 3 days
	                		        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
	                		        return $where;
	                		    }
	                		    add_filter('posts_where', 'filter_where_236');
	                		    $args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ), 'orderby'=>'comment_count', 'order'=>'DESC');
	                		} elseif($block_4right=='category') {
	                		    $cat_id = $block_4right_cat;
	                		    $cat_id_name = get_category($cat_id);
	                		    $cat_id_name = $cat_id_name->cat_name;

	                		    $args = array('post_type'=>'post', 'posts_per_page'=>3, 'cat'=>$cat_id);
	                		} elseif($block_4right=='videos') {
	                			$args = array( "post_type" => 'video', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ) );
	                		}

	                		$wp_query = new WP_Query( $args );
	                	?>
	                	<?php if ($wp_query->have_posts()): ?>
	                		<div class="box">
	                		    <?php if ($block_4right=='latest'): ?>
	                		    	<h3 class="box-title"><span><?php _e('Latest News', 'newsstand'); ?></span></h3>
	                		    <?php elseif($block_4right=='mostpopular'): ?>
	                		    	<h3 class="box-title"><span><?php _e('Most Popular', 'newsstand'); ?></span></h3>
	                		    <?php elseif($block_4right=='category'): ?>
	                		    	<h3 class="box-title"><span><?php _e('From', 'newsstand'); echo esc_html(' '.$cat_id_name); ?></span></h3>
	                		    <?php elseif($block_4right=='videos'): ?>
	                		    	<h3 class="box-title"><span><?php _e('Latest Videos', 'newsstand'); ?></span></h3>
	                		    <?php endif ?>

	                		    <div class="scrollable">
	                		        <div class="news-post-list lightGallery-videos-2">

										<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

											<?php
												$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
												$video_url = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true );
											?>

		                		            <div class="single">
		                		                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
		                		                    <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>

		                		                    <?php if ($block_4right=='videos'): ?>
		                		                    	<?php if (!empty($video_url)): ?>
		                		                    		<a href="<?php echo esc_url($video_url); ?>" class="play-video" data-src="<?php echo esc_url($video_url); ?>" data-thumb-src="<?php echo esc_url($thumb_url); ?>"></a>
		                		                    	<?php endif ?>
		                		                    <?php endif ?>
		                		                </div>
		                		                <div class="post-info">
		                		                    <span><?php the_time($newsstand_dateformat); ?></span>
		                		                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
		                		                </div>
		                		                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
		                		                <p><?php echo newsstand_excerpt(90); ?></p>
		                		            </div><!-- end of single -->
		                		        <?php endwhile; ?>

	                		        </div>
	                		    </div>
	                		</div><!-- end of box -->
	                	<?php endif ?>

	                	<?php remove_filter('posts_where', 'filter_where_236'); ?>

	                	<?php wp_reset_query(); ?>

						<?php
							function filter_where_10($where = '') {
								// show posts form last 3 days
							    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-3 days')) . "'";
							    return $where;
							}
							add_filter('posts_where', 'filter_where_10');

							$args = array('post_type'=>'post', 'posts_per_page'=>3, 'orderby'=>'comment_count', 'order'=>'DESC', 'post__not_in' => get_option( 'sticky_posts' ));
							$wp_query = new WP_Query( $args );
						?>

						<?php if ($wp_query->have_posts()): ?>
							<div class="box">
							    <h3 class="box-title"><span><?php _e('Popular', 'newsstand'); ?></span></h3>
							    <div class="scrollable">
							        <div class="news-post-list">

							        	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

							        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

								            <div class="single">
								                <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
								                    <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
								                </div>
								                <div class="post-info">
								                    <span><?php the_time($newsstand_dateformat); ?></span>
								                    <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
								                </div>
								                <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
								                <p><?php echo newsstand_excerpt(90); ?></p>
								            </div><!-- end of single -->

							            <?php endwhile; ?>

							        </div>
							    </div>
							</div><!-- end of box -->
						<?php endif ?>

						<?php remove_filter('posts_where', 'filter_where_10'); ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

<?php wp_reset_query(); ?>

<?php
	$banner_4_image = get_post_meta( get_the_ID(), 'newsstand_banner_4_image', 1, true );
	$banner_4_link = get_post_meta( get_the_ID(), 'newsstand_banner_4_link', 1, true );
?>

<?php if (!empty($banner_4_link) && !empty($banner_4_link)): ?>
	<section class="big-banner-holder">
	    <div class="container">
	        <a href="<?php echo esc_url($banner_4_link); ?>" target="_blank"><img src="<?php echo esc_url($banner_4_image); ?>" alt=""></a>
	    </div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php
	$show_vblock = get_post_meta( get_the_ID(), 'newsstand_show_vblock', 1, true );
	$args = array('post_type' => 'video', 'posts_per_page' => 8, 'post__not_in' => get_option( 'sticky_posts' ) );
	$wp_query = new WP_Query( $args );
?>
<?php if ($show_vblock=='on'): ?>
	<?php if ($wp_query->have_posts()): ?>

		<section class="video-posts-holder">
		    <div class="container">
		        <div class="vph-slider lightGallery-videos-1">

		        	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

		        		<?php
		        			$thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		        			$video_url = get_post_meta( get_the_ID(), 'newsstand_video_url', 1, true );
		        		?>

		        		<?php if (!empty($video_url)): ?>
		        			<div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>)">
		        			    <span class="valign">
		        			        <a href="<?php echo esc_url($video_url); ?>" class="play-video" data-src="<?php echo esc_url($video_url); ?>" data-thumb-src="<?php echo esc_url($thumb_url); ?>"></a>
		        			        <span class="title"><?php the_title(); ?></span>
		        			        <span class="num"><?php the_time($newsstand_dateformat); ?></span>
		        			    </span>
		        			</div><!-- end of single -->
		        		<?php endif ?>

		            <?php endwhile; ?>

		        </div>
		    </div>
		</section>

	<?php endif ?>
<?php endif ?>

<?php wp_reset_query(); ?>

<section class="news-splitted">
    <div class="container">
        <div class="actual-container">
            <div class="row">
            	<?php
            		$newsblock = get_post_meta( get_the_ID(), 'newsstand_block_newsblock_category', 1, true );
            		$categoryID = get_category($newsblock[0]);

            		$nb_cat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');
            		$nb_cat_name = $categoryID->category_nicename;
            		$cat_id = $categoryID->cat_ID;

            		$args = array('post_type'=>'post', 'posts_per_page'=>8);
            		$wp_query = new WP_Query( $args );
            	?>
            	<?php if ($wp_query->have_posts()): ?>

            		<div class="col-md-9">

            		    <div class="col-title" style="border-color: <?php echo esc_attr($nb_cat_color) ?>;"><span style="background-color: <?php echo esc_attr($nb_cat_color) ?>;"><?php echo esc_html($nb_cat_name); ?></span></div>

            		    <div class="row">

            		        <div class="posts-holder bunch">

            		        	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

            		        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

            		            <div class="col-sm-6 col-md-3">
            		                <div class="single">
            		                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
            		                        <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
            		                    </div>
            		                    <div class="post-info">
            		                        <span><?php the_time($newsstand_dateformat); ?></span>
            		                        <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat) ?></span>
            		                    </div>
            		                    <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
            		                    <p><?php echo newsstand_excerpt(80); ?></p>
            		                </div><!-- end of single -->
            		            </div><!-- end of col -->

            		            <?php endwhile; ?>

            		        </div>

            		    </div>
            		</div>

            	<?php endif ?>

            	<?php wp_reset_query(); ?>

            	<?php
            		$is_blogging = get_post_meta( get_the_ID(), 'newsstand_block_snewsblock_blogging', 1, true );
            		if ($is_blogging == 'on') {
            			$args = array('post_type'=>'blog', 'posts_per_page'=>2);
            		} else {
            			$bcat = get_post_meta( get_the_ID(), 'newsstand_block_snewsblock_category', 1, true );
            			$cat_id = $bcat[0];
            			$categoryID = get_category($cat_id);

            			$bcat_color = Taxonomy_MetaData::get( 'category', $categoryID->cat_ID, 'newsstand_cat_color');
            			$bcat_name = $categoryID->category_nicename;

            			$args = array('post_type'=>'post', 'posts_per_page'=>2, 'cat' => $cat_id);
            		}

            		$wp_query = new WP_Query( $args );
            	?>
            	<?php if ($wp_query->have_posts()): ?>
            		<div class="col-md-3 secondcol">
            			<?php if ($is_blogging == 'on'): ?>
            				<div class="col-title" style="border-color: #fddc32;"><span style="background-color: #fddc32;"><?php _e('BLOGGING', 'newsstand'); ?></span></div>
            			<?php else: ?>
            				<div class="col-title" style="border-color: <?php echo esc_attr($bcat_color); ?>;"><span style="background-color: <?php echo esc_attr($bcat_color); ?>;"><?php echo esc_html($bcat_name); ?></span></div>
            			<?php endif ?>

            		    <div class="posts-holder onlytwo">

            		    	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

            		    		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

            		        <div class="single">
            		            <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
            		                <a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a>
            		            </div>
            		            <div class="post-info">
            		                <span><?php the_time($newsstand_dateformat); ?></span>
            		                <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
            		            </div>
            		            <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
            		            <p><?php echo newsstand_excerpt(90); ?></p>
            		        </div><!-- end of single -->

            		        <?php endwhile; ?>

            		    </div>
            		</div>
            	<?php endif ?>

            </div>
        </div>
    </div>
</section>

<?php wp_reset_query(); ?>

<?php
	$args = array( 'post_type' => 'gallery', 'posts_per_page' => 5 );
	$wp_query = new WP_Query( $args );
?>

<?php if ($wp_query->have_posts()): ?>
	<section class="big-gallery-slider">
	    <div class="container">
	        <div class="actual-container">
	            <div class="bgs-slider">
	                <?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	                	<?php
	                	    $gallery_images = get_post_meta( get_the_ID(), 'newsstand_images', 1, true );
	                	    $gi_count = 0;
	                	    foreach ($gallery_images as $image) { $gi_count++; }

	                	    $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	                	    if (empty($thumb_url)) {
	                	        $x=1;
	                	        foreach ($gallery_images as $image) {
	                	            if ($x==1) {
	                	                $thumb_url = $image;
	                	            }
	                	            $x++;
	                	        }
	                	    }
	                	?>
	                	<div class="single" style="background-image: url(<?php echo esc_url($thumb_url); ?>);">
	                	    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                	</div><!-- end of single -->
	                <?php endwhile; ?>
	            </div>
	        </div>
	    </div>
	</section>
<?php endif ?>

<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>